<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Base
 */
class Base extends Controller
{    
    public $auth_info;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // pass value public data session with variable $authInfo
        $this->middleware(function($request, $next){
            $this->auth_info = $request->session()->get('auth_info');
            return $next($request);
        });
    }

    
}
