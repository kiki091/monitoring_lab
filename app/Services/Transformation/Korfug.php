<?php

namespace App\Services\Transformation;

class Korfug
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
    {dd($data);
        $dataTransform = array_map(function($data) {

            return [

                'id'          => isset($data['id']) ? $data['id'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['dokter_id'] = isset($data['dokter_id']) ? $data['dokter_id'] : '';
        $objData['tgl_usulan'] = isset($data['tgl_usulan']) ? $data['tgl_usulan'] : '';
        $objData['nip_korfug'] = isset($data['nip_korfug']) ? $data['nip_korfug'] : '';
        $objData['karantina_tumbuhan_id'] = isset($data['karantina_tumbuhan_id']) ? $data['karantina_tumbuhan_id'] : '';

        return $objData;
    }

}