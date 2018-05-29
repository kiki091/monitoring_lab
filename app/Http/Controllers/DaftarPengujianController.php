<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\DaftarPengujian as DaftarPengujianServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class DaftarPengujianController extends BaseController
{
    protected $response;
    protected $daftarPengujian;
    protected $targetPengujian;

    public function __construct(DaftarPengujianServices $daftarPengujian, TargetPengujianServices $targetPengujian, ResponseService $response)
    {
        $this->response = $response;
        $this->daftarPengujian = $daftarPengujian;
        $this->targetPengujian = $targetPengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.daftar-pengujian.main';
        
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
        $data['list_data'] = $this->daftarPengujian->getData();
        $data['list_target'] = $this->targetPengujian->getData();

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
            return $this->daftarPengujian->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarPengujian->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'target_pengujian_id'       => 'required',
            'kode_hph'                  => 'required',
            'lama_uji'                  => 'required|numeric',
        ];

        return $rules;
    }
}