<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

// model
use App\Models\ReserveMeeting;


use App\Models\ReserveCar;

/**
 * HomeController
 */
class HomeController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        

        $meeting_lists = DB::table('reserve_meetings')
                        ->where('status_approved', '1')
                        ->where('is_deleted', '0')
                        ->where('is_active','1')
                        ->get();

        $meeting_car = DB::table('reserve_car')
                        ->where('status_approved', '1')
                        ->where('is_deleted', '0')
                        ->where('is_active','1')
                        ->get();
        
        # code...
        $data = ['auth_status', 'auth_info','meeting_lists', 'meeting_car'];
        return view('default.dashboard.index', compact($data))->render();
    }
}
