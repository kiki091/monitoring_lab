<?php

namespace App\Models;

use App\Models\BaseModel;

class Perusahaan extends BaseModel
{
    protected $table = 'tbl_perusahaan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'kode_perusahaan',
        'nama_perusahaan',
        'alamat',
        'no_telpon',
        'contact_person',
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

    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}