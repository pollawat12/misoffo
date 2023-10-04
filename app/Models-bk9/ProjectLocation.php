<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    use HasFactory;

    protected $table = 'project_locations';
    
    public $timestamps = false;

    
    /**
     * getWithProjectId
     *
     * @param  mixed $projectId
     * @return void
     */
    public static function getWithProjectId($projectId=0)
    {
        $conditions = [
            'projects_id' => (int) $projectId,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        return self::where($conditions)->get();
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
