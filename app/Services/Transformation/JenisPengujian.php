<?php

namespace App\Services\Transformation;

class JenisPengujian
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

                'id'                     => isset($data['id']) ? $data['id'] : '',
                'nama_jenis_pengujian'   => isset($data['nama_jenis_pengujian']) ? $data['nama_jenis_pengujian'] : '',
                'target_pengujian'       => isset($data['target_pengujian']) ? $data['target_pengujian']['nama_target_pengujian']  : '',
                'metode_pengujian'       => isset($data['metode_pengujian']) ? $data['metode_pengujian']['nama_metode_pengujian'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                      = isset($data['id']) ? $data['id'] : '';
        $objData['nama_jenis_pengujian']    = isset($data['nama_jenis_pengujian']) ? $data['nama_jenis_pengujian'] : '';
        $objData['target_pengujian_id']     = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';
        $objData['metode_pengujian_id']     = isset($data['metode_pengujian_id']) ? $data['metode_pengujian_id'] : '';

        return $objData;
    }

}