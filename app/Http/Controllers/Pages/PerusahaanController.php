<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Perusahaan as PerusahaanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PerusahaanController extends BaseController
{
    protected $response;
    protected $daftarPerusahaan;

    public function __construct(ResponseService $response, PerusahaanServices $daftarPerusahaan)
    {
        $this->response = $response;
        $this->daftarPerusahaan = $daftarPerusahaan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.perusahaan.main';
        
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
        $data['list_data'] = $this->daftarPerusahaan->getData();

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
            return $this->daftarPerusahaan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarPerusahaan->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_perusahaan'        => 'required',
            'alamat'                 => 'required',
            'no_telpon'              => 'required',
            //'contact_person'         => 'required',
        ];

        return $rules;
    }
}