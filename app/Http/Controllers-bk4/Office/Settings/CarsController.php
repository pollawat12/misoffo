<?php

namespace App\Http\Controllers\Office\Settings;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

class CarsController extends Base
{
    /**
     * Undocumented function index
     *
     * @return void
     */
    function index()
    {
        // $cars = 
        # code...
        $data = [];

        return view('default.office.setting.car.index', compact($data));
    }

    /**
     * Undocumented function add
     *
     * @return void
     */
    function add()
    {
        
        # code...
        $data = [];

        return view('default.office.setting.car.add', compact($data));
    }

    /**
     * Undocumented function edit
     *
     * @param [type] $id
     * @param Request $request
     * @return void
     */
    function edit($id, Request $request)
    {

        # code...
        $data = [];

        return view('', compact($data));
    }

    /**
     * Undocumented function show
     *
     * @param Request $request
     * @return void
     */
    function show(Request $request)
    {

        # code...
        $data = [];

        return view('', compact($data));
    }
}
