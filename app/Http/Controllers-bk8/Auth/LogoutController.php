<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

/**
 * LogoutController
 */
class LogoutController extends Base 
{    
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->session()->has('is_logined')) {
            $request->session()->flush();

            return redirect('auth/login');
        }
    }
}
