<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectIndicatorReport extends Model
{
    use HasFactory;

    protected $table = 'project_indicator_reports';
    
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
        
        $indicator = ProjectIndicator::find((int) $id);

        $process->description = $data['description'];
        $process->eval_value = (int) 0;
        $process->eval_detail = '';
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->project_indicators_id = (int) $id;
        $process->projects_id = (int) $indicator->projects_id;

        // update status indicator
        $update = ProjectIndicator::find((int) $id);
        $update->status_indicator = (int) 2;
        $update->updated_at = getDateNow();
        $update->save();
        

        return $process->save();
    }


    public static function doUpdateStatus($status=1,$id=0)
    {
        $process = self::find((int) $id);

        $process->status_report = $status;
        $process->updated_at = getDateNow();
        return $process->save();
    }
}
