<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Permohonan as PermohonanInterface;
use App\Models\Sample as SampleModel;
use App\Models\Permohonan as PermohonanModel;
use App\Models\SamplePermohonan as SamplePermohonanModel;
use App\Services\Transformation\Permohonan as PermohonanTransformation;
use App\Custom\Facades\DataHelper;

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
    protected $daftarSample;
    protected $daftarPermohonan;
    protected $daftarSamplePermohonan;
    protected $daftarPermohonanTransformation;

    function __construct(SampleModel $daftarSample, SamplePermohonanModel $daftarSamplePermohonan, PermohonanModel $daftarPermohonan, PermohonanTransformation $daftarPermohonanTransformation)
    {

        $this->daftarSample = $daftarSample;
        $this->daftarPermohonan = $daftarPermohonan;
        $this->daftarSamplePermohonan = $daftarSamplePermohonan;
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

            if(!$this->storeDataSample($params)) {
                DB::rollBack();
                return $this->setResponse("Failed save data", false);
            }

            if(!$this->storeDataSamplePermohonan($params)) {
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
            }

            $eloquentPermohonan->dokter_hewan_id      = isset($params['dokter_hewan_id']) ? $params['dokter_hewan_id'] : '';
            $eloquentPermohonan->kegiatan_id          = isset($params['kegiatan_id']) ? $params['kegiatan_id'] : '';
            $eloquentPermohonan->upt_id               = isset($params['upt_id']) ? $params['upt_id'] : '';
            $eloquentPermohonan->daerah_id            = isset($params['daerah_id']) ? $params['daerah_id'] : '';
            $eloquentPermohonan->negara_id            = isset($params['negara_id']) ? $params['negara_id'] : '';
            $eloquentPermohonan->type_permohonan      = isset($params['type_permohonan']) ? $params['type_permohonan'] : '';
            $eloquentPermohonan->nama_pemilik         = isset($params['nama_pemilik']) ? $params['nama_pemilik'] : '';
            $eloquentPermohonan->alamat_pemilik       = isset($params['alamat_pemilik']) ? $params['alamat_pemilik'] : '';
            $eloquentPermohonan->lampiran_hasil_uji   = isset($params['lampiran_hasil_uji']) ? $params['lampiran_hasil_uji'] : '';
            $eloquentPermohonan->pengiriman_sample    = isset($params['pengiriman_sample']) ? $params['pengiriman_sample'] : '';
            $eloquentPermohonan->nama_pengirim        = isset($params['nama_pengirim']) ? $params['nama_pengirim'] : '';
            $eloquentPermohonan->tgl_terima_sample    = isset($params['tgl_terima_sample']) ? $params['tgl_terima_sample'] : '';
            $eloquentPermohonan->nip_petugas_penerima = isset($params['nip_petugas_penerima']) ? $params['nip_petugas_penerima'] : '';

            if(isset($params['dokument_pendukung']) && !empty($params['dokument_pendukung'])) {

                $eloquentPermohonan->dokument_pendukung   = strtolower(str_slug($params['dokument_pendukung']->getClientOriginalName()));
            }

            if($eloquentPermohonan->save()) {
                $eloquentPermohonan->id = $this->permohonanId;
                return true;
            }

            return false;


        } catch (Exception $e) {
            return false;
        }
    }

    protected function storeDataSample($params)
    {

        try {
            
            

        } catch (Exception $e) {
            return false;
        }
    }

    protected function storeDataSamplePermohonan($params)
    {

        try {

            

        } catch (Exception $e) {
            
        }
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
    	$daftarPermohonan = new PermohonanModel;

        if(isset($params['id'])) {
            $daftarPermohonan = PermohonanModel::where('id', $params['id']);
        }

        if(isset($params['order'])) {
            $daftarPermohonan->orderBy($params['order'], $orderType);
        }

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