<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\KelompokSample as KelompokSampleInterface;
use App\Models\KelompokSample as KelompokSampleModel;
use App\Services\Transformation\KelompokSample as KelompokSampleTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class KelompokSample extends BaseImplementation implements KelompokSampleInterface
{

    protected $daftarKelompokSample;
    protected $daftarKelompokSampleTransformation;

    function __construct(KelompokSampleModel $daftarKelompokSample, KelompokSampleTransformation $daftarKelompokSampleTransformation)
    {

        $this->daftarKelompokSample = $daftarKelompokSample;
        $this->daftarKelompokSampleTransformation = $daftarKelompokSampleTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
        return $this->daftarKelompokSampleTransformation->getDataTransform($this->daftarKelompokSample($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarKelompokSampleTransformation->getSingleDataTransform($this->daftarKelompokSample($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarKelompokSample;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarKelompokSample->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_kelompok    = 'KS-'.rand(100, 1000);
                $eloquent->created_at       = Carbon::now();
            }

            $eloquent->nama_kelompok        = isset($params['nama_kelompok']) ? $params['nama_kelompok'] : '';
            

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
    
    protected function daftarKelompokSample($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarKelompokSample = KelompokSampleModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarKelompokSample = KelompokSampleModel::where('id', $params['id']);
        }

        if(!$daftarKelompokSample->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarKelompokSample->get()->toArray();
                } else {
                    return $daftarKelompokSample->first()->toArray();
                }
            break;
        }
    }

}