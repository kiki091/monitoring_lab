<?php

namespace App\Models;

use App\Models\BaseModel;

class Daerah extends BaseModel
{
    protected $table = 'tbl_daerah';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_daerah',
        'nama_daerah',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

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