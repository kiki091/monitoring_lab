<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\DaftarPengujian as DaftarPengujianInterface;
use App\Models\DaftarPengujian as DaftarPengujianModel;
use App\Services\Transformation\DaftarPengujian as DaftarPengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class DaftarPengujian extends BaseImplementation implements DaftarPengujianInterface
{

    protected $daftarPengujian;
    protected $daftarPengujianTransformation;

    function __construct(DaftarPengujianModel $daftarPengujian, DaftarPengujianTransformation $daftarPengujianTransformation)
    {

        $this->daftarPengujian = $daftarPengujian;
        $this->daftarPengujianTransformation = $daftarPengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$daftarPengujianData = $this->daftarPengujian($params, 'asc', 'array', false);

    	return $this->daftarPengujianTransformation->getDataTransform($daftarPengujianData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarPengujianTransformation->getSingleDataTransform($this->daftarPengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarPengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->daftarPengujian->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->target_pengujian_id      = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->kode_hph      = isset($params['kode_hph']) ? $params['kode_hph'] : '';
            $eloquent->lama_uji      = isset($params['lama_uji']) ? $params['lama_uji'] : '';
            $eloquent->created_at    = Carbon::now();

            if($eloquent->save())
                return true;
            else
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
    
    protected function daftarPengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarPengujian = $this->daftarPengujian->with('target_pengujian');

        if(isset($params['id'])) {
            $daftarPengujian = DaftarPengujianModel::where('id', $params['id']);
        }

        if(isset($params['order'])) {
            $daftarPengujian->orderBy($params['order'], $orderType);
        }

        if(!$daftarPengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarPengujian->get()->toArray();
                } else {
                    return $daftarPengujian->first()->toArray();
                }
            break;
        }
    }

}