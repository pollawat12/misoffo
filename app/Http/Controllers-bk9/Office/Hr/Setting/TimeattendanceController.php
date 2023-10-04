<?php

namespace App\Http\Controllers\Office\Hr\Setting;

use App\Http\Controllers\Base;
use App\Models\HrSettingTime;
use Illuminate\Http\Request;

class TimeattendanceController extends Base
{
    /**
     * Undocumented function __construct
     */
    public function __construct()
    {
        parent::__construct();
        // dd($this->auth_info);
    }

    /**
     * Undocumented function index
     *
     * @return void
     */
    public function index()
    {
        $id = 1;

        $info = HrSettingTime::find((int) $id);
        # code...
        $data = ['id', 'info'];

        return view('default.office.hr.settings.timeattendance.edit', compact($data));
    }

    /**
     * Undocumented function edit
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->all();

            $updateResult = HrSettingTime::updateRecord($input, $input['edit_id']);

            if ($updateResult) $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
        }


        return response()->json($response, 200);
    }
}
