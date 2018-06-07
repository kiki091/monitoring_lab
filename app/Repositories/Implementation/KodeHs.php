<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KodeHs as KodeHsInterface;
use App\Models\KodeHs as KodeHsModel;
use App\Services\Transformation\KodeHs as KodeHsTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KodeHs extends BaseImplementation implements KodeHsInterface
{

    protected $daftarKodeHs;
    protected $daftarKodeHsTransformation;

    function __construct(KodeHsModel $daftarKodeHs, KodeHsTransformation $daftarKodeHsTransformation)
    {

        $this->daftarKodeHs = $daftarKodeHs;
        $this->daftarKodeHsTransformation = $daftarKodeHsTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarKodeHsTransformation->getDataTransform($this->daftarKodeHs($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarKodeHsTransformation->getSingleDataTransform($this->daftarKodeHs($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarKodeHs;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarKodeHs->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_hs  = 'KHS-'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->uraian_komoditas  = isset($params['uraian_komoditas']) ? $params['uraian_komoditas'] : '';
            $eloquent->description_english  = isset($params['description_english']) ? $params['description_english'] : '';

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
    
    protected function daftarKodeHs($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarKodeHs = KodeHsModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarKodeHs = KodeHsModel::where('id', $params['id']);
        }

        if(!$daftarKodeHs->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarKodeHs->get()->toArray();
                } else {
                    return $daftarKodeHs->first()->toArray();
                }
            break;
        }
    }

}