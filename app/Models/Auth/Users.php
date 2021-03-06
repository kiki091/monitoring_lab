<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $connection = 'auth';
    protected $table = 'users';
    protected $guard = 'users';

    public $timestamps = true;

    protected $fillable = [
        'is_active',
        'location_id',
        'name',
        'email',
        'password',
        'update_at',
        'created_by'
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

    public function role()
    {
        return $this->hasMany('App\Models\Auth\Role', 'user_id', 'id')->with('privilage');
    }


    public function user_menu()
    {
        return $this->hasMany('App\Models\Auth\UserMenu', 'user_id', 'id')->with('menu');
    }

    public function system_location()
    {
        return $this->hasMany('App\Models\Auth\SystemLocation', 'user_id', 'id')->with('system');
    }


    /***************** Scope *****************/

    /**
     * @param $query
     */
    public function scopeIsActive($query, $params = true)
    {
        return $query->where('is_active', $params);
    }


    /**
     * @param $query
     */
    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * @param $query
     */
    public function scopeUserId($query, $params = true)
    {
        return $query->where('id', $params);
    }
}