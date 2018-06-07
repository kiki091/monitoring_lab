<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Kegiatan as KegiatanInterface;
use App\Models\Kegiatan as KegiatanModel;
use App\Services\Transformation\Kegiatan as KegiatanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Kegiatan extends BaseImplementation implements KegiatanInterface
{

    protected $daftarKegiatan;
    protected $daftarKegiatanTransformation;

    function __construct(KegiatanModel $daftarKegiatan, KegiatanTransformation $daftarKegiatanTransformation)
    {

        $this->daftarKegiatan = $daftarKegiatan;
        $this->daftarKegiatanTransformation = $daftarKegiatanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarKegiatanTransformation->getDataTransform($this->daftarKegiatan($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarKegiatanTransformation->getSingleDataTransform($this->daftarKegiatan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarKegiatan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarKegiatan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_kegiatan  = isset($params['nama_kegiatan']) ? $params['nama_kegiatan'] : '';
            

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
    
    protected function daftarKegiatan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarKegiatan = KegiatanModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarKegiatan = KegiatanModel::where('id', $params['id']);
        }

        if(!$daftarKegiatan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarKegiatan->get()->toArray();
                } else {
                    return $daftarKegiatan->first()->toArray();
                }
            break;
        }
    }

}