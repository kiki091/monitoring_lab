<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterPerusahaan as MasterPerusahaanInterface;

class MasterPerusahaan {

    /**
     * @var MasterPerusahaanInterface
     */
    protected $masterPerusahaan;

    public function __construct(MasterPerusahaanInterface $masterPerusahaan)
    {
        $this->masterPerusahaan = $masterPerusahaan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->masterPerusahaan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->masterPerusahaan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->masterPerusahaan->edit($params);
    }
} 