<?php

namespace App\Services\Transformation;

class Jabatan
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
                'kode_jabatan'       => isset($data['kode_jabatan']) ? $data['kode_jabatan'] : '',
                'nama_jabatan'       => isset($data['nama_jabatan']) ? $data['nama_jabatan'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['kode_jabatan'] = isset($data['kode_jabatan']) ? $data['kode_jabatan'] : '';
        $objData['nama_jabatan'] = isset($data['nama_jabatan']) ? $data['nama_jabatan'] : '';

        return $objData;
    }

}