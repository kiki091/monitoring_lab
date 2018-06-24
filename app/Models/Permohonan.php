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
    
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategori_uji_id', 'id');
    }
    
    public function sample_permohonan()
    {
        return $this->hasMany('App\Models\SamplePermohonan', 'permohonan_id', 'id')->with('sample');
    }
    
    public function permohonan_pengujian()
    {
        return $this->belongsTo('App\Models\PermohonanPengujian', 'id', 'permohonan_id')->with(['target_uji_golongan', 'target_pest']);
    }
    
    public function upt()
    {
        return $this->belongsTo('App\Models\Upt', 'upt_id', 'id');
    }
    
    public function daerah()
    {
        return $this->belongsTo('App\Models\Daerah', 'daerah_id', 'id');
    }
    
    public function negara()
    {
        return $this->belongsTo('App\Models\Negara', 'negara_id', 'id');
    }

    
    public function perusahaan()
    {
        return $this->belongsTo('App\Models\Perusahaan', 'perusahaan_id', 'id');
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