<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDutyDetail extends Model
{
    use HasFactory;

    protected $table = 'user_duty_details';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    //
    /**
     * getDataAll
     *
     * @param  mixed $type
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataAll($id=0 , $parentId=0, $isCount=false)
    {
        
        $conditions = [
            'users_id' =>  $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        
        
        $query = self::where($conditions)->orderBy('date_start', 'ASC');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $department = DataSetting::getNameDataByValueAndType($row->department_no,'department');
                $position = DataSetting::getNameDataByValueAndType($row->position_no,'position');
                $group_work = DataSetting::getNameDataByValueAndType($row->group_no,'group_work');

                if($row->status_work == '0'){ $work = 'ทำงาน'; }elseif($row->status_work == '1'){ $work = 'ลาออก'; }elseif($row->status_work == '2'){ $work = 'เกษียณ'; }else{ $work = 'เข้างานใหม่'; }

                $array[] = [
                    'id' => $row->id,
                    'contract_type' => $row->contract_type,
                    'department' => $department,
                    'position' => $position,
                    'group_work' => $group_work,
                    'date_start' => $row->date_start,
                    'date_end' => ($row->date_end != NULL) ? getDateTimeTH($row->date_end , false) : '',
                    'status_work' => $work,
                ];
            }
        }


        return $array;
    }


    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->contract_type = (int) $data['contract_type'];
        $process->department_no = (int) $data['department_no'];
        $process->position_no = (int) $data['position_no'];
        $process->group_no = (int) $data['group_no'];
        $process->government_no = (int) $data['government_no'];
        $process->government_number = (int) $data['government_number'];
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->date_resign = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
        $process->status_work = (int) $data['status_work'];
        $process->users_id = (int) $data['user_id'];
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->contract_type = (int) $data['contract_type'];
        $process->department_no = (int) $data['department_no'];
        $process->position_no = (int) $data['position_no'];
        $process->group_no = (int) $data['group_no'];
        $process->government_no = (int) $data['government_no'];
        $process->government_number = (int) $data['government_number'];
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->date_resign = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->status_work = (int) $data['status_work'];
        $process->note = (isset($data['note'])) ? $data['note'] : null;
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
}
