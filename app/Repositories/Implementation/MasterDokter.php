<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterDokter as MasterDokterInterface;
use App\Models\MasterDokter as MasterDokterModel;
use App\Services\Transformation\MasterDokter as MasterDokterTransformation;
use App\Custom\Facades\DataHelper;

use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterDokter extends BaseImplementation implements MasterDokterInterface
{

    protected $dokter;
    protected $dokterTransformation;

    function __construct(MasterDokterModel $dokter, MasterDokterTransformation $dokterTransformation)
    {

        $this->dokter = $dokter;
        $this->dokterTransformation = $dokterTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	$dokterData = $this->dokter($params, 'asc', 'array', false);

    	return $this->dokterTransformation->getDataTransform($dokterData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->dokterTransformation->getSingleDataTransform($this->dokter($params, 'asc', 'array', true));
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
            
            $eloquent = $this->dokter;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->dokter->find($params['id']);

            }

            $eloquent->nip_dokter      = isset($params['nip_dokter']) ? $params['nip_dokter'] : '';
            $eloquent->nama_lengkap      = isset($params['nama_lengkap']) ? $params['nama_lengkap'] : '';
            $eloquent->alamat      = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->no_telpon      = isset($params['no_telpon']) ? $params['no_telpon'] : '';

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
    
    protected function dokter($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$dokter = new MasterDokterModel;

        if(isset($params['id'])) {
            $dokter = MasterDokterModel::where('id', $params['id']);
        }

        if(!$dokter->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $dokter->get()->toArray();
                } else {
                    return $dokter->first()->toArray();
                }
            break;
        }
    }

}