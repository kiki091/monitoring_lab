<?php

namespace App\Services\Transformation;

class DaftarDaerah
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
                'kode_daerah'       => isset($data['kode_daerah']) ? $data['kode_daerah'] : '',
                'nama_daerah'       => isset($data['nama_daerah']) ? $data['nama_daerah'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['kode_daerah'] = isset($data['kode_daerah']) ? $data['kode_daerah'] : '';
        $objData['nama_daerah'] = isset($data['nama_daerah']) ? $data['nama_daerah'] : '';

        return $objData;
    }

}