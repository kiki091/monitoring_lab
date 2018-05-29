<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterKategori as MasterKategoriInterface;

class MasterKategori {

    /**
     * @var MasterKategoriInterface
     */
    protected $kategori;

    public function __construct(MasterKategoriInterface $kategori)
    {
        $this->kategori = $kategori;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->kategori->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->kategori->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->kategori->edit($params);
    }
} 