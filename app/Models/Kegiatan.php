<?php

namespace App\Models;

use App\Models\BaseModel;

class Kegiatan extends BaseModel
{
    protected $table = 'tbl_kegiatan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_kegiatan',
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