<?php

namespace App\Models;

use App\Models\BaseModel;

class KelompokMetodePengujian extends BaseModel
{
    protected $table = 'tbl_kelompok_metode_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_kelompok',
        'nama_kelompok',
    ];
    
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    protected $guarded = [];

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}