<?php

namespace App\Models;

use App\Models\BaseModel;

class Penugasan extends BaseModel
{
    protected $table = 'tbl_penugasan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'no_surat',
        'target_uji_id',
        'kedudukan',
        'karantina_tumbuhan_id',
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
    
    public function target_pengujian()
    {
        return $this->belongsTo('App\Models\TargetPengujian', 'target_uji_id', 'id');
    }
    
    public function karantina()
    {
        return $this->belongsTo('App\Models\KarantinaTumbuhan', 'karantina_tumbuhan_id', 'id')->with(['sample']);
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