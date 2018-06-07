<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MetodePengujian as MetodePengujianInterface;
use App\Models\MetodePengujian as MetodePengujianModel;
use App\Services\Transformation\MetodePengujian as MetodePengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MetodePengujian extends BaseImplementation implements MetodePengujianInterface
{

    protected $daftarMetodePengujian;
    protected $daftarMetodePengujianTransformation;

    function __construct(MetodePengujianModel $daftarMetodePengujian, MetodePengujianTransformation $daftarMetodePengujianTransformation)
    {

        $this->daftarMetodePengujian = $daftarMetodePengujian;
        $this->daftarMetodePengujianTransformation = $daftarMetodePengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarMetodePengujianTransformation->getDataTransform($this->daftarMetodePengujian($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarMetodePengujianTransformation->getSingleDataTransform($this->daftarMetodePengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarMetodePengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarMetodePengujian->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_metode_pengujian            = isset($params['nama_metode_pengujian']) ? $params['nama_metode_pengujian'] : '';
            $eloquent->target_pengujian_id              = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->laboratorium_id                  = isset($params['laboratorium_id']) ? $params['laboratorium_id'] : '';
            $eloquent->kelompok_metode_pengujian_id     = isset($params['kelompok_metode_pengujian_id']) ? $params['kelompok_metode_pengujian_id'] : '';
            

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
    
    protected function daftarMetodePengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarMetodePengujian = $this->daftarMetodePengujian->with(['target_pengujian','laboratorium','kelompok_metode_pengujian'])->orderBy('created_at', $orderType);

        if(!empty($params['id'])) {
            $daftarMetodePengujian->where('id', $params['id']);
        }

        if(!$daftarMetodePengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarMetodePengujian->get()->toArray();
                } else {
                    return $daftarMetodePengujian->first()->toArray();
                }
            break;
        }
    }

}