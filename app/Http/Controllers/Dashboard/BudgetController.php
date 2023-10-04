<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DashboardInformation;
use App\Models\Budget; // budget_costs
use App\Models\Incomes;
use App\Models\IncomesDetail;
use App\Models\BudgetYear;
use App\Models\BudgetYearDetail;
use App\Models\YearBudget;
use App\Models\BudgetsrDetail;
use App\Models\DataSetting;
use App\Models\BudgetDetailYear;
use App\Models\BudgetsCosts;
use App\Models\BudgetsrDetailYear;
use Illuminate\Support\Facades\DB;

class BudgetController extends Base 
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
    public function index(Request $request)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'is_default' => (int) 1
        ];
        $last_year_info = YearBudget::where($conditions)->orderBy('in_year','desc')->first();

        $condition_delete = [
            'dashbard_type' => 'account',
            'data_type' => 'widget_state'
        ];
        $state_result = DashboardInformation::where($condition_delete)->first();
        $state_info = json_decode($state_result->data_json);

        $condition_delete = [
            'dashbard_type' => 'account',
            'data_type' => 'income_state'
        ];
        $state_result = DashboardInformation::where($condition_delete)->first();
        $income_info = json_decode($state_result->data_json);
        
        # code...
        $data = ['state_info', 'income_info'];

        $id = 71;

        $insid = $id;

        $institutionid = $request->input('id');
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');
        $institutionId = $request->input('institutionid');

        $yearsDetail = YearBudget::where('id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $budgets = DataSetting::find((int) $budgetsid);

        $year = BudgetYear::getdata();

        $budgets = BudgetYear::find((int) $id);

        $info = BudgetYear::find((int) $id);

        $detail = BudgetsrDetail::where('budgettype_id', 10)->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $budgetTitles = DataSetting::where('group_type', "budgets")->where('is_deleted', '0')->where('is_active','1')->get();




        // $budget_hr = DB::table('budgets_detail')
        //             ->leftjoin('budgets_detail_year', 'budgets_detail.id', '=', 'budgets_detail_year.budgets_detail_id')
        //             ->where('budgets_detail.budgettype_id',  10)
        //             ->where('budgets_detail_year.sort_order',  1)
        //             ->get();


        $budget_hr = DB::table('budgets_detail_year')
                    ->leftjoin('budgets_detail', 'budgets_detail_year.budgets_detail_id', '=', 'budgets_detail.id')
                    ->where('budgets_detail.budgettype_id',  10)
                    ->where('budgets_detail_year.sort_order',  1)
                    ->get();

        $budget_op = DB::table('budgets_detail_year')
                    ->leftjoin('budgets_detail', 'budgets_detail_year.budgets_detail_id', '=', 'budgets_detail.id')
                    ->where('budgets_detail.budgettype_id',  10)
                    ->where('budgets_detail_year.sort_order',  2)
                    ->get();
        


        $arr = ['budgets' , 'info' , 'institutionId' , 'budgetsid' , 'detail' , 'yearid' , 'id' , 'insid' , 'yearsDetail' , 'institution' , 'year', 'budgetTitles','budget_hr','budget_op'];

        // display
      
        return view('default.dashboard.index-budget', compact($arr ))->render();
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
            $this_year = date('Y');
            $start_year = $this_year - 1;

            $start_budget_year = implode('', [$start_year,'10','01']);
            $end_budget_year = implode('', [$this_year,'09','30']);

            $incomes = Incomes::getIncomeInYears($start_budget_year, $end_budget_year);

            $income_totals = 0;
            $expense_totals = 0;
            $income_month = 0;

            $array = [];
            if ($incomes) {
                foreach ($incomes as $income) {
                    $income_conditions = [
                        'is_deleted' => (int) 0,
                        'is_active' => (int) 1,
                        'incomes_id' => (int) $income->id
                    ];
                    $details = IncomesDetail::where($income_conditions)->get();

                    if ($details) {
                        foreach ($details as $detail) {
                            $income_totals += $detail->incomes_total;
                            if ($income->incomes_day == date('Y-m-d')) {
                                $income_month += $detail->incomes_total;
                            }
                        }
                    }
                }
            }

            $array = [
                'income_totals' => getNumberCurrency($income_totals),
                'expense_totals' => getNumberCurrency(0),
                'income_month' => getNumberCurrency($income_month)
            ];

            $data = [
                'dashbard_type' => 'account',
                'data_type' => 'widget_state',
                'data_json' => json_encode($array),
                'created_at' => getDateNow(),
                'updated_at' => getDateNow(),
            ];
            // delete
            $condition_delete = [
                'dashbard_type' => 'account',
                'data_type' => 'widget_state'
            ];
            DashboardInformation::where($condition_delete)->delete();
            // insert array
            $result = DashboardInformation::insertArray($data);
        }


        if ($data_type == 'income_data') {

            $months = getMonthInBudgetYear();
            $this_year = date('Y');
            $start_year = $this_year - 1;

            $range_s_month = ['10', '11', '12'];
            $income_conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
            $array_incomes = [];
            foreach ($months as $code => $month) {
                $search_date = $this_year . '-' . $code;
                // $label_date = $month;
                if (in_array($code, $range_s_month)) {
                    $search_date = $start_year . '-' . $code;
                } 
                
                $incomes = Incomes::where($income_conditions)->where('incomes_day', 'like', '%'.$search_date.'%')->get();
                $income_totals = 0;
                if ($incomes) {
                    foreach ($incomes as $income) {
                        $income_conditions = [
                            'is_deleted' => (int) 0,
                            'is_active' => (int) 1,
                            'incomes_id' => (int) $income->id
                        ];
                        $details = IncomesDetail::where($income_conditions)->get();

                        if ($details) {
                            foreach ($details as $detail) {
                                $income_totals += $detail->incomes_total;
                            }
                        }
                    }
                }
                $array_incomes[] = [
                    'label' => $month,
                    'amount' => ($income_totals/1000000) // หน่วยนับ 1 ล้านบาท
                ];
            }// end foreach
            
            // delete
            $condition_delete = [
                'dashbard_type' => 'account',
                'data_type' => 'income_state'
            ];
            DashboardInformation::where($condition_delete)->delete();
            // insert array
            $data = [
                'dashbard_type' => 'account',
                'data_type' => 'income_state',
                'data_json' => json_encode($array_incomes),
                'created_at' => getDateNow(),
                'updated_at' => getDateNow(),
            ];
            $result = DashboardInformation::insertArray($data);
        }
    }
}
