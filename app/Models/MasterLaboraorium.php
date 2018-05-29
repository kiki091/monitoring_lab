<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterLaboraorium extends BaseModel
{
    protected $table = 'tbl_laboratorium';

    public $timestamps = false;

    protected $fillable = [
        'nama_laboratorium',
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