<?php

namespace App\Models;

use App\Models\BaseModel;

class DokterHewan extends BaseModel
{
    protected $table = 'tbl_dokter_hewan';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nip_dokter',
        'nama_lengkap',
        'alamat',
        'no_telpon',
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


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}