<?php

namespace App\Models;

use App\Models\BaseModel;

class PermohonanPengujian extends BaseModel
{
    protected $table = 'tbl_permohonan_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'permohonan_id',
        'target_uji_golongan_id',
        'target_pest_id',
        'lama_uji',
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
    
    public function permohonan()
    {
        return $this->belongsTo('App\Models\Permohonan', 'permohonan_id', 'id');
    }
    
    public function target_uji_golongan()
    {
        return $this->belongsTo('App\Models\TargetUjiGolongan', 'target_uji_golongan_id', 'id');
    }
    
    public function target_pest()
    {
        return $this->belongsTo('App\Models\TargetPest', 'target_pest_id', 'id');
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