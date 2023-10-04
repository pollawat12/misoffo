<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsDirector extends Model
{
    use HasFactory;

    protected $table = 'projects_director';
    
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
            'is_active' => (int) 1,
        ];

        $query = self::where($conditions);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }

    public static function inserRow($purchasesid , $positionid , $returnId)
    {
        $process = new self;
        $process->parent_id = 0;
        $process->sort_order = 0;
        $process->user_id = $purchasesid;
        $process->position_id = $positionid;
        $process->job_id = $returnId;
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
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->position_id = isset($data['position_id'])  ? trim($data['position_id']) : 0;
        $process->job_id = isset($data['job_id'])  ? trim($data['job_id']) : 0;
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
