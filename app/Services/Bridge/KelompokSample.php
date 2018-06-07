<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KelompokSample as KelompokSampleInterface;

class KelompokSample {

    /**
     * @var Kelompok Sample Interface
     */
    protected $daftarKelompokSample;

    public function __construct(KelompokSampleInterface $daftarKelompokSample)
    {
        $this->daftarKelompokSample = $daftarKelompokSample;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarKelompokSample->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarKelompokSample->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarKelompokSample->edit($params);
    }
} 