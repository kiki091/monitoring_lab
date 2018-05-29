<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterKegiatan extends BaseModel
{
    protected $table = 'tbl_kegiatan';

    public $timestamps = false;

    protected $fillable = [
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
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}