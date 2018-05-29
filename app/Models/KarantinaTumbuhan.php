<?php

namespace App\Models;

use App\Models\BaseModel;

class KarantinaTumbuhan extends BaseModel
{
    protected $table = 'tbl_karantina_tumbuhan';

    public $timestamps = true;

    protected $fillable = [
        'no_permohonan',
        'tgl_permohonan',
        'kodefikasi_sample',
        'kategori_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
    public function kategori()
    {
        return $this->belongsTo('App\Models\MasterKategori', 'kategori_id', 'id');
    }
    
    public function upt()
    {
        return $this->belongsTo('App\Models\MasterUpt', 'upt_id', 'id');
    }
    
    public function dokter()
    {
        return $this->belongsTo('App\Models\MasterDokter', 'dokter_id', 'id');
    }
    
    public function kegiatan()
    {
        return $this->belongsTo('App\Models\MasterKegiatan', 'kegiatan_id', 'id');
    }
    
    public function perusahaan()
    {
        return $this->belongsTo('App\Models\MasterPerusahaan', 'perusahaan_id', 'id');
    }
    
    public function korfug()
    {
        return $this->hasMany('App\Models\Korfug', 'karantina_tumbuhan_id', 'id')->with(['dokter']);
    }
    
    public function sample()
    {
        return $this->belongsTo('App\Models\SampleTumbuhan', 'kodefikasi_sample', 'id')->with(['target_pengujian', 'target_pengujian.metode_pengujian', 'target_pengujian.metode_pengujian.lab']);
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