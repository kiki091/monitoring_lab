<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\TargetPengujian as TargetPengujianInterface;
use App\Models\TargetPengujian as TargetPengujianModel;
use App\Services\Transformation\TargetPengujian as TargetPengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class TargetPengujian extends BaseImplementation implements TargetPengujianInterface
{

    protected $daftarTargetPengujian;
    protected $daftarTargetPengujianTransformation;

    function __construct(TargetPengujianModel $daftarTargetPengujian, TargetPengujianTransformation $daftarTargetPengujianTransformation)
    {

        $this->daftarTargetPengujian = $daftarTargetPengujian;
        $this->daftarTargetPengujianTransformation = $daftarTargetPengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarTargetPengujianTransformation->getDataTransform($this->daftarTargetPengujian($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarTargetPengujianTransformation->getSingleDataTransform($this->daftarTargetPengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarTargetPengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarTargetPengujian->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_target_pengujian  = isset($params['nama_target_pengujian']) ? $params['nama_target_pengujian'] : '';
            

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
    
    protected function daftarTargetPengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarTargetPengujian = TargetPengujianModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarTargetPengujian = TargetPengujianModel::where('id', $params['id']);
        }

        if(!$daftarTargetPengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarTargetPengujian->get()->toArray();
                } else {
                    return $daftarTargetPengujian->first()->toArray();
                }
            break;
        }
    }

}