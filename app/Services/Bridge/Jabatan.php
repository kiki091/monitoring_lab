<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Jabatan as JabatanInterface;

class Jabatan {

    /**
     * @var Jabatan Interface
     */
    protected $daftarJabatan;

    public function __construct(JabatanInterface $daftarJabatan)
    {
        $this->daftarJabatan = $daftarJabatan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarJabatan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarJabatan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarJabatan->edit($params);
    }
} 