<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MediaTranspor as MediaTransporInterface;
use App\Models\MediaTranspor as MediaTransporModel;
use App\Services\Transformation\MediaTranspor as MediaTransporTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MediaTranspor extends BaseImplementation implements MediaTransporInterface
{

    protected $daftarMediaTranspor;
    protected $daftarMediaTransporTransformation;

    function __construct(MediaTransporModel $daftarMediaTranspor, MediaTransporTransformation $daftarMediaTransporTransformation)
    {

        $this->daftarMediaTranspor = $daftarMediaTranspor;
        $this->daftarMediaTransporTransformation = $daftarMediaTransporTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarMediaTransporTransformation->getDataTransform($this->daftarMediaTranspor($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarMediaTransporTransformation->getSingleDataTransform($this->daftarMediaTranspor($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarMediaTranspor;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarMediaTranspor->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_media_transpor  = isset($params['nama_media_transpor']) ? $params['nama_media_transpor'] : '';
            

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
    
    protected function daftarMediaTranspor($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarMediaTranspor = MediaTransporModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarMediaTranspor = MediaTransporModel::where('id', $params['id']);
        }

        if(!$daftarMediaTranspor->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarMediaTranspor->get()->toArray();
                } else {
                    return $daftarMediaTranspor->first()->toArray();
                }
            break;
        }
    }

}