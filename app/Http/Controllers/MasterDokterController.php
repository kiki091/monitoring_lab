<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\MasterDokter as MasterDokterServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class MasterDokterController extends BaseController
{
    protected $response;
    protected $masterDokter;

    public function __construct(MasterDokterServices $masterDokter, ResponseService $response)
    {
        $this->response = $response;
        $this->masterDokter = $masterDokter;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.dokter.main';
        
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
        $data['list_data'] = $this->masterDokter->getData();

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
            return $this->masterDokter->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->masterDokter->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_lengkap'      => 'required|max:75',
            'alamat'            => 'required',
            'no_telpon'         => 'required|numeric',
        ];

        if(!empty($request['id']))
            $rules['nip_dokter'] = 'required';
        else
            $rules['nip_dokter'] = 'required|unique:tbl_dokter|max:20';

        return $rules;
    }
}