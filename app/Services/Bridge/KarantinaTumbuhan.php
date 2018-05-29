<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KarantinaTumbuhan as KarantinaTumbuhanInterface;

class KarantinaTumbuhan {

    /**
     * @var KarantinaTumbuhanInterface
     */
    protected $karantinaTumbuhan;

    public function __construct(KarantinaTumbuhanInterface $karantinaTumbuhan)
    {
        $this->karantinaTumbuhan = $karantinaTumbuhan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->karantinaTumbuhan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->karantinaTumbuhan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->karantinaTumbuhan->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function confirm($params = array())
    {
        return $this->karantinaTumbuhan->confirm($params);
    }
} 