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

                'id'                => isset($data['id']) ? $data['id'] : '',
                'nama_kelompok'     => isset($data['nama_kelompok']) ? $data['nama_kelompok'] : '',
                'laboratorium'     => isset($data['lab']['nama_laboratorium']) ? $data['lab']['nama_laboratorium'] : '',
                'target_pengujian'     => isset($data['target_pengujian']['nama_target']) ? $data['target_pengujian']['nama_target'] : '',
                'kelompok_pengujian'     => isset($data['kelompok_pengujian']['nama_kelompok']) ? $data['kelompok_pengujian']['nama_kelompok'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['nama_kelompok'] = isset($data['nama_kelompok']) ? $data['nama_kelompok'] : '';
        $objData['target_pengujian_id'] = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';
        $objData['laboratorium_id'] = isset($data['laboratorium_id']) ? $data['laboratorium_id'] : '';
        $objData['kelompok_uji_id'] = isset($data['kelompok_uji_id']) ? $data['kelompok_uji_id'] : '';

        return $objData;
    }

}