<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Models\DataSetting; 
use App\Models\User; 
use App\Models\UserDiagram; 

class DiagramController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DataSetting::where('group_type', "department")->where('parent_id', 0)->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $arr = ['items' , 'employees'];

        // display
        $file = 'default.office.hr.diagram.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSub($id)
    {
        $items = DataSetting::where('group_type', "department")->where('parent_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $arr = ['items' , 'employees' , 'id'];

        // display
        $file = 'default.office.hr.diagram.indexSub';

        return view($file, compact($arr))->render();
    }

    public function info(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $id = $request->input('id');
            $type = $request->input('type');

            if($type == 'boss'){

                $Leave = UserDiagram::where('department_id',$id)->where('level_id','1')->get();
                $LeaveCount = $Leave->count();

                if($LeaveCount > 0){
                    foreach ($Leave as $row);

                    $dataTmp = [
                        'user_id' => $row->user_id,
                        'level_id' => $row->level_id,
                        'department_id' => $row->department_id,
                        'email' => $row->email,
                        'tel' => $row->tel,
                        'mobile' => $row->mobile,
                        'id' => $row->id,
                        'action' => 'boss',
                    ];
                }else{

                    $dataTmp = [
                        'user_id' => '',
                        'level_id' => 1,
                        'department_id' => $id,
                        'email' => '',
                        'tel' => '',
                        'mobile' => '',
                        'id' => 0,
                        'action' => 'boss',
                    ];
                }

                

            }else{

                $dataTmp = [
                    'user_id' => '',
                    'level_id' => 2,
                    'department_id' => $id,
                    'email' => '',
                    'tel' => '',
                    'mobile' => '',
                    'id' => 0,
                    'action' => 'add',
                ];

            }
               
            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }


    public function store(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'boss'){

                if($data['edit_id'] == '0'){
                    $result = UserDiagram::insertRow($data);
                }else{
                    $result = UserDiagram::updateRow($data, $data['edit_id']);
                }
            }else{

                $result = UserDiagram::insertRow($data);

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
        $process = UserDiagram::deleteRow($id);

        return redirect()->back();
    }
}
