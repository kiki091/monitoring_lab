<?php

namespace App\Services\Transformation;

class Penugasan
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
                'no_surat'       => isset($data['no_surat']) ? $data['no_surat'] : '',
                'target_uji'       => isset($data['target_pengujian']['nama_target']) ? $data['target_pengujian']['nama_target'] : '',
                'kedudukan'       => isset($data['kedudukan']) ? $data['kedudukan'] : '',
                'karantina'       => isset($data['karantina']['no_permohonan']) ? $data['karantina']['no_permohonan'] : '',
                'kode_sample'       => isset($data['karantina']['sample']['kode_sample']) ? $data['karantina']['sample']['kode_sample'] : '',
                'nama_sample'       => isset($data['karantina']['sample']['nama_sample']) ? $data['karantina']['sample']['nama_sample'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                      = isset($data['id']) ? $data['id'] : '';
        $objData['no_surat']                = isset($data['no_surat']) ? $data['no_surat'] : '';
        $objData['target_uji_id']           = isset($data['target_uji_id']) ? $data['target_uji_id'] : '';
        $objData['kedudukan']               = isset($data['kedudukan']) ? $data['kedudukan'] : '';
        $objData['karantina_tumbuhan_id']   = isset($data['karantina_tumbuhan_id']) ? $data['karantina_tumbuhan_id'] : '';

        return $objData;
    }

}