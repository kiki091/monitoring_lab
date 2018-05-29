<?php

namespace App\Services\Transformation\Auth;

class Location
{
	/**
     * Get Location Transformation
     * @param $data
     * @return array
     */
    public function getLocationCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setLocationCmsTransform($data);
    }

    /**
     * Set Location Transformation
     * @param $data
     * @return array
     */

    protected function setLocationCmsTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [

                'location_id'   => isset($data['id']) ? $data['id'] : '',
                'name'          => isset($data['name']) ? $data['name'] : '',
                'slug'          => isset($data['slug']) ? $data['slug'] : '',
            ];

        },$data);

        return $dataTransform;
    }

}