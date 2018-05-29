<?php

namespace App\Models;

use App\Models\BaseModel;

class HasilLaboratorium extends BaseModel
{
    protected $table = 'tbl_hasil_laboratorium';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'karantina_tumbuhan_id',
        'kesimpulan',
        'keterangan',
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