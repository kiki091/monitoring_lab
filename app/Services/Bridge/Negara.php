<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Negara as NegaraInterface;

class Negara {

    /**
     * @var Negara Interface
     */
    protected $daftarNegara;

    public function __construct(NegaraInterface $daftarNegara)
    {
        $this->daftarNegara = $daftarNegara;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarNegara->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarNegara->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarNegara->edit($params);
    }
} 