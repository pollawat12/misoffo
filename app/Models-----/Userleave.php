<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public static function getLeave($id=0, $isCount=false)
    {
        if($id == 0){
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }else{
            $conditions = [
                'users_id' => (int) $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }
        

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $info = UserInformation::where('users_id', (int) $row->users_id)->first();

                $empName = (!empty($info->prename) && is_numeric($info->prename)) ? DataSetting::getNameDataByValueAndType($info->prename,'prename').' ' : '';

                $emp = User::find((int) $row->users_id);

                $role = Role::find((int) $emp->roles_id);
                
                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type,'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $empName.' '.$info->firstname.' '.$info->lastname,
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


    /**
     * getEmployees
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getCheckEmplyooLeave($id=0, $isCount=false)
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

                $empName = (!empty($info->prename) && is_numeric($info->prename)) ? DataSetting::getNameDataByValueAndType($info->prename,'prename').' ' : '';

                $emp = User::find((int) $row->users_id);

                $role = Role::find((int) $emp->roles_id);
                
                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type,'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $empName.' '.$info->firstname.' '.$info->lastname,
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



    public static function insertRow($data, $returnId=false)
    {
        $process = new self;
        $process->leave_type = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->users_id = (int) $data['user_id'];
        $process->represent_name = isset($data['represent_name'])  ? trim($data['represent_name']) : NULL;
        $process->represent_tel = isset($data['represent_tel'])  ? trim($data['represent_tel']) : NULL;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->is_approved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
        $process->is_deleted = (int) 9;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->leave_type = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->date_resign = isset($data['date_resign'])  ? getInputDateToDB($data['date_resign']) : date('Y-m-d');
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : date('Y-m-d');
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : date('Y-m-d');
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->represent_name = isset($data['represent_name'])  ? trim($data['represent_name']) : NULL;
        $process->represent_tel = isset($data['represent_tel'])  ? trim($data['represent_tel']) : NULL;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->is_approved = isset($data['is_approved'])  ? (int) trim($data['is_approved']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function deleteRow($id=0)
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
    public static function getSearchDay($data , $isCount=false)
    {   
        if($data['type'] == 0){

            if(!empty($data['day'])){
                $conditions = [
                    'date_start' => getDateFromInputDate($data['day']),
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            }else{
                $conditions = [
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            }
            
        }else{
            
            if(!empty($data['day'])){
                $conditions = [
                    'date_start' => getDateFromInputDate($data['day']),
                    'leave_type' => $data['type'],
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];
            }else{
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
                
                $Leave = DataSetting::getNameDataByValueAndType($row->leave_type,'leave');

                $array[] = [
                    'id' => $row->id,
                    'name' => $info->prename.' '.$info->firstname.' '.$info->lastname,
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
