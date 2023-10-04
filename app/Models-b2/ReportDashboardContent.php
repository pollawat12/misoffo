<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDashboardContent extends Model
{
    use HasFactory;

    protected $table = 'report_dashboard_contents';
    
    public $timestamps = false;

    
    /**
     * insertDataJson
     *
     * @param  mixed $data
     * @param  mixed $reportId
     * @param  mixed $itemId
     * @return void
     */
    public static function insertDataJson($data=[], $reportId=0, $itemId=0, $divTarget='')
    {
        $nRows = self::where(['report_dashboards_id' => (int) $reportId, 'item_id' => (int) $itemId])->count();

        if ($nRows > 0) {
            $process = self::where(['report_dashboards_id' => (int) $reportId, 'item_id' => (int) $itemId])->delete();
        }

        $process = new self();
        $process->data_value = json_encode($data);
        $process->data_description = '';
        $process->div_target_id = trim($divTarget);
        $process->item_id = (int) $itemId;
        $process->report_dashboards_id = (int) $reportId;

        // insert database
        return $process->save();
    }
}
