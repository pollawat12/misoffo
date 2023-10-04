<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

// model
use App\Models\ReserveMeeting;

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

        $meeting_lists = ReserveMeeting::getMeetingLists();

        
        # code...
        $data = ['auth_status', 'auth_info', 'meeting_lists'];
        return view('default.dashboard.index', compact($data))->render();
    }
}
