<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DataSetting;
use App\Models\ReserveCar;
use App\Models\User;
use App\Models\UserDiagram;


use Illuminate\Support\Facades\DB;

class ReservcarController extends Base
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $meetings = ReserveCar::getMeetingLists();

        $auth_info = $request->session()->get('auth_info');

        # code...
        $data = ['meetings', 'auth_info'];
        
        return view('default.office.hr.reserve-car.index', compact($data))->render();
    }

    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {

        $employees = User::getEmployees();

        // $division_user_id = DB::table('user_diagram')
        //     ->leftjoin('data_settings', 'user_diagram.department_id', '=', 'data_settings.id')
        //     ->where('user_diagram.level_id', 1)
        //     ->where('user_diagram.is_active', 1)
        //     ->where('data_settings.group_type', 'group_work')
        //     ->orderBy('data_settings.id')
        //     ->get();

        $conditions = ['group_type' => 'car_num', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $rooms = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'car_tpye', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $meeting_types = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'meeting_item', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $meeting_items = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'group_work', 'is_deleted' => (int) 0, 'is_active' => (int) 1];

        $group_works = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'department', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $department_works = DataSetting::where($conditions)->get();

        $auth_info = $request->session()->get('auth_info');

        # code...
        $data = ['rooms', 'meeting_types', 'meeting_items', 'auth_info', 'group_works', 'department_works', 'employees'];
        return view('default.office.service.reserve-car-new.add', compact($data))->render();
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function edit($id, Request $request)
    {

        $employees = User::getEmployees();

        $conditions = ['group_type' => 'car_num', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $rooms = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'car_tpye', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $meeting_types = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'meeting_item', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $meeting_items = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'group_work', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $group_works = DataSetting::where($conditions)->get();

        $conditions = ['group_type' => 'department', 'is_deleted' => (int) 0, 'is_active' => (int) 1];
        $department_works = DataSetting::where($conditions)->get();

        $auth_info = $request->session()->get('auth_info');

        $info = ReserveCar::find((int) $id);
        // accessory items
        $array_tmp = $accessory_items = [];
        if (!empty($info->accessory_items)) {
            $array_tmp = (array) json_decode($info->accessory_items);
            if (count($array_tmp) > 0) {
                foreach ($array_tmp as $val) {
                    $accessory_items[] = (int) $val;
                }
            }
        }

        # code...
        $data = ['rooms', 'meeting_types', 'meeting_items', 'auth_info', 'group_works', 'department_works', 'info', 'id', 'accessory_items', 'employees'];
        return view('default.office.service.reserve-car-new.edit', compact($data))->render();
    }


    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        $auth_info = $request->session()->get('auth_info');

        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->all();

            $employees = userDiagram::where('user_id', $auth_info)->where('is_active', 1)->first();

            $isApproved = 0;
            if ($employees->user_level  == 4) {
                $isApproved = 0;
            } else {
                $isApproved = 0;
            }

            $strEmpList = "";
            if (array_key_exists("employees", $input)) {
                foreach ($input['employees'] as $val) {
                    $strEmpList =$strEmpList. ""."\n"."". trim($val);
                }
            }


            //return response()->json($strEmpList, 200);

            $date_start = getInputDateToDB(trim($input['date_start'])) . ' ' . trim($input['time_start']) . ':00';
            $date_end = getInputDateToDB(trim($input['date_end'])) . ' ' . trim($input['time_end']) . ':00';

            // conver time for check date
            $date_start_checked = getDateTimeForCheck($date_start);
            $date_end_checked = getDateTimeForCheck($date_end, 'end');
            $existsMeeting = ReserveCar::getMeetingExists($date_start_checked, $date_end_checked, $input['meeting_room_id']);
            if (count($existsMeeting) > 0) {
                $response = ['status' => false, 'msg' => 'ไม่สามารถจองรถได้ เนื่องจากมีผู้จองแล้ว!'];
                return response()->json($response, 200);
            }

            $division_user_id = DB::table('user_diagram')
                ->leftjoin('data_settings', 'user_diagram.department_id', '=', 'data_settings.id')
                ->where('user_diagram.level_id', 1)
                ->where('user_diagram.is_active', 1)
                ->where('data_settings.group_type', 'group_work')
                ->where('data_settings.id', (int) trim($input['groups_id']))
                ->orderBy('data_settings.id')
                ->first();

            //return response()->json($division_user_id, 200);

            // accessory items
            $accessoryJsonData = (isset($input['accessory_items'])) ? json_encode($input['accessory_items']) : null;

            $array = [
                'code' => getToken(10),
                'title' => trim($input['title']),
                'detail' => trim($input['detail']),
                'date_start' => $date_start,
                'date_end' => $date_end,
                'time_start' => trim($input['time_start']),
                'time_end' => trim($input['time_end']),
                'file_attach' => null,
                'personal_nums' => (int) trim($input['personal_nums']),
                'owner_name' => trim($input['owner_name']),
                'owner_tel' => trim($input['owner_tel']),
                'departments_id' => (int) trim($input['departments_id']),
                'groups_id' => (int) trim($input['groups_id']),
                'accessory_items' => $accessoryJsonData,
                'status_approved' => $isApproved,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1,
                'updated_at' => \Carbon\Carbon::now(),
                'meeting_room_id' => (int) $input['meeting_room_id'],
                'meeting_type_id' => (int) $input['meeting_type_id'],
                'updated_by' => (int) $auth_info['user_id'],
                'image_cover' => null,
                // 'division_user_id' =>  (int) $division_user_id->user_id,
                'admin_user_id' =>  (int) 146,
                'user_id' => (int) $auth_info['user_id'],
                'employees' =>trim($strEmpList),
                'driver' => trim($input['driver']),
                'person_category' => trim($input['person_category']),
                'purpose_car' => trim($input['purpose_car']),
                'car_type' => trim($input['car_type'])

            ];

            $result = ReserveCar::insertArray($array);

            if ($result) {
                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }


    public function substore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $action = $request->action_name;
            if ($action == "cancel") {
                $id = $request->cancel_id;
            } else {
                $id = $request->edit_id;
            }

            //return response()->json($action, 200);

            $data = $request->input;
            $auth_info = $request->session()->get('auth_info');

            $leave_user_id = $request->leave_user_id;


            $dataCheck = strtotime(date('Y-m-d'));

            $resignProject = strtotime(getInputDateToDB($data['date_resign']));

            $startProject = strtotime(getInputDateToDB($data['date_start']));

            $endProject = strtotime(getInputDateToDB($data['date_end']));

            // if($dataCheck <= $resignProject){
            if ($startProject > $endProject) {

                $resp = ['status' => false, 'msg' => 'ระบุวันลาไม่ถูกต้อง'];
            } else {

                if ($id == 0) {

                    if ($request->hasFile('upfile_leave')) {
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($data['user_id'], 'upfilesLeave');

                        $file = $request->file('upfile_leave');
                        $fileName = rand(1, 99) . 'TF' . date('YmdHis') . '.' . $file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload . '/' . $fileName;

                        $data['leave_file'] = $uploadFilename;
                    }

                    $result = Userleave::insertRow($data, true);

                    $employee = Userleave::getCheckEmplyooLeave($result);
                    foreach ($employee as $row);

                    $numday = round((strtotime($row['date_end']) - strtotime($row['date_start'])) / 60 / 60 / 24) + 1;

                    //MyNotification::notiEmployeeLeave($row['name'], $row['leave_type'], $start=getDateTimeTH($row['date_start'] , false), $end=getDateTimeTH($row['date_end'] , false), $numday);
                } else {
                    //$resp = ['status' => true, 'msg' => $request->leave_user_id];
                    //return response()->json($action, 200);
                    $result = Userleave::updateRow($data, $id, $auth_info, $leave_user_id, $action);
                    // -- upload file -- //
                    if ($request->hasFile('upfile_leave')) {
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($data['user_id'], 'upfilesLeave');

                        $file = $request->file('upfile_leave');
                        $fileName = rand(1, 99) . 'TF' . date('YmdHis') . '.' . $file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload . '/' . $fileName;

                        $result = Userleave::where('id', (int) $id)->update(array('leave_file' => $uploadFilename));
                    }

                    $employee = Userleave::getCheckEmplyooLeave($id);
                    foreach ($employee as $row);

                    $numday = round((strtotime($row['date_end']) - strtotime($row['date_start'])) / 60 / 60 / 24) + 1;

                    if ($data['is_approved'] == '1') {
                        $is_approved = 'อนุมัติ';
                    } elseif ($data['is_approved'] == '2') {
                        $is_approved = 'ไม่อนุมัติ';
                    } else {
                        $is_approved = 'แก้ไขวันลา';
                    }

                    //MyNotification::notiEmployeeLeave($row['name'], $row['leave_type'], $start=getDateTimeTH($row['date_start'] , false), $end=getDateTimeTH($row['date_end'] , false), $numday , $is_approved);
                }


                // $userId = $data['division_user_id'] ;

                // $userInfo = UserInformation::where('users_id', trim($userId))->first();

                // //$resp = ['status' => false, 'msg' => $userInfo];
                // //return response()->json($resp, 200);

                // if ($userInfo && !empty($userInfo)) {

                //     $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                //     $template = 'template_emails.MailLeave';

                //     $date = Carbon::now();

                //     $link = 

                //     $contents = [

                //         'subject' => 'แจ้งการลาของเจ้าหน้าที่'.' '.$date,
                //         'name' => $information->firstname.' '.$information->lastname,
                //         'body' => ''];

                //     Mail::to(trim($userInfo->email))->send(new \App\Mail\LeaveMail($template, $contents));


                // }


                if ($result) {

                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                }
            }
            // }else{

            //     $resp = ['status' => false, 'msg' => 'ไม่สามารถเลือกวันที่กรอกย้อยหลังได้'];
            // }
        }

        return response()->json($resp, 200);
    }












    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        //updateArray($array, $id=0)
        $auth_info = $request->session()->get('auth_info');
        $response = ['status' => false, 'msg' => 'error!'];



        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->all();
            $edit_id = $request->input('edit_id');

            //$employees = userDiagram::where('user_id', $data['user_id'])->where('is_active', 1)->first();


            $date_start = getInputDateToDB(trim($input['date_start'])) . ' ' . trim($input['time_start']) . ':00';
            $date_end = getInputDateToDB(trim($input['date_end'])) . ' ' . trim($input['time_end']) . ':00';


            // conver time for check date
            $date_start_checked = getDateTimeForCheck($date_start);
            $date_end_checked = getDateTimeForCheck($date_end, 'end');


            $existsMeeting = ReserveCar::getMeetingExists($date_start_checked, $date_end_checked, $input['meeting_room_id']);
            if (count($existsMeeting) > 0) {
                $response = ['status' => false, 'msg' => 'ไม่สามารถจองรถได้ เนื่องจากมีผู้จองแล้ว!'];
                return response()->json($response, 200);
            }


            $array = [
                'title' => trim($input['title']),
                'detail' => trim($input['detail']),
                'date_start' => $date_start,
                'date_end' => $date_end,
                'time_start' => trim($input['time_start']),
                'time_end' => trim($input['time_end']),
                'file_attach' => null,
                'personal_nums' => (int) trim($input['personal_nums']),
                'owner_name' => trim($input['owner_name']),
                'owner_tel' => trim($input['owner_tel']),
                'departments_id' => (int) trim($input['departments_id']),
                'groups_id' => (int) trim($input['groups_id']),
                'status_approved' => (int) $input['status_approved'],
                'is_deleted' => (int) 0,
                'is_active' => (int) 1,
                'updated_at' => \Carbon\Carbon::now(),
                'meeting_room_id' => (int) $input['meeting_room_id'],
                'meeting_type_id' => (int) $input['meeting_type_id'],
                'updated_by' => (int) $auth_info['user_id'],
                'image_cover' => null,
                'car_start' => (int) trim($input['car_start']),
                'car_end' => (int) trim($input['car_end']),
                'driver' => trim($input['driver']),
                'person_category' => trim($input['person_category']),
                'purpose_car' => trim($input['purpose_car']),
                
            ];

            $result = ReserveCar::updateArray($array, $edit_id);

            if ($result) {
                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }

    /**
     * delete
     *
     * @param  mixed $request
     * @return void
     */
    public static function delete(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $id = $request->del_id;
            $result = ReserveCar::deleteRow($id);

            if ($result) {
                $response = ['status' => true, 'msg' => 'ลบรายการสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }


    public function report(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');


        $items = ReserveCar::getMeetingLists();

        $arr = ['t', 'pr', 'items'];

        // display

        return view('default.office.service.reserve-car-new.report', compact($arr))->render();
    }


    public function print($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');


        $items = ReserveCar::getMeetingLists($id);

        $arr = ['t', 'pr', 'id', 'items'];

        // display

        return view('default.office.service.reserve-car-new.print', compact($arr))->render();
    }
}
