<?php

namespace App\Services\Transformation;

class MasterUpt
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
                'kode_upt'          => isset($data['kode_upt']) ? $data['kode_upt'] : '',
                'nama_upt'          => isset($data['nama_upt']) ? $data['nama_upt'] : '',
                'daerah'            => isset($data['daerah']) ? $data['daerah'] : '',
                'jns_pelabuhan'     => isset($data['jns_pelabuhan']) ? $data['jns_pelabuhan'] : '',
                'kelas_upt'         => isset($data['kelas_upt']) ? $data['kelas_upt'] : '',
                'nama_lab'          => isset($data['lab']['nama_laboratorium']) ? $data['lab']['nama_laboratorium'] : '',
                'daerah'            => isset($data['daerah']['nama_daerah']) ? $data['daerah']['nama_daerah'] : '',
                'alamat'            => isset($data['alamat']) ? $data['alamat'] : '',
                'no_tlp'            => isset($data['no_tlp']) ? $data['no_tlp'] : '',
                'no_fax'            => isset($data['no_fax']) ? $data['no_fax'] : '',
                'email'             => isset($data['email']) ? $data['email'] : '',
            ];

        },$data);

        return $dataTransform;
    }

    protected function setSingleDataTransform($data)
    {
        $objData['id'] = isset($data['id']) ? $data['id'] : '';
        $objData['kode_upt'] = isset($data['kode_upt']) ? $data['kode_upt'] : '';
        $objData['nama_upt'] = isset($data['nama_upt']) ? $data['nama_upt'] : '';
        $objData['daerah'] = isset($data['daerah']) ? $data['daerah'] : '';
        $objData['jns_pelabuhan'] = isset($data['jns_pelabuhan']) ? $data['jns_pelabuhan'] : '';
        $objData['kelas_upt'] = isset($data['kelas_upt']) ? $data['kelas_upt'] : '';
        $objData['lab_id'] = isset($data['lab_id']) ? $data['lab_id'] : '';
        $objData['daerah_id'] = isset($data['daerah_id']) ? $data['daerah_id'] : '';
        $objData['alamat'] = isset($data['alamat']) ? $data['alamat'] : '';
        $objData['no_tlp'] = isset($data['no_tlp']) ? $data['no_tlp'] : '';
        $objData['no_fax'] = isset($data['no_fax']) ? $data['no_fax'] : '';
        $objData['email'] = isset($data['email']) ? $data['email'] : '';

        return $objData;
    }

}