<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransferInOffice extends Model
{
    use HasFactory;

    protected $table = 'user_transfer_in_offices';
    
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
        
        
        $query = self::where($conditions)->orderBy('date_start', 'ASC');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $department = DataSetting::getNameDataByValueAndType($row->from_department,'department');
                // $position = DataSetting::getNameDataByValueAndType($row->from_position,'group_work');
                // $positionTo = DataSetting::getNameDataByValueAndType($row->to_position,'group_work');

                $array[] = [
                    'id' => $row->id,
                    'from_department' => $department,
                    // 'from_position' => $position,
                    'from_institution' => $row->from_institution,
                    'to_department' => $row->to_department,
                    // 'to_position' => $positionTo,
                    'to_institution' => $row->to_institution,
                    'is_present' => $row->is_present,
                    'transfer_file' => $row->transfer_file,
                    'is_loan' => $row->is_loan,
                    'date_start' => $row->date_start,
                    'date_end' => $row->date_end,
                ];
            }
        }


        return $array;
    }

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->from_department = (int) $data['from_department'];
        $process->from_position = (isset($data['from_position'])) ? (int) $data['from_position'] : Null;
        $process->from_institution = (isset($data['from_institution'])) ? $data['from_institution'] : '';
        $process->to_department = (isset($data['to_department'])) ? $data['to_department'] : '';
        $process->to_position = (isset($data['to_position'])) ? (int) $data['to_position'] : Null;
        $process->to_institution = (isset($data['to_institution'])) ? $data['to_institution'] : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->leader_name = (isset($data['leader_name'])) ? $data['leader_name'] : null;
        $process->leader_tel = (isset($data['leader_tel'])) ? $data['leader_tel'] : null;
        $process->leader_email = (isset($data['leader_email'])) ? $data['leader_email'] : null;
        $process->leader_mobile = (isset($data['leader_mobile'])) ? $data['leader_mobile'] : null;
        $process->transfer_file = (isset($data['transfer_file'])) ? $data['transfer_file'] : null;
        $process->is_loan = (isset($data['is_loan'])) ? $data['is_loan'] : null;
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
        
        $process->from_department = (int) $data['from_department'];
        $process->from_position = (isset($data['from_position'])) ? (int) $data['from_position'] : Null;
        $process->from_institution = (isset($data['from_institution'])) ? $data['from_institution'] : '';
        $process->to_department = (isset($data['to_department'])) ? $data['to_department'] : '';
        $process->to_position = (isset($data['to_position'])) ? (int) $data['to_position'] : Null;
        $process->to_institution = (isset($data['to_institution'])) ? $data['to_institution'] : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->leader_name = (isset($data['leader_name'])) ? $data['leader_name'] : null;
        $process->leader_tel = (isset($data['leader_tel'])) ? $data['leader_tel'] : null;
        $process->leader_email = (isset($data['leader_email'])) ? $data['leader_email'] : null;
        $process->leader_mobile = (isset($data['leader_mobile'])) ? $data['leader_mobile'] : null;
        $process->is_loan = (isset($data['is_loan'])) ? $data['is_loan'] : null;
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
