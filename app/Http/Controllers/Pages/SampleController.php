<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Sample as SampleServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Bridge\Satuan as SatuanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class SampleController extends BaseController
{
    protected $response;
    protected $daftarSample;
    protected $daftarTargetPengujian;
    protected $daftarSatuan;

    public function __construct(ResponseService $response, SampleServices $daftarSample, SatuanServices $daftarSatuan, TargetPengujianServices $daftarTargetPengujian)
    {
        $this->response = $response;
        $this->daftarSample = $daftarSample;
        $this->daftarTargetPengujian = $daftarTargetPengujian;
        $this->daftarSatuan = $daftarSatuan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.monitoring.sample.main';
        
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
        $data['list_satuan'] = $this->daftarSatuan->getData();
        $data['list_data'] = $this->daftarSample->getData($request->all());

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
            return $this->daftarSample->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarSample->edit($request->except(['_token']));
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
            'satuan_id'                 => 'required',
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