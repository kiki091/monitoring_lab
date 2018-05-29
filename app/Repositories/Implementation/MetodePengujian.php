<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MetodePengujian as MetodePengujianInterface;
use App\Models\MetodePengujian as MetodePengujianModel;
use App\Services\Transformation\MetodePengujian as MetodePengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MetodePengujian extends BaseImplementation implements MetodePengujianInterface
{

    protected $metodePengujian;
    protected $metodePengujianTransformation;

    function __construct(MetodePengujianModel $metodePengujian, MetodePengujianTransformation $metodePengujianTransformation)
    {

        $this->metodePengujian = $metodePengujian;
        $this->metodePengujianTransformation = $metodePengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$metodePengujianData = $this->metodePengujian($params, 'asc', 'array', false);

    	return $this->metodePengujianTransformation->getDataTransform($metodePengujianData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->metodePengujianTransformation->getSingleDataTransform($this->metodePengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->metodePengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->metodePengujian->find($params['id']);
                $eloquent->updated_at    = Carbon::now();

            }

            $eloquent->nama_kelompok     = isset($params['nama_kelompok']) ? $params['nama_kelompok'] : '';
            $eloquent->target_pengujian_id     = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->laboratorium_id     = isset($params['laboratorium_id']) ? $params['laboratorium_id'] : '';
            $eloquent->kelompok_uji_id     = isset($params['kelompok_uji_id']) ? $params['kelompok_uji_id'] : '1';
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
    
    protected function metodePengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$metodePengujian = MetodePengujianModel::with(['target_pengujian', 'lab', 'kelompok_pengujian']);

        if(isset($params['id'])) {
            $metodePengujian = MetodePengujianModel::where('id', $params['id']);
        }

        if(!$metodePengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $metodePengujian->get()->toArray();
                } else {
                    return $metodePengujian->first()->toArray();
                }
            break;
        }
    }

}