<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Sample as SampleInterface;
use App\Models\Sample as SampleModel;
use App\Services\Transformation\Sample as SampleTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Sample extends BaseImplementation implements SampleInterface
{

    protected $daftarSample;
    protected $daftarSampleTransformation;

    function __construct(SampleModel $daftarSample, SampleTransformation $daftarSampleTransformation)
    {

        $this->daftarSample = $daftarSample;
        $this->daftarSampleTransformation = $daftarSampleTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarSampleTransformation->getDataTransform($this->daftarSample($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarSampleTransformation->getSingleDataTransform($this->daftarSample($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarSample;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarSample->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_sample  = 'KST-'.rand(100, 1000).'.'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_sample                  = isset($params['nama_sample']) ? $params['nama_sample'] : '';
            $eloquent->jenis_sample                 = isset($params['jenis_sample']) ? $params['jenis_sample'] : '';
            $eloquent->jml_vol                      = isset($params['jml_vol']) ? $params['jml_vol'] : '';
            $eloquent->satuan_id                    = isset($params['satuan_id']) ? $params['satuan_id'] : '';
            $eloquent->nama_komoditas               = isset($params['nama_komoditas']) ? $params['nama_komoditas'] : '';
            $eloquent->tgl_pengambilan_sample       = isset($params['tgl_pengambilan_sample']) ? $params['tgl_pengambilan_sample'] : '';
            $eloquent->metode_pengambilan_sample    = isset($params['metode_pengambilan_sample']) ? $params['metode_pengambilan_sample'] : '';
            $eloquent->kondisi_sample               = isset($params['kondisi_sample']) ? $params['kondisi_sample'] : '';
            $eloquent->target_pengujian_id          = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->nama_customer                = isset($params['nama_customer']) ? $params['nama_customer'] : '';
            $eloquent->alamat                       = isset($params['alamat']) ? $params['alamat'] : '';
            

            if($eloquent->save())
                return true;

            return false;


        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get All Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    
    protected function daftarSample($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarSample = SampleModel::with(['satuan','target_pengujian'])->orderBy('created_at', $orderType);

        if(isset($params['id']) && !empty($params['id'])) {
            $daftarSample->where('id', $params['id']);
        }

        if(isset($params['limit_data']) && !empty($params['limit_data'])) {
            $daftarSample->take(1, 20);
        }

        if(isset($params['kode_sample']) && !empty($params['kode_sample'])) {
            $daftarSample->where('kode_sample', 'like', '%'.$params['kode_sample'].'%');
            $daftarSample->orWhere('nama_sample', 'like', '%'.$params['kode_sample'].'%');
        }

        if(!$daftarSample->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarSample->get()->toArray();
                } else {
                    return $daftarSample->first()->toArray();
                }
            break;
        }
    }

}