<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\TargetPest as TargetPestInterface;
use App\Models\TargetPest as TargetPestModel;
use App\Services\Transformation\TargetPest as TargetPestTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class TargetPest extends BaseImplementation implements TargetPestInterface
{

    protected $daftarTargetPest;
    protected $daftarTargetPestTransformation;

    function __construct(TargetPestModel $daftarTargetPest, TargetPestTransformation $daftarTargetPestTransformation)
    {

        $this->daftarTargetPest = $daftarTargetPest;
        $this->daftarTargetPestTransformation = $daftarTargetPestTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarTargetPestTransformation->getDataTransform($this->daftarTargetPest($params, 'asc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarTargetPestTransformation->getSingleDataTransform($this->daftarTargetPest($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarTargetPest;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarTargetPest->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_target_pest  = 'KTP-'.rand(100, 1000);
                $eloquent->created_at        = Carbon::now();
            }

            $eloquent->nama_target_hph       = isset($params['nama_target_hph']) ? $params['nama_target_hph'] : '';
            $eloquent->target_pengujian_id   = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            

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
    
    protected function daftarTargetPest($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarTargetPest = TargetPestModel::with('target_pengujian');

        if(isset($params['id'])) {
            $daftarTargetPest = TargetPestModel::where('id', $params['id'])->orderBy('created_at', $orderType);
        }

        if(!$daftarTargetPest->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarTargetPest->get()->toArray();
                } else {
                    return $daftarTargetPest->first()->toArray();
                }
            break;
        }
    }

}