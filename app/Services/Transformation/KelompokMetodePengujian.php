<?php

namespace App\Services\Transformation;

class KelompokMetodePengujian
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
                'kode_kelompok'       => isset($data['kode_kelompok']) ? $data['kode_kelompok'] : '',
                'nama_kelompok'       => isset($data['nama_kelompok']) ? $data['nama_kelompok'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['kode_kelompok'] = isset($data['kode_kelompok']) ? $data['kode_kelompok'] : '';
        $objData['nama_kelompok'] = isset($data['nama_kelompok']) ? $data['nama_kelompok'] : '';

        return $objData;
    }

}