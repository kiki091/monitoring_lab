<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\MasterUpt as MasterUptServices;
use App\Services\Bridge\MasterLaboraorium as MasterLaboraoriumServices;
use App\Services\Bridge\DaftarDaerah as DaftarDaerahServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class MasterUptController extends BaseController
{
    protected $response;
    protected $masterUptServices;
    protected $masterLaboraorium;
    protected $daftarDaerah;

    public function __construct(MasterUptServices $masterUptServices, MasterLaboraoriumServices $masterLaboraorium, ResponseService $response, DaftarDaerahServices $daftarDaerah)
    {
        $this->response = $response;
        $this->masterUptServices = $masterUptServices;
        $this->masterLaboraorium = $masterLaboraorium;
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
        $data['list_data'] = $this->masterUptServices->getData();
        $data['list_lab'] = $this->masterLaboraorium->getData();
        $data['list_daerah'] = $this->daftarDaerah->getData();

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
            return $this->masterUptServices->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->masterUptServices->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_upt'        => 'required',
            'kelas_upt'       => 'required',
            'lab_id'        => 'required',
            'jns_pelabuhan'   => 'required',
            'daerah_id'       => 'required',
            'alamat'          => 'required',
            'no_tlp'          => 'required',
            'email'           => 'required|email',
        ];

        return $rules;
    }
}