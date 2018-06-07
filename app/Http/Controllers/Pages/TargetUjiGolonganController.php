<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\TargetUjiGolongan as TargetUjiGolonganServices;
use App\Services\Bridge\KodeHs as KodeHsServices;
use App\Services\Bridge\Satuan as SatuanServices;
use App\Services\Bridge\KelompokSample as KelompokSampleServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class TargetUjiGolonganController extends BaseController
{
    protected $response;
    protected $daftarKodeHs;
    protected $daftarSatuan;
    protected $daftarTargetUjiGolongan;
    protected $daftarKelompokSample;

    public function __construct(ResponseService $response, TargetUjiGolonganServices $daftarTargetUjiGolongan, KelompokSampleServices $daftarKelompokSample, SatuanServices $daftarSatuan, KodeHsServices $daftarKodeHs)
    {
        $this->response = $response;
        $this->daftarTargetUjiGolongan = $daftarTargetUjiGolongan;
        $this->daftarKelompokSample = $daftarKelompokSample;
        $this->daftarKodeHs = $daftarKodeHs;
        $this->daftarSatuan = $daftarSatuan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.target-uji-golongan.main';
        
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
        $data['list_kode_hs'] = $this->daftarKodeHs->getData();
        $data['list_satuan'] = $this->daftarSatuan->getData();
        $data['list_sample'] = $this->daftarKelompokSample->getData();
        $data['list_data'] = $this->daftarTargetUjiGolongan->getData();

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
            return $this->daftarTargetUjiGolongan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarTargetUjiGolongan->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'kelompok_sample_id'=> 'required',
            'nama_ilmiah'       => 'required',
            'kode_hs_id'        => 'required',
            'satuan_id'         => 'required',
        ];

        return $rules;
    }
}