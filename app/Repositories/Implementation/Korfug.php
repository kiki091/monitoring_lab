<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Korfug as KorfugInterface;
use App\Models\Korfug as KorfugModel;
use App\Services\Transformation\Korfug as KorfugTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Korfug extends BaseImplementation implements KorfugInterface
{

    protected $korfug;
    protected $korfugTransformation;

    function __construct(KorfugModel $korfug, KorfugTransformation $korfugTransformation)
    {

        $this->korfug = $korfug;
        $this->korfugTransformation = $korfugTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$korfugData = $this->korfug($params, 'asc', 'array', false);

    	return $this->korfugTransformation->getDataTransform($korfugData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->korfugTransformation->getSingleDataTransform($this->korfug($params, 'asc', 'array', true));
    }

    /**
     * Delete Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function delete($params)
    {
        try {
            if (!isset($params['id']) && empty($params['id'])) {
                return $this->setResponse('Required id', false);
            }

            DB::beginTransaction();

            if (!$this->removeData($params)) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success delete data', true);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Remove Data News From Database
     * @param $data
     * @return bool
     */

    protected function removeData($params)
    {
        try {

            $delete = $this->korfug
                ->where('id', $params['id'])
                ->forceDelete();

            if ($delete)
                return true;

            return $this->setResponse('Failed delete data', false);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
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
            
            $eloquent = $this->korfug;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->korfug->find($params['id']);
                $eloquent->updated_at  = Carbon::now();
            }

            $eloquent->dokter_id                = isset($params['dokter_id']) ? $params['dokter_id'] : '';
            $eloquent->tgl_usulan               = isset($params['tgl_usulan']) ? $params['tgl_usulan'] : '';
            $eloquent->nip_korfug               = isset($params['nip_korfug']) ? $params['nip_korfug'] : '';
            $eloquent->kedudukan                = isset($params['kedudukan']) ? $params['kedudukan'] : '';
            $eloquent->karantina_tumbuhan_id    = isset($params['karantina_tumbuhan_id']) ? $params['karantina_tumbuhan_id'] : '';
            $eloquent->created_at   = Carbon::now();

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
    
    protected function korfug($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$korfug = KorfugModel::with(['karantina_tumbuhan']);

        if(isset($params['id'])) {
            $korfug = KorfugModel::where('id', $params['id']);
        }

        if(!$korfug->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $korfug->get()->toArray();
                } else {
                    return $korfug->first()->toArray();
                }
            break;
        }
    }

}