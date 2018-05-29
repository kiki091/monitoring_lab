<?php

namespace App\Services\Transformation;

class HasilLaboratorium
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
                'laboratorium'      => isset($data['karantina']['sample']['target_pengujian']['metode_pengujian']['lab']['nama_laboratorium']) ? $data['karantina']['sample']['target_pengujian']['metode_pengujian']['lab']['nama_laboratorium'] : '',
                'kode_sample'                => isset($data['karantina']['sample']['kode_sample']) ? $data['karantina']['sample']['kode_sample'] : '',
                'nama_sample'                => isset($data['karantina']['sample']['nama_sample']) ? $data['karantina']['sample']['nama_sample'] : '',
                'tgl_terima_sample'                => isset($data['karantina']['tgl_terima_sample']) ? $data['karantina']['tgl_terima_sample'] : '',
                'tgl_permohonan'                => isset($data['karantina']['tgl_permohonan']) ? $data['karantina']['tgl_permohonan'] : '',
                'target_pengujian'                => isset($data['karantina']['sample']['target_pengujian']['nama_target']) ? $data['karantina']['sample']['target_pengujian']['nama_target'] : '',
                'metode_pengujian'                => isset($data['karantina']['sample']['target_pengujian']['metode_pengujian']['nama_kelompok']) ? $data['karantina']['sample']['target_pengujian']['metode_pengujian']['nama_kelompok'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {dd($data);
        $objData['id'] = isset($data['id']) ? $data['id'] : '';

        return $objData;
    }

}