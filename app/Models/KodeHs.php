<?php

namespace App\Models;

use App\Models\BaseModel;

class KodeHs extends BaseModel
{
    protected $table = 'tbl_kode_hs';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_hs',
        'uraian_komoditas',
        'description_english',
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