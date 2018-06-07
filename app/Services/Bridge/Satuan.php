<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Satuan as SatuanInterface;

class Satuan {

    /**
     * @var Satuan Interface
     */
    protected $daftarSatuan;

    public function __construct(SatuanInterface $daftarSatuan)
    {
        $this->daftarSatuan = $daftarSatuan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarSatuan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarSatuan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarSatuan->edit($params);
    }
} 