<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterLaboraorium as MasterLaboraoriumInterface;
use App\Models\MasterLaboraorium as MasterLaboraoriumModel;
use App\Services\Transformation\MasterLaboraorium as MasterLaboraoriumTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterLaboraorium extends BaseImplementation implements MasterLaboraoriumInterface
{

    protected $masterLaboraorium;
    protected $masterLaboraoriumTransformation;

    function __construct(MasterLaboraoriumModel $masterLaboraorium, MasterLaboraoriumTransformation $masterLaboraoriumTransformation)
    {

        $this->masterLaboraorium = $masterLaboraorium;
        $this->masterLaboraoriumTransformation = $masterLaboraoriumTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($data)
    {
    	$params = [
    		'order'	=> 'order',
    	];

    	$masterLaboraoriumData = $this->masterLaboraorium($params, 'asc', 'array', false);

    	return $this->masterLaboraoriumTransformation->getDataTransform($masterLaboraoriumData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->masterLaboraoriumTransformation->getSingleDataTransform($this->masterLaboraorium($params, 'asc', 'array', true));
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
            
            $eloquent = $this->masterLaboraorium;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->masterLaboraorium->find($params['id']);

            }

            $eloquent->nama_laboratorium      = isset($params['nama_laboratorium']) ? $params['nama_laboratorium'] : '';

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
    
    protected function masterLaboraorium($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$masterLaboraorium = new MasterLaboraoriumModel;

        if(isset($params['id']) && !empty($params['id'])) {
            $masterLaboraorium =  MasterLaboraoriumModel::where('id', $params['id']);
        }

        if(!$masterLaboraorium->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $masterLaboraorium->get()->toArray();
                } else {
                    return $masterLaboraorium->first()->toArray();
                }
            break;
        }
    }

}