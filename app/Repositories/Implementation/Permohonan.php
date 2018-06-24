<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Permohonan as PermohonanInterface;
use App\Models\PermohonanPengujian as PermohonanPengujianModel;
use App\Models\Permohonan as PermohonanModel;
use App\Models\SamplePermohonan as SamplePermohonanModel;
use App\Services\Transformation\Permohonan as PermohonanTransformation;
use App\Custom\Auth\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Permohonan extends BaseImplementation implements PermohonanInterface
{

    protected $permohonanId;
    protected $sampleId;
    protected $daftarPermohonan;
    protected $daftarSamplePermohonan;
    protected $daftarPermohonanPengujian;
    protected $daftarPermohonanTransformation;

    function __construct(PermohonanPengujianModel $daftarPermohonanPengujian, SamplePermohonanModel $daftarSamplePermohonan, PermohonanModel $daftarPermohonan, PermohonanTransformation $daftarPermohonanTransformation)
    {

        $this->daftarPermohonan = $daftarPermohonan;
        $this->daftarSamplePermohonan = $daftarSamplePermohonan;
        $this->daftarPermohonanPengujian = $daftarPermohonanPengujian;
        $this->daftarPermohonanTransformation = $daftarPermohonanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$daftarPermohonanData = $this->daftarPermohonan($params, 'asc', 'array', false);

    	return $this->daftarPermohonanTransformation->getDataTransform($daftarPermohonanData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarPermohonanTransformation->getSingleDataTransform($this->daftarPermohonan($params, 'asc', 'array', true));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function store($params)
    {
        try {

            DB::beginTransaction();

            if(!$this->storeDataPermohonan($params)) {
                DB::rollBack();
                return $this->setResponse("Failed save data", false);
            }

            if(!$this->storeDataSamplePermohonan($params)) {
                DB::rollBack();
                return $this->setResponse("Failed save data", false);
            }

            if(!$this->storeDataPermohonanPengujian($params)) {
                DB::rollBack();
                return $this->setResponse("Failed save data", false);
            }

            if (!$this->uploadFile($params)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse("Success save data", true);
            
        } catch (Exception $e) {
            DB::rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    protected function storeDataPermohonan($params)
    {
        try {
            
            $eloquentPermohonan = $this->daftarPermohonan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquentPermohonan = $this->daftarPermohonan->find($params['id']);
                $eloquentPermohonan->updated_at  = Carbon::now();

            } else {
                
                $eloquentPermohonan->no_agenda        = rand(10000, 100000).'/'.rand(10000, 100000).'/'.Carbon::now()->format('m').'/'.Carbon::now()->format('Y');
                $eloquentPermohonan->no_permohonan    = rand(10000, 100000).'.'.rand(10000, 100000).'.'.rand(10000, 100000);
                $eloquentPermohonan->tgl_permohonan   = Carbon::now()->format('Y-m-d');
                $eloquentPermohonan->created_at       = Carbon::now();
                $eloquentPermohonan->user_id          = DataHelper::userId();
            }

            $eloquentPermohonan->dokter_hewan_id      = isset($params['dokter_hewan_id']) ? $params['dokter_hewan_id'] : '';
            $eloquentPermohonan->kategori_uji_id      = isset($params['kategori_uji_id']) ? $params['kategori_uji_id'] : '';
            $eloquentPermohonan->kegiatan_id          = isset($params['kegiatan_id']) ? $params['kegiatan_id'] : '';
            $eloquentPermohonan->upt_id               = isset($params['upt_id']) ? $params['upt_id'] : '0';
            $eloquentPermohonan->daerah_id            = isset($params['daerah_id']) ? $params['daerah_id'] : '0';
            $eloquentPermohonan->negara_id            = isset($params['negara_id']) ? $params['negara_id'] : '0';
            $eloquentPermohonan->perusahaan_id        = isset($params['perusahaan_id']) ? $params['perusahaan_id'] : '0';
            $eloquentPermohonan->type_permohonan      = isset($params['type_permohonan']) ? $params['type_permohonan'] : '';
            $eloquentPermohonan->nama_pemilik         = isset($params['nama_pemilik']) ? $params['nama_pemilik'] : '';
            $eloquentPermohonan->alamat_pemilik       = isset($params['alamat_pemilik']) ? $params['alamat_pemilik'] : '';
            $eloquentPermohonan->lampiran_hasil_uji   = isset($params['lampiran_hasil_uji']) ? $params['lampiran_hasil_uji'] : '';
            $eloquentPermohonan->pengiriman_sample    = isset($params['pengiriman_sample']) ? $params['pengiriman_sample'] : '';
            $eloquentPermohonan->nama_pengirim        = isset($params['nama_pengirim']) ? $params['nama_pengirim'] : '';
            $eloquentPermohonan->tgl_terima_sample    = isset($params['tgl_terima_sample']) ? $params['tgl_terima_sample'] : '';
            $eloquentPermohonan->nip_petugas_penerima = isset($params['nip_petugas_penerima']) ? $params['nip_petugas_penerima'] : '';

            if(isset($params['dokument_pendukung']) && !empty($params['dokument_pendukung'])) {

                $eloquentPermohonan->dokument_pendukung   = $params['dokument_pendukung']->getClientOriginalName();
            }

            if($eloquentPermohonan->save()) {
                $this->permohonanId = $eloquentPermohonan->id;
                return true;
            }

            return false;


        } catch (Exception $e) {
            return false;
        }
    }

    protected function storeDataSamplePermohonan($params)
    {

        try {

            if(!empty($params['id']))
                $this->removeDataSamplePermohonan($params['id']);

            foreach ($params['sample_id'] as $key => $value) {
                $objData[] = [
                    'sample_id'     => $value,
                    'permohonan_id' => $this->permohonanId,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];
            }

            if($saved = $this->daftarSamplePermohonan->insert($objData))
                return true;

            return false;

        } catch (Exception $e) {
            return false;
        }
    }

    protected function storeDataPermohonanPengujian($params)
    {

        try {

            if(!empty($params['id']))
                $this->removeDataPermohonanPengujian($params['id']);

            $store = $this->daftarPermohonanPengujian;

            $store->permohonan_id               = $this->permohonanId;
            $store->target_uji_golongan_id      = isset($params['target_uji_golongan_id']) ? $params['target_uji_golongan_id'] : '';
            $store->target_pest_id              = isset($params['target_pest_id']) ? $params['target_pest_id'] : '';
            $store->lama_uji                    = isset($params['lama_uji']) ? $params['lama_uji'] : '';
            $store->created_at                  = Carbon::now();
            $store->updated_at                  = Carbon::now();

            if($store->save())
                return true;

            return false;

        } catch (Exception $e) {
            return false;
        }
    }

    protected function removeDataSamplePermohonan($permohonan_id)
    {
        if(empty($permohonan_id))
            return false;

        $this->daftarSamplePermohonan->where('permohonan_id', $permohonan_id)->delete();
    }

    protected function removeDataPermohonanPengujian($permohonan_id)
    {
        if(empty($permohonan_id))
            return false;

        $this->daftarPermohonanPengujian->where('permohonan_id', $permohonan_id)->delete();
    }

    /**
     * Upload Desktop Images
     * @param $data
     * @return true
     */

    protected function uploadFile($data)
    {
        try {

            if (isset($data['dokument_pendukung']) && !empty($data['dokument_pendukung']))
            {
                if ($data['dokument_pendukung']->isValid()) {

                    $filename = strtolower(str_slug($data['dokument_pendukung']->getClientOriginalName()));

                    if (! $data['dokument_pendukung']->move('./file/dokument_pendukung/permohonan/', $filename)) {
                        $this->message = 'Failed upload dokument pendukung';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['dokument_pendukung']->getErrorMessage();
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function daftarPermohonan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarPermohonan = $this->daftarPermohonan->with(['dokter_hewan', 'kegiatan', 'sample_permohonan', 'sample_permohonan.sample', 'kategori', 'permohonan_pengujian', 'upt', 'daerah', 'negara', 'perusahaan'])->orderBy('tgl_permohonan', 'desc');

        if(isset($params['status'])) 
            $daftarPermohonan->where('status', $params['status']);

        if(isset($params['type_permohonan'])) 
            $daftarPermohonan->where('type_permohonan', $params['type_permohonan']);
        
        if(isset($params['upt_id'])) 
            $daftarPermohonan->where('upt_id', $params['upt_id']);
        
        if(isset($params['negara_id'])) 
            $daftarPermohonan->where('negara_id', $params['negara_id']);
        
        if(isset($params['perusahaan_id'])) 
            $daftarPermohonan->where('perusahaan_id', $params['perusahaan_id']);
        
        if(isset($params['daerah_id'])) 
            $daftarPermohonan->where('daerah_id', $params['daerah_id']);
        
        if(isset($params['tgl_permohonan'])) 
            $daftarPermohonan->where('tgl_permohonan', $params['tgl_permohonan']);
        
        if(isset($params['no_permohonan'])) 
            $daftarPermohonan->where('no_permohonan', 'like', '%'.$params['no_permohonan'].'%');

        if(isset($params['id'])) 
            $daftarPermohonan->where('id', $params['id']);
        

        if(DataHelper::userLevel() == 'admin')
            $daftarPermohonan->where('user_id', DataHelper::userId());

        if(!$daftarPermohonan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarPermohonan->get()->toArray();
                } else {
                    return $daftarPermohonan->first()->toArray();
                }
            break;
        }
    }

}