<?php

namespace App\Models;

use App\Models\BaseModel;

class DaftarPengujian extends BaseModel
{
    protected $table = 'tbl_daftar_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'target_pengujian_id',
        'kode_hph',
        'lama_uji',
        'created_at',
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

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_pengujian_id', 'id');
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