<?php

namespace App\Custom\Auth;

use Request;
use App\Redis\MenuLocation as MenuLocationRedis;
use App\Models\Auth\System as SystemModels;
use App\Custom\Facades\DataHelper;
use Cache;
use Session;
use Auth;
use Route;

class RouteUsersLocation {

	const DEFAULT_LOCATION = 'cms';

	/**
     * Set Menu Location
     * @return null
     */
    public function setUsersLocation()
    {
        $menuLocation = Request::segment(1);

        $menuLocationCollection     = SystemModels::get()->toArray();
        
        if(empty($menuLocationCollection))
            return null;

        foreach ($menuLocationCollection as $key => $value) {
           
            if($value['slug'] == $menuLocation) {
                $isExists = true;
                break;
            }
            $isExists = false;
        }

        if(!$isExists) {

            Session::forget('current_auth_location');

            $this->setSessionCurrentMenuLocation('');

            return self::DEFAULT_LOCATION;
        }


        $this->setSessionCurrentMenuLocation($menuLocation);

        return $menuLocation;

    }

    /**
    * Get Session Menu Location List
    * @return array
    */
    public function getSessionMenuLocationList()
    {   
        
        $redisKey                   = MenuLocationRedis::AUTH_MENU_COLLECTION;
        $menuLocationCollection     = Cache::rememberForever($redisKey, function() {

            return SystemModels::get()->toArray();

        });
        
        return $menuLocationCollection;
                

    }

    /**
     * Set Session Current Menu
     * @param $param
     */
    public function setSessionCurrentMenuLocation($param)
    {
        Session::forget('current_auth_location');
        Session::put('current_auth_location', $param);
    }

}