<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Satuan as SatuanInterface;
use App\Models\Satuan as SatuanModel;
use App\Services\Transformation\Satuan as SatuanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Satuan extends BaseImplementation implements SatuanInterface
{

    protected $daftarSatuan;
    protected $daftarSatuanTransformation;

    function __construct(SatuanModel $daftarSatuan, SatuanTransformation $daftarSatuanTransformation)
    {

        $this->daftarSatuan = $daftarSatuan;
        $this->daftarSatuanTransformation = $daftarSatuanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarSatuanTransformation->getDataTransform($this->daftarSatuan($params, 'asc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarSatuanTransformation->getSingleDataTransform($this->daftarSatuan($params, 'asc', 'array', true));
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

            if(!$this->checkKode($params)) {
                DB::rollBack();
                return $this->setResponse("Kode sudah digunakan", false);
            }

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

    protected function checkKode($params)
    {
        try {

            if(!empty($params['id'])) {

                $eloquent = $this->daftarSatuan->where('kode_satuan', $params['kode_satuan'])->first()->toArray();

                if($params['kode_satuan'] == $eloquent['kode_satuan']) 
                    return true;

                if(empty($eloquent))
                    return true;

                return false;

            } else {

                $eloquent = $this->daftarSatuan->where('kode_satuan', $params['kode_satuan'])->get()->toArray();

                if(count($eloquent) != 0) 
                    return false;
                
                return true;
            }

        } catch (Exception $e) {

            return false;
        }
    }

    protected function storeData($params)
    {
        try {
            
            $eloquent = $this->daftarSatuan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarSatuan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {

                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->kode_satuan  = isset($params['kode_satuan']) ? $params['kode_satuan'] : '';
            $eloquent->nama_satuan  = isset($params['nama_satuan']) ? $params['nama_satuan'] : '';
            

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
    
    protected function daftarSatuan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarSatuan = SatuanModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarSatuan = SatuanModel::where('id', $params['id']);
        }

        if(!$daftarSatuan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarSatuan->get()->toArray();
                } else {
                    return $daftarSatuan->first()->toArray();
                }
            break;
        }
    }

}