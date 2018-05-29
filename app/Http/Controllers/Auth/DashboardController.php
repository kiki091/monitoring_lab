<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use RouteUsersLocation;
use Carbon\Carbon;
use JavaScript;
use Auth;
use Session;
use Validator;
use Symfony\Component\VarDumper\Cloner\Data;
use URL;

class DashboardController extends BaseController
{
    public function __construct()
    {
        
        JavaScript::put([
            'href_url' => URL::current(),
            'app_domain' => env('AUTH_DOMAIN_PREFIX').env('APP_DOMAIN'),
            'token' => csrf_token(),
            'systemLocation' => RouteUsersLocation::setUsersLocation(),
        ]);
    }

    /**
     * Index Of Dashboard
     * @return string
     */
    public function index(Request $request)
    {

        $blade = self::URL_BLADE_AUTH. '.dashboard';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);

    }
}