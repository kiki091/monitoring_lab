<?php

namespace App\Models;

use App\Models\BaseModel;

class Korfug extends BaseModel
{
    protected $table = 'tbl_korfug';

    public $timestamps = true;

    protected $fillable = [
        'dokter_id',
        'nip_korfug',
        'karantina_tumbuhan_id',
        'tgl_usulan'
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
    
    public function karantina_tumbuhan()
    {
        return $this->belongsTo('App\Models\KarantinaTumbuhan', 'karantina_tumbuhan_id', 'id')->with(['sample']);
    }
    
    public function dokter()
    {
        return $this->belongsTo('App\Models\MasterDokter', 'dokter_id', 'id');
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