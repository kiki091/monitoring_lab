<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KodeHs as KodeHsInterface;

class KodeHs {

    /**
     * @var KodeHs Interface
     */
    protected $daftarKodeHs;

    public function __construct(KodeHsInterface $daftarKodeHs)
    {
        $this->daftarKodeHs = $daftarKodeHs;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarKodeHs->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarKodeHs->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarKodeHs->edit($params);
    }
} 