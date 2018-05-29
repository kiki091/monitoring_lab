<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Bridge\MasterLaboraorium as MasterLaboraoriumServices;
use App\Services\Bridge\MetodePengujian as MetodePengujianServices;
use App\Services\Bridge\KelompokPengujian as KelompokPengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class MetodePengujianController extends BaseController
{
    protected $response;
    protected $targetPengujian;
    protected $masterLaboraorium;
    protected $metodePengujian;
    protected $kelompokPengujian;

    public function __construct(TargetPengujianServices $targetPengujian, MasterLaboraoriumServices $masterLaboraorium, MetodePengujianServices $metodePengujian, KelompokPengujianServices $kelompokPengujian, ResponseService $response)
    {
        $this->response = $response;
        $this->targetPengujian = $targetPengujian;
        $this->masterLaboraorium = $masterLaboraorium;
        $this->metodePengujian = $metodePengujian;
        $this->kelompokPengujian = $kelompokPengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.metode-pengujian.main';
        
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
        $data['list_data'] = $this->metodePengujian->getData();
        $data['list_target'] = $this->targetPengujian->getData();
        $data['list_lab'] = $this->masterLaboraorium->getData();
        $data['list_kelompok'] = $this->kelompokPengujian->getData();

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
            return $this->metodePengujian->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->metodePengujian->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_kelompok'             => 'required',
            'target_pengujian_id'       => 'required',
            'laboratorium_id'           => 'required',
            'kelompok_uji_id'           => 'required',
        ];

        return $rules;
    }
}