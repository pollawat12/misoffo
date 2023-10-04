<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvaluations extends Model
{
    use HasFactory;

    protected $table = 'user_evaluations';
    
    public $timestamps = false;

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->sort_order = 0;
        $process->result_eval = (isset($data['result_eval'])) ? $data['result_eval'] : null;
        $process->salary_start = (isset($data['salary_start'])) ? $data['salary_start'] : 0.00;
        $process->salary_end = (isset($data['salary_end'])) ? $data['salary_end'] : 0.00;
        $process->salary_sum = (isset($data['salary_sum'])) ? $data['salary_sum'] : 0.00;
        $process->salary_div = (isset($data['salary_div'])) ? $data['salary_div'] : 0.00;
        $process->salary_number = (isset($data['salary_number'])) ? $data['salary_number'] : 0;
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
        $process->is_approved = (isset($data['is_approved'])) ? $data['is_approved'] : 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->users_id = (int) $data['user_id'];
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->sort_order = 0;
        $process->result_eval = (isset($data['result_eval'])) ? $data['result_eval'] : null;
        $process->salary_start = (isset($data['salary_start'])) ? $data['salary_start'] : 0.00;
        $process->salary_end = (isset($data['salary_end'])) ? $data['salary_end'] : 0.00;
        $process->salary_sum = (isset($data['salary_sum'])) ? $data['salary_sum'] : 0.00;
        $process->salary_div = (isset($data['salary_div'])) ? $data['salary_div'] : 0.00;
        $process->salary_number = (isset($data['salary_number'])) ? $data['salary_number'] : 0;
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
        $process->is_approved = (isset($data['is_approved'])) ? $data['is_approved'] : 0;
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
