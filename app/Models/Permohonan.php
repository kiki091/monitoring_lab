<?php

namespace App\Models;

use App\Models\BaseModel;

class Permohonan extends BaseModel
{
    protected $table = 'tbl_permohonan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'tgl_permohonan',
        'no_agenda',
        'no_permohonan',
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
    
    public function dokter_hewan()
    {
        return $this->belongsTo('App\Models\DokterHewan', 'dokter_hewan_id', 'id');
    }
    
    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan', 'kegiatan_id', 'id');
    }
    
    public function sample_permohonan()
    {
        return $this->hasMany('App\Models\SamplePermohonan', 'id', 'permohonan_id')->with('sample');
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