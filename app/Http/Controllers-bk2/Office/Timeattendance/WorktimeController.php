<?php

namespace App\Http\Controllers\Office\Timeattendance;

use App\Http\Controllers\Base;
use App\Models\HrSettingTime;
use App\Models\TimeAttendance;
use App\Models\UserInformation;
use Illuminate\Http\Request;

class WorktimeController extends Base
{
    /**
     * Undocumented function index
     *
     * @return void
     */
    public function index()
    {
        $authInfo = $this->auth_info;
        $information = UserInformation::where('users_id',(int) $authInfo['user_id'])->first();
        $id = 1;
        $settingInfo = HrSettingTime::find((int) $id);
        $lat = '13.7462411';
        $lng = '100.5347402';
        $distance = (float) getCalDistance([$settingInfo->latitude, $settingInfo->longitude], [$lat, $lng]);
        $distance_number = $kiloDistance = $distance * 1000;
        $check_time_type = 'office';
        if ($kiloDistance >= $settingInfo->office_distance) $check_time_type = 'wfh';
        // dd($kiloDistance);

        $btnCheckInStatus = true;
        $defaultAvatar = URL('assets/img/User_icon.png');
        // if (($settingInfo->office_distance > 0) && ($kiloDistance > $settingInfo->office_distance)) $btnCheckInStatus = false;
        // $today = strtotime(date('Y-m-d H:i:s'));
        $timeCheckIn = strtotime(date('Y-m-d').' '.$settingInfo->check_in.':00');
        $timeCheckOut = strtotime(date('Y-m-d').' '.$settingInfo->check_out.':00');
        $checkType = getCheckTimeType($timeCheckIn, $timeCheckOut);
        $statusCheckType = getCheckTimeType($timeCheckIn, $timeCheckOut, true);
        $today = getDateTimeTH(date('Y-m-d H:i:s'), false, false, true);
        # code...
        $data = ['lat', 'lng', 'settingInfo', 'today', 'checkType', 'authInfo', 'statusCheckType', 'btnCheckInStatus', 'check_time_type', 'distance_number','information','defaultAvatar'];
        return view('default.office.timeattendance.index', compact($data));
    }

    /**
     * Undocumented function save
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $response = ['status' => false, 'msg' =>'error!'];
        $authInfo = $this->auth_info;
        $settingInfo = HrSettingTime::find((int) 1);
        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->all();
            // insert to db
            $insertId = TimeAttendance::insertDB($input, $authInfo['user_id']);
            if ($insertId) {
                $lat = $input['latitude'];
                $lng = $input['longitude'];
                $distance = (float) getCalDistance([$settingInfo->latitude, $settingInfo->longitude], [$lat, $lng]);
                $distance_number = $kiloDistance = $distance * 1000;
                $check_time_type = 'office';
                if ($kiloDistance >= $settingInfo->office_distance) $check_time_type = 'wfh';
                $data = [
                    'check_time_type' => $check_time_type,
                    'distance_number' => $distance_number
                ];
                $updateResult = TimeAttendance::where('id',(int) $insertId)->update($data);
            }
            // check if response data json format
            if ($insertId) $response = ['status' => true, 'msg' =>'ลงเวลาปฏิบัติงานสำเร็จ!'];
        }
        
        return response()->json($response, 200);
    }
}