<?php

namespace App\Http\Controllers\Office\hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\DataSetting;
use App\Models\UserToCourses;

class CoursesController extends Base
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Courses::getDataAll();

        $arr = ['courses'];

        // display
        $file = 'default.office.hr.courses.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $course = DataSetting::where('group_type', "course")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['course'];
        
        // display
        $file = 'default.office.hr.courses.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Courses::find((int) $id);

        $course = DataSetting::where('group_type', "course")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['course' , 'info' , 'id'];
        
        // display
        $file = 'default.office.hr.courses.edit';

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
            $id = $request->edit_id;
            $action = $request->action;
            $data = $request->input;

            if($id == 0){

                $result = Courses::inserRow($data);

            }else{

                $result = Courses::updateRow($data, $id);

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
    public function destroy($id)
    {
        $process = Courses::deleteRow($id);
        

        return redirect()->back();
    }

    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subindex($id)
    {
        // $courses = Courses::getDataAll($id);
        $courses = Courses::where('id', $id)->get();

        $user = UserToCourses::getDataAll($id);

        $arr = ['id' , 'courses' , 'user'];

        // display
        $file = 'default.office.hr.courses.subindex';

        return view($file, compact($arr))->render();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function substore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            $result = UserToCourses::inserRow($data);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
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
    public function subdestroy($id)
    {
        $process = UserToCourses::deleteRow($id);
        

        return redirect()->back();
    }

    public function employeeindex($id)
    {
        $courses = UserToCourses::getCourses($id);

        $arr = ['courses' , 'id'];

        // display
        $file = 'default.office.hr.courses.employee';

        return view($file, compact($arr))->render();
    }


}
