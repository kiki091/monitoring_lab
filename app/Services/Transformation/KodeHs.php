<?php

namespace App\Services\Transformation;

class KodeHs
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

                'id'                    => isset($data['id']) ? $data['id'] : '',
                'kode_hs'               => isset($data['kode_hs']) ? $data['kode_hs'] : '',
                'uraian_komoditas'      => isset($data['uraian_komoditas']) ? $data['uraian_komoditas'] : '',
                'description_english'   => isset($data['description_english']) ? $data['description_english'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                      = isset($data['id']) ? $data['id'] : '';
        $objData['kode_hs']                 = isset($data['kode_hs']) ? $data['kode_hs'] : '';
        $objData['uraian_komoditas']        = isset($data['uraian_komoditas']) ? $data['uraian_komoditas'] : '';
        $objData['description_english']     = isset($data['description_english']) ? $data['description_english'] : '';

        return $objData;
    }

}