<?php

namespace App\Services\Transformation;

class Perusahaan
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
                'kode_perusahaan'   => isset($data['kode_perusahaan']) ? $data['kode_perusahaan'] : '',
                'nama_perusahaan'   => isset($data['nama_perusahaan']) ? $data['nama_perusahaan'] : '',
                'alamat'            => isset($data['alamat']) ? $data['alamat'] : '',
                'no_telpon'         => isset($data['no_telpon']) ? $data['no_telpon'] : '',
                'contact_person'    => isset($data['contact_person']) ? $data['contact_person'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']              = isset($data['id']) ? $data['id'] : '';
        $objData['kode_perusahaan'] = isset($data['kode_perusahaan']) ? $data['kode_perusahaan'] : '';
        $objData['nama_perusahaan'] = isset($data['nama_perusahaan']) ? $data['nama_perusahaan'] : '';
        $objData['alamat']          = isset($data['alamat']) ? $data['alamat'] : '';
        $objData['no_telpon']       = isset($data['no_telpon']) ? $data['no_telpon'] : '';
        $objData['contact_person']  = isset($data['contact_person']) ? $data['contact_person'] : '';

        return $objData;
    }

}