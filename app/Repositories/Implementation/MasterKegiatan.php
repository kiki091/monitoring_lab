<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterKegiatan as MasterKegiatanInterface;
use App\Models\MasterKegiatan as MasterKegiatanModel;
use App\Services\Transformation\MasterKegiatan as MasterKegiatanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterKegiatan extends BaseImplementation implements MasterKegiatanInterface
{

    protected $masterKegiatan;
    protected $masterKegiatanTransformation;

    function __construct(MasterKegiatanModel $masterKegiatan, MasterKegiatanTransformation $masterKegiatanTransformation)
    {

        $this->masterKegiatan = $masterKegiatan;
        $this->masterKegiatanTransformation = $masterKegiatanTransformation;
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

    	$masterKegiatanData = $this->masterKegiatan($params, 'asc', 'array', false);

    	return $this->masterKegiatanTransformation->getDataTransform($masterKegiatanData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->masterKegiatanTransformation->getSingleDataTransform($this->masterKegiatan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->masterKegiatan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->masterKegiatan->find($params['id']);

            }

            $eloquent->nama_kegiatan      = isset($params['nama_kegiatan']) ? $params['nama_kegiatan'] : '';

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
    
    protected function masterKegiatan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$masterKegiatan = new MasterKegiatanModel;

        if(isset($params['id']) && !empty($params['id'])) {
            $masterKegiatan =  MasterKegiatanModel::where('id', $params['id']);
        }

        if(!$masterKegiatan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $masterKegiatan->get()->toArray();
                } else {
                    return $masterKegiatan->first()->toArray();
                }
            break;
        }
    }

}