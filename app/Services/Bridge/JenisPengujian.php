<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\JenisPengujian as JenisPengujianInterface;

class JenisPengujian {

    /**
     * @var Jenis Pengujian Interface
     */
    protected $daftarJenisPengujian;

    public function __construct(JenisPengujianInterface $daftarJenisPengujian)
    {
        $this->daftarJenisPengujian = $daftarJenisPengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarJenisPengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarJenisPengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarJenisPengujian->edit($params);
    }
} 