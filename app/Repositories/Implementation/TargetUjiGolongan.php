<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\TargetUjiGolongan as TargetUjiGolonganInterface;
use App\Models\TargetUjiGolongan as TargetUjiGolonganModel;
use App\Services\Transformation\TargetUjiGolongan as TargetUjiGolonganTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class TargetUjiGolongan extends BaseImplementation implements TargetUjiGolonganInterface
{

    protected $daftarTargetUjiGolongan;
    protected $daftarTargetUjiGolonganTransformation;

    function __construct(TargetUjiGolonganModel $daftarTargetUjiGolongan, TargetUjiGolonganTransformation $daftarTargetUjiGolonganTransformation)
    {

        $this->daftarTargetUjiGolongan = $daftarTargetUjiGolongan;
        $this->daftarTargetUjiGolonganTransformation = $daftarTargetUjiGolonganTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarTargetUjiGolonganTransformation->getDataTransform($this->daftarTargetUjiGolongan($params, 'asc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarTargetUjiGolonganTransformation->getSingleDataTransform($this->daftarTargetUjiGolongan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarTargetUjiGolongan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarTargetUjiGolongan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_target_uji  = 'KT-'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->kelompok_sample_id   = isset($params['kelompok_sample_id']) ? $params['kelompok_sample_id'] : '';
            $eloquent->nama_ilmiah          = isset($params['nama_ilmiah']) ? $params['nama_ilmiah'] : '';
            $eloquent->kode_hs_id           = isset($params['kode_hs_id']) ? $params['kode_hs_id'] : '';
            $eloquent->satuan_id            = isset($params['satuan_id']) ? $params['satuan_id'] : '';
            

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
    
    protected function daftarTargetUjiGolongan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarTargetUjiGolongan = TargetUjiGolonganModel::with(['kelompok_sample','kode_hs','satuan'])->orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarTargetUjiGolongan = TargetUjiGolonganModel::where('id', $params['id']);
        }

        if(!$daftarTargetUjiGolongan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarTargetUjiGolongan->get()->toArray();
                } else {
                    return $daftarTargetUjiGolongan->first()->toArray();
                }
            break;
        }
    }

}