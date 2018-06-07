<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Laboratorium as LaboratoriumInterface;

class Laboratorium {

    /**
     * @var Laboratorium Interface
     */
    protected $daftarLaboratorium;

    public function __construct(LaboratoriumInterface $daftarLaboratorium)
    {
        $this->daftarLaboratorium = $daftarLaboratorium;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarLaboratorium->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarLaboratorium->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarLaboratorium->edit($params);
    }
} 