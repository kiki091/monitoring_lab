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

    protected $targetPengujian;
    protected $targetPengujianTransformation;

    function __construct(TargetPengujianModel $targetPengujian, TargetPengujianTransformation $targetPengujianTransformation)
    {

        $this->targetPengujian = $targetPengujian;
        $this->targetPengujianTransformation = $targetPengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$targetPengujianData = $this->targetPengujian($params, 'asc', 'array', false);

    	return $this->targetPengujianTransformation->getDataTransform($targetPengujianData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->targetPengujianTransformation->getSingleDataTransform($this->targetPengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->targetPengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->targetPengujian->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->nama_target      = isset($params['nama_target']) ? $params['nama_target'] : '';
            $eloquent->target_hph      = isset($params['target_hph']) ? $params['target_hph'] : '';
            $eloquent->keterangan      = isset($params['keterangan']) ? $params['keterangan'] : '';
            $eloquent->created_at       = Carbon::now();

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
    
    protected function targetPengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$targetPengujian = new TargetPengujianModel;

        if(isset($params['id'])) {
            $targetPengujian = TargetPengujianModel::where('id', $params['id']);
        }

        if(!$targetPengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $targetPengujian->get()->toArray();
                } else {
                    return $targetPengujian->first()->toArray();
                }
            break;
        }
    }

}