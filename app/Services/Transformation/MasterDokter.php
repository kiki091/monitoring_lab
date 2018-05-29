<?php

namespace App\Services\Transformation;

class MasterDokter
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

                'id'            => isset($data['id']) ? $data['id'] : '',
                'nip_dokter'    => isset($data['nip_dokter']) ? $data['nip_dokter'] : '',
                'nama_lengkap'  => isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '',
                'alamat'        => isset($data['alamat']) ? $data['alamat'] : '',
                'no_telpon'     => isset($data['no_telpon']) ? $data['no_telpon'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['nip_dokter'] = isset($data['nip_dokter']) ? $data['nip_dokter'] : '';
        $objData['nama_lengkap'] = isset($data['nama_lengkap']) ? $data['nama_lengkap'] : '';
        $objData['alamat'] = isset($data['alamat']) ? $data['alamat'] : '';
        $objData['no_telpon'] = isset($data['no_telpon']) ? $data['no_telpon'] : '';

        return $objData;
    }

}