<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\TargetPengujian as TargetPengujianInterface;

class TargetPengujian {

    /**
     * @var TargetPengujianInterface
     */
    protected $targetPengujian;

    public function __construct(TargetPengujianInterface $targetPengujian)
    {
        $this->targetPengujian = $targetPengujian;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->targetPengujian->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->targetPengujian->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->targetPengujian->edit($params);
    }
} 