<?php

namespace App\Models;

use App\Models\BaseModel;

class MetodePengujian extends BaseModel
{
    protected $table = 'tbl_metode_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'target_pengujian_id',
        'nama_metode_pengujian',
        'laboratorium_id',
        'kelompok_metode_pengujian_id',
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
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_pengujian_id', 'id');
    }
    
    public function laboratorium()
    {
        return $this->belongsTo('App\Models\Laboratorium', 'laboratorium_id', 'id');
    }
    
    public function kelompok_metode_pengujian()
    {
        return $this->belongsTo('App\Models\KelompokMetodePengujian', 'kelompok_metode_pengujian_id', 'id');
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