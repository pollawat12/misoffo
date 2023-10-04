<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsJobs extends Model
{
    use HasFactory;

    protected $table = 'projects_jobs';
    
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
            'work_id' => (int) $id,
        ];

        $query = self::where($conditions);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->job_name = isset($data['job_name'])  ? trim($data['job_name']) : '';
        $process->job_num = isset($data['job_num'])  ? trim($data['job_num']) : 1;
        $process->department_id = isset($data['department_id'])  ? trim($data['department_id']) : 0;
        $process->group_work_id = isset($data['group_work_id'])  ? trim($data['group_work_id']) : 0;
        $process->educational_name = isset($data['educational_name'])  ? trim($data['educational_name']) : '';
        $process->experience_num = isset($data['experience_num'])  ? trim($data['experience_num']) : 0;
        $process->salary = isset($data['salary'])  ? trim($data['salary']) : 0.00;
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->work_id = isset($data['work_id'])  ? trim($data['work_id']) : 0;
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

        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->job_name = isset($data['job_name'])  ? trim($data['job_name']) : '';
        $process->job_num = isset($data['job_num'])  ? trim($data['job_num']) : 1;
        $process->department_id = isset($data['department_id'])  ? trim($data['department_id']) : 0;
        $process->group_work_id = isset($data['group_work_id'])  ? trim($data['group_work_id']) : 0;
        $process->educational_name = isset($data['educational_name'])  ? trim($data['educational_name']) : '';
        $process->experience_num = isset($data['experience_num'])  ? trim($data['experience_num']) : 0;
        $process->salary = isset($data['salary'])  ? trim($data['salary']) : 0.00;
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->work_id = isset($data['work_id'])  ? trim($data['work_id']) : 0;
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
