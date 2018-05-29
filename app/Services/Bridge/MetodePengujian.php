<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MetodePengujian as MetodePengujianInterface;

class MetodePengujian {

    /**
     * @var MetodePengujianInterface
     */
    protected $metodePengujian;

    public function __construct(MetodePengujianInterface $metodePengujian)
    {
        $this->metodePengujian = $metodePengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->metodePengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->metodePengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->metodePengujian->edit($params);
    }
} 