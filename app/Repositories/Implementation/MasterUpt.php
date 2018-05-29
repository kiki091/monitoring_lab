<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterUpt as MasterUptInterface;
use App\Models\MasterUpt as MasterUptModel;
use App\Services\Transformation\MasterUpt as MasterUptTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterUpt extends BaseImplementation implements MasterUptInterface
{

    protected $masterUptServices;
    protected $masterUptServicesTransformation;

    function __construct(MasterUptModel $masterUptServices, MasterUptTransformation $masterUptServicesTransformation)
    {

        $this->masterUptServices = $masterUptServices;
        $this->masterUptServicesTransformation = $masterUptServicesTransformation;
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

    	$masterUptServicesData = $this->masterUptServices($params, 'asc', 'array', false);

    	return $this->masterUptServicesTransformation->getDataTransform($masterUptServicesData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        
        return $this->masterUptServicesTransformation->getSingleDataTransform($this->masterUptServices($params, 'asc', 'array', true));
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
            
            $eloquent = $this->masterUptServices;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->masterUptServices->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->kode_upt      = "U-".rand(10, 1000);
            $eloquent->nama_upt      = isset($params['nama_upt']) ? $params['nama_upt'] : '';
            $eloquent->kelas_upt     = isset($params['kelas_upt']) ? $params['kelas_upt'] : '';
            $eloquent->lab_id        = isset($params['lab_id']) ? $params['lab_id'] : '';
            $eloquent->jns_pelabuhan = isset($params['jns_pelabuhan']) ? $params['jns_pelabuhan'] : '';
            $eloquent->daerah_id     = isset($params['daerah_id']) ? $params['daerah_id'] : '';
            $eloquent->alamat        = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->no_tlp        = isset($params['no_tlp']) ? $params['no_tlp'] : '';
            $eloquent->no_fax        = isset($params['no_fax']) ? $params['no_fax'] : '';
            $eloquent->email         = isset($params['email']) ? $params['email'] : '';
            $eloquent->created_at    = Carbon::now();

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
    
    protected function masterUptServices($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$masterUptServices = MasterUptModel::with(['lab', 'daerah']);

        if(isset($params['id']) && !empty($params['id'])) {
            $masterUptServices =  MasterUptModel::where('id', $params['id']);
        }

        if(!$masterUptServices->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $masterUptServices->get()->toArray();
                } else {
                    return $masterUptServices->first()->toArray();
                }
            break;
        }
    }

}