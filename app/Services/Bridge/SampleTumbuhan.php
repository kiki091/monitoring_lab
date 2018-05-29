<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\SampleTumbuhan as SampleTumbuhanInterface;

class SampleTumbuhan {

    /**
     * @var SampleTumbuhanInterface
     */
    protected $sampleTumbuhan;

    public function __construct(SampleTumbuhanInterface $sampleTumbuhan)
    {
        $this->sampleTumbuhan = $sampleTumbuhan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->sampleTumbuhan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->sampleTumbuhan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->sampleTumbuhan->edit($params);
    }
} 