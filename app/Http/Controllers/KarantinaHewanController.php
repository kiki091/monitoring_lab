<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\KarantinaHewan as KarantinaHewanServices;
use App\Services\Bridge\MasterKegiatan as MasterKegiatanServices;
use App\Services\Bridge\MasterDokter as MasterDokterServices;
use App\Services\Bridge\SampleHewan as SampleHewanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Carbon\Carbon;
use PDF;
use Auth;
use Session;
use Validator;
use ValidatesRequests;

class KarantinaHewanController extends BaseController
{
    protected $response;
    protected $karantinaHewan;
    protected $kegiatan;
    protected $dokter;
    protected $sampleHewan;

    public function __construct(KarantinaHewanServices $karantinaHewan, SampleHewanServices $sampleHewan, MasterKegiatanServices $kegiatan, MasterDokterServices $dokter, ResponseService $response)
    {
        $this->response = $response;
        $this->karantinaHewan = $karantinaHewan;
        $this->kegiatan = $kegiatan;
        $this->dokter = $dokter;
        $this->sampleHewan = $sampleHewan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.karantina-hewan.main';
        
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

        $data = $this->karantinaHewan->edit($request->all());

        $pdf = PDF::loadView(self::URL_BLADE_CMS. '.karantina-hewan.print-out.tanda-terima-sample', $data, $date);
        
        return $pdf->setPaper('a4', 'landscape')->download('tanda-terima-sample.pdf');
    }

    /**
     * Index 
     * @return string
     */

    public function varifikasi(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.karantina-hewan.varifikasi';
        
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
        $data['permohonan'] = $this->karantinaHewan->getData($request->all());
        $data['kegiatan'] = $this->kegiatan->getData();
        $data['dokter'] = $this->dokter->getData();
        $data['sample'] = $this->sampleHewan->getData();

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
            return $this->karantinaHewan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->karantinaHewan->edit($request->except(['_token']));
    }

    /**
     * Edit Data
     * @return string
     */

    public function confirm(Request $request)
    {
        return $this->karantinaHewan->confirm($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'tgl_permohonan'        => 'required',
            'kode_sample_hewan_id'        => 'required',
            'dokter_hewan_id'           => 'required',
            'kegiatan_id'             => 'required',
            'negara_id'           => 'required',
            'nama_pemilik'             => 'required',
            'lampiran_hasil_uji'         => 'required',
            'pengiriman_sample'     => 'required',
            'nama_pengirim'        => 'required',
            'tgl_terima_sample'     => 'required',
            'nip_petugas_penerima'  => 'required',
        ];

        if(!empty($request['dokument_pendukung'])) {
            $rules['dokument_pendukung'] = 'required|max:20000|mimes:pdf, doc,docx,xlsx';
        }

        return $rules;
    }
}