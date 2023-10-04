<?php

namespace App\Http\Controllers\Office\Services;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

class ReservcarController extends Base
{
    /**
     * Undocumented function index
     *
     * @return void
     */
    function index()
    {
        # code...
        $data = [];

        return view('default.office.service.reserve-car.index-booking', compact($data));
    }

    /**
     * Undocumented function index
     *
     * @return void
     */
    function add()
    {
        # code...
        $data = [];
        
        return view('default.office.service.reserve-car.booking-add', compact($data));
    }
}
