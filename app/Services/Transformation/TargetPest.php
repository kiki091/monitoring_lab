<?php

namespace App\Services\Transformation;

class TargetPest
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
                'kode_target_pest'  => isset($data['kode_target_pest']) ? $data['kode_target_pest'] : '',
                'nama_target_hph'   => isset($data['nama_target_hph']) ? $data['nama_target_hph'] : '',
                'target_pengujian'  => isset($data['target_pengujian']) ? $data['target_pengujian']['nama_target_pengujian'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                  = isset($data['id']) ? $data['id'] : '';
        $objData['kode_target_pest']    = isset($data['kode_target_pest']) ? $data['kode_target_pest'] : '';
        $objData['nama_target_hph']     = isset($data['nama_target_hph']) ? $data['nama_target_hph'] : '';
        $objData['target_pengujian_id'] = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';

        return $objData;
    }

}