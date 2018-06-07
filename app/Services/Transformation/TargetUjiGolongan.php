<?php

namespace App\Services\Transformation;

class TargetUjiGolongan
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
                'kode_target_uji'   => isset($data['kode_target_uji']) ? $data['kode_target_uji'] : '',
                'nama_ilmiah'       => isset($data['nama_ilmiah']) ? $data['nama_ilmiah'] : '',
                'kelompok_sample'   => isset($data['kelompok_sample']) ? $data['kelompok_sample']['nama_kelompok'] : '',
                'kode_hs'           => isset($data['kode_hs']) ? $data['kode_hs']['kode_hs'] : '',
                'satuan'            => isset($data['satuan']) ? $data['satuan']['nama_satuan'] : '',
                
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id']                  = isset($data['id']) ? $data['id'] : '';
        $objData['kode_target_uji']     = isset($data['kode_target_uji']) ? $data['kode_target_uji'] : '';
        $objData['nama_ilmiah']         = isset($data['nama_ilmiah']) ? $data['nama_ilmiah'] : '';
        $objData['kelompok_sample_id']  = isset($data['kelompok_sample_id']) ? $data['kelompok_sample_id'] : '';
        $objData['kode_hs_id']          = isset($data['kode_hs_id']) ? $data['kode_hs_id'] : '';
        $objData['satuan_id']           = isset($data['satuan_id']) ? $data['satuan_id'] : '';

        return $objData;
    }

}