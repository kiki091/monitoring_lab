<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MediaTranspor as MediaTransporInterface;

class MediaTranspor {

    /**
     * @var MediaTranspor Interface
     */
    protected $daftarMediaTranspor;

    public function __construct(MediaTransporInterface $daftarMediaTranspor)
    {
        $this->daftarMediaTranspor = $daftarMediaTranspor;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarMediaTranspor->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarMediaTranspor->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarMediaTranspor->edit($params);
    }
} 