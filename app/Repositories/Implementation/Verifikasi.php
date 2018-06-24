<?php

namespace App\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Verifikasi as VerifikasiInterface;
use App\Models\Permohonan as VerifikasiPermohonanModel;
use App\Custom\Facades\DataHelper;

use Carbon\Carbon;
use Cache;
use Session;
use DB;
use Auth;
use Hash;

class Verifikasi extends BaseImplementation implements VerifikasiInterface
{

    protected $permohonanVerifikasi;

    function __construct(VerifikasiPermohonanModel $permohonanVerifikasi)
    {

        $this->permohonanVerifikasi = $permohonanVerifikasi;
    }


    /**
     * Confirm Data
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */

    public function store($params)
    {
        try {
            
            if(empty($params['id']))
                return $this->setResponse("Verifikasi gagal", false);

            DB::beginTransaction();

            $oldData = $this->permohonanVerifikasi
                ->where('id', $params['id'])
                ->first()->toArray();

            $updatedData = [
                'status' => $params['status'] ? $params['status'] : '0',
                'saran' => $params['saran'] ? $params['saran'] : '',
                'updated_at' => Carbon::now()
            ];

            $changeStatus = $this->permohonanVerifikasi
                ->where('id', $params['id'])
                ->update($updatedData);

            if($changeStatus) {
                DB::commit();
                
                return $this->setResponse('Success verifikasi data', true);
            }

            DB::rollBack();
            return $this->setResponse('Gagal verifikasi data', false);

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

}