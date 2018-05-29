<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\MasterKategori as MasterKategoriInterface;
use App\Models\MasterKategori as MasterKategoriModel;
use App\Services\Transformation\MasterKategori as MasterKategoriTransformation;
use App\Custom\Facades\DataHelper;

use Cache;
use Session;
use DB;
use Auth;
use Hash;

class MasterKategori extends BaseImplementation implements MasterKategoriInterface
{

    protected $kategori;
    protected $kategoriTransformation;

    function __construct(MasterKategoriModel $kategori, MasterKategoriTransformation $kategoriTransformation)
    {

        $this->kategori = $kategori;
        $this->kategoriTransformation = $kategoriTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($data)
    {
    	$params = [
    		'order'	=> 'order',
    	];

    	$kategoriData = $this->kategori($params, 'asc', 'array', false);

    	return $this->kategoriTransformation->getDataTransform($kategoriData);
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->kategoriTransformation->getSingleDataTransform($this->kategori($params, 'asc', 'array', true));
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
            
            $eloquent = $this->kategori;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent                = $this->kategori->find($params['id']);

            }

            $eloquent->nama_kategori      = isset($params['nama_kategori']) ? $params['nama_kategori'] : '';

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
    
    protected function kategori($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$kategori = new MasterKategoriModel;

        if(isset($params['id'])) {
            $kategori = MasterKategoriModel::where('id', $params['id']);
        }

        if(!$kategori->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $kategori->get()->toArray();
                } else {
                    return $kategori->first()->toArray();
                }
            break;
        }
    }

}