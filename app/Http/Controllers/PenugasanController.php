<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Penugasan as PenugasanServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Bridge\KarantinaTumbuhan as KarantinaTumbuhanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PenugasanController extends BaseController
{
    protected $response;
    protected $penugasan;
    protected $targetPengujian;
    protected $karantinaTumbuhan;

    public function __construct(ResponseService $response, KarantinaTumbuhanServices $karantinaTumbuhan, TargetPengujianServices $targetPengujian, PenugasanServices $penugasan)
    {
        $this->response = $response;
        $this->penugasan = $penugasan;
        $this->targetPengujian = $targetPengujian;
        $this->karantinaTumbuhan = $karantinaTumbuhan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.penugasan.main';
        
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
        $data['list_data'] = $this->penugasan->getData();
        $data['list_target'] = $this->targetPengujian->getData();
        $data['list_permohonan'] = $this->karantinaTumbuhan->getData($request->all());

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
            return $this->penugasan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->penugasan->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [

            'target_uji_id'             => 'required',
            'kedudukan'                 => 'required',
            'karantina_tumbuhan_id'     => 'required',
        ];

        return $rules;
    }
}