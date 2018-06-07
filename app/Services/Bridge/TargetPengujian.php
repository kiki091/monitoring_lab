<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\TargetPengujian as TargetPengujianInterface;

class TargetPengujian {

    /**
     * @var Target Pengujian Interface
     */
    protected $daftarTargetPengujian;

    public function __construct(TargetPengujianInterface $daftarTargetPengujian)
    {
        $this->daftarTargetPengujian = $daftarTargetPengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarTargetPengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarTargetPengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarTargetPengujian->edit($params);
    }
} 