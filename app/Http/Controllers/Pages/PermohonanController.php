<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Bridge\Daerah as DaerahServices;
use App\Services\Bridge\Upt as UptServices;
use App\Services\Bridge\Negara as NegaraServices;
use App\Services\Bridge\Permohonan as PermohonanServices;
use App\Services\Bridge\DokterHewan as DokterHewanServices;
use App\Services\Bridge\Kegiatan as KegiatanServices;
use App\Services\Bridge\Sample as SampleServices;
use App\Services\Bridge\TargetPengujian as TargetPengujianServices;
use App\Services\Bridge\Satuan as SatuanServices;
use App\Services\Bridge\Kategori as KategoriServices;
use App\Services\Bridge\Perusahaan as PerusahaanServices;
use App\Services\Bridge\TargetPest as TargetPestServices;
use App\Services\Bridge\TargetUjiGolongan as TargetUjiGolonganServices;
use App\Services\Api\Response as ResponseService;
use App\Custom\DataHelper;

use Auth;
use Session;
use Validator;
use ValidatesRequests;

class PermohonanController extends BaseController
{
    protected $response;
    protected $daftarUpt;
    protected $daftarDaerah;
    protected $daftarNegara;
    protected $daftarPermohonan;
    protected $daftarDokterHewan;
    protected $daftarKegiatan;
    protected $daftarSample;
    protected $daftarTargetPengujian;
    protected $daftarSatuan;
    protected $daftarKategori;
    protected $daftarPerusahaan;
    protected $daftarTargetPest;
    protected $daftarTargetUjiGolongan;

    public function __construct(ResponseService $response, UptServices $daftarUpt, NegaraServices $daftarNegara, PermohonanServices $daftarPermohonan, 
            DokterHewanServices $daftarDokterHewan, KegiatanServices $daftarKegiatan, SampleServices $daftarSample, TargetPengujianServices $daftarTargetPengujian, SatuanServices $daftarSatuan, KategoriServices $daftarKategori, PerusahaanServices $daftarPerusahaan, DaerahServices $daftarDaerah, TargetUjiGolonganServices $daftarTargetUjiGolongan, TargetPestServices $daftarTargetPest)
    {
        $this->response = $response;
        $this->daftarUpt = $daftarUpt;
        $this->daftarNegara = $daftarNegara;
        $this->daftarPermohonan = $daftarPermohonan;
        $this->daftarDokterHewan = $daftarDokterHewan;
        $this->daftarKegiatan = $daftarKegiatan;
        $this->daftarSample = $daftarSample;
        $this->daftarTargetPengujian = $daftarTargetPengujian;
        $this->daftarSatuan = $daftarSatuan;
        $this->daftarKategori = $daftarKategori;
        $this->daftarPerusahaan = $daftarPerusahaan;
        $this->daftarDaerah = $daftarDaerah;
        $this->daftarTargetPest = $daftarTargetPest;
        $this->daftarTargetUjiGolongan = $daftarTargetUjiGolongan;
    }

    /**
     * Index 
     * @return string
     */

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_CMS. '.monitoring.permohonan.main';
        
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
        $data['list_upt'] = $this->daftarUpt->getData();
        $data['list_negara'] = $this->daftarNegara->getData();
        $data['list_dokter'] = $this->daftarDokterHewan->getData();
        $data['list_kegiatan'] = $this->daftarKegiatan->getData();
        $data['list_target'] = $this->daftarTargetPengujian->getData();
        $data['list_satuan'] = $this->daftarSatuan->getData();
        $data['list_sample'] = $this->daftarSample->getData(['limit_data' => true]);
        $data['list_kategori'] = $this->daftarKategori->getData();
        $data['list_perusahaan'] = $this->daftarPerusahaan->getData();
        $data['list_daerah'] = $this->daftarDaerah->getData();
        $data['list_target_pest'] = $this->daftarTargetPest->getData();
        $data['list_target_uji_golongan'] = $this->daftarTargetUjiGolongan->getData();
        $data['list_data'] = $this->daftarPermohonan->getData();

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
            return $this->daftarPermohonan->store($request->except(['_token']));
        }
    }

    /**
     * Edit Data
     * @return string
     */

    public function edit(Request $request)
    {
        return $this->daftarPermohonan->edit($request->except(['_token']));
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    protected function validation($request = array())
    {
        if($request['kegiatan_id'] == '3')
        {
            $rules = [
                'type_permohonan'           => 'required',
                'kategori_uji_id'           => 'required',
                'kegiatan_id'               => 'required',
                'negara_id'                 => 'required',
                'dokter_hewan_id'           => 'required',
                'nama_pemilik'              => 'required',
                'alamat_pemilik'            => 'required',
                'pengiriman_sample'         => 'required',
                'nama_pengirim'             => 'required',
                'tgl_terima_sample'         => 'required',
                'nip_petugas_penerima'      => 'required',
                'sample_id'                 => 'required',
                'target_uji_golongan_id'    => 'required',
                'target_pest_id'            => 'required',
                'lama_uji'                  => 'required|numeric',
            ];

        } else {
            $rules = [
                'type_permohonan'           => 'required',
                'kategori_uji_id'           => 'required',
                'kegiatan_id'               => 'required',
                'upt_id'                    => 'required',
                'daerah_id'                 => 'required',
                'dokter_hewan_id'           => 'required',
                'perusahaan_id'             => 'required',
                'pengiriman_sample'         => 'required',
                'nama_pengirim'             => 'required',
                'tgl_terima_sample'         => 'required',
                'nip_petugas_penerima'      => 'required',
                'sample_id'                 => 'required',
                'target_uji_golongan_id'    => 'required',
                'target_pest_id'            => 'required',
                'lama_uji'                  => 'required|numeric',
            ];
        }
        
        if(!empty($request['dokument_pendukung']))
            $rules['dokument_pendukung'] = 'required|max:1200|mimes:pdf,doc,docx,xlsx';

        if(! is_null($request->input('id')))
            if (is_null($request->file('dokument_pendukung')))
                unset($rules['dokument_pendukung']);

        return $rules;
    }
}