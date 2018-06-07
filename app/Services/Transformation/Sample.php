<?php

namespace App\Services\Transformation;

class Sample
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

                'id'                        => isset($data['id']) ? $data['id'] : '',
                'kode_sample'               => isset($data['kode_sample']) ? $data['kode_sample'] : '',
                'nama_sample'               => isset($data['nama_sample']) ? $data['nama_sample'] : '',
                'jenis_sample'              => isset($data['jenis_sample']) ? $data['jenis_sample'] : '',
                'jml_vol'                   => isset($data['jml_vol']) ? $data['jml_vol'] : '',
                'nama_komoditas'            => isset($data['nama_komoditas']) ? $data['nama_komoditas'] : '',
                'satuan'                    => isset($data['satuan']) ? $data['satuan']['nama_satuan'] : '',
                'tgl_pengambilan_sample'    => isset($data['tgl_pengambilan_sample']) ? $data['tgl_pengambilan_sample'] : '',
                'metode_pengambilan_sample' => isset($data['metode_pengambilan_sample']) ? $data['metode_pengambilan_sample'] : '',
                'kondisi_sample'            => isset($data['kondisi_sample']) ? $data['kondisi_sample'] : '',
                'target_pengujian'          => isset($data['target_pengujian']) ? $data['target_pengujian']['nama_target_pengujian'] : '',
                'nama_customer'             => isset($data['nama_customer']) ? $data['nama_customer'] : '',
                'alamat'                    => isset($data['alamat']) ? $data['alamat'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                      = isset($data['id']) ? $data['id'] : '';
        $objData['kode_sample']             = isset($data['kode_sample']) ? $data['kode_sample'] : '';
        $objData['nama_sample']             = isset($data['nama_sample']) ? $data['nama_sample'] : '';
        $objData['jenis_sample']            = isset($data['jenis_sample']) ? $data['jenis_sample'] : '';
        $objData['jml_vol']                 = isset($data['jml_vol']) ? $data['jml_vol'] : '';
        $objData['nama_komoditas']          = isset($data['nama_komoditas']) ? $data['nama_komoditas'] : '';
        $objData['satuan_id']               = isset($data['satuan_id']) ? $data['satuan_id'] : '';
        $objData['tgl_pengambilan_sample']  = isset($data['tgl_pengambilan_sample']) ? $data['tgl_pengambilan_sample'] : '';
        $objData['metode_pengambilan_sample'] = isset($data['metode_pengambilan_sample']) ? $data['metode_pengambilan_sample'] : '';
        $objData['kondisi_sample']          = isset($data['kondisi_sample']) ? $data['kondisi_sample'] : '';
        $objData['target_pengujian_id']     = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';
        $objData['nama_customer']           = isset($data['nama_customer']) ? $data['nama_customer'] : '';
        $objData['alamat']                  = isset($data['alamat']) ? $data['alamat'] : '';

        return $objData;
    }

}