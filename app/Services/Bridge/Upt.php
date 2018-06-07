<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Upt as UptInterface;

class Upt {

    /**
     * @var Upt Interface
     */
    protected $daftarUpt;

    public function __construct(UptInterface $daftarUpt)
    {
        $this->daftarUpt = $daftarUpt;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarUpt->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarUpt->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarUpt->edit($params);
    }
} 