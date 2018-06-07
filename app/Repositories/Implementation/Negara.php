<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Negara as NegaraInterface;
use App\Models\Negara as NegaraModel;
use App\Services\Transformation\Negara as NegaraTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Negara extends BaseImplementation implements NegaraInterface
{

    protected $daftarNegara;
    protected $daftarNegaraTransformation;

    function __construct(NegaraModel $daftarNegara, NegaraTransformation $daftarNegaraTransformation)
    {

        $this->daftarNegara = $daftarNegara;
        $this->daftarNegaraTransformation = $daftarNegaraTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarNegaraTransformation->getDataTransform($this->daftarNegara($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarNegaraTransformation->getSingleDataTransform($this->daftarNegara($params, 'asc', 'array', true));
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
                return $this->setResponse("Failed save data", false);
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

                $objec = $this->daftarNegara->where('id', $params['id'])->first()->toArray();

                if($objec['kode_negara'] == $params['kode_negara'])
                    return true;
                
                return true;

            } else {

                $objec = $this->daftarNegara->where('kode_negara', $params['kode_negara'])->get()->toArray();

                if(!count($objec))
                    return true;

                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

    protected function storeData($params)
    {
        try {
            
            $eloquent = $this->daftarNegara;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarNegara->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->kode_negara  = isset($params['kode_negara']) ? $params['kode_negara'] : '';
            $eloquent->nama_negara  = isset($params['nama_negara']) ? $params['nama_negara'] : '';
            

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
    
    protected function daftarNegara($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarNegara = NegaraModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarNegara = NegaraModel::where('id', $params['id']);
        }

        if(!$daftarNegara->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarNegara->get()->toArray();
                } else {
                    return $daftarNegara->first()->toArray();
                }
            break;
        }
    }

}