<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;

    protected $table = 'user_experiences';
    
    public $timestamps = false;

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->sort_order = 0;
        $process->company = (isset($data['company'])) ? $data['company'] : null;
        $process->address = (isset($data['address'])) ? $data['address'] : null;
        $process->salary = (isset($data['salary'])) ? $data['salary'] : 0.00;
        $process->position = (isset($data['position'])) ? $data['position'] : null;
        $process->job_description = (isset($data['job_description'])) ? $data['job_description'] : null;
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (!empty($data['date_end']) || $data['date_end'] != NULL) ? getInputDateToDB($data['date_end']) : NULL;
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
        $process->company = (isset($data['company'])) ? $data['company'] : null;
        $process->address = (isset($data['address'])) ? $data['address'] : null;
        $process->salary = (isset($data['salary'])) ? $data['salary'] : 0.00;
        $process->position = (isset($data['position'])) ? $data['position'] : null;
        $process->job_description = (isset($data['job_description'])) ? $data['job_description'] : null;
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
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
