<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KarantinaHewan as KarantinaHewanInterface;
use App\Models\KarantinaHewan as KarantinaHewanModel;
use App\Services\Transformation\KarantinaHewan as KarantinaHewanTransformation;
use App\Custom\Auth\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KarantinaHewan extends BaseImplementation implements KarantinaHewanInterface
{

    protected $karantinaHewan;
    protected $karantinaHewanTransformation;

    protected $no_permohonan;
    protected $message;

    function __construct(KarantinaHewanModel $karantinaHewan, KarantinaHewanTransformation $karantinaHewanTransformation)
    {

        $this->karantinaHewan = $karantinaHewan;
        $this->karantinaHewanTransformation = $karantinaHewanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$karantinaHewanData = $this->karantinaHewan($params, 'asc', 'array', false);

    	return $this->karantinaHewanTransformation->getDataTransform($karantinaHewanData);
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
        $this->no_permohonan = 'KRNT-H-'.Carbon::now()->format('Y').'/'.Carbon::now()->format('m').'/'.Carbon::now()->format('d').'/'.rand(1000, 100000);

        $data = $this->karantinaHewan->where('no_permohonan', $this->no_permohonan)->get()->toArray();

        if(count($data) == 0)
        {
            return true;
        }

        return $this->generateRequestNumber();
    }

    protected function storeData($params)
    {

        try {
            
            $eloquent = $this->karantinaHewan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->karantinaHewan->find($params['id']);
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

            $eloquent->tgl_permohonan             = isset($params['tgl_permohonan']) ? $params['tgl_permohonan'] : '';
            $eloquent->kode_sample_hewan_id       = isset($params['kode_sample_hewan_id']) ? $params['kode_sample_hewan_id'] : '';
            $eloquent->dokter_hewan_id            = isset($params['dokter_hewan_id']) ? $params['dokter_hewan_id'] : '';
            $eloquent->kegiatan_id                = isset($params['kegiatan_id']) ? $params['kegiatan_id'] : '';
            $eloquent->negara_id                  = isset($params['negara_id']) ? $params['negara_id'] : '';
            $eloquent->nama_pemilik               = isset($params['nama_pemilik']) ? $params['nama_pemilik'] : '';
            $eloquent->lampiran_hasil_uji         = isset($params['lampiran_hasil_uji']) ? $params['lampiran_hasil_uji'] : '';
            $eloquent->pengiriman_sample          = isset($params['pengiriman_sample']) ? $params['pengiriman_sample'] : '';
            $eloquent->nama_pengirim              = isset($params['nama_pengirim']) ? $params['nama_pengirim'] : '';
            $eloquent->tgl_terima_sample          = isset($params['tgl_terima_sample']) ? $params['tgl_terima_sample'] : '';
            $eloquent->nip_petugas_penerima       = isset($params['nip_petugas_penerima']) ? $params['nip_petugas_penerima'] : '';

            if(!empty($params['dokument_pendukung'])) {
                $eloquent->dokument_pendukung     = $params['dokument_pendukung']->getClientOriginalName();
            }

            $eloquent->keterangan                 = isset($params['keterangan']) ? $params['keterangan'] : '';
            $eloquent->saran                      = isset($params['saran']) ? $params['saran'] : '';
            $eloquent->created_at                 = Carbon::now();

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
        return $this->karantinaHewanTransformation->getSingleDataTransform($this->karantinaHewan($params, 'asc', 'array', true));
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

            $oldData = $this->karantinaHewan
                ->where('id', $params['id'])
                ->first()->toArray();

            $updatedData = [
                'status' => $params['status'] ? $params['status'] : '0',
                'saran' => $params['saran'] ? $params['saran'] : '',
                'updated_at' => Carbon::now()
            ];

            $changeStatus = $this->karantinaHewan
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
    
    protected function karantinaHewan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$karantinaHewan = $this->karantinaHewan->with(['dokter', 'kegiatan', 'sample'])->orderBy('created_at', 'desc')->where('user_id', DataHelper::userId());

        if(isset($params['id']) && !empty($params['id'])) {
            $karantinaHewan = $this->karantinaHewan->with(['dokter', 'kegiatan', 'sample'])->where('id', $params['id']);
        }

        if(isset($params['status']) && !empty($params['status'])) {
            // $karantinaHewan->where('status', $params['status']);
        }

        if(isset($params['permohonan_id']) && !empty($params['permohonan_id'])) {
            $karantinaHewan = $this->karantinaHewan->with(['dokter', 'kegiatan', 'sample'])->where('id', $params['permohonan_id']);
        }

        if(!$karantinaHewan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $karantinaHewan->get()->toArray();
                } else {
                    return $karantinaHewan->first()->toArray();
                }
            break;
        }
    }

}