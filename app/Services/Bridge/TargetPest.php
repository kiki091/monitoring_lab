<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\TargetPest as TargetPestInterface;

class TargetPest {

    /**
     * @var Target Pest Interface
     */
    protected $daftarTargetPest;

    public function __construct(TargetPestInterface $daftarTargetPest)
    {
        $this->daftarTargetPest = $daftarTargetPest;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarTargetPest->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarTargetPest->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarTargetPest->edit($params);
    }
} 