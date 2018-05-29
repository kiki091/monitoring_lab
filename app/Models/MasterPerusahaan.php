<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterPerusahaan extends BaseModel
{
    protected $table = 'tbl_perusahaan';

    public $timestamps = true;

    protected $fillable = [
        'kode_perusahaan',
        'nama_perusahaan',
        'alamat'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];



    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}