<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Kategori as KategoriInterface;

class Kategori {

    /**
     * @var Kategori Interface
     */
    protected $daftarKategori;

    public function __construct(KategoriInterface $daftarKategori)
    {
        $this->daftarKategori = $daftarKategori;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarKategori->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarKategori->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarKategori->edit($params);
    }
} 