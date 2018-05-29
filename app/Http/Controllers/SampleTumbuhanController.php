<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\SampleTumbuhan as SampleTumbuhanServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use ValidatesRequests;

class SampleTumbuhanController extends BaseController
{
    protected $response;
    protected $sampleTumbuhan;
    protected $targetPengujian;

    public function __construct(SampleTumbuhanServices $sampleTumbuhan, TargetPengujianServices $targetPengujian, ResponseService $response)
    {
        $this->response = $response;
        $this->sampleTumbuhan = $sampleTumbuhan;
        $this->targetPengujian = $targetPengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.sample-tumbuhan.main';
        
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
        $data['sample'] = $this->sampleTumbuhan->getData();
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
            return $this->sampleTumbuhan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->sampleTumbuhan->edit($request->except(['_token']));
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
            'nama_komoditas'            => 'required',
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