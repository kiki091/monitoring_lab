<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KarantinaTumbuhan as KarantinaTumbuhanInterface;
use App\Models\KarantinaTumbuhan as KarantinaTumbuhanModel;
use App\Services\Transformation\KarantinaTumbuhan as KarantinaTumbuhanTransformation;
use App\Custom\Auth\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KarantinaTumbuhan extends BaseImplementation implements KarantinaTumbuhanInterface
{

    protected $karantinaTumbuhan;
    protected $karantinaTumbuhanTransformation;

    protected $no_permohonan;
    protected $message;

    function __construct(KarantinaTumbuhanModel $karantinaTumbuhan, KarantinaTumbuhanTransformation $karantinaTumbuhanTransformation)
    {

        $this->karantinaTumbuhan = $karantinaTumbuhan;
        $this->karantinaTumbuhanTransformation = $karantinaTumbuhanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$karantinaTumbuhanData = $this->karantinaTumbuhan($params, 'asc', 'array', false);

    	return $this->karantinaTumbuhanTransformation->getDataTransform($karantinaTumbuhanData);
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

            if(!$this->storeData($params)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
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

    protected function generateRequestNumber()
    {
        $obj = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $this->no_permohonan = 'PRM-'.str_shuffle($obj);

        $data = $this->karantinaTumbuhan->where('no_permohonan', $this->no_permohonan)->get()->toArray();

        if(count($data) == 0)
        {
            return true;
        }

        return $this->generateRequestNumber();
    }

    protected function storeData($params)
    {

        try {
            
            $eloquent = $this->karantinaTumbuhan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->karantinaTumbuhan->find($params['id']);
                $eloquent->updated_at    = Carbon::now();
                $eloquent->updated_by    = DataHelper::userId();

            } else {

                if($this->generateRequestNumber() == true)
                {
                    $eloquent->no_permohonan = $this->no_permohonan;
                    $eloquent->user_id       = DataHelper::userId();

                } else {

                    return false;
                }
            }

            $eloquent->tgl_permohonan       = isset($params['tgl_permohonan']) ? $params['tgl_permohonan'] : '';
            $eloquent->upt_id               = isset($params['upt_id']) ? $params['upt_id'] : '';
            $eloquent->kategori_id          = isset($params['kategori_id']) ? $params['kategori_id'] : '';
            $eloquent->kodefikasi_sample    = isset($params['kodefikasi_sample']) ? $params['kodefikasi_sample'] : '';
            $eloquent->dokter_id            = isset($params['dokter_id']) ? $params['dokter_id'] : '';
            $eloquent->kegiatan_id          = isset($params['kegiatan_id']) ? $params['kegiatan_id'] : '';
            $eloquent->kode_area            = isset($params['kode_area']) ? $params['kode_area'] : '';
            $eloquent->perusahaan_id        = isset($params['perusahaan_id']) ? $params['perusahaan_id'] : '';
            $eloquent->lampiran_hsl_uji     = isset($params['lampiran_hsl_uji']) ? $params['lampiran_hsl_uji'] : '';
            $eloquent->pengiriman_sample    = isset($params['pengiriman_sample']) ? $params['pengiriman_sample'] : '';
            $eloquent->nama_pengantar       = isset($params['nama_pengantar']) ? $params['nama_pengantar'] : '';
            $eloquent->tgl_terima_sample    = isset($params['tgl_terima_sample']) ? $params['tgl_terima_sample'] : '';
            $eloquent->nip_petugas_penerima = isset($params['nip_petugas_penerima']) ? $params['nip_petugas_penerima'] : '';

            if(!empty($params['dokument_pendukung'])) {
                $eloquent->dokument_pendukung   = $params['dokument_pendukung']->getClientOriginalName();
            }

            $eloquent->keterangan           = isset($params['keterangan']) ? $params['keterangan'] : '';
            $eloquent->created_at           = Carbon::now();

            if($eloquent->save())
                return true;

            return false;

        } catch (Exception $e) {
            return false;
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

                    $filename = $data['dokument_pendukung']->getClientOriginalName();

                    if (! $data['dokument_pendukung']->move('./upload/document/', $filename)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['brochure']->getErrorMessage();
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
     * Edit Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function edit($params)
    {
        return $this->karantinaTumbuhanTransformation->getSingleDataTransform($this->karantinaTumbuhan($params, 'asc', 'array', true));
    }

    /**
     * Confirm Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function confirm($params)
    {
        try {
            
            if(empty($params['id']) || empty($params['status']))
                return $this->setResponse("Verifikasi gagal", false);

            DB::beginTransaction();

            $oldData = $this->karantinaTumbuhan
                ->where('id', $params['id'])
                ->first()->toArray();

            $updatedData = [
                'status' => $params['status'] ? $params['status'] : '0',
                'saran' => $params['saran'] ? $params['saran'] : '',
                'updated_at' => Carbon::now()
            ];

            $changeStatus = $this->karantinaTumbuhan
                ->where('id', $params['id'])
                ->update($updatedData);

            if($changeStatus) {
                DB::commit();
                
                return $this->setResponse('Success verifikasi data', true);
            }

            DB::rollBack();
            return $this->setResponse('Gagal verifikasi data', false);

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function karantinaTumbuhan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$karantinaTumbuhan = $this->karantinaTumbuhan->with(['kategori', 'upt', 'dokter', 'kegiatan', 'perusahaan', 'sample', 'korfug'])->orderBy('created_at', 'desc');

        if(isset($params['id'])) {
            $karantinaTumbuhan = $this->karantinaTumbuhan->with(['kategori', 'upt', 'dokter', 'kegiatan', 'perusahaan', 'sample', 'korfug'])->where('id', $params['id']);
        }

        if(isset($params['status']) && !empty($params['status'])) {
            $karantinaTumbuhan->where('status', $params['status']);
        }

        if(isset($params['permohonan_id']) && !empty($params['permohonan_id'])) {
            $karantinaTumbuhan = $this->karantinaTumbuhan->with(['kategori', 'upt', 'dokter', 'kegiatan', 'perusahaan', 'sample', 'korfug'])->where('id', $params['permohonan_id']);
        }

        if(!$karantinaTumbuhan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $karantinaTumbuhan->get()->toArray();
                } else {
                    return $karantinaTumbuhan->first()->toArray();
                }
            break;
        }
    }

}