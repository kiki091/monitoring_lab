<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\HasilLaboratorium as HasilLaboratoriumInterface;

class HasilLaboratorium {

    /**
     * @var HasilLaboratoriumInterface
     */
    protected $hasilLaboratorium;

    public function __construct(HasilLaboratoriumInterface $hasilLaboratorium)
    {
        $this->hasilLaboratorium = $hasilLaboratorium;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->hasilLaboratorium->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = array())
    {
        return $this->hasilLaboratorium->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = array())
    {
        return $this->hasilLaboratorium->edit($params);
    }
} 