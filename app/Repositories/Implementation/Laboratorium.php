<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Laboratorium as LaboratoriumInterface;
use App\Models\Laboratorium as LaboratoriumModel;
use App\Services\Transformation\Laboratorium as LaboratoriumTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Laboratorium extends BaseImplementation implements LaboratoriumInterface
{

    protected $daftarLaboratorium;
    protected $daftarLaboratoriumTransformation;

    function __construct(LaboratoriumModel $daftarLaboratorium, LaboratoriumTransformation $daftarLaboratoriumTransformation)
    {

        $this->daftarLaboratorium = $daftarLaboratorium;
        $this->daftarLaboratoriumTransformation = $daftarLaboratoriumTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarLaboratoriumTransformation->getDataTransform($this->daftarLaboratorium($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarLaboratoriumTransformation->getSingleDataTransform($this->daftarLaboratorium($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarLaboratorium;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarLaboratorium->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_laboratorium  = isset($params['nama_laboratorium']) ? $params['nama_laboratorium'] : '';
            

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
    
    protected function daftarLaboratorium($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarLaboratorium = LaboratoriumModel::orderBy('created_at', $orderType);

        if(!empty($params['id'])) {
            $daftarLaboratorium = LaboratoriumModel::where('id', $params['id']);
        }

        if(!$daftarLaboratorium->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarLaboratorium->get()->toArray();
                } else {
                    return $daftarLaboratorium->first()->toArray();
                }
            break;
        }
    }

}