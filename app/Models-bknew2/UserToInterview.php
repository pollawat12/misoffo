<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToInterview extends Model
{
    use HasFactory;

    protected $table = 'user_to_interview';
    
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
    public static function getDataAll($id, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'job_id' => (int) $id,
        ];

        $query = self::where($conditions);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->job_id = isset($data['job_id'])  ? trim($data['job_id']) : 0;
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;
        $process->checkin_date = isset($data['checkin_date'])  ? getInputDateToDB($data['checkin_date']) : NULL;
        $process->is_checkin = isset($data['is_checkin'])  ? trim($data['is_checkin']) : 0;
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

    public static function updateRow($data , $id)
    {
        $process = self::find((int) $id);

        $process->job_id = isset($data['job_id'])  ? trim($data['job_id']) : 0;
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;
        $process->checkin_date = isset($data['checkin_date'])  ? getInputDateToDB($data['checkin_date']) : NULL;
        $process->is_checkin = isset($data['is_checkin'])  ? trim($data['is_checkin']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
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
