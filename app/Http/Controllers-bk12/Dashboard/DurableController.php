<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DashboardInformation;
use App\Models\Durable;
use App\Models\DurableRepair;

class DurableController extends Base 
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $condition_delete = [
            'dashbard_type' => 'durable',
            'data_type' => 'widget_state'
        ];
        $state_result = DashboardInformation::where($condition_delete)->first();
        $state_info = json_decode($state_result->data_json);

        // Durable
        $items = Durable::getDataDashboard();

        # code...
        $data = ['state_info', 'items'];
        return view('default.dashboard.index-durable', compact($data))->render();
    }
    
    /**
     * generateReport
     *
     * @param  mixed $request
     * @return void
     */
    public function generateReport(Request $request)
    {
        $data_type = $request->input('data_type');//data_state
        if ($data_type == 'data_state') {
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
            $durables = Durable::where($conditions)->get();

            $totals = count($durables);
            $in_stock = 0;
            $in_borrow = 0;
            $in_distribute = 0;

            $array = [];
            if ($durables) {
                foreach ($durables as $durable) {
                    $in_stock += ($durable->durable_status == 0) ? 1 : 0;
                    $in_borrow += ($durable->durable_status == 1) ? 1 : 0;
                    $in_distribute += ($durable->durable_status == 2) ? 1 : 0;
                }
            }
            // repair
            $repairs = DurableRepair::where($conditions)->whereIn('is_approved', [0, 1])->get();
            $in_repairs = count($repairs);

            $array = [
                'totals' => number_format($totals),
                'in_stock' => number_format($in_stock),
                'in_borrow' => number_format($in_borrow),
                'in_distribute' => number_format($in_distribute),
                'in_repairs' => number_format($in_repairs)
            ];

            $data = [
                'dashbard_type' => 'durable',
                'data_type' => 'widget_state',
                'data_json' => json_encode($array),
                'created_at' => getDateNow(),
                'updated_at' => getDateNow(),
            ];
            // delete
            $condition_delete = [
                'dashbard_type' => 'durable',
                'data_type' => 'widget_state'
            ];
            DashboardInformation::where($condition_delete)->delete();
            // insert array
            $result = DashboardInformation::insertArray($data);
        }

        
    }
}
