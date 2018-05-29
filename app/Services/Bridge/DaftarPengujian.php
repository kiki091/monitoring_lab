<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\DaftarPengujian as DaftarPengujianInterface;

class DaftarPengujian {

    /**
     * @var DaftarPengujianInterface
     */
    protected $daftarPengujian;

    public function __construct(DaftarPengujianInterface $daftarPengujian)
    {
        $this->daftarPengujian = $daftarPengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarPengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarPengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarPengujian->edit($params);
    }
} 