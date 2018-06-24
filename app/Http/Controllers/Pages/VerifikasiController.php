<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Permohonan as PermohonanServices;
use App\Services\Bridge\Verifikasi as VerifikasiServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class VerifikasiController extends BaseController
{
    protected $response;
    protected $daftarPermohonan;
    protected $verifikasi;

    public function __construct(ResponseService $response, PermohonanServices $daftarPermohonan, VerifikasiServices $verifikasi)
    {
        $this->response = $response;
        $this->verifikasi = $verifikasi;
        $this->daftarPermohonan = $daftarPermohonan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.monitoring.verifikasi.main';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }

    /**
     * Get Data 
     * @return string
     */

    public function getData(Request $request)
    {
        $data['list_data'] = $this->daftarPermohonan->getData(['status' => '1']);

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Data
     * @return string
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validation($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->verifikasi->store($request->except(['_token']));
        }
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'status'        => 'required',
            'saran'        => 'required',
        ];

        return $rules;
    }
}