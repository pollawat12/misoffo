<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSummaryReport extends Model
{
    use HasFactory;

    protected $table = 'project_summary_report';
    
    public $timestamps = false;

    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $actionId
     * @return void
     */
    public static function insertRow($data, $actionId=0)
    {
        $process = new self;
        $process->summary = $data['summary'];
        $process->description = $data['description'];
        $process->summary_work = $data['summary_work'];
        $process->summary_percent = $data['summary_percent'];
        $process->summary_money = $data['summary_money'];
        $process->status_report = (int) 2;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->projects_id = $data['projects_id'];
        $process->project_report_id = $data['project_report_id'];
        $process->save();

        return $process->id;
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->summary = $data['summary'];
        $process->description = $data['description'];
        $process->summary_work = $data['summary_work'];
        $process->summary_percent = $data['summary_percent'];
        $process->summary_money = $data['summary_money'];
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
