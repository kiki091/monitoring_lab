<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\DokterHewan as DokterHewanInterface;

class DokterHewan {

    /**
     * @var DokterHewan Interface
     */
    protected $daftarDokterHewan;

    public function __construct(DokterHewanInterface $daftarDokterHewan)
    {
        $this->daftarDokterHewan = $daftarDokterHewan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarDokterHewan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarDokterHewan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarDokterHewan->edit($params);
    }
} 