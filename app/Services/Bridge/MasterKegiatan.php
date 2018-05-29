<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\MasterKegiatan as MasterKegiatanInterface;

class MasterKegiatan {

    /**
     * @var MasterKegiatanInterface
     */
    protected $masterKegiatan;

    public function __construct(MasterKegiatanInterface $masterKegiatan)
    {
        $this->masterKegiatan = $masterKegiatan;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->masterKegiatan->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->masterKegiatan->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->masterKegiatan->edit($params);
    }
} 