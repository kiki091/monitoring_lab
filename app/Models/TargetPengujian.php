<?php

namespace App\Models;

use App\Models\BaseModel;

class TargetPengujian extends BaseModel
{
    protected $table = 'tbl_target_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_target'
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
    
    public function metode_pengujian()
    {
        return $this->belongsTo('App\Models\MetodePengujian', 'id', 'target_pengujian_id');
    }


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}