<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Sample as SampleInterface;

class Sample {

    /**
     * @var Sample  Interface
     */
    protected $daftarSample;

    public function __construct(SampleInterface $daftarSample)
    {
        $this->daftarSample = $daftarSample;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarSample->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarSample->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarSample->edit($params);
    }
} 