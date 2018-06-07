<?php

namespace App\Models;

use App\Models\BaseModel;

class Upt extends BaseModel
{
    protected $table = 'tbl_upt';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_upt',
        'nama_upt',
        'daerah_id',
        'jenis_pelabuhan',
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
    
    public function daerah()
    {
        return $this->belongsTo('App\Models\Daerah', 'daerah_id', 'id');
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