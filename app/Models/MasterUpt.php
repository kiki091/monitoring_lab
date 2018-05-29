<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterUpt extends BaseModel
{
    protected $table = 'tbl_upt';

    public $timestamps = true;
    
    protected $fillable = [
        'kode_upt',
        'nama_upt',
        'jns_pelabuhan',
        'daerah'
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
        return $this->belongsTo('App\Models\MasterLaboraorium', 'lab_id', 'id');
    }
    
    public function daerah()
    {
        return $this->belongsTo('App\Models\DaftarDaerah', 'daerah_id', 'id');
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