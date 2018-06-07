<?php

namespace App\Services\Transformation;

class Negara
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
                'kode_negara'       => isset($data['kode_negara']) ? $data['kode_negara'] : '',
                'nama_negara'       => isset($data['nama_negara']) ? $data['nama_negara'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['kode_negara'] = isset($data['kode_negara']) ? $data['kode_negara'] : '';
        $objData['nama_negara'] = isset($data['nama_negara']) ? $data['nama_negara'] : '';

        return $objData;
    }

}