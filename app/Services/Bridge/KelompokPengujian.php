<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KelompokPengujian as KelompokPengujianInterface;

class KelompokPengujian {

    /**
     * @var KelompokPengujianInterface
     */
    protected $kelompokPengujian;

    public function __construct(KelompokPengujianInterface $kelompokPengujian)
    {
        $this->kelompokPengujian = $kelompokPengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->kelompokPengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->kelompokPengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->kelompokPengujian->edit($params);
    }
} 