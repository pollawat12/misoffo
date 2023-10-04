<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIndicator extends Model
{
    use HasFactory;

    protected $table = 'project_indicators';
    
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

        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->name = $data['name'];
        $process->indicator_type = $data['indicator_type'];
        $process->goal_detail = '';
        $process->goal_value = 0;
        $process->note = $data['note'];
        $process->status_indicator = (int) 1;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->projects_id = (int) $id;
        

        return $process->save();
    }
    
    /**
     * doUpdateStatus
     *
     * @param  mixed $status
     * @param  mixed $id
     * @return void
     */
    public static function doUpdateStatus($status=1,$id=0)
    {
        $process = self::find((int) $id);

        $process->status_indicator = $status;
        $process->updated_at = getDateNow();
        return $process->save();
    }
}
