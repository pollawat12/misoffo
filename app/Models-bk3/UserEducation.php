<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;

    protected $table = 'user_educations';
    
    public $timestamps = false;

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->degress_no = (isset($data['degress_no'])) ? $data['degress_no'] : null;
        $process->institute_name = (isset($data['institute_name'])) ? $data['institute_name'] : null;
        $process->faculty_name = (isset($data['faculty_name'])) ? $data['faculty_name'] : null;
        $process->education_degree = (isset($data['education_degree'])) ? $data['education_degree'] : null;
        $process->education_file = (isset($data['education_file'])) ? $data['education_file'] : null;
        $process->education_branch = (isset($data['education_branch'])) ? $data['education_branch'] : null;
        $process->year_start = (isset($data['year_start'])) ? $data['year_start'] : null;
        $process->year_end = (isset($data['year_end'])) ? $data['year_end'] : null;
        $process->note = (isset($data['note'])) ? $data['note'] : null;
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
        
        $process->degress_no = (isset($data['degress_no'])) ? $data['degress_no'] : null;
        $process->institute_name = (isset($data['institute_name'])) ? $data['institute_name'] : null;
        $process->faculty_name = (isset($data['faculty_name'])) ? $data['faculty_name'] : null;
        $process->education_degree = (isset($data['education_degree'])) ? $data['education_degree'] : null;
        // $process->education_file = (isset($data['education_file'])) ? $data['education_file'] : null;
        $process->education_branch = (isset($data['education_branch'])) ? $data['education_branch'] : null;
        $process->year_start = (isset($data['year_start'])) ? $data['year_start'] : null;
        $process->year_end = (isset($data['year_end'])) ? $data['year_end'] : null;
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
