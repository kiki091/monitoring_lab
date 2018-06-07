<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Pegawai as PegawaiInterface;
use App\Models\Pegawai as PegawaiModel;
use App\Services\Transformation\Pegawai as PegawaiTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Pegawai extends BaseImplementation implements PegawaiInterface
{

    protected $daftarPegawai;
    protected $daftarPegawaiTransformation;

    function __construct(PegawaiModel $daftarPegawai, PegawaiTransformation $daftarPegawaiTransformation)
    {

        $this->daftarPegawai = $daftarPegawai;
        $this->daftarPegawaiTransformation = $daftarPegawaiTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {
    	return $this->daftarPegawaiTransformation->getDataTransform($this->daftarPegawai($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarPegawaiTransformation->getSingleDataTransform($this->daftarPegawai($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarPegawai;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarPegawai->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->nip_pegawai  = 'NP-'.rand(100, 1000).'.'.rand(100, 1000).'.'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_lengkap  = isset($params['nama_lengkap']) ? $params['nama_lengkap'] : '';
            $eloquent->jabatan_id    = isset($params['jabatan_id']) ? $params['jabatan_id'] : '';
            

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
    
    protected function daftarPegawai($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarPegawai = $this->daftarPegawai->with('jabatan')->orderBy('created_at', $orderType);

        if(!empty($params['id'])) {
            $daftarPegawai->where('id', $params['id']);
        }

        if(!$daftarPegawai->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarPegawai->get()->toArray();
                } else {
                    return $daftarPegawai->first()->toArray();
                }
            break;
        }
    }

}