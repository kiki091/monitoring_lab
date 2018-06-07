<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Upt as UptInterface;
use App\Models\Upt as UptModel;
use App\Services\Transformation\Upt as UptTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Upt extends BaseImplementation implements UptInterface
{

    protected $daftarUpt;
    protected $daftarUptTransformation;

    function __construct(UptModel $daftarUpt, UptTransformation $daftarUptTransformation)
    {

        $this->daftarUpt = $daftarUpt;
        $this->daftarUptTransformation = $daftarUptTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$daftarUptData = $this->daftarUpt($params, 'asc', 'array', false);

    	return $this->daftarUptTransformation->getDataTransform($daftarUptData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarUptTransformation->getSingleDataTransform($this->daftarUpt($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarUpt;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarUpt->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_upt  = 'KD-'.rand(100, 1000).'.'.rand(100, 1000).'.'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_upt         = isset($params['nama_upt']) ? $params['nama_upt'] : '';
            $eloquent->daerah_id        = isset($params['daerah_id']) ? $params['daerah_id'] : '';
            $eloquent->jenis_pelabuhan  = isset($params['jenis_pelabuhan']) ? $params['jenis_pelabuhan'] : '';
            

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
    
    protected function daftarUpt($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarUpt = UptModel::with('daerah')->orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarUpt = UptModel::where('id', $params['id']);
        }

        if(!$daftarUpt->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarUpt->get()->toArray();
                } else {
                    return $daftarUpt->first()->toArray();
                }
            break;
        }
    }

}