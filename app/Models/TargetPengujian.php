<?php

namespace App\Models;

use App\Models\BaseModel;

class TargetPengujian extends BaseModel
{
    protected $table = 'tbl_target_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_target_pengujian',
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