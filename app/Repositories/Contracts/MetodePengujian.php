<?php

namespace App\Repositories\Contracts;


interface MetodePengujian
{

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * @param $params
     * @return mixed
     */
    public function store($params);

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params);

} 