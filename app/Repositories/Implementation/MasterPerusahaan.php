<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterPerusahaan as MasterPerusahaanInterface;
use App\Models\MasterPerusahaan as MasterPerusahaanModel;
use App\Services\Transformation\MasterPerusahaan as MasterPerusahaanTransformation;
use App\Custom\Facades\DataHelper;

use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterPerusahaan extends BaseImplementation implements MasterPerusahaanInterface
{

    protected $perusahaan;
    protected $perusahaanTransformation;

    function __construct(MasterPerusahaanModel $perusahaan, MasterPerusahaanTransformation $perusahaanTransformation)
    {

        $this->perusahaan = $perusahaan;
        $this->perusahaanTransformation = $perusahaanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$perusahaanData = $this->perusahaan($params, 'asc', 'array', false);

    	return $this->perusahaanTransformation->getDataTransform($perusahaanData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->perusahaanTransformation->getSingleDataTransform($this->perusahaan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->perusahaan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->perusahaan->find($params['id']);

            }

            $eloquent->kode_perusahaan      = 'KP-'.rand(1000, 10000);
            $eloquent->nama_perusahaan      = isset($params['nama_perusahaan']) ? $params['nama_perusahaan'] : '';
            $eloquent->alamat               = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->no_telpon            = isset($params['no_telpon']) ? $params['no_telpon'] : '';

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
    
    protected function perusahaan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$perusahaan = new MasterPerusahaanModel;

        if(isset($params['id'])) {
            $perusahaan = MasterPerusahaanModel::where('id', $params['id']);
        }

        if(!$perusahaan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $perusahaan->get()->toArray();
                } else {
                    return $perusahaan->first()->toArray();
                }
            break;
        }
    }

}