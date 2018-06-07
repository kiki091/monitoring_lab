<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\TargetPest as TargetPestServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class TargetPestController extends BaseController
{
    protected $response;
    protected $daftarTargetPest;
    protected $daftarTargetPengujian;

    public function __construct(ResponseService $response, TargetPestServices $daftarTargetPest, TargetPengujianServices $daftarTargetPengujian)
    {
        $this->response = $response;
        $this->daftarTargetPest = $daftarTargetPest;
        $this->daftarTargetPengujian = $daftarTargetPengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.target-pest.main';
        
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
        $data['list_target'] = $this->daftarTargetPengujian->getData();
        $data['list_data'] = $this->daftarTargetPest->getData();

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
            return $this->daftarTargetPest->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarTargetPest->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_target_hph'        => 'required',
            'target_pengujian_id'        => 'required',
        ];

        return $rules;
    }
}