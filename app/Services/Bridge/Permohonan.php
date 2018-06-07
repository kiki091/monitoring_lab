<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Permohonan as PermohonanInterface;

class Permohonan {

    /**
     * @var Permohonan Interface
     */
    protected $daftarPermohonan;

    public function __construct(PermohonanInterface $daftarPermohonan)
    {
        $this->daftarPermohonan = $daftarPermohonan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarPermohonan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarPermohonan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarPermohonan->edit($params);
    }
} 