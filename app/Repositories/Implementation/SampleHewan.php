<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\SampleHewan as SampleHewanInterface;
use App\Models\SampleHewan as SampleHewanModel;
use App\Services\Transformation\SampleHewan as SampleHewanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class SampleHewan extends BaseImplementation implements SampleHewanInterface
{

    protected $sampleHewan;
    protected $sampleHewanTransformation;

    protected $no_permohonan;
    protected $message;

    function __construct(SampleHewanModel $sampleHewan, SampleHewanTransformation $sampleHewanTransformation)
    {

        $this->sampleHewan = $sampleHewan;
        $this->sampleHewanTransformation = $sampleHewanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$sampleHewanData = $this->sampleHewan($params, 'asc', 'array', false);

    	return $this->sampleHewanTransformation->getDataTransform($sampleHewanData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function store($param)
    {
        try {
            
            DB::beginTransaction();

            if(!$this->storeData($param)) {
                DB::rollBack();
                return $this->setResponse("Failed save data", false);
            }

            DB::commit();
            return $this->setResponse("Success save data", true);

        } catch (Exception $e) {
            DB::rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    protected function storeData($params)
    {

        try {
            
            $eloquent = $this->sampleHewan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->sampleHewan->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->kode_sample                  = 'SH-'.rand(1000, 10000);
            $eloquent->nama_sample                  = isset($params['nama_sample']) ? $params['nama_sample'] : '';
            $eloquent->jenis_sample                 = isset($params['jenis_sample']) ? $params['jenis_sample'] : '';
            $eloquent->jml_vol                      = isset($params['jml_vol']) ? $params['jml_vol'] : '';
            $eloquent->tgl_pengambilan_sample       = isset($params['tgl_pengambilan_sample']) ? $params['tgl_pengambilan_sample'] : '';
            $eloquent->metode_pengambilan_sample    = isset($params['metode_pengambilan_sample']) ? $params['metode_pengambilan_sample'] : '';
            $eloquent->kondisi_sample               = isset($params['kondisi_sample']) ? $params['kondisi_sample'] : '';
            $eloquent->satuan                       = isset($params['satuan']) ? $params['satuan'] : '';
            $eloquent->target_pengujian_id          = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->nama_customer                = isset($params['nama_customer']) ? $params['nama_customer'] : '';
            $eloquent->alamat                       = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->created_at                   = Carbon::now();

            return $eloquent->save();

        } catch (Exception $e) {
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

        return $this->sampleHewanTransformation->getSingleDataTransform($this->sampleHewan($params, 'asc', 'array', true));
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function sampleHewan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$sampleHewan = SampleHewanModel::with(['target_pengujian']);

        if(isset($params['id'])) {
            $sampleHewan = SampleHewanModel::where('id', $params['id']);
        }

        if(!$sampleHewan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $sampleHewan->get()->toArray();
                } else {
                    return $sampleHewan->first()->toArray();
                }
            break;
        }
    }

}