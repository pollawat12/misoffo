<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportDashboardContent;

class ReportDashboard extends Model
{
    use HasFactory;

    protected $table = 'report_dashboards';
    
    public $timestamps = false;

    

    public static function getReportToDashboard($cateId=1)
    {
        // $searchDate = date('Y-m', strtotime($reportDate));

        $conditions = [
            'categories_id' => (int) $cateId,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $reportInfo = self::where($conditions)->orderBy('updated_at', 'desc')->first();
        $reports = [];

        if (!empty($reportInfo) && $reportInfo) {
            $dataResults = ReportDashboardContent::where('report_dashboards_id', (int) $reportInfo->id)->get();

            if ($dataResults && !empty($dataResults)) {
                foreach ($dataResults as $row) {
                   // $reports[][] = $row->
                    $reports[$row->item_id] = [
                        'div_target_id' => $row->div_target_id,
                        'contents' => $row->data_value
                    ];
                }
            }
        }

        return $reports;
    }


        
    /**
     * createReportDashboard
     *
     * @param  mixed $cateInfo
     * @param  mixed $reportDate
     * @param  mixed $data
     * @return void
     */
    public static function createReportDashboard($cateInfo=[], $reportDate='', $data=[])
    {
        $subject = 'รายงานสรุปข้อมูลแยกเป็นรายจังหวัด';

        if (empty($reportDate)) { 
            $reportDate = getDateNow();
        }

        $searchDate = date('Y-m', strtotime($reportDate));
        $divTargetId = '';

        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'categories_id' => (int) $cateInfo['cate_id']
        ];
        $nRows = self::where($conditions)->where('report_date', 'like', '%'.$searchDate.'%')->count();

        if ($nRows == 0) {

            $divTargetId = $cateInfo['div_target'];

            $process = new self();

            $process->parent_id = (int) 0;
            $process->sort_order = (int) $cateInfo['item_id'];
            $process->subject = $subject;
            $process->note = $subject;
            $process->budget_year_no = 2563;
            $process->div_target_id = '';
            $process->categories_id = (int) $cateInfo['cate_id'];
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->report_date = $reportDate;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->save();

            $reportId = $process->id;
        } else {
            $info = $process = self::where($conditions)->where('report_date', 'like', '%'.$searchDate.'%')->first();
            $process->updated_at = getDateNow();
            $process->save();

            $reportId = $info->id;
        }
        
        ReportDashboardContent::insertDataJson($data, $reportId, $cateInfo['item_id'],$divTargetId);

    }
}
