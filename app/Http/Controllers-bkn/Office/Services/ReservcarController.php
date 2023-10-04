<?php

namespace App\Http\Controllers\Office\Services;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DataSetting;
use App\Models\ReserveCar;
class ReservcarController extends Base
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $meetings = ReserveCar::getMeetingLists();
        
        # code...
        $data = ['meetings'];
        return view('default.office.service.reserve-car-new.index', compact($data))->render();
    }
    
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
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
        $data = ['rooms', 'meeting_types', 'meeting_items', 'auth_info', 'group_works', 'department_works'];
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
        $data = ['rooms', 'meeting_types', 'meeting_items', 'auth_info', 'group_works', 'department_works', 'info', 'id', 'accessory_items'];
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
            

            $date_start = getInputDateToDB(trim($input['date_start'])).' '.trim($input['time_start']).':00';
            $date_end = getInputDateToDB(trim($input['date_end'])).' '.trim($input['time_end']).':00';

            // conver time for check date
            $date_start_checked = getDateTimeForCheck($date_start);
            $date_end_checked = getDateTimeForCheck($date_end, 'end');
            $existsMeeting = ReserveCar::getMeetingExists($date_start_checked, $date_end_checked, $input['meeting_room_id']);
            if (count($existsMeeting) > 0) {
                $response = ['status' => false, 'msg' => 'ไม่สามารถจองห้องประชุมนี้ได้ เนื่องจากมีผู้จองแล้ว!'];
                return response()->json($response, 200);
            }
            
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
                'status_approved' => (int) $input['status_approved'],
                'is_use_room' => (int) 1,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1,
                'updated_at' => \Carbon\Carbon::now(),
                'meeting_room_id' => (int) $input['meeting_room_id'],
                'meeting_type_id' => (int) $input['meeting_type_id'],
                'updated_by' => (int) $auth_info['user_id'],
                'image_cover' => null
            ];
            
            $result = ReserveCar::insertArray($array);

            if ($result) {
                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($response, 200);
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

            $date_start = getInputDateToDB(trim($input['date_start'])).' '.trim($input['time_start']).':00';
            $date_end = getInputDateToDB(trim($input['date_end'])).' '.trim($input['time_end']).':00';


            // conver time for check date
            $date_start_checked = getDateTimeForCheck($date_start);
            $date_end_checked = getDateTimeForCheck($date_end, 'end');
            $existsMeeting = ReserveCar::getMeetingExistsUpdate($date_start_checked, $date_end_checked, $input['meeting_room_id'], $edit_id);
            // $existsMeeting = ReserveCar::getMeetingExistsUpdate($date_start_checked, $date_end_checked, $input['meeting_room_id'], );
            if (count($existsMeeting) > 0) {
                $response = ['status' => false, 'msg' => 'ไม่สามารถจองห้องประชุมนี้ได้ เนื่องจากมีผู้จองแล้ว!'];
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
                'accessory_items' => json_encode($input['accessory_items']),
                'status_approved' => (int) $input['status_approved'],
                'is_use_room' => (int) 1,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1,
                'updated_at' => \Carbon\Carbon::now(),
                'meeting_room_id' => (int) $input['meeting_room_id'],
                'meeting_type_id' => (int) $input['meeting_type_id'],
                'updated_by' => (int) $auth_info['user_id'],
                'image_cover' => null
            ];
            
            $result = ReserveCar::updateArray($array);

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
    public function delete(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('GET')) {
            $id = $request->del_id;
            $result = ReserveCar::deleteRow($id);

            if ($result) {
                $response = ['status' => true, 'msg' => 'ลบรายการสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }
}
