<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveCar extends Model
{
    use HasFactory;

    protected $table = 'reserve_car';

    public $timestamps = false;


    public static function getMeetingLists()
    {
        $conditions = [
            't1.is_deleted' => (int) 0,
            't1.is_active' =>  (int) 1
        ];

        $query = DB::table('reserve_car as t1')
            ->leftJoin('data_settings as t2', 't2.id', '=', 't1.meeting_room_id')
            ->leftJoin('data_settings as t3', 't3.id', '=', 't1.meeting_type_id')
            ->where('t2.group_type', 'car_num')
            ->where('t3.group_type', 'car_tpye')
            ->where($conditions)
            ->select('t1.*', 't2.name as meeting_room', 't3.name as meeting_type');

        return $query->orderBy('date_start', 'desc')->get();
    }


    /**
     * insertArray
     *
     * @param  mixed $array
     * @param  mixed $return_id
     * @return void
     */
    public static function insertArray($array, $return_id = false)
    {
        // $query = new self;
        if ($return_id) {
            return self::create($array)->id;
        }
        return self::insert($array);
    }
    
    // public static function insertRow($data, $returnId = false)
    // {

    //     $employees = UserDiagram::where('user_id', $data['user_id'])->where('is_active', 1)->first();
    //     //select role วนิดา is_approved = 1

    //     //select role ไพลิน is_approved = 2

    //     $isApproved = 0;
    //     $strLev = "";


    //     if ($employees->user_level  == 4) {
    //         $isApproved = 0;
    //         $strLev = "officer_user_id";
    //         if ((int) $data['division_user_id'] == 99) {
    //             $isApproved = 1;

    //             $userId = $data['department_user_id'];

    //             $userInfo = UserInformation::where('users_id', trim($userId))->first();

    //             //$resp = ['status' => false, 'msg' => $userInfo];
    //             //return response()->json($resp, 200);

    //             if ($userInfo && !empty($userInfo)) {

    //                 $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
    //                 $template = 'template_emails.MailLeave';

    //                 $date = Carbon::now();

    //                 $link =

    //                     $contents = [

    //                         'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
    //                         'name' => $information->firstname . ' ' . $information->lastname,
    //                         'body' => ''
    //                     ];


    //                 Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
    //             }
    //         } else {

    //             $userId = $data['division_user_id'];

    //             $userInfo = UserInformation::where('users_id', trim($userId))->first();

    //             //$resp = ['status' => false, 'msg' => $userInfo];
    //             //return response()->json($resp, 200);

    //             if ($userInfo && !empty($userInfo)) {

    //                 $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
    //                 $template = 'template_emails.MailLeave';

    //                 $date = Carbon::now();

    //                 $link =

    //                     $contents = [

    //                         'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
    //                         'name' => $information->firstname . ' ' . $information->lastname,
    //                         'body' => ''
    //                     ];


    //                 Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
    //             }
    //         }
    //     }

    //     if ($employees->user_level  == 3) {
    //         $isApproved = 1;
    //         $strLev = "division_user_id";

    //         $userId = $data['department_user_id'];

    //         $userInfo = UserInformation::where('users_id', trim($userId))->first();

    //         //$resp = ['status' => false, 'msg' => $userInfo];
    //         //return response()->json($resp, 200);

    //         if ($userInfo && !empty($userInfo)) {

    //             $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
    //             $template = 'template_emails.MailLeave';

    //             $date = Carbon::now();

    //             $link =

    //                 $contents = [

    //                     'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
    //                     'name' => $information->firstname . ' ' . $information->lastname,
    //                     'body' => ''
    //                 ];


    //             Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
    //         }

    //         //'t3.department_user_id' => (int) $userId,
    //     }

    //     if ($employees->user_level  == 2) {
    //         $isApproved = 2;
    //         $strLev = "department_user_id";


    //         $userId = $data['director_user_id'];
    //         $userInfo = UserInformation::where('users_id', trim($userId))->first();
    //         if ($userInfo && !empty($userInfo)) {

    //             $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
    //             $template = 'template_emails.MailLeave';

    //             $date = Carbon::now();

    //             $link =

    //                 $contents = [

    //                     'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
    //                     'name' => $information->firstname . ' ' . $information->lastname,
    //                     'body' => ''
    //                 ];


    //             Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
    //         }
    //     }


    //     if ($employees->user_level  == 1) {
    //         $isApproved = 4;
    //         $strLev =  "director_user_id";
    //     }


    //     $process = new self;
    //     $process->leave_type = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;

    //     $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
    //     $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
    //     $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');

    //     $process->time_start = isset($data['time_start'])  ? getInputDateToDB($data['time_start']) :':00';

    //     $process->time_end = isset($data['time_end'])  ? getInputDateToDB($data['time_end']) :':00';
       
    //     $process->note = isset($data['note'])  ? trim($data['note']) : '';
    //     $process->comment = isset($data['comment'])  ? trim($data['comment']) : '';
    //     $process->users_id = (int) $data['user_id'];
    //     $process->represent_name = isset($data['represent_name'])  ? trim($data['represent_name']) : NULL;
    //     $process->represent_tel = isset($data['represent_tel'])  ? trim($data['represent_tel']) : NULL;
    //     $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
    //     $process->is_approved = isset($isApproved)  ? (int) trim($isApproved) : 0;
    //     $process->is_deleted = (int) 0;
    //     $process->is_active = (int) 1;
    //     $process->created_at = getDateNow();
    //     $process->updated_at = getDateNow();
    //     $process->division_user_id = (int) $data['division_user_id'];
    //     $process->department_user_id = (int) $data['department_user_id'];
    //     $process->director_user_id = (int) $data['director_user_id'];
    //     $process->start_day_status = (int) $data['start_day_status'];
    //     $process->end_day_status = (int) $data['end_day_status'];


    //     if ($returnId) {
    //         $process->save();

    //         return $process->id;
    //     }

    //     return $process->save();
    // }

    /**
     * updateArray
     *
     * @param  mixed $input
     * @param  mixed $return_id
     * @return void
     */
    public static function updateArray($array, $id = 0)
    {
        // $query = new self;
        return self::where('id', $id)->update($array);
    }

    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
    public static function deleteRow($id = 0)
    {
        $process = self::find((int) $id);

        $process->is_deleted = (int) 1;
        $process->is_active = (int) 0;
        $process->updated_at = getDateNow();
        $process->save();

        return $process->save();
    }

    /**
     * getMeetingExists
     *
     * @param  mixed $sDate
     * @param  mixed $eDate
     * @return void
     */
    public static function getMeetingExists($sDate = '', $eDate = '', $meeting_id = 0)
    {
        $conditions = [
            'meeting_room_id' => (int) $meeting_id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $query = self::where($conditions)->where(function ($q) use ($sDate, $eDate) {
            $q->whereBetween('date_start', [$sDate, $eDate])->orWhereBetween('date_end', [$sDate, $eDate]);
        });

        return $query->get();
    }

    /**
     * getMeetingExistsUpdate
     *
     * @param  mixed $sDate
     * @param  mixed $eDate
     * @param  mixed $room_meeting_id
     * @param  mixed $meeting_id
     * @param  mixed $user_id
     * @return void
     */
    public static function getMeetingExistsUpdate($sDate = '', $eDate = '', $room_meeting_id = 0, $meeting_id = 0)
    {
        return 0;
        $info = self::find((int) $meeting_id);

        $timestamp_date_start = strtotime($info->date_start);
        $timestamp_date_end = strtotime($info->date_end);
        $new_timestamp_date_start = strtotime($sDate);
        $new_timestamp_date_end = strtotime($eDate);

        if (($timestamp_date_start == $new_timestamp_date_start) && ($timestamp_date_end == $new_timestamp_date_end) && $meeting_id > 0) {
            return (int) 0;
        }

        $conditions = [
            'meeting_room_id' => (int) $room_meeting_id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $query = self::where($conditions)->where(function ($q) use ($sDate, $eDate) {
            $q->whereBetween('date_start', [$sDate, $eDate])->orWhereBetween('date_end', [$sDate, $eDate]);
        });

        $results = $query->get();
        return (int) count($results);
    }

    public static function getMeetingExistsUpdate2($sDate = '', $eDate = '', $room_meeting_id = 0, $meeting_id = 0)
    {
        return 0;
    }
}
