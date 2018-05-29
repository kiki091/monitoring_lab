<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Korfug as KorfugServices;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\MasterDokter as MasterDokterServices;
use App\Services\Bridge\KarantinaTumbuhan as KarantinaTumbuhanServices;
use App\Custom\DataHelper;

use Carbon\Carbon;
use PDF;
use Auth;
use Session;
use Validator;
use ValidatesRequests;

class KorfugController extends BaseController
{
    protected $response;
    protected $korfug;
    protected $dokter;
    protected $karantinaTumbuhan;

    public function __construct(KarantinaTumbuhanServices $karantinaTumbuhan, MasterDokterServices $dokter, ResponseService $response, KorfugServices $korfug)
    {
        $this->korfug = $korfug;
        $this->dokter = $dokter;
        $this->response = $response;
        $this->karantinaTumbuhan = $karantinaTumbuhan;
    }


    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.korfug.main';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }

    /**
     * Index 
     * @return string
     */

    public function print(Request $request)
    {   
        $date['tanggal'] = Carbon::now()->format('d M Y');

        if($request['type'] == 'permintaan') {
            
            $data = $this->karantinaTumbuhan->edit($request->all());

            $pdf = PDF::loadView(self::URL_BLADE_CMS. '.korfug.print-permintaan', $data, $date);
        }
        else{

            $data = $this->karantinaTumbuhan->edit($request->all());

            $pdf = PDF::loadView(self::URL_BLADE_CMS. '.korfug.print-usulan', $data, $date);
        }
        
        return $pdf->setPaper('a4', 'landscape')->download('report.pdf');
    }

    /**
     * Get Data 
     * @return string
     */

    public function getData(Request $request)
    {
        $data['dokter'] = $this->dokter->getData();
        $data['permohonan'] = $this->karantinaTumbuhan->getData($request->all());

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
            return $this->korfug->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->korfug->edit($request->except(['_token']));
    }

    /**
     * Edit Data
     * @return string
     */

    public function delete(Request $request)
    {
        return $this->korfug->delete($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'dokter_id'             => 'required',
            'tgl_usulan'            => 'required|date',
            'nip_korfug'            => 'required',
            'karantina_tumbuhan_id' => 'required',
            'kedudukan'             => 'required',
        ];

        return $rules;
    }
}