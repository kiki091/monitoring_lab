<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterKategori extends BaseModel
{
    protected $table = 'tbl_kategori';

    public $timestamps = true;

    protected $fillable = [
        'nama_kategori',
        'created_at',
        'updated_at'
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