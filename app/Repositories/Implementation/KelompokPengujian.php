<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KelompokPengujian as KelompokPengujianInterface;
use App\Models\KelompokPengujian as KelompokPengujianModel;
use App\Services\Transformation\KelompokPengujian as KelompokPengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KelompokPengujian extends BaseImplementation implements KelompokPengujianInterface
{

    protected $kelompokPengujian;
    protected $kelompokPengujianTransformation;

    function __construct(KelompokPengujianModel $kelompokPengujian, KelompokPengujianTransformation $kelompokPengujianTransformation)
    {

        $this->kelompokPengujian = $kelompokPengujian;
        $this->kelompokPengujianTransformation = $kelompokPengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$kelompokPengujianData = $this->kelompokPengujian($params, 'asc', 'array', false);

    	return $this->kelompokPengujianTransformation->getDataTransform($kelompokPengujianData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->kelompokPengujianTransformation->getSingleDataTransform($this->kelompokPengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->kelompokPengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->kelompokPengujian->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->nama_kelompok     = isset($params['nama_kelompok']) ? $params['nama_kelompok'] : '';
            $eloquent->created_at        = Carbon::now();

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
    
    protected function kelompokPengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$kelompokPengujian = new KelompokPengujianModel;

        if(isset($params['id'])) {
            $kelompokPengujian = KelompokPengujianModel::where('id', $params['id']);
        }

        if(!$kelompokPengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $kelompokPengujian->get()->toArray();
                } else {
                    return $kelompokPengujian->first()->toArray();
                }
            break;
        }
    }

}