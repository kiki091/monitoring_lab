<?php

namespace App\Services\Transformation;

class Permohonan
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
                'tgl_permohonan'        => isset($data['tgl_permohonan']) ? $data['tgl_permohonan'] : '',
                'no_agenda'             => isset($data['no_agenda']) ? $data['no_agenda'] : '',
                'no_permohonan'         => isset($data['no_permohonan']) ? $data['no_permohonan'] : '',
                'type_permohonan'       => isset($data['type_permohonan']) ? $data['type_permohonan'] : '',
                'kategori'              => isset($data['kategori']['nama_kategori']) ? $data['kategori']['nama_kategori'] : '',
                'tgl_terima_sample'     => isset($data['tgl_terima_sample']) ? $data['tgl_terima_sample'] : '',
                'nama_pengirim'         => isset($data['nama_pengirim']) ? $data['nama_pengirim'] : '',
                'status'                => isset($data['status']) ? $data['status'] : '',
                'nip_petugas_penerima'  => isset($data['nip_petugas_penerima']) ? $data['nip_petugas_penerima'] : '',
                'nama_kegiatan'         => isset($data['kegiatan']) ? $data['kegiatan']['nama_kegiatan'] : '',
                'nama_upt'              => isset($data['upt']) ? $data['upt']['nama_upt'] : '',
                'nama_daerah'           => isset($data['daerah']) ? $data['daerah']['nama_daerah'] : '',
                'nama_perusahaan'       => isset($data['perusahaan']) ? $data['perusahaan']['nama_perusahaan'] : '',
                'nama_negara'           => isset($data['negara']) ? $data['negara']['nama_negara'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['tgl_permohonan'] = isset($data['tgl_permohonan']) ? $data['tgl_permohonan'] : '';
        $objData['kategori_uji_id'] = isset($data['kategori_uji_id']) ? $data['kategori_uji_id'] : '';
        $objData['dokter_hewan_id'] = isset($data['dokter_hewan_id']) ? $data['dokter_hewan_id'] : '';
        $objData['kegiatan_id'] = isset($data['kegiatan_id']) ? $data['kegiatan_id'] : '';
        $objData['upt_id'] = isset($data['upt_id']) ? $data['upt_id'] : '';
        $objData['daerah_id'] = isset($data['daerah_id']) ? $data['daerah_id'] : '';
        $objData['perusahaan_id'] = isset($data['perusahaan_id']) ? $data['perusahaan_id'] : '';
        $objData['negara_id'] = isset($data['negara_id']) ? $data['negara_id'] : '';
        $objData['type_permohonan'] = isset($data['type_permohonan']) ? $data['type_permohonan'] : '';
        $objData['nama_pemilik'] = isset($data['nama_pemilik']) ? $data['nama_pemilik'] : '';
        $objData['alamat_pemilik'] = isset($data['alamat_pemilik']) ? $data['alamat_pemilik'] : '';
        $objData['lampiran_hasil_uji'] = isset($data['lampiran_hasil_uji']) ? $data['lampiran_hasil_uji'] : '';
        $objData['dokument_pendukung'] = isset($data['dokument_pendukung']) ? $data['dokument_pendukung'] : '';
        $objData['pengiriman_sample'] = isset($data['pengiriman_sample']) ? $data['pengiriman_sample'] : '';
        $objData['nama_pengirim'] = isset($data['nama_pengirim']) ? $data['nama_pengirim'] : '';
        $objData['tgl_terima_sample'] = isset($data['tgl_terima_sample']) ? $data['tgl_terima_sample'] : '';
        $objData['nip_petugas_penerima'] = isset($data['nip_petugas_penerima']) ? $data['nip_petugas_penerima'] : '';
        $objData['sample_permohonan'] = isset($data['sample_permohonan']) ? $this->getDataSamplePermohonan($data['sample_permohonan']) : '';
        $objData['target_uji_golongan_id'] = isset($data['permohonan_pengujian']) ? $data['permohonan_pengujian']['target_uji_golongan_id'] : '';
        $objData['target_pest_id'] = isset($data['permohonan_pengujian']) ? $data['permohonan_pengujian']['target_pest_id'] : '';
        $objData['lama_uji'] = isset($data['permohonan_pengujian']) ? $data['permohonan_pengujian']['lama_uji'] : '';

        return $objData;
    }

    protected function getDataSamplePermohonan($data)
    {
        return array_map(function($data) {

            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'is_checked' => true,
                'sample_id' => isset($data['sample_id']) ? $data['sample_id'] : '',
                'kode_sample' => isset($data['sample']) ? $data['sample']['kode_sample'] : '',
                'nama_sample' => isset($data['sample']) ? $data['sample']['nama_sample'] : '',
            ];  
        },$data);
    }

}