<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\KelompokMetodePengujian as KelompokMetodePengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class KelompokMetodePengujianController extends BaseController
{
    protected $response;
    protected $daftarKelompokMetodePengujian;

    public function __construct(ResponseService $response, KelompokMetodePengujianServices $daftarKelompokMetodePengujian)
    {
        $this->response = $response;
        $this->daftarKelompokMetodePengujian = $daftarKelompokMetodePengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.kel-metode-pengujian.main';
        
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
        $data['list_data'] = $this->daftarKelompokMetodePengujian->getData();

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
            return $this->daftarKelompokMetodePengujian->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarKelompokMetodePengujian->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_kelompok'        => 'required',
        ];

        return $rules;
    }
}