<?php

namespace App\Http\Controllers\Office\Hr;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyNotification;

use App\Models\User;
use App\Models\UserInformation;
use App\Models\DataSetting; 
use App\Models\Userleave;
use App\Models\LeaveSetting;
use App\Models\UserLeaveAction;

class LeaveController extends Base
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
    public function all(Request $request)
    {
        $Leave = Userleave::getLeave();

        $categoryLeave = DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['Leave' , 'categoryLeave'];

        // display
        $file = 'default.office.hr.leave.all';

        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function departments($id , $depid , Request $request)
    {
        $Leave = User::selcetUserLeaveDepartments($depid);
        
        $employees = UserInformation::where('users_id',$id)->get();

        $categoryLeave = DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['Leave' , 'categoryLeave' , 'employees' , 'id' , 'depid'];

        // display
        $file = 'default.office.hr.leave.departments';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id , Request $request)
    {
        $Leave = Userleave::getLeave($id);

        $employees = UserInformation::where('users_id',$id)->get();

        $categoryLeave = DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['Leave' , 'employees' , 'categoryLeave' , 'id'];

        // display
        $file = 'default.office.hr.leave.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id , $typeid)
    {
        $employees = User::getEmployees();

        $categoryLeave = DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['employees' , 'categoryLeave' , 'id' , 'typeid'];

        // display
        $file = 'default.office.hr.leave.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
        $t = $request->input('t');

        $pr = $request->input('pr');

        $de = $request->input('de');

        $info = Userleave::find((int) $id);

        $employees = User::getEmployees();

        $categoryLeave = DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['employees' , 'categoryLeave' ,'id' , 'info' , 't' , 'pr' , 'de'];

        // display
        $file = 'default.office.hr.leave.edit';

        return view($file, compact($arr))->render();
    }

    /**
     * substore
     *
     * @param  mixed $request
     * @return void
     */
    public function substore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $action = $request->action_name;
            $data = $request->input; 

            $dataCheck = strtotime(date('Y-m-d'));

            $resignProject = strtotime(getInputDateToDB($data['date_resign']));
            
            $startProject = strtotime(getInputDateToDB($data['date_start']));

            $endProject = strtotime(getInputDateToDB($data['date_end']));

            if($dataCheck <= $resignProject){
                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันลาไม่ถูกต้อง'];

                }else{

                    if($id == 0){

                        if ($request->hasFile('upfile_leave')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id'] , 'upfilesLeave');

                            $file = $request->file('upfile_leave');
                            $fileName = rand(1,99).'TF'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $data['leave_file'] = $uploadFilename;
                        }

                        $result = Userleave::insertRow($data , true);

                        $employee = Userleave::getCheckEmplyooLeave($result);
                        foreach ($employee as $row);

                        $numday = round((strtotime($row['date_end']) - strtotime($row['date_start']))/60/60/24) + 1;

                        //MyNotification::notiEmployeeLeave($row['name'], $row['leave_type'], $start=getDateTimeTH($row['date_start'] , false), $end=getDateTimeTH($row['date_end'] , false), $numday);
                    }else{
                        $result = Userleave::updateRow($data, $id);

                        // -- upload file -- //
                        if ($request->hasFile('upfile_leave')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id'] , 'upfilesLeave');

                            $file = $request->file('upfile_leave');
                            $fileName = rand(1,99).'TF'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $result = Userleave::where('id', (int) $id)->update(array('leave_file' => $uploadFilename));
                        }

                        $employee = Userleave::getCheckEmplyooLeave($id);
                        foreach ($employee as $row);

                        $numday = round((strtotime($row['date_end']) - strtotime($row['date_start']))/60/60/24) + 1;

                        if($data['is_approved'] == '1'){ $is_approved = 'อนุมัติ'; }elseif($data['is_approved'] == '2'){ $is_approved = 'ไม่อนุมัติ'; }else{  $is_approved = 'แก้ไขวันลา'; }

                        //MyNotification::notiEmployeeLeave($row['name'], $row['leave_type'], $start=getDateTimeTH($row['date_start'] , false), $end=getDateTimeTH($row['date_end'] , false), $numday , $is_approved);
                    }
                    
                    if ($result) {
                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    }

                }
            }else{

                $resp = ['status' => false, 'msg' => 'ไม่สามารถเลือกวันที่กรอกย้อยหลังได้'];
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
        $process = Userleave::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workall(Request $request)
    {
        $employees = User::getEmployees();

        $arr = ['employees'];

        // display
        $file = 'default.office.hr.leave.workall';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workindex($id , Request $request)
    {
        $t = $request->input('t');

        $items = DataSetting::where('group_type','leave')->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = UserInformation::where('users_id',$id)->get();

        $arr = ['items' , 'employees' , 'id' , 't'];

        // display
        $file = 'default.office.hr.leave.workindex';

        return view($file, compact($arr))->render();
    }

    public function workinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $id = $request->input('id');
            $uid = $request->input('uid');

            $info = DataSetting::find((int) $id);

            $Leave = LeaveSetting::where('leave_id',$id)->where('user_id',$uid)->get();
            $LeaveCount = $Leave->count();

            if($LeaveCount > 0){
                foreach ($Leave as $row);

                $dataTmp = [
                    'name' => $info->name,
                    'user_id' => $uid,
                    'leave_id' => $id,
                    'id' => $row->id,
                    'number_date' => $row->number_date,
                    'sum_not_over' => $row->sum_not_over,
                    'action' => 'edit',
                ];

                

            }else{

                $dataTmp = [
                    'name' => $info->name,
                    'user_id' => $uid,
                    'leave_id' => $id,
                    'id' => '0',
                    'number_date' => '',
                    'sum_not_over' => '',
                    'action' => 'add',
                ];

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
    public function workstore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'add'){

                $result = LeaveSetting::inserRow($data);

            }else{

                $result = LeaveSetting::updateRow($data, $data['edit_id']);

            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAll(Request $request)
    {
        $data = $request->input;

        // if($data['type'] == '1'){
            
        $Leave = Userleave::getSearchDay($data);

        $arr = ['Leave'];

        // display
        $file = 'default.office.hr.leave.Day';

        // }else{
        //     $employees = User::getEmployees();

        //     $items = DataSetting::where('group_type','leave')->where('is_deleted', '0')->where('is_active','1')->get();
        //     $numitems = $items->count();

        //     $arr = ['employees' , 'items' , 'numitems'];

        //     // display
        //     $file = 'default.office.hr.leave.Month';
        // }
        return view($file, compact($arr))->render();
    }


    public function info(Request $request) 
    {
        $id = $request->id;

        $userid = $request->type;

        if($userid == 0){
            if($id == '39'){
                $html = ' <div class="row">';
                $html .= '<div class="col-md-6">';
                $html .= '<div class="form-group">';
                $html .= '<label for="represent_name">ผู้ปฎิบัติงานแทน</label>';
                $html .= '<input type="text" name="input[represent_name]" class="form-control" placeholder="" style="height: 45px;">';
                $html .= '<small id="represent_name" class="form-text text-muted"></small>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="col-md-6">';
                $html .= '<div class="form-group">';
                $html .= '<label for="represent_tel">เบอร์โทรติดต่อ</label>';
                $html .= '<input type="text" name="input[represent_tel]" class="form-control" placeholder="" style="height: 45px;">';
                $html .= '<small id="represent_tel" class="form-text text-muted"></small>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }else{
                $html = '';
            }

            $json = ['status' => false, 'info' => $html];
            
        }else{

            $info = DataSetting::find((int) $id);

            $LeaveNum = Userleave::where('users_id', $userid)->where('leave_type', $id)->where('is_approved', '1')->where('is_deleted', '0')->where('is_active','1')->get();
            $LeaveNumCount = $LeaveNum->count();

            $Leaves = \App\Models\LeaveSetting::where('user_id', $userid)->where('leave_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
            $LeavesCount = $Leaves->count();
            if($LeavesCount > 0){
                foreach ($Leaves as $Leave);

                $LeaveD = $info->data_value + $Leave['number_date'];
            }else{

                $LeaveD =  $info->data_value + 0;
            }

            if($LeaveD ==  $LeaveNumCount){

                $alertCheck = '(การลาเต็มจำนวน)';

                $dataTmp = '<button type="submit" id="button_sub" class="btn btn-primary" disabled> <i class="mdi mdi-database-plus"> บันทึก</i></button>';

            }else{

                $alertCheck = '';

                $dataTmp = '<button type="submit" id="button_sub" class="btn btn-primary" > <i class="mdi mdi-database-plus"> บันทึก</i></button>';
            }

            $html = $LeaveNumCount;
            $html .= ' / ';
            $html .= $LeaveD;
            $html .= ' ที่มีสิทธิ์ลา ';
            $html .= $alertCheck ;

            $json = ['status' => false, 'info' => $html , 'checkIS' => $dataTmp];
        }

        

        return response()->json($json, 200);
    }

    public function leavedecline(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');

            $decline = UserLeaveAction::where('leave_id',$uid)->get();
            $declineCount = $decline->count();

            if($declineCount > 0){
                foreach ($decline as $row);

                $dataTmp = [
                    'role_num' => $row->role_num,
                    'leave_id' => $uid,
                    'id' => $row->id,
                    'action' => 'edit',
                ];

                

            }else{

                $dataTmp = [
                    'role_num' => '',
                    'leave_id' => $uid,
                    'id' => '',
                    'action' => 'add',
                ];

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
    public function savedecline(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'add'){

                $result = UserLeaveAction::inserRow($data);

            }else{

                $result = UserLeaveAction::updateRow($data, $data['edit_id']);

            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }
}
