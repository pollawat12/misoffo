<?php

namespace App\Http\Controllers\Office\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

// model
use App\Models\YearBudget;

class YearsController extends Base 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = YearBudget::getDataAll();

        $arr = ['years'];

        // display
        $file = 'default.office.setting.year.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr = [];
        
        // display
        $file = 'default.office.setting.year.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            $result = YearBudget::inserRow($data);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $info = YearBudget::find((int) $id);
        
        $arr = ['id', 'info'];

        // display
        $file = 'default.office.setting.year.edit';

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;

            $result = YearBudget::updateRow($data, $id);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = YearBudget::deleteRow($id);

        return redirect()->back();
    }
}
