<?php

namespace App\Models;

use App\Models\BaseModel;

class TargetUjiGolongan extends BaseModel
{
    protected $table = 'tbl_target_uji_golongan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_target_uji',
        'kelompok_sample_id',
        'nama_ilmiah',
        'kode_hs_id',
        'satuan_id',
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
    
    public function kelompok_sample()
    {
        return $this->belongsTo('App\Models\KelompokSample', 'kelompok_sample_id', 'id');
    }
    
    public function kode_hs()
    {
        return $this->belongsTo('App\Models\KodeHs', 'kode_hs_id', 'id');
    }
    
    public function satuan()
    {
        return $this->belongsTo('App\Models\Satuan', 'satuan_id', 'id');
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