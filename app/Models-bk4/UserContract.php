<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContract extends Model
{
    use HasFactory;

    protected $table = 'user_contracts';
    
    public $timestamps = false;

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
        
        
        $query = self::where($conditions)->orderBy('contracts_date', 'ASC');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $duty = UserDutyDetail::find((int) $row->duty_id);

                $position = DataSetting::getNameDataByValueAndType($duty->position_no,'position');

                $array[] = [
                    'id' => $row->id,
                    'government_number' => $row->government_number,
                    'contracts_date' => $row->contracts_date,
                    'contracts_file' => $row->contracts_file,
                    'position' => $position,
                    'date_start' => $row->date_start,
                    'date_end' => ($row->date_end != NULL) ? $row->date_end : '',
                ];
            }
        }


        return $array;
    }


    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->duty_id = (int) $data['duty_id'];
        $process->government_number = (int) $data['government_number'];
        $process->contracts_date = (isset($data['contracts_date'])) ? getInputDateToDB($data['contracts_date']) : null;
        $process->contracts_file = (isset($data['contracts_file'])) ? $data['contracts_file'] : null;
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;;
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
        
        $process->duty_id = (int) $data['duty_id'];
        $process->government_number = (int) $data['government_number'];
        $process->contracts_date = (isset($data['contracts_date'])) ? getInputDateToDB($data['contracts_date']) : null;
        // $process->contracts_file = '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;;
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
