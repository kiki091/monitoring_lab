<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\SampleHewan as SampleHewanServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use ValidatesRequests;

class SampleHewanController extends BaseController
{
    protected $response;
    protected $sampleHewan;
    protected $targetPengujian;

    public function __construct(SampleHewanServices $sampleHewan, TargetPengujianServices $targetPengujian, ResponseService $response)
    {
        $this->response = $response;
        $this->sampleHewan = $sampleHewan;
        $this->targetPengujian = $targetPengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.sample-hewan.main';
        
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
        $data['sample'] = $this->sampleHewan->getData();
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
            return $this->sampleHewan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->sampleHewan->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_sample'               => 'required',
            'jenis_sample'              => 'required',
            'jml_vol'                   => 'required',
            'satuan'                    => 'required',
            'tgl_pengambilan_sample'    => 'required',
            'metode_pengambilan_sample' => 'required',
            'kondisi_sample'            => 'required',
            'target_pengujian_id'       => 'required',
            'nama_customer'             => 'required',
            'alamat'                    => 'required',
        ];

        return $rules;
    }
}