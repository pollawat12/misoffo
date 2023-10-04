<?php

namespace App\Http\Controllers\Office\Settings\Meeting;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DataSetting;

class AccessoryController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $rooms = DataSetting::getDataAll('meeting_item');
        
        # code...
        $data = ['rooms'];
        return view('default.office.setting.meeting.item.index', compact($data))->render();
    }
    
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {

        # code...
        $data = [];
        return view('default.office.setting.meeting.item.add', compact($data))->render();
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

        $_info = DataSetting::find((int) $id);
        
        # code...
        $data = ['_info', 'id'];
        return view('default.office.setting.meeting.item.edit', compact($data))->render();
    }

    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->input();

            $array = [
                'parent_id' => (int) 0,
                'sort_order' => (int) 1,
                'name' => $input['name'],
                'group_type' => $input['group_type'],
                'value_type' => (int) 0,
                'data_value' => (int) 0,
                'data_string' => '-',
                'is_deleted' => (int) $input['is_deleted'],
                'is_active' => (int) 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'amount' => (int) $input['amount']
            ];
            
            $result = DataSetting::insertArray($array);

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
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->input();

            $array = [
                'name' => $input['name'],
                'group_type' => $input['group_type'],
                'is_deleted' => (int) $input['is_deleted'],
                'updated_at' => \Carbon\Carbon::now(),
                'amount' => (int) $input['amount']
            ];
            
            $result = DataSetting::updateArray($array, $input['edit_id']);

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

        if ($request->ajax() && $request->isMethod('POST')) {
            $id = $request->del_id;
            $result = DataSetting::deleteRow($id);

            if ($result) {
                $response = ['status' => true, 'msg' => 'ลบรายการสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }
}
