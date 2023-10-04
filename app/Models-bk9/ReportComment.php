<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    use HasFactory;

    protected $table = 'report_comments';
    
    public $timestamps = false;

    
    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $parentId
     * @param  mixed $id
     * @return void
     */
    public static function insertRow($data,$parentId=0,$typeId=1,$id=0)
    {
        $report = \App\ProjectActionReport::find((int) $id);

        $process = new self;

        $process->parent_id = (int) $parentId;
        $process->description = $data['description'];
        $process->filepath = '';
        $process->comment_type = $typeId; // 1=คำแนะนำ, 2=คำถาม/ตอบกลับ
        $process->is_read = (int) 0;
        $process->is_deleted = 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->project_action_reports_id = (int) $id;
        $process->project_actions_id = (int) $report->project_actions_id;
        
        return $process->save();
    }
}
