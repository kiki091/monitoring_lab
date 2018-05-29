<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\SampleHewan as SampleHewanInterface;

class SampleHewan {

    /**
     * @var SampleHewanInterface
     */
    protected $sampleHewan;

    public function __construct(SampleHewanInterface $sampleHewan)
    {
        $this->sampleHewan = $sampleHewan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->sampleHewan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->sampleHewan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->sampleHewan->edit($params);
    }
} 