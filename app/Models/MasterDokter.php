<?php

namespace App\Models;

use App\Models\BaseModel;

class MasterDokter extends BaseModel
{
    protected $table = 'tbl_dokter';

    public $timestamps = true;

    protected $fillable = [
        'is_active',
        'nama_lengkap',
        'alamat',
        'no_telpon'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $guarded = ['users'];


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}