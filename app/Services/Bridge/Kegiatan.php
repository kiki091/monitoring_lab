<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Kegiatan as KegiatanInterface;

class Kegiatan {

    /**
     * @var Kegiatan Interface
     */
    protected $daftarKegiatan;

    public function __construct(KegiatanInterface $daftarKegiatan)
    {
        $this->daftarKegiatan = $daftarKegiatan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarKegiatan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarKegiatan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarKegiatan->edit($params);
    }
} 