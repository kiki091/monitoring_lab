<?php

namespace App\Models;

use App\Models\BaseModel;

class Satuan extends BaseModel
{
    protected $table = 'tbl_satuan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_satuan',
        'nama_satuan',
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