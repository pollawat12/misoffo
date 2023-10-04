<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
//use App\Models\userDiagram;

class Usercar extends Model
{
    use HasFactory;

    protected $table = 'user_car';

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
        $process->code = isset($data['code'])  ? trim($data['code']) : 0;
        $process->title = isset($data['title'])  ? trim($data['title']) : '';
        $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : '';
        $process->time_start = isset($data['time_start'])  ? trim($data['time_start']) : '';
        $process->time_end = isset($data['time_end'])  ? trim($data['time_end']) : '';
        $process->file_attach = isset($data['file_attach'])  ? trim($data['file_attach']) : '';
        $process->personal_nums = (isset($data['personal_nums'])) ? $data['personal_nums'] : (int) 0;
        $process->owner_name = isset($data['owner_name'])  ? trim($data['owner_name']) : NULL;
        $process->owner_tel = isset($data['owner_tel'])  ? trim($data['owner_tel']) : NULL;
        $process->departments_id = (isset($data['departments_id'])) ? $data['departments_id'] : (int) 0;
        $process->groups_id = (isset($data['groups_id'])) ? $data['groups_id'] : (int) 0;
        $process->is_approved = isset($isApproved)  ? (int) trim($isApproved) : 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->meeting_room_id = (isset($data['meeting_room_id'])) ? $data['meeting_room_id'] : (int) 0;
        $process->meetIng_type_id = (isset($data['meetIng_type_id'])) ? $data['meetIng_type_id'] : (int) 0;
        $process->created_by = (isset($data['created_by'])) ? $data['created_by'] : (int) 0;
        $process->updated_by = (isset($data['updated_by'])) ? $data['updated_by'] : (int) 0;
        $process->meeting_category = (isset($data['meeting_category'])) ? $data['meeting_category'] : (int) 0;
        $process->car_start = (isset($data['car_start'])) ? $data['car_start'] : (int) 0;
        $process->car_end = (isset($data['car_end'])) ? $data['car_end'] : (int) 0;
        $process->driver = isset($data['driver'])  ? trim($data['driver']) : '';
        $process->person_category = isset($data['person_category'])  ? trim($data['person_category']) : '';
        $process->purpose_car = isset($data['purpose_car'])  ? trim($data['purpose_car']) : '';
        $process->car_type = isset($data['car_type'])  ? trim($data['car_type']) : '';
        $process->division_user_id = (int) $data['division_user_id'];
        $process->department_user_id = (int) $data['department_user_id'];
        $process->director_user_id = (int) $data['director_user_id'];
        // $process->admin_user_id = (int) $data['admin_user_id'];
        $process->users_id = (int) $data['user_id'];
    


        if ($returnId) {
            $process->save();

            return $process->id;
        }

        return $process->save();
    }

    public static function updateRow($data, $id = 0, $auth_info, $leave_user_id = 0 , $action)
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
