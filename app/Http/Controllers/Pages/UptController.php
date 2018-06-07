<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Upt as UptServices;
use App\Services\Bridge\Daerah as DaerahServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class UptController extends BaseController
{
    protected $response;
    protected $daftarUpt;
    protected $daftarDaerah;

    public function __construct(ResponseService $response, UptServices $daftarUpt, DaerahServices $daftarDaerah)
    {
        $this->response = $response;
        $this->daftarUpt = $daftarUpt;
        $this->daftarDaerah = $daftarDaerah;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.upt.main';
        
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
        $data['list_daerah'] = $this->daftarDaerah->getData();
        $data['list_data'] = $this->daftarUpt->getData();

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
            return $this->daftarUpt->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarUpt->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_upt'               => 'required',
            'daerah_id'              => 'required',
            'jenis_pelabuhan'        => 'required',
        ];

        return $rules;
    }
}