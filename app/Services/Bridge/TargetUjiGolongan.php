<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\TargetUjiGolongan as TargetUjiGolonganInterface;

class TargetUjiGolongan {

    /**
     * @var Target Uji Golongan Interface
     */
    protected $daftarTargetUjiGolongan;

    public function __construct(TargetUjiGolonganInterface $daftarTargetUjiGolongan)
    {
        $this->daftarTargetUjiGolongan = $daftarTargetUjiGolongan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->daftarTargetUjiGolongan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->daftarTargetUjiGolongan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->daftarTargetUjiGolongan->edit($params);
    }
} 