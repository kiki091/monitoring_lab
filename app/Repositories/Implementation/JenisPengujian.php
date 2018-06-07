<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\JenisPengujian as JenisPengujianInterface;
use App\Models\JenisPengujian as JenisPengujianModel;
use App\Services\Transformation\JenisPengujian as JenisPengujianTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class JenisPengujian extends BaseImplementation implements JenisPengujianInterface
{

    protected $daftarJenisPengujian;
    protected $daftarJenisPengujianTransformation;

    function __construct(JenisPengujianModel $daftarJenisPengujian, JenisPengujianTransformation $daftarJenisPengujianTransformation)
    {

        $this->daftarJenisPengujian = $daftarJenisPengujian;
        $this->daftarJenisPengujianTransformation = $daftarJenisPengujianTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

        $daftarJenisPengujianData = $this->daftarJenisPengujian($params, 'asc', 'array', false);

        return $this->daftarJenisPengujianTransformation->getDataTransform($daftarJenisPengujianData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarJenisPengujianTransformation->getSingleDataTransform($this->daftarJenisPengujian($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarJenisPengujian;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarJenisPengujian->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_jenis_pengujian = isset($params['nama_jenis_pengujian']) ? $params['nama_jenis_pengujian'] : '';
            $eloquent->target_pengujian_id  = isset($params['target_pengujian_id']) ? $params['target_pengujian_id'] : '';
            $eloquent->metode_pengujian_id  = isset($params['metode_pengujian_id']) ? $params['metode_pengujian_id'] : '';
            

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
    
    protected function daftarJenisPengujian($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $daftarJenisPengujian = JenisPengujianModel::with(['target_pengujian','metode_pengujian'])->orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarJenisPengujian = JenisPengujianModel::where('id', $params['id']);
        }

        if(!$daftarJenisPengujian->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarJenisPengujian->get()->toArray();
                } else {
                    return $daftarJenisPengujian->first()->toArray();
                }
            break;
        }
    }

}