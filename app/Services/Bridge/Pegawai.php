<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Pegawai as PegawaiInterface;

class Pegawai {

    /**
     * @var Pegawai Interface
     */
    protected $daftarPegawai;

    public function __construct(PegawaiInterface $daftarPegawai)
    {
        $this->daftarPegawai = $daftarPegawai;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarPegawai->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarPegawai->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarPegawai->edit($params);
    }
} 