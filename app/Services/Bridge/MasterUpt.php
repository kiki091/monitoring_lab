<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterUpt as MasterUptInterface;

class MasterUpt {

    /**
     * @var MasterUptInterface
     */
    protected $masterUptServices;

    public function __construct(MasterUptInterface $masterUptServices)
    {
        $this->masterUptServices = $masterUptServices;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->masterUptServices->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->masterUptServices->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->masterUptServices->edit($params);
    }
} 