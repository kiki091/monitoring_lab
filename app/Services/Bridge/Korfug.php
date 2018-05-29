<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Korfug as KorfugInterface;

class Korfug {

    /**
     * @var KorfugInterface
     */
    protected $korfug;

    public function __construct(KorfugInterface $korfug)
    {
        $this->korfug = $korfug;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->korfug->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->korfug->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->korfug->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = array())
    {
        return $this->korfug->delete($params);
    }
} 