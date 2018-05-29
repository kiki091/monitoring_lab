<?php

namespace App\Models;

use App\Models\BaseModel;

class MetodePengujian extends BaseModel
{
    protected $table = 'tbl_metode_pengujian';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama_kelompok'
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
    
    public function lab()
    {
        return $this->belongsTo('App\Models\MasterLaboraorium', 'laboratorium_id', 'id');
    }
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_pengujian_id', 'id');
    }
    
    public function kelompok_pengujian()
    {
        return $this->belongsTo('App\Models\KelompokPengujian', 'kelompok_uji_id', 'id');
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