<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGoal extends Model
{
    use HasFactory;

    protected $table = 'project_goals';
    
    public $timestamps = false;

    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public static function insertRow($data, $id=0)
    {
        $process = new self;

        $process->description = $data['name'];
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->projects_id = (int) $id;
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->description = $data['name'];
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
