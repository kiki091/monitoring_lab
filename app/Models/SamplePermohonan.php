<?php

namespace App\Models;

use App\Models\BaseModel;

class SamplePermohonan extends BaseModel
{
    protected $table = 'tbl_sample_permohonan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'permohonan_id',
        'sample_id',
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
    
    public function sample()
    {
        return $this->belongsTo('App\Models\Sample', 'sample_id', 'id');
    }
    
    public function permohonan()
    {
        return $this->belongsTo('App\Models\Sample', 'permohonan_id', 'id');
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