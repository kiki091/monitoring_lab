<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Bridge\Laboratorium as LaboratoriumServices;
use App\Services\Bridge\KelompokMetodePengujian as KelompokMetodePengujianServices;
use App\Services\Bridge\MetodePengujian as MetodePengujianServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class MetodePengujianController extends BaseController
{
    protected $response;
    protected $daftarTargetPengujian;
    protected $daftarLaboratorium;
    protected $daftarKelompokMetodePengujian;
    protected $daftarMetodePengujian;

    public function __construct(ResponseService $response, MetodePengujianServices $daftarMetodePengujian, TargetPengujianServices $daftarTargetPengujian, LaboratoriumServices $daftarLaboratorium, KelompokMetodePengujianServices $daftarKelompokMetodePengujian)
    {
        $this->response = $response;
        $this->daftarTargetPengujian = $daftarTargetPengujian;
        $this->daftarLaboratorium = $daftarLaboratorium;
        $this->daftarKelompokMetodePengujian = $daftarKelompokMetodePengujian;
        $this->daftarMetodePengujian = $daftarMetodePengujian;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.master.metode-pengujian.main';
        
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
        $data['list_laboratorium'] = $this->daftarLaboratorium->getData();
        $data['list_kelompok'] = $this->daftarKelompokMetodePengujian->getData();
        $data['list_data'] = $this->daftarMetodePengujian->getData();

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
            return $this->daftarMetodePengujian->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarMetodePengujian->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'nama_metode_pengujian'              => 'required',
            'target_pengujian_id'                => 'required',
            'laboratorium_id'                    => 'required',
            'kelompok_metode_pengujian_id'       => 'required',
        ];

        return $rules;
    }
}