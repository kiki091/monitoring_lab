<?php

namespace App\Services\Transformation;

class KarantinaTumbuhan
{
	/**
     * Get Transformation
     * @param $data
     * @return array
     */
    public function getDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataTransform($data);
    }

    /**
     * Get Transformation
     * @param $data
     * @return array
     */
    public function getSingleDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleDataTransform($data);
    }

    /**
     * Set Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [

                'id'                    => isset($data['id']) ? $data['id'] : '',
                'no_permohonan'         => isset($data['no_permohonan']) ? $data['no_permohonan'] : '',
                'tgl_permohonan'        => isset($data['tgl_permohonan']) ? $data['tgl_permohonan'] : '',
                'kodefikasi_sample'     => isset($data['sample']['kode_sample']) ? $data['sample']['kode_sample'] : '',
                'kode_area'             => isset($data['kode_area']) ? $data['kode_area'] : '',
                'dokument_pendukung'    => isset($data['dokument_pendukung']) ? $data['dokument_pendukung'] : '',
                'lampiran_hsl_uji'      => isset($data['lampiran_hsl_uji']) ? $data['lampiran_hsl_uji'] : '',
                'pengiriman_sample'     => isset($data['pengiriman_sample']) ? $data['pengiriman_sample'] : '',
                'nama_pengantar'        => isset($data['nama_pengantar']) ? $data['nama_pengantar'] : '',
                'tgl_terima_sample'     => isset($data['tgl_terima_sample']) ? $data['tgl_terima_sample'] : '',
                'nip_petugas_penerima'  => isset($data['nip_petugas_penerima']) ? $data['nip_petugas_penerima'] : '',
                'kategori'              => isset($data['kategori']) ? $data['kategori']['nama_kategori'] : '',
                'upt'                   => isset($data['upt']) ? $data['upt']['nama_upt'] : '',
                'dokter'                => isset($data['dokter']) ? $data['dokter']['nama_lengkap'] : '',
                'kegiatan'              => isset($data['kegiatan']) ? $data['kegiatan']['nama_kegiatan'] : '',
                'perusahaan'            => isset($data['perusahaan']) ? $data['perusahaan']['nama_perusahaan'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {

        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['no_permohonan'] = isset($data['no_permohonan']) ? $data['no_permohonan'] : '';
        $objData['tgl_permohonan'] = isset($data['tgl_permohonan']) ? $data['tgl_permohonan'] : '';
        $objData['tgl_terima_sample'] = isset($data['tgl_terima_sample']) ? $data['tgl_terima_sample'] : '';
        $objData['kodefikasi_sample'] = isset($data['kodefikasi_sample']) ? $data['kodefikasi_sample'] : '';
        $objData['kategori_id'] = isset($data['kategori_id']) ? $data['kategori_id'] : '';
        $objData['upt_id'] = isset($data['upt_id']) ? $data['upt_id'] : '';
        $objData['dokter_id'] = isset($data['dokter_id']) ? $data['dokter_id'] : '';
        $objData['kegiatan_id'] = isset($data['kegiatan_id']) ? $data['kegiatan_id'] : '';
        $objData['kode_area'] = isset($data['kode_area']) ? $data['kode_area'] : '';
        $objData['perusahaan_id'] = isset($data['perusahaan_id']) ? $data['perusahaan_id'] : '';
        $objData['dokument_pendukung'] = isset($data['dokument_pendukung']) ? $data['dokument_pendukung'] : '';
        $objData['dokument_pendukung_url'] = isset($data['dokument_pendukung']) ? asset('/upload/document/'.$data['dokument_pendukung']) : '';
        $objData['lampiran_hsl_uji'] = isset($data['lampiran_hsl_uji']) ? $data['lampiran_hsl_uji'] : '';
        $objData['pengiriman_sample'] = isset($data['pengiriman_sample']) ? $data['pengiriman_sample'] : '';
        $objData['nama_pengantar'] = isset($data['nama_pengantar']) ? $data['nama_pengantar'] : '';
        $objData['tgl_terima_sample'] = isset($data['tgl_terima_sample']) ? $data['tgl_terima_sample'] : '';
        $objData['nip_petugas_penerima'] = isset($data['nip_petugas_penerima']) ? $data['nip_petugas_penerima'] : '';
        $objData['keterangan'] = isset($data['keterangan']) ? $data['keterangan'] : '';
        $objData['status'] = isset($data['status']) ? $data['status'] : '';
        $objData['saran'] = isset($data['saran']) ? $data['saran'] : '';

        $objData['kategori'] = isset($data['kategori']['nama_kategori']) ? $data['kategori']['nama_kategori'] : '';
        $objData['upt'] = isset($data['upt']['nama_upt']) ? $data['upt']['nama_upt'] : '';
        $objData['kode_upt'] = isset($data['upt']['kode_upt']) ? $data['upt']['kode_upt'] : '';
        $objData['nip_dokter'] = isset($data['dokter']['nip_dokter']) ? $data['dokter']['nip_dokter'] : '';
        $objData['nama_dokter'] = isset($data['dokter']['nama_lengkap']) ? $data['dokter']['nama_lengkap'] : '';
        $objData['kegiatan'] = isset($data['kegiatan']['nama_kegiatan']) ? $data['kegiatan']['nama_kegiatan'] : '';
        $objData['kode_perusahaan'] = isset($data['perusahaan']['kode_perusahaan']) ? $data['perusahaan']['kode_perusahaan'] : '';
        $objData['nama_perusahaan'] = isset($data['perusahaan']['nama_perusahaan']) ? $data['perusahaan']['nama_perusahaan'] : '';
        $objData['kode_sample'] = isset($data['sample']['kode_sample']) ? $data['sample']['kode_sample'] : '';
        $objData['nama_sample'] = isset($data['sample']['nama_sample']) ? $data['sample']['nama_sample'] : '';
        $objData['target_uji_id'] = isset($data['sample']['target_pengujian']['id']) ? $data['sample']['target_pengujian']['id'] : '';
        $objData['target_pengujian'] = isset($data['sample']['target_pengujian']['nama_target']) ? $data['sample']['target_pengujian']['nama_target'] : '';
        $objData['target_hph'] = isset($data['sample']['target_pengujian']['target_hph']) ? $data['sample']['target_pengujian']['target_hph'] : '';
        $objData['metode_pengujian'] = isset($data['sample']['target_pengujian']['metode_pengujian']['nama_kelompok']) ? $data['sample']['target_pengujian']['metode_pengujian']['nama_kelompok'] : '';
        $objData['laboratorium'] = isset($data['sample']['target_pengujian']['metode_pengujian']['lab']['nama_laboratorium']) ? $data['sample']['target_pengujian']['metode_pengujian']['lab']['nama_laboratorium'] : '';
        $objData['jenis_sample'] = isset($data['sample']['jenis_sample']) ? $data['sample']['jenis_sample'] : '';
        $objData['jml_vol'] = isset($data['sample']['jml_vol']) ? $data['sample']['jml_vol'] : '';
        $objData['satuan_sample'] = isset($data['sample']['satuan']) ? $data['sample']['satuan'] : '';
        $objData['korfug'] = isset($data['korfug']) ? $this->getListKofrugByKarantina($data['korfug']) : '';

        return $objData;
    }

    protected function getListKofrugByKarantina($data)
    {
        $dataTransform = array_map(function($data) {

            return [
                'id'            => isset($data['id']) ? $data['id'] : '',
                'tgl_usulan'    => isset($data['tgl_usulan']) ? $data['tgl_usulan'] : '',
                'nip_korfug'    => isset($data['nip_korfug']) ? $data['nip_korfug'] : '',
                'kedudukan'     => isset($data['kedudukan']) ? $data['kedudukan'] : '',
                'dokter'        => isset($data['dokter']['nama_lengkap']) ? $data['dokter']['nama_lengkap'] : '',
            ];
        },$data);

        $finalData = [];
        foreach ($dataTransform as $item) {
            $finalData[$item['kedudukan']][] = $item;

        }
        
        return $finalData;
    }

}