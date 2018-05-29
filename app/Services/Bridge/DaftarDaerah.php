<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\DaftarDaerah as DaftarDaerahInterface;

class DaftarDaerah {

    /**
     * @var DaftarDaerahInterface
     */
    protected $daftarDaerah;

    public function __construct(DaftarDaerahInterface $daftarDaerah)
    {
        $this->daftarDaerah = $daftarDaerah;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarDaerah->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarDaerah->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarDaerah->edit($params);
    }
} 