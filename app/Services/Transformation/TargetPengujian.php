<?php

namespace App\Services\Transformation;

class TargetPengujian
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
                'nama_target'       => isset($data['nama_target']) ? $data['nama_target'] : '',
                'target_hph'       => isset($data['target_hph']) ? $data['target_hph'] : '',
                'keterangan'       => isset($data['keterangan']) ? $data['keterangan'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['nama_target'] = isset($data['nama_target']) ? $data['nama_target'] : '';
        $objData['target_hph'] = isset($data['target_hph']) ? $data['target_hph'] : '';
        $objData['keterangan'] = isset($data['keterangan']) ? $data['keterangan'] : '';

        return $objData;
    }

}