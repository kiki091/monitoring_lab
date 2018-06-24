<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Verifikasi as VerifikasiInterface;

class Verifikasi {

    /**
     * @var Verifikasi Interface
     */
    protected $daftarVerifikasi;

    public function __construct(VerifikasiInterface $daftarVerifikasi)
    {
        $this->daftarVerifikasi = $daftarVerifikasi;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarVerifikasi->store($params);
    }
} 