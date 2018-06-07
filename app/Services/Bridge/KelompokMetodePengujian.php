<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KelompokMetodePengujian as KelompokMetodePengujianInterface;

class KelompokMetodePengujian {

    /**
     * @var Kelompok Metode Pengujian Interface
     */
    protected $daftarKelompokMetodePengujian;

    public function __construct(KelompokMetodePengujianInterface $daftarKelompokMetodePengujian)
    {
        $this->daftarKelompokMetodePengujian = $daftarKelompokMetodePengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarKelompokMetodePengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarKelompokMetodePengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarKelompokMetodePengujian->edit($params);
    }
} 