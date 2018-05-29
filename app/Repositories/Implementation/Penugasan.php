<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Penugasan as PenugasanInterface;
use App\Models\Penugasan as PenugasanModel;
use App\Services\Transformation\Penugasan as PenugasanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Penugasan extends BaseImplementation implements PenugasanInterface
{

    protected $penugasan;
    protected $penugasanTransformation;

    function __construct(PenugasanModel $penugasan, PenugasanTransformation $penugasanTransformation)
    {

        $this->penugasan = $penugasan;
        $this->penugasanTransformation = $penugasanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$penugasanData = $this->penugasan($params, 'asc', 'array', false);

    	return $this->penugasanTransformation->getDataTransform($penugasanData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->penugasanTransformation->getSingleDataTransform($this->penugasan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->penugasan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->penugasan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();
            }

            $eloquent->no_surat                 = 'SP-'.rand(1000, 100000);
            $eloquent->target_uji_id            = isset($params['target_uji_id']) ? $params['target_uji_id'] : '';
            $eloquent->kedudukan                = isset($params['kedudukan']) ? $params['kedudukan'] : '';
            $eloquent->karantina_tumbuhan_id    = isset($params['karantina_tumbuhan_id']) ? $params['karantina_tumbuhan_id'] : '';
            $eloquent->created_at               = Carbon::now();

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
    
    protected function penugasan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$penugasan = PenugasanModel::with(['target_pengujian', 'karantina']);

        if(isset($params['id'])) {
            $penugasan = PenugasanModel::where('id', $params['id']);
        }

        if(!$penugasan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $penugasan->get()->toArray();
                } else {
                    return $penugasan->first()->toArray();
                }
            break;
        }
    }

}