<?php

namespace App\Models;

use App\Models\BaseModel;

class Pegawai extends BaseModel
{
    protected $table = 'tbl_pegawai';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nip_pegawai',
        'nama_lengkap',
        'jabatan_id',
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
    
    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'jabatan_id', 'id');
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