<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\KarantinaHewan as KarantinaHewanInterface;

class KarantinaHewan {

    /**
     * @var KarantinaHewanInterface
     */
    protected $karantinaHewan;

    public function __construct(KarantinaHewanInterface $karantinaHewan)
    {
        $this->karantinaHewan = $karantinaHewan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->karantinaHewan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->karantinaHewan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->karantinaHewan->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function confirm($params = array())
    {
        return $this->karantinaHewan->confirm($params);
    }
} 