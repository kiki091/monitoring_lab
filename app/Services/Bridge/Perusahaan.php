<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Perusahaan as PerusahaanInterface;

class Perusahaan {

    /**
     * @var Perusahaan Interface
     */
    protected $daftarPerusahaan;

    public function __construct(PerusahaanInterface $daftarPerusahaan)
    {
        $this->daftarPerusahaan = $daftarPerusahaan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarPerusahaan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarPerusahaan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarPerusahaan->edit($params);
    }
} 