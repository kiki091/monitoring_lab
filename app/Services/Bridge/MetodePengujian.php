<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MetodePengujian as MetodePengujianInterface;

class MetodePengujian {

    /**
     * @var Metode Pengujian Interface
     */
    protected $daftarMetodePengujian;

    public function __construct(MetodePengujianInterface $daftarMetodePengujian)
    {
        $this->daftarMetodePengujian = $daftarMetodePengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarMetodePengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarMetodePengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarMetodePengujian->edit($params);
    }
} 