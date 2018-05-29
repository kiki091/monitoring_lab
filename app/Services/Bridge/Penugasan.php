<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Penugasan as PenugasanInterface;

class Penugasan {

    /**
     * @var PenugasanInterface
     */
    protected $penugasan;

    public function __construct(PenugasanInterface $penugasan)
    {
        $this->penugasan = $penugasan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->penugasan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->penugasan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->penugasan->edit($params);
    }
} 