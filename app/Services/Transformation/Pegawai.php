<?php

namespace App\Services\Transformation;

class Pegawai
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

                'id'                => isset($data['id']) ? $data['id'] : '',
                'nip_pegawai'       => isset($data['nip_pegawai']) ? $data['nip_pegawai'] : '',
                'nama_lengkap'      => isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '',
                'jabatan'           => isset($data['jabatan']) ? $data['jabatan']['nama_jabatan'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']              = isset($data['id']) ? $data['id'] : '';
        $objData['nip_pegawai']     = isset($data['nip_pegawai']) ? $data['nip_pegawai'] : '';
        $objData['nama_lengkap']    = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $objData['jabatan_id']      = isset($data['jabatan_id']) ? $data['jabatan_id'] : '';

        return $objData;
    }

}