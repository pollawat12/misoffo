<?php

namespace App\Http\Controllers\Office\Settings;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

class CarsController extends Base
{
    function index()
    {

        # code...
        $data = [];

        return view('default.office.setting.car.index', compact($data));
    }


    function add()
    {
        
        # code...
        $data = [];

        return view('default.office.setting.car.add', compact($data));
    }
}
