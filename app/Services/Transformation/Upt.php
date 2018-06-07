<?php

namespace App\Services\Transformation;

class Upt
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
                'kode_upt'       => isset($data['kode_upt']) ? $data['kode_upt'] : '',
                'nama_upt'       => isset($data['nama_upt']) ? $data['nama_upt'] : '',
                'daerah'       => isset($data['daerah']) ? $data['daerah']['nama_daerah'] : '',
                'jenis_pelabuhan'       => isset($data['jenis_pelabuhan']) ? $data['jenis_pelabuhan'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']              = isset($data['id']) ? $data['id'] : '';
        $objData['kode_upt']        = isset($data['kode_upt']) ? $data['kode_upt'] : '';
        $objData['nama_upt']        = isset($data['nama_upt']) ? $data['nama_upt'] : '';
        $objData['daerah_id']       = isset($data['daerah_id']) ? $data['daerah_id'] : '';
        $objData['jenis_pelabuhan'] = isset($data['jenis_pelabuhan']) ? $data['jenis_pelabuhan'] : '';

        return $objData;
    }

}