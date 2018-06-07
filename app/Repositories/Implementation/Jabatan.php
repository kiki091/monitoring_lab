<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Jabatan as JabatanInterface;
use App\Models\Jabatan as JabatanModel;
use App\Services\Transformation\Jabatan as JabatanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Jabatan extends BaseImplementation implements JabatanInterface
{

    protected $daftarJabatan;
    protected $daftarJabatanTransformation;

    function __construct(JabatanModel $daftarJabatan, JabatanTransformation $daftarJabatanTransformation)
    {

        $this->daftarJabatan = $daftarJabatan;
        $this->daftarJabatanTransformation = $daftarJabatanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarJabatanTransformation->getDataTransform($this->daftarJabatan($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarJabatanTransformation->getSingleDataTransform($this->daftarJabatan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarJabatan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarJabatan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->kode_jabatan  = 'KJ-'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_jabatan  = isset($params['nama_jabatan']) ? $params['nama_jabatan'] : '';
            

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
    
    protected function daftarJabatan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarJabatan = JabatanModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarJabatan = JabatanModel::where('id', $params['id']);
        }

        if(!$daftarJabatan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarJabatan->get()->toArray();
                } else {
                    return $daftarJabatan->first()->toArray();
                }
            break;
        }
    }

}