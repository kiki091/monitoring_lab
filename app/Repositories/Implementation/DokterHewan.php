<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\DokterHewan as DokterHewanInterface;
use App\Models\DokterHewan as DokterHewanModel;
use App\Services\Transformation\DokterHewan as DokterHewanTransformation;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class DokterHewan extends BaseImplementation implements DokterHewanInterface
{

    protected $daftarDokterHewan;
    protected $daftarDokterHewanTransformation;

    function __construct(DokterHewanModel $daftarDokterHewan, DokterHewanTransformation $daftarDokterHewanTransformation)
    {

        $this->daftarDokterHewan = $daftarDokterHewan;
        $this->daftarDokterHewanTransformation = $daftarDokterHewanTransformation;
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function getData($params)
    {

    	return $this->daftarDokterHewanTransformation->getDataTransform($this->daftarDokterHewan($params, 'desc', 'array', false));
    }

    /**
     * Get Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        return $this->daftarDokterHewanTransformation->getSingleDataTransform($this->daftarDokterHewan($params, 'asc', 'array', true));
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
            
            $eloquent = $this->daftarDokterHewan;

            if(isset($params['id']) && !empty($params['id'])) 
            {
                $eloquent = $this->daftarDokterHewan->find($params['id']);
                $eloquent->updated_at  = Carbon::now();

            } else {
                
                $eloquent->nip_dokter  = 'NDH-'.rand(100, 1000).'.'.rand(100, 1000);
                $eloquent->created_at   = Carbon::now();
            }

            $eloquent->nama_lengkap  = isset($params['nama_lengkap']) ? $params['nama_lengkap'] : '';
            $eloquent->alamat  = isset($params['alamat']) ? $params['alamat'] : '';
            $eloquent->no_telpon  = isset($params['no_telpon']) ? $params['no_telpon'] : '';
            

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
    
    protected function daftarDokterHewan($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
    	$daftarDokterHewan = DokterHewanModel::orderBy('created_at', $orderType);

        if(isset($params['id'])) {
            $daftarDokterHewan = DokterHewanModel::where('id', $params['id']);
        }

        if(!$daftarDokterHewan->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $daftarDokterHewan->get()->toArray();
                } else {
                    return $daftarDokterHewan->first()->toArray();
                }
            break;
        }
    }

}