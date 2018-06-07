<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Perusahaan as PerusahaanInterface;
use App\Models\Perusahaan as PerusahaanModel;
use App\Services\Transformation\Perusahaan as PerusahaanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Perusahaan extends BaseImplementation implements PerusahaanInterface
{

    protected $daftarPerusahaan;
    protected $daftarPerusahaanTransformation;

    function __construct(PerusahaanModel $daftarPerusahaan, PerusahaanTransformation $daftarPerusahaanTransformation)
    {

        $this->daftarPerusahaan = $daftarPerusahaan;
        $this->daftarPerusahaanTransformation = $daftarPerusahaanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarPerusahaanTransformation->getDataTransform($this->daftarPerusahaan($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarPerusahaanTransformation->getSingleDataTransform($this->daftarPerusahaan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarPerusahaan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarPerusahaan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_perusahaan  = 'KP-'.rand(100, 1000).'.'.rand(100, 1000);
                $eloquent->created_at       = Carbon::now();
            }

            $eloquent->nama_perusahaan  = isset($params['nama_perusahaan']) ? $params['nama_perusahaan'] : '';
            $eloquent->alamat           = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->no_telpon        = isset($params['no_telpon']) ? $params['no_telpon'] : '';
            $eloquent->contact_person   = isset($params['contact_person']) ? $params['contact_person'] : '';
            

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
    
    protected function daftarPerusahaan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarPerusahaan = PerusahaanModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarPerusahaan = PerusahaanModel::where('id', $params['id']);
        }

        if(!$daftarPerusahaan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarPerusahaan->get()->toArray();
                } else {
                    return $daftarPerusahaan->first()->toArray();
                }
            break;
        }
    }

}