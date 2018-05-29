<?php

namespace App\Models;

use App\Models\BaseModel;

class KarantinaHewan extends BaseModel
{
    protected $table = 'tbl_karantina_hewan';

    public $timestamps = true;

    protected $fillable = [
        'no_permohonan',
        'tgl_permohonan',
        'kode_sample_hewan_id',
        'kategori_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    
    public function dokter()
    {
        return $this->belongsTo('App\Models\MasterDokter', 'dokter_id', 'id');
    }
    
    public function kegiatan()
    {
        return $this->belongsTo('App\Models\MasterKegiatan', 'kegiatan_id', 'id');
    }
    
    public function sample()
    {
        return $this->belongsTo('App\Models\SampleHewan', 'kode_sample_hewan_id', 'id')->with(['target_pengujian', 'target_pengujian.metode_pengujian', 'target_pengujian.metode_pengujian.lab']);
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