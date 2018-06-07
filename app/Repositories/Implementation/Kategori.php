<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Kategori as KategoriInterface;
use App\Models\Kategori as KategoriModel;
use App\Services\Transformation\Kategori as KategoriTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Kategori extends BaseImplementation implements KategoriInterface
{

    protected $daftarKategori;
    protected $daftarKategoriTransformation;

    function __construct(KategoriModel $daftarKategori, KategoriTransformation $daftarKategoriTransformation)
    {

        $this->daftarKategori = $daftarKategori;
        $this->daftarKategoriTransformation = $daftarKategoriTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

        return $this->daftarKategoriTransformation->getDataTransform($this->daftarKategori($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarKategoriTransformation->getSingleDataTransform($this->daftarKategori($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarKategori;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarKategori->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_kategori  = isset($params['nama_kategori']) ? $params['nama_kategori'] : '';
            

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
    
    protected function daftarKategori($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $daftarKategori = KategoriModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarKategori = KategoriModel::where('id', $params['id']);
        }

        if(!$daftarKategori->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarKategori->get()->toArray();
                } else {
                    return $daftarKategori->first()->toArray();
                }
            break;
        }
    }

}