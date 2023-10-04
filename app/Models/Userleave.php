<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
//use App\Models\userDiagram;

class Userleave extends Model
{
    use HasFactory;

    protected $table = 'user_leave';

    public $timestamps = false;

    /**
     * getEmployees
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getLeave($id = 0, $isCount = false)
    {
        if ($id == 0) {
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        } else {
            $conditions = [
                'users_id' => (int) $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }


        $query = self::where($conditions);

        $records = $query->orderby('date_resign', 'DESC')->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $info = UserInformation::where('users_id', (int) $row->users_id)->first();

                $empName = (!empty($info->prename) && is_numeric($info->prename)) ? DataSetting::getNameDataByValueAndType($info->prename, 'prename') . ' ' : '';

                $emp = User::find((int) $row->users_id);

                $role = Role::find((int) $emp->roles_id);

                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type, 'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $empName . ' ' . $info->firstname . ' ' . $info->lastname,
                    'role_name' => $role->name,
                    'leave_type' => $Leave,
                    'date_resign' => $row->date_resign,
                    'date_start' => $row->date_start,
                    'date_end' => $row->date_end,
                    'is_approved' => $row->is_approved,
                    'total_date' => $row->total_date,
                ];
            }
        }


        return $array;
    }


    /**
     * getEmployees
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getCheckEmplyooLeave($id = 0, $isCount = false)
    {
        $conditions = [
            'id' => (int) $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];


        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $info = UserInformation::where('users_id', (int) $row->users_id)->first();

                $empName = (!empty($info->prename) && is_numeric($info->prename)) ? DataSetting::getNameDataByValueAndType($info->prename, 'prename') . ' ' : '';

                $emp = User::find((int) $row->users_id);

                $role = Role::find((int) $emp->roles_id);

                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type, 'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $empName . ' ' . $info->firstname . ' ' . $info->lastname,
                    'role_name' => $role->name,
                    'leave_type' => $Leave,
                    'date_resign' => $row->date_resign,
                    'date_start' => $row->date_start,
                    'date_end' => $row->date_end,
                    'is_approved' => $row->is_approved,
                ];
            }
        }


        return $array;
    }



    public static function insertRow($data, $returnId = false)
    {


        $employees = UserDiagram::where('user_id', $data['user_id'])->where('is_active', 1)->first();
        //select role วนิดา is_approved = 1

        //select role ไพลิน is_approved = 2

        $isApproved = 0;
        $strLev = "";


        if ($employees->user_level  == 4) {
            $isApproved = 0;
            $strLev = "officer_user_id";
            if ((int) $data['division_user_id'] == 99) {
                $isApproved = 1;

                $userId = $data['department_user_id'];

                $userInfo = UserInformation::where('users_id', trim($userId))->first();

                //$resp = ['status' => false, 'msg' => $userInfo];
                //return response()->json($resp, 200);

                if ($userInfo && !empty($userInfo)) {

                    $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                    $template = 'template_emails.MailLeave';

                    $date = Carbon::now();

                    $link =

                        $contents = [

                            'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
                            'name' => $information->firstname . ' ' . $information->lastname,
                            'body' => ''
                        ];


                    Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
                }
            } else {

                $userId = $data['division_user_id'];

                $userInfo = UserInformation::where('users_id', trim($userId))->first();

                //$resp = ['status' => false, 'msg' => $userInfo];
                //return response()->json($resp, 200);

                if ($userInfo && !empty($userInfo)) {

                    $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                    $template = 'template_emails.MailLeave';

                    $date = Carbon::now();

                    $link =

                        $contents = [

                            'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
                            'name' => $information->firstname . ' ' . $information->lastname,
                            'body' => ''
                        ];


                    Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
                }
            }
        }

        if ($employees->user_level  == 3) {
            $isApproved = 1;
            $strLev = "division_user_id";

            $userId = $data['department_user_id'];

            $userInfo = UserInformation::where('users_id', trim($userId))->first();

            //$resp = ['status' => false, 'msg' => $userInfo];
            //return response()->json($resp, 200);

            if ($userInfo && !empty($userInfo)) {

                $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                $template = 'template_emails.MailLeave';

                $date = Carbon::now();

                $link =

                    $contents = [

                        'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
                        'name' => $information->firstname . ' ' . $information->lastname,
                        'body' => ''
                    ];


                Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
            }

            //'t3.department_user_id' => (int) $userId,
        }

        if ($employees->user_level  == 2) {
            $isApproved = 2;
            $strLev = "department_user_id";


            $userId = $data['director_user_id'];
            $userInfo = UserInformation::where('users_id', trim($userId))->first();
            if ($userInfo && !empty($userInfo)) {

                $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                $template = 'template_emails.MailLeave';

                $date = Carbon::now();

                $link =

                    $contents = [

                        'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
                        'name' => $information->firstname . ' ' . $information->lastname,
                        'body' => ''
                    ];


                Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
            }
        }


        if ($employees->user_level  == 1) {
            $isApproved = 4;
            $strLev =  "director_user_id";
        }


        $process = new self;
        $process->leave_type = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');
        $process->total_date = (float) $data['total_date'];
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->comment = isset($data['comment'])  ? trim($data['comment']) : '';
        $process->users_id = (int) $data['user_id'];
        $process->represent_name = isset($data['represent_name'])  ? trim($data['represent_name']) : NULL;
        $process->represent_tel = isset($data['represent_tel'])  ? trim($data['represent_tel']) : NULL;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->is_approved = isset($isApproved)  ? (int) trim($isApproved) : 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->division_user_id = (int) $data['division_user_id'];
        $process->department_user_id = (int) $data['department_user_id'];
        $process->director_user_id = (int) $data['director_user_id'];
        $process->start_day_status = (int) $data['start_day_status'];
        $process->end_day_status = (int) $data['end_day_status'];


        if ($returnId) {
            $process->save();

            return $process->id;
        }

        return $process->save();
    }

    public static function updateRow($data, $id = 0, $auth_info = 0, $leave_user_id = 0 , $action = 0)
    {


        $process = self::find((int) $id);

        //$userLeaveData = userDiagram::where('id', $data['user_id'])->where('is_active', 1)->first();

        //เจ้าของใบลา
        // $employees = userDiagram::where('user_id',$data['user_id'])->where('is_active',1)->first();

        $employees = UserDiagram::where('user_id', $leave_user_id)->where('is_active', 1)->first();

        //คนlogin
        $employeeslogin = UserDiagram::where('user_id', $auth_info['user_id'])->where('is_active', 1)->first();


        $isApproved = 0;

        if($action == "cancel"){
            $isApproved = 5;
            //$isApproved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
            $userId = $process->department_user_id;
            $userInfo = UserInformation::where('users_id', trim(145))->first();
            if ($userInfo && !empty($userInfo)) {

                $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                $template = 'template_emails.MailLeave';

                $date = Carbon::now();

                $link =

                    $contents = [

                        'subject' => 'แจ้งการยกเลิกการลาของเจ้าหน้าที่' . ' ' . $date,
                        'name' => $information->firstname . ' ' . $information->lastname,
                        'body' => ''
                    ];


                Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
            }



        }else
        {

            if ($process->user_level  == 4) {

            }
    
            if ($employees->user_level  == 4) {
                if ($employeeslogin->user_level  == 2) {
                    $isApproved = 4;
                } else {
                    $isApproved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
                    $userId = $process->department_user_id;
                    $userInfo = UserInformation::where('users_id', trim($userId))->first();
                    if ($userInfo && !empty($userInfo)) {
    
                        $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                        $template = 'template_emails.MailLeave';
    
                        $date = Carbon::now();
    
                        $link =
    
                            $contents = [
    
                                'subject' => 'แจ้งการลาของเจ้าหน้าที่' . ' ' . $date,
                                'name' => $information->firstname . ' ' . $information->lastname,
                                'body' => ''
                            ];
    
    
                        Mail::to("krutae8920@gmail.com")->send(new \App\Mail\LeaveMail($template, $contents));
                    }
    
    
    
                }
            }
    
            if ($employees->user_level  == 3) {
                if ($employeeslogin->user_level  == 2) {
    
                    $isApproved = 4;
                    
                } else {
                    $isApproved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
                    
                }
            }
    
    
            if ($employees->user_level  == 2) {
                if ($employeeslogin->user_level  == 1) {
                    $isApproved = 4;
                } else {
                    $isApproved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
                }
            }
    
            if($data['is_approved'] == 9 ){
                $isApproved = 9;
    
            }

            if($data['is_approved'] == 6 ){
                $isApproved = 6;
    
            }
            
    
    

        }




        $process->leave_type = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->comment = isset($data['comment'])  ? trim($data['comment']) : '';
        $process->represent_name = isset($data['represent_name'])  ? trim($data['represent_name']) : NULL;
        $process->represent_tel = isset($data['represent_tel'])  ? trim($data['represent_tel']) : NULL;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->is_approved = isset($isApproved)  ? (int) trim($isApproved) : 0;
        $process->updated_at = getDateNow();

        return $process->save();
    }

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
     * getSearch
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getSearchDay($data, $isCount = false)
    {
        if ($data['type'] == 0) {

            if (!empty($data['day'])) {
                $conditions = [
                    'date_start' => getDateFromInputDate($data['day']),
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            } else {
                $conditions = [
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            }
        } else {

            if (!empty($data['day'])) {
                $conditions = [
                    'date_start' => getDateFromInputDate($data['day']),
                    'leave_type' => $data['type'],
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            } else {
                $conditions = [
                    'leave_type' => $data['type'],
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            }
        }


        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $info = UserInformation::where('users_id', (int) $row->users_id)->first();

                $emp = User::find((int) $row->users_id);

                $role = Role::find((int) $emp->roles_id);

                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type, 'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $info->prename . ' ' . $info->firstname . ' ' . $info->lastname,
                    'role_name' => $role->name,
                    'leave_type' => $Leave,
                    'date_resign' => $row->date_resign,
                    'date_start' => $row->date_start,
                    'date_end' => $row->date_end,
                    'is_approved' => $row->is_approved,
                ];
            }
        }


        return $array;
    }
}
