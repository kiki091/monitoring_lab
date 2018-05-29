<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterLaboraorium as MasterLaboraoriumInterface;

class MasterLaboraorium {

    /**
     * @var MasterLaboraoriumInterface
     */
    protected $masterLaboraorium;

    public function __construct(MasterLaboraoriumInterface $masterLaboraorium)
    {
        $this->masterLaboraorium = $masterLaboraorium;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->masterLaboraorium->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->masterLaboraorium->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->masterLaboraorium->edit($params);
    }
} 