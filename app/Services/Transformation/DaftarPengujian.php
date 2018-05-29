<?php

namespace App\Services\Transformation;

class DaftarPengujian
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
                'kode_hph'          => isset($data['kode_hph']) ? $data['kode_hph'] : '',
                'target_pengujian'  => isset($data['target_pengujian']) ? $data['target_pengujian']['nama_target'] : '',
                'lama_uji'          => isset($data['lama_uji']) ? $data['lama_uji'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['target_pengujian_id'] = isset($data['target_pengujian_id']) ? $data['target_pengujian_id'] : '';
        $objData['kode_hph'] = isset($data['kode_hph']) ? $data['kode_hph'] : '';
        $objData['lama_uji'] = isset($data['lama_uji']) ? $data['lama_uji'] : '';

        return $objData;
    }

}