<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCommentIndicator extends Model
{
    use HasFactory;

    protected $table = 'report_comment_indicators';
    
    public $timestamps = false;

    public static function insertRow($data,$parentId=0,$typeId=1,$id=0)
    {
        $reportInfo = \App\ProjectIndicatorReport::find((int) $id);

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
        $process->project_indicator_reports_id = (int) $id;
        $process->project_indicators_id = (int) $reportInfo->indicators_id;
        
        return $process->save();
    }
}
