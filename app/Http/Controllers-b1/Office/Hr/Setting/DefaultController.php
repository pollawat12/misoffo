<?php

namespace App\Http\Controllers\Office\Hr\Setting;


use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Models\User;
use App\Models\DataSetting;
use App\Models\Holiday;

class DefaultController extends Base
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
    public function index(Request $request)
    {
        $employees = User::getEmployees();

        $arr = ['employees'];

        // display
        $file = 'default.office.hr.employee.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function holiday($id , Request $request)
    {
        $info = DataSetting::find((int) $id);
        
        $holiday = Holiday::where('holiday_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['holiday' , 'info' , 'id'];

        // display
        $file = 'default.office.hr.holiday.index';

        return view($file, compact($arr))->render();
    }

    public function holidayinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');

            $holiday = Holiday::where('id',$uid)->get();
            $holidayCount = $holiday->count();

            if($holidayCount > 0){
                foreach ($holiday as $row);

                $dataTmp = [
                    'is_year' => $row->is_year,
                    'is_date' => ($row->is_date) ? getDateFormatToInput($row->is_date) : null,
                    'id' => $uid,
                    'action' => 'edit',
                ];

                

            }else{

                $dataTmp = [];

            }
               
            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function holidaystore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'add'){
                $result = Holiday::inserRow($data);
            }else{
                $result = Holiday::updateRow($data , $data['edit_id']);
            }
            

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
    public function holidaydestroy($id)
    {
        $process = Holiday::deleteRow($id);

        return redirect()->back();
    }
}
