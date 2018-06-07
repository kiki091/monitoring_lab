<?php

namespace App\Models;

use App\Models\BaseModel;

class Jabatan extends BaseModel
{
    protected $table = 'tbl_jabatan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_jabatan',
        'nama_jabatan',
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