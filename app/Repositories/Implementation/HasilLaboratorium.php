<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\HasilLaboratorium as HasilLaboratoriumInterface;
use App\Models\HasilLaboratorium as HasilLaboratoriumModel;
use App\Services\Transformation\HasilLaboratorium as HasilLaboratoriumTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class HasilLaboratorium extends BaseImplementation implements HasilLaboratoriumInterface
{

    protected $hasilLaboratorium;
    protected $hasilLaboratoriumTransformation;

    function __construct(HasilLaboratoriumModel $hasilLaboratorium, HasilLaboratoriumTransformation $hasilLaboratoriumTransformation)
    {

        $this->hasilLaboratorium = $hasilLaboratorium;
        $this->hasilLaboratoriumTransformation = $hasilLaboratoriumTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	$hasilLaboratoriumData = $this->hasilLaboratorium($params, 'asc', 'array', false);

    	return $this->hasilLaboratoriumTransformation->getDataTransform($hasilLaboratoriumData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->hasilLaboratoriumTransformation->getSingleDataTransform($this->hasilLaboratorium($params, 'asc', 'array', true));
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
            
            $eloquent = $this->hasilLaboratorium;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->hasilLaboratorium->find($params['id']);
                $eloquent->updated_at  = Carbon::now();
            }

            $eloquent->karantina_tumbuhan_id  = isset($params['karantina_tumbuhan_id']) ? $params['karantina_tumbuhan_id'] : '';
            $eloquent->kesimpulan  = isset($params['kesimpulan']) ? $params['kesimpulan'] : '';
            $eloquent->keterangan  = isset($params['keterangan']) ? $params['keterangan'] : '';
            $eloquent->hasil       = isset($params['hasil']) ? $params['hasil'] : '';
            $eloquent->created_at  = Carbon::now();

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
    
    protected function hasilLaboratorium($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$hasilLaboratorium = HasilLaboratoriumModel::with(['karantina']);

        if(isset($params['id'])) {
            $hasilLaboratorium = HasilLaboratoriumModel::where('id', $params['id']);
        }

        if(!$hasilLaboratorium->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $hasilLaboratorium->get()->toArray();
                } else {
                    return $hasilLaboratorium->first()->toArray();
                }
            break;
        }
    }

}