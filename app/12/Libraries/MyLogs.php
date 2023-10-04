<?php 
namespace App\Libraries;

use DB;
use URL;
use Auth;
use App\Models\ActivityLog;
use App\Models\UserDutyDetail;

class MyLogs 
{
    public static function saveLog($data=[])
    {
        $authId = Auth::user()->id;
        $userInfo = [
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];

        $detail = [];

        $data = [
            'subject' => $data['subject'],
            'route_path' => url()->current(),
            'detail' => null,
            'detail_json' => json_encode($detail),
            'user_info' => json_encode($userInfo),
            'department_id' => (int) $data['department_id'],
            'group_id' => (int) $data['group_id'],
            'position_id' => (int) $data['position_id'],
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'created_at' => getDateNow(),
            'updated_at' => getDateNow(),
            'users_id' => (int) $authId,
            'updated_by_id' => (int) 0
        ];
        ActivityLog::insertOneWithArray($data);
    }


    public static function getNavNotifications()
    {
        $authId = Auth::user()->id;

        $duty = UserDutyDetail::where('users_id',$authId)->where('is_deleted', '0')->where('is_active','1')->skip(0)->take(1)->get();
        $dutyCount = $duty->count();
        $positionId = 0;
        if($dutyCount > 0){

            foreach ($duty as $rowDuty);

            if($rowDuty->position_no == '10'){

                $positionId = 10;
            }
        }


        $activities = ActivityLog::getByPositionId($positionId);

        return $activities;
    }
}
