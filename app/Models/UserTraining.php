<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTraining extends Model
{
    use HasFactory;

    protected $table = 'user_traning';
    
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
    public static function getDataAll($isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1

        ];

        $query = self::where($conditions);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->institute_name = isset($data['institute_name'])  ? trim($data['institute_name']) : '';
        $process->course_name = isset($data['course_name'])  ? trim($data['course_name']) : '';
        $process->description  = isset($data['course_name'])  ? trim($data['course_name']) : '';
        $process->time_start = (isset($data['time_start'])) ? $data['time_start']: null;
        $process->certificate_name = isset($data['certificate_name'])  ? trim($data['certificate_name']) : '';
        $process->certificate_file = isset($data['certificate_file'])  ? trim($data['certificate_file']) : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;

        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->institute_name = isset($data['institute_name'])  ? trim($data['institute_name']) : '';
        $process->course_name = isset($data['course_name'])  ? trim($data['course_name']) : '';
        $process->description  = isset($data['course_name'])  ? trim($data['course_name']) : '';
        $process->time_start = (isset($data['time_start'])) ? $data['time_start']: null;
        $process->certificate_name = isset($data['certificate_name'])  ? trim($data['certificate_name']) : '';
        $process->certificate_file = isset($data['certificate_file'])  ? trim($data['certificate_file']) : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;
        
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
