<?php

namespace App\Models;

use App\Models\BaseModel;

class TargetPest extends BaseModel
{
    protected $table = 'tbl_target_pest';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_target_pest',
        'nama_target_hph',
        'target_pengujian_id',
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