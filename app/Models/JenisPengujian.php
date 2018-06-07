<?php

namespace App\Models;

use App\Models\BaseModel;

class JenisPengujian extends BaseModel
{
    protected $table = 'tbl_jenis_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_jenis_pengujian',
        'target_pengujian_id',
        'metode_pengujian_id',
    ];
    
    protected $hidden = [
        'remember_token',
    ];

    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_pengujian_id', 'id');
    }
    
    public function metode_pengujian()
    {
        return $this->belongsTo('App\Models\MetodePengujian', 'metode_pengujian_id', 'id');
    }

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}