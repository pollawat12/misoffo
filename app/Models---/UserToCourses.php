<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToCourses extends Model
{
    use HasFactory;

    protected $table = 'user_to_courses';
    
    public $timestamps = false;

    public static function getDataAll($id=0,$isCount=false)
    {
        $conditions = [
            'courses_id' => $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        
        
        $query = self::where($conditions)->orderBy('id', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $userInformation = UserInformation::where('users_id',$row->users_id)->get();
                foreach ($userInformation as $rowUserInformation);

                $user = User::where('id',$row->users_id)->get();
                foreach ($user as $rowUser);

                $role = Role::where('id',$rowUser->roles_id)->get();
                foreach ($role as $rowRole);

                $array[] = [
                    'id' => $row->id,
                    'name' => $rowUserInformation->prename.' '.$rowUserInformation->firstname.' '.$rowUserInformation->lastname,
                    'role' => $rowRole->name,
                    'is_checkin' => $row->is_checkin,
                    'checkin_date' => $row->checkin_date,
                ];
            }
        }


        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->courses_id = isset($data['courses_id'])  ? trim($data['courses_id']) : 0;
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;
        $process->is_checkin = isset($data['is_checked'])  ? trim($data['is_checked']) : 0;
        $process->checkin_date = (isset($data['checked_at'])) ? getInputDateToDB($data['checked_at']) : null;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
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
     * getEmployees
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getCourses($id, $isCount=false)
    {
        $conditions = [
            'users_id' => (int) $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);


        $records = $query->get();
    
        $array = [];
        

        if (!empty($records)) {
            foreach ($records as $row) {

                $Courses = Courses::where('id',$row->courses_id)->get();
                foreach ($Courses as $rowCourse);

                $categroy = DataSetting::getNameDataByValueAndType($rowCourse->categroy_courses_id,'course');

                $array[] = [
                    'id' => $row->id,
                    'courses_id' => $rowCourse->id,
                    'name' => $rowCourse->name,
                    'date_start' => $rowCourse->date_start,
                    'date_end' => $rowCourse->date_end,
                    'time' => $rowCourse->time_start.' - '.$rowCourse->time_end,
                    'budget_year' => $rowCourse->budget_year,
                    'categroy' => $categroy,
                ];
            }
        }


        return $array;
    }
    
}
