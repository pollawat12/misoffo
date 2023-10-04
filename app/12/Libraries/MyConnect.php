<?php 

namespace App\Libraries;

use Auth;
use URL;
use DB;
use Session;
use Illuminate\Http\Request;

class MyConnect
{
    /**
     * getConnectDB
     *
     * @param  mixed $cfConnect
     * @return void
     */
    public static function getConnectDB($cfConnect='') 
    {
        $query = DB::connection($cfConnect);
        return $query;
    }
}
