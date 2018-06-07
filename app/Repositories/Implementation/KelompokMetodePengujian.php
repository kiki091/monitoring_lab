<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KelompokMetodePengujian as KelompokMetodePengujianInterface;
use App\Models\KelompokMetodePengujian as KelompokMetodePengujianModel;
use App\Services\Transformation\KelompokMetodePengujian as KelompokMetodePengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KelompokMetodePengujian extends BaseImplementation implements KelompokMetodePengujianInterface
{

    protected $daftarKelompokMetodePengujian;
    protected $daftarKelompokMetodePengujianTransformation;

    function __construct(KelompokMetodePengujianModel $daftarKelompokMetodePengujian, KelompokMetodePengujianTransformation $daftarKelompokMetodePengujianTransformation)
    {

        $this->daftarKelompokMetodePengujian = $daftarKelompokMetodePengujian;
        $this->daftarKelompokMetodePengujianTransformation = $daftarKelompokMetodePengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarKelompokMetodePengujianTransformation->getDataTransform($this->daftarKelompokMetodePengujian($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarKelompokMetodePengujianTransformation->getSingleDataTransform($this->daftarKelompokMetodePengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarKelompokMetodePengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarKelompokMetodePengujian->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_kelompok  = 'KMP-'.rand(100, 1000);
                $eloquent->created_at     = Carbon::now();
            }

            $eloquent->nama_kelompok      = isset($params['nama_kelompok']) ? $params['nama_kelompok'] : '';
            

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
    
    protected function daftarKelompokMetodePengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarKelompokMetodePengujian = KelompokMetodePengujianModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarKelompokMetodePengujian = KelompokMetodePengujianModel::where('id', $params['id']);
        }

        if(!$daftarKelompokMetodePengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarKelompokMetodePengujian->get()->toArray();
                } else {
                    return $daftarKelompokMetodePengujian->first()->toArray();
                }
            break;
        }
    }

}