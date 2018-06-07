<?php

namespace App\Models;

use App\Models\BaseModel;

class Sample extends BaseModel
{
    protected $table = 'tbl_sample';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_sample',
        'nama_sample',
        'jenis_sample',
        'jml_vol',
        'satuan_id',
        'nama_komoditas',
        'tgl_pengambilan_sample',
        'metode_pengambilan_sample',
        'kondisi_sample',
        'target_pengujian_id',
        'nama_customer',
        'alamat',
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
    
    public function satuan()
    {
        return $this->belongsTo('App\Models\Satuan', 'satuan_id', 'id');
    }
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_pengujian_id', 'id');
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