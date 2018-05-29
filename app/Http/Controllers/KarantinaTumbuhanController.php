<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\KarantinaTumbuhan as KarantinaTumbuhanServices;
use App\Services\Bridge\MasterKegiatan as MasterKegiatanServices;
use App\Services\Bridge\MasterKategori as MasterKategoriServices;
use App\Services\Bridge\MasterDokter as MasterDokterServices;
use App\Services\Bridge\MasterUpt as MasterUptServices;
use App\Services\Bridge\MasterPerusahaan as MasterPerusahaanServices;
use App\Services\Bridge\SampleTumbuhan as SampleTumbuhanServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Carbon\Carbon;
use PDF;
use Auth;
use Session;
use Validator;
use ValidatesRequests;

class KarantinaTumbuhanController extends BaseController
{
    protected $response;
    protected $karantinaTumbuhan;
    protected $kegiatan;
    protected $kategori;
    protected $dokter;
    protected $masterUptServices;
    protected $perusahaan;
    protected $sampleTumbuhan;

    public function __construct(KarantinaTumbuhanServices $karantinaTumbuhan, SampleTumbuhanServices $sampleTumbuhan, MasterKegiatanServices $kegiatan, MasterKategoriServices $kategori, MasterDokterServices $dokter, MasterUptServices $masterUptServices, MasterPerusahaanServices $perusahaan, ResponseService $response)
    {
        $this->response = $response;
        $this->karantinaTumbuhan = $karantinaTumbuhan;
        $this->kegiatan = $kegiatan;
        $this->kategori = $kategori;
        $this->dokter = $dokter;
        $this->masterUptServices = $masterUptServices;
        $this->perusahaan = $perusahaan;
        $this->sampleTumbuhan = $sampleTumbuhan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.karantina-tumbuhan.main';
        
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

        $data = $this->karantinaTumbuhan->edit($request->all());

        $pdf = PDF::loadView(self::URL_BLADE_CMS. '.karantina-tumbuhan.print-out.tanda-terima-sample', $data, $date);
        
        return $pdf->setPaper('a4', 'landscape')->download('tanda-terima-sample.pdf');
    }

    /**
     * Index 
     * @return string
     */

    public function varifikasi(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.karantina-tumbuhan.varifikasi';
        
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
        $data['permohonan'] = $this->karantinaTumbuhan->getData($request->all());
        $data['kegiatan'] = $this->kegiatan->getData();
        $data['kategori'] = $this->kategori->getData();
        $data['dokter'] = $this->dokter->getData();
        $data['upt'] = $this->masterUptServices->getData();
        $data['perusahaan'] = $this->perusahaan->getData();
        $data['sample'] = $this->sampleTumbuhan->getData();

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
            return $this->karantinaTumbuhan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->karantinaTumbuhan->edit($request->except(['_token']));
    }

    /**
     * Edit Data
     * @return string
     */

    public function confirm(Request $request)
    {
        return $this->karantinaTumbuhan->confirm($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        $rules = [
            'tgl_permohonan'        => 'required',
            'kategori_id'           => 'required',
            'dokter_id'             => 'required',
            'kegiatan_id'           => 'required',
            'kode_area'             => 'required',
            'perusahaan_id'         => 'required',
            'lampiran_hsl_uji'      => 'required',
            'pengiriman_sample'     => 'required',
            'nama_pengantar'        => 'required',
            'tgl_terima_sample'     => 'required',
            'nip_petugas_penerima'  => 'required',
            //'dokument_pendukung'    => 'required',
        ];

        return $rules;
    }
}