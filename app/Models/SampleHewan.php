<?php

namespace App\Models;

use App\Models\BaseModel;

class SampleHewan extends BaseModel
{
    protected $table = 'tbl_sample_hewan';

    public $timestamps = false;

    protected $fillable = [
        'kode_sample',
        'nama_sample',
        'jenis_sample',
        'jml_vol'
    ];

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
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}