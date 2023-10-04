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
    public function index()
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


        //code ดึงข้อมูล charts



        $sort_order = '1.';
        $parent_id = '68';

        $office_1_Hr10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_10');
        $office_1_Hr11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_11');
        $office_1_Hr12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_12');
        $office_1_Hr1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_1');
        $office_1_Hr2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_2');
        $office_1_Hr3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_3');
        $office_1_Hr4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_4');
        $office_1_Hr5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_5');
        $office_1_Hr6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_6');
        $office_1_Hr7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_7');
        $office_1_Hr8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_8');
        $office_1_Hr9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order.'%')->where('parent_id', 'like', $parent_id.'%')->sum('month_9');
       



        $sort_order_op1 = '2.1.1.';
        $parent_id_op1 = '69';

        $sort_order_op2 = '2.3.';
        $parent_id_op2 = '700';

        $sort_order_op3 = '2.3.7';
        $parent_id_op3 = '707';

        $sort_order_op4 = '2.4';
        $parent_id_op4 = '75';

        $sort_order_op5 = '2.5';
        $parent_id_op5 = '76';


        $office_1_op10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                            ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_10');


        $office_1_op11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                            ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_11');
    



        $office_1_op12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                           ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_12');


        $office_1_op1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                            ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_1');
        
        $office_1_op2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                           ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_2');                           


        $office_1_op3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                            ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_3');


        $office_1_op4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                            ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_4');


        $office_1_op5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                          ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_5');  


        $office_1_op6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                           ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_6');                             

        $office_1_op7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                           ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_7');

        $office_1_op8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                          ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_8');


        $office_1_op9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_order_op1.'%')->where('parent_id', 'like', $parent_id_op1.'%') //2.1.1.1
                                           ->orwhere('sort_order' ,'2.2.1')->where('parent_id', 698) //2.2.1
                                            ->orwhere('sort_order', 'like', $sort_order_op2.'%')->where('parent_id', 'like', $parent_id_op2.'%')  //2.3
                                            ->orwhere('sort_order', 'like', $sort_order_op3.'%')->where('parent_id', 'like', $parent_id_op3.'%')  //2.3.7
                                            ->orwhere('sort_order', 'like', $sort_order_op4.'%')->where('parent_id', 'like', $parent_id_op4.'%')  //2.4
                                            ->orwhere('sort_order', 'like', $sort_order_op5.'%')->where('parent_id', 'like', $parent_id_op5.'%')  //2.5.
                                            ->sum('month_9');



        $office_1_invest10 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_10');
        $office_1_invest11 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_11');
        $office_1_invest12 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_12');
        $office_1_invest1 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_1');
        $office_1_invest2 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_2');
        $office_1_invest3 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_3');
        $office_1_invest4 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_4');
        $office_1_invest5 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_5');
        $office_1_invest6 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_6');
        $office_1_invest7 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_7');
        $office_1_invest8 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_8');
        $office_1_invest9 = BudgetsrDetailYear::where('sort_order', '3.1.1')->where('parent_id', 772)->sum('month_9');


        $office_1_other10 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_10');
        $office_1_other11 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_11');
        $office_1_other12 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_12');
        $office_1_other1 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_1');
        $office_1_other2 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_2');
        $office_1_other3 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_3');
        $office_1_other4 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_4');
        $office_1_other5 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_5');
        $office_1_other6 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_6');
        $office_1_other7 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_7');
        $office_1_other8 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_8');
        $office_1_other9 = BudgetsrDetailYear::where('sort_order', '4.1')->where('parent_id', 774)->sum('month_9');
        

        // code ดึงข้อมูลงบบุคลากร
        $office_2_Hr10 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_10');
        $office_2_Hr11 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_11');
        $office_2_Hr12 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_12');
        $office_2_Hr1 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_1');
        $office_2_Hr2 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_2');
        $office_2_Hr3 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_3');
        $office_2_Hr4 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_4');
        $office_2_Hr5 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_5');
        $office_2_Hr6 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_6');
        $office_2_Hr7 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_7');
        $office_2_Hr8 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_8');
        $office_2_Hr9 = BudgetsrDetailYear::where('sort_order', '1.1.1')->where('parent_id', 544)->sum('month_9');
        // code ดึงข้อมูลงบบุคลากร


        
        // code ดึงข้อมูลงบดำเนินงาน
        $office_2_op10 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_10');
        $office_2_op11 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_11');
        $office_2_op12 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_12');
        $office_2_op1 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_1');
        $office_2_op2 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_2');
        $office_2_op3 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_3');
        $office_2_op4 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_4');
        $office_2_op5 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_5');
        $office_2_op6 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_6');
        $office_2_op7 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_7');
        $office_2_op8 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_8');
        $office_2_op9 = BudgetsrDetailYear::where('parent_id',547)->orWhere('parent_id',550)->orWhere('parent_id',556)->sum('month_9');
        // code ดึงข้อมูลงบดำเนินงาน
       


        $sort_off3 = '1.1.';
        $parent_off3 = '521';

        $office_3_Hr10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_10');
        $office_3_Hr11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_11');
        $office_3_Hr12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_12');
        $office_3_Hr1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_1');
        $office_3_Hr2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_2');
        $office_3_Hr3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_3');
        $office_3_Hr4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_4');
        $office_3_Hr5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_5');
        $office_3_Hr6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_6');
        $office_3_Hr7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_7');
        $office_3_Hr8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_8');
        $office_3_Hr9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off3.'%')->where('parent_id', 'like', $parent_off3.'%')->sum('month_9');



        $sort_off32 = '2.';
        $parent_off32 = '52';

        $sort_off33 = '3.1';




        $office_3_op10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_10');
        $office_3_op11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_11');
        $office_3_op12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_12');
        $office_3_op1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_1');
        $office_3_op2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_2');
        $office_3_op3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_3');
        $office_3_op4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_4');
        $office_3_op5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_5');
        $office_3_op6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_6');
        $office_3_op7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_7');
        $office_3_op8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_8');
        $office_3_op9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off32.'%')->where('parent_id', 'like', $parent_off32.'%')
                                            ->orwhere('sort_order' ,'2.3.1')->where('parent_id', 534)
                                            ->orwhere('sort_order' ,'2.4.1')->where('parent_id', 536)
                                            ->sum('month_9');




        $office_3_invest10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_10');
        $office_3_invest11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_11');
        $office_3_invest12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_12');
        $office_3_invest1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_1');
        $office_3_invest2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_2');
        $office_3_invest3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_3');
        $office_3_invest4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_4');
        $office_3_invest5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_5');
        $office_3_invest6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_6');
        $office_3_invest7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_7');
        $office_3_invest8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_8');
        $office_3_invest9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off33.'%')->where('parent_id', 539)->sum('month_9');


        $sort_off41 = '1.1.';


        $sort_off42 = '2.';
        $parent_off42 = '51';

        $office_4_Hr10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_10');
        $office_4_Hr11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_11');
        $office_4_Hr12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_12');
        $office_4_Hr1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_1');
        $office_4_Hr2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_2');
        $office_4_Hr3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_3');
        $office_4_Hr4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_4');
        $office_4_Hr5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_5');
        $office_4_Hr6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_6');
        $office_4_Hr7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_7');
        $office_4_Hr8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_8');
        $office_4_Hr9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off41.'%')->where('parent_id', 510)->sum('month_9');

        $office_4_op10 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_10');
        $office_4_op11 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_11');
        $office_4_op12 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_12');
        $office_4_op1 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_1');
        $office_4_op2 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_2');
        $office_4_op3 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_3');
        $office_4_op4 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_4');
        $office_4_op5 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_5');
        $office_4_op6 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_6');
        $office_4_op7 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_7');
        $office_4_op8 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_8');
        $office_4_op9 = BudgetsrDetailYear::where('sort_order', 'like', $sort_off42.'%')->where('parent_id', 'like', $parent_off42.'%')->sum('month_9');



        $office_4_op_costs10 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 10)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
        
        $office_4_op_costs11 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 11)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');

        $office_4_op_costs12 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 12)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
        
        $office_4_op_costs1 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 1)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
                                
        $office_4_op_costs2 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 2)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
        
        $office_4_op_costs3 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 3)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
                        
        $office_4_op_costs4 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 4)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
        $office_4_op_costs5 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 5)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');

        $office_4_op_costs6 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 6)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');

        $office_4_op_costs7 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 7)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
                    
        $office_4_op_costs8 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 8)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');
                        
        $office_4_op_costs9 = BudgetsCosts::where('year_id', 7)->where('year_budget' , 9)
                                            ->where('institution' , 324)->where('budget_categroy' , 168)
                                            ->sum('expenses_amount');




        $total_hr10 = $office_1_Hr10 + $office_2_Hr10 + $office_3_Hr10 + $office_4_Hr10;
        $total_hr11 = $office_1_Hr11 + $office_2_Hr11 + $office_3_Hr11 + $office_4_Hr11;
        $total_hr12 = $office_1_Hr12 + $office_2_Hr12 + $office_3_Hr12 + $office_4_Hr12;
        $total_hr1 = $office_1_Hr1 + $office_2_Hr1 + $office_3_Hr1 + $office_4_Hr1;
        $total_hr2 = $office_1_Hr2 + $office_2_Hr2 + $office_3_Hr2 + $office_4_Hr2;
        $total_hr3 = $office_1_Hr3 + $office_2_Hr3 + $office_3_Hr3 + $office_4_Hr3;
        $total_hr4 = $office_1_Hr4 + $office_2_Hr4 + $office_3_Hr4 + $office_4_Hr4;
        $total_hr5 = $office_1_Hr5 + $office_2_Hr5 + $office_3_Hr5 + $office_4_Hr5;
        $total_hr6 = $office_1_Hr6 + $office_2_Hr6 + $office_3_Hr6 + $office_4_Hr6;
        $total_hr7 = $office_1_Hr7 + $office_2_Hr7 + $office_3_Hr7 + $office_4_Hr7;
        $total_hr8 = $office_1_Hr8 + $office_2_Hr8 + $office_3_Hr8 + $office_4_Hr8;
        $total_hr9 = $office_1_Hr9 + $office_2_Hr9 + $office_3_Hr9 + $office_4_Hr9;





        $total_op10 = $office_1_op10 + $office_2_op10 + $office_3_op10 + $office_4_op10;
        $total_op11 = $office_1_op11 + $office_2_op11 + $office_3_op11 + $office_4_op11;
        $total_op12 = $office_1_op12 + $office_2_op12 + $office_3_op12 + $office_4_op12;
        $total_op1 = $office_1_op1 + $office_2_op1 + $office_3_op1 + $office_4_op1;
        $total_op2 = $office_1_op2 + $office_2_op2 + $office_3_op2 + $office_4_op2;
        $total_op3 = $office_1_op3 + $office_2_op3 + $office_3_op3 + $office_4_op3;
        $total_op4 = $office_1_op4 + $office_2_op4 + $office_3_op4 + $office_4_op4;
        $total_op5 = $office_1_op5 + $office_2_op5 + $office_3_op5 + $office_4_op5;
        $total_op6 = $office_1_op6 + $office_2_op6 + $office_3_op6 + $office_4_op6;
        $total_op7 = $office_1_op7 + $office_2_op7 + $office_3_op7 + $office_4_op7;
        $total_op8 = $office_1_op8 + $office_2_op8 + $office_3_op8 + $office_4_op8;
        $total_op9 = $office_1_op9 + $office_2_op9 + $office_3_op9 + $office_4_op9;





        $total_in10 = $office_1_invest10 + $office_3_invest10;
        $total_in11 = $office_1_invest11 + $office_3_invest11;
        $total_in12 = $office_1_invest12 + $office_3_invest12;
        $total_in1 =  $office_1_invest1 + $office_3_invest1;
        $total_in2 =  $office_1_invest2 + $office_3_invest2;
        $total_in3 =  $office_1_invest3 + $office_3_invest3;
        $total_in4 =  $office_1_invest4 + $office_3_invest4;
        $total_in5 =  $office_1_invest5 + $office_3_invest5;
        $total_in6 =  $office_1_invest6 + $office_3_invest6;
        $total_in7 =  $office_1_invest7 + $office_3_invest7;
        $total_in8 =  $office_1_invest8 + $office_3_invest8;
        $total_in9 =  $office_1_invest9 + $office_3_invest9;




        $arr_office1_hr = ['office_1_Hr10', 'office_1_Hr11', 'office_1_Hr12', 'office_1_Hr1', 'office_1_Hr2', 'office_1_Hr3', 'office_1_Hr4',
                            'office_1_Hr5', 'office_1_Hr6', 'office_1_Hr7', 'office_1_Hr8', 'office_1_Hr9'];

        $arr_office1_op = ['office_1_op10', 'office_1_op11', 'office_1_op12', 'office_1_op1', 'office_1_op2', 'office_1_op3', 'office_1_op4',
                           'office_1_op5', 'office_1_op6', 'office_1_op7', 'office_1_op8', 'office_1_op9' ];

        $arr_office1_in = ['office_1_invest10','office_1_invest11','office_1_invest12','office_1_invest1','office_1_invest2','office_1_invest3'
                            ,'office_1_invest4','office_1_invest5','office_1_invest6','office_1_invest7','office_1_invest8','office_1_invest9'
                            ];
        $arr_office1_other = ['office_1_other10','office_1_other11','office_1_other12','office_1_other1','office_1_other2','office_1_other3'
                                ,'office_1_other4','office_1_other5','office_1_other6','office_1_other7','office_1_other8','office_1_other9'
                                ];


        
        $arr_office2_hr = ['office_2_Hr10','office_2_Hr11','office_2_Hr12','office_2_Hr1','office_2_Hr2','office_2_Hr3','office_2_Hr4',
                            'office_2_Hr5','office_2_Hr6','office_2_Hr7','office_2_Hr8','office_2_Hr9'];

        $arr_office2_op = ['office_2_op10','office_2_op11','office_2_op12','office_2_op1','office_2_op2','office_2_op3','office_2_op4',
                            'office_2_op5','office_2_op6','office_2_op7','office_2_op8','office_2_op9'];



        $arr_office3_hr =['office_3_Hr10','office_3_Hr11','office_3_Hr12','office_3_Hr1','office_3_Hr2','office_3_Hr3','office_3_Hr4'
                            ,'office_3_Hr5' ,'office_3_Hr6','office_3_Hr7','office_3_Hr8','office_3_Hr9'];

        $arr_office3_op = ['office_3_op10','office_3_op11','office_3_op12','office_3_op1','office_3_op2','office_3_op3','office_3_op4',
                            'office_3_op5','office_3_op6','office_3_op7','office_3_op8','office_3_op9'];
        
        $arr_office3_in = ['office_3_invest10','office_3_invest11','office_3_invest12','office_3_invest1','office_3_invest2','office_3_invest3'
                            ,'office_3_invest4','office_3_invest5','office_3_invest6','office_3_invest7','office_3_invest8','office_3_invest9'
                            ];



        $arr_office4_hr =['office_4_Hr10','office_4_Hr11','office_4_Hr12','office_4_Hr1','office_4_Hr2','office_4_Hr3','office_4_Hr4'
                            ,'office_4_Hr5' ,'office_4_Hr6','office_4_Hr7','office_4_Hr8','office_4_Hr9'];

        $arr_office4_op = ['office_4_op10','office_4_op11','office_4_op12','office_4_op1','office_4_op2','office_4_op3','office_4_op4',
                            'office_4_op5','office_4_op6','office_4_op7','office_4_op8','office_4_op9'];

        

        $arr_total_hr  =  ['total_hr10','total_hr11','total_hr12','total_hr1','total_hr2','total_hr3','total_hr4','total_hr5','total_hr6'
                            ,'total_hr7','total_hr8','total_hr9'];
        
        $arr_total_op  =  ['total_op10','total_op11','total_op12','total_op1','total_op2','total_op3','total_op4','total_op5','total_op6'
                            ,'total_op7','total_op8','total_op9'];
        
        $arr_total_in  =  ['total_in10','total_in11','total_in12','total_in1','total_in2','total_in3','total_in4','total_in5','total_in6'
                            ,'total_in7','total_in8','total_in9'];





        $arr_office4_op_costs = ['office_4_op_costs10','office_4_op_costs11','office_4_op_costs12','office_4_op_costs1','office_4_op_costs2'
                                ,'office_4_op_costs3','office_4_op_costs4','office_4_op_costs5','office_4_op_costs6','office_4_op_costs7'
                                ,'office_4_op_costs8','office_4_op_costs9'
                                    ];


        
        



        return view('default.dashboard.index-budget', compact($data, $arr_office1_hr, $arr_office1_op, $arr_office1_in, 
                                                            $arr_office1_other, $arr_office2_hr, $arr_office2_op, $arr_office3_hr ,$arr_office3_op,
                                                            $arr_office3_in , $arr_office4_hr , $arr_office4_op , $arr_total_hr ,$arr_total_op , $arr_total_in,
                                                            $arr_office4_op_costs
                                                            ))->render();
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
