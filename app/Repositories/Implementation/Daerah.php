<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Daerah as DaerahInterface;
use App\Models\Daerah as DaerahModel;
use App\Services\Transformation\Daerah as DaerahTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Daerah extends BaseImplementation implements DaerahInterface
{

    protected $daftarDaerah;
    protected $daftarDaerahTransformation;

    function __construct(DaerahModel $daftarDaerah, DaerahTransformation $daftarDaerahTransformation)
    {

        $this->daftarDaerah = $daftarDaerah;
        $this->daftarDaerahTransformation = $daftarDaerahTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$daftarDaerahData = $this->daftarDaerah($params, 'asc', 'array', false);

    	return $this->daftarDaerahTransformation->getDataTransform($daftarDaerahData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarDaerahTransformation->getSingleDataTransform($this->daftarDaerah($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarDaerah;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarDaerah->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_daerah  = 'KD-'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_daerah  = isset($params['nama_daerah']) ? $params['nama_daerah'] : '';
            

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
    
    protected function daftarDaerah($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarDaerah = new DaerahModel;

        if(isset($params['id'])) {
            $daftarDaerah = DaerahModel::where('id', $params['id']);
        }

        if(isset($params['order'])) {
            $daftarDaerah->orderBy($params['order'], $orderType);
        }

        if(!$daftarDaerah->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarDaerah->get()->toArray();
                } else {
                    return $daftarDaerah->first()->toArray();
                }
            break;
        }
    }

}