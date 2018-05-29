<?php

namespace App\Models;

use RouteUsersLocation;
use Session;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $systemLocation;

    public function __construct() {

    	return $this->systemLocation = RouteUsersLocation::setUsersLocation();
    }
}