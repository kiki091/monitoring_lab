<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\SampleTumbuhan as SampleTumbuhanInterface;
use App\Models\SampleTumbuhan as SampleTumbuhanModel;
use App\Services\Transformation\SampleTumbuhan as SampleTumbuhanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class SampleTumbuhan extends BaseImplementation implements SampleTumbuhanInterface
{

    protected $sampleTumbuhan;
    protected $sampleTumbuhanTransformation;

    protected $no_permohonan;
    protected $message;

    function __construct(SampleTumbuhanModel $sampleTumbuhan, SampleTumbuhanTransformation $sampleTumbuhanTransformation)
    {

        $this->sampleTumbuhan = $sampleTumbuhan;
        $this->sampleTumbuhanTransformation = $sampleTumbuhanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($param)
    {
    	$params = [
    		'order'	=> 'order',
    	];

    	$sampleTumbuhanData = $this->sampleTumbuhan($params, 'asc', 'array', false);

    	return $this->sampleTumbuhanTransformation->getDataTransform($sampleTumbuhanData);
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
            
            $eloquent = $this->sampleTumbuhan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->sampleTumbuhan->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->kode_sample                  = 'SH-'.rand(1000, 10000);
            $eloquent->nama_sample                  = isset($params['nama_sample']) ? $params['nama_sample'] : '';
            $eloquent->jenis_sample                 = isset($params['jenis_sample']) ? $params['jenis_sample'] : '';
            $eloquent->jml_vol                      = isset($params['jml_vol']) ? $params['jml_vol'] : '';
            $eloquent->nama_komoditas               = isset($params['nama_komoditas']) ? $params['nama_komoditas'] : '';
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

    public function edit($param)
    {
        dd($params);
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function sampleTumbuhan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$sampleTumbuhan = SampleTumbuhanModel::with(['target_pengujian']);

        if(isset($params['id'])) {
            $sampleTumbuhan = SampleTumbuhanModel::where('id', $params['id']);
        }

        if(!$sampleTumbuhan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $sampleTumbuhan->get()->toArray();
                } else {
                    return $sampleTumbuhan->first()->toArray();
                }
            break;
        }
    }

}