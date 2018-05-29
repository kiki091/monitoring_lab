<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterDokter as MasterDokterInterface;

class MasterDokter {

    /**
     * @var MasterDokterInterface
     */
    protected $masterDokter;

    public function __construct(MasterDokterInterface $masterDokter)
    {
        $this->masterDokter = $masterDokter;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->masterDokter->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->masterDokter->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->masterDokter->edit($params);
    }
} 