<?php

namespace App\Services\Transformation;

class MetodePengujian
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

                'id'                       => isset($data['id']) ? $data['id'] : '',
                'nama_metode_pengujian'    => isset($data['nama_metode_pengujian']) ? $data['nama_metode_pengujian'] : '',
                'target_pengujian'         => isset($data['target_pengujian']) ? $data['target_pengujian']['nama_target_pengujian'] : '',
                'laboratorium'             => isset($data['laboratorium']) ? $data['laboratorium']['nama_laboratorium'] : '',
                'kode_kelompok'            => isset($data['kelompok_metode_pengujian']) ? $data['kelompok_metode_pengujian']['kode_kelompok'] : '',
                'nama_kelompok'            => isset($data['kelompok_metode_pengujian']) ? $data['kelompok_metode_pengujian']['nama_kelompok'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                           = isset($data['id']) ? $data['id'] : '';
        $objData['nama_metode_pengujian']        = isset($data['nama_metode_pengujian']) ? $data['nama_metode_pengujian'] : '';
        $objData['target_pengujian_id']          = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';
        $objData['laboratorium_id']              = isset($data['laboratorium_id']) ? $data['laboratorium_id'] : '';
        $objData['kelompok_metode_pengujian_id'] = isset($data['kelompok_metode_pengujian_id']) ? $data['kelompok_metode_pengujian_id'] : '';

        return $objData;
    }

}