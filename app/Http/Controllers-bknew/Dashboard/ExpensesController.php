<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\DataSetting;
use App\Models\YearBudget;
use App\Models\BudgetsYearSet;
use App\Models\AssetEstimate;
use App\Models\AssetEstimateDetail;

use App\Models\AssetFund;
use App\Models\AssetFundDetail;

use App\Models\AssetIncomes;
use App\Models\AssetIncomesDetail;

use App\Models\AssetMonth;
use App\Models\AssetMonthDetail;

use DB;

/**
 * StrategyController
 */
class ExpensesController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function estimate(Request $request)
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $t = $request->input('t');
        $pr = $request->input('pr');
        
       
        $info = AssetEstimate::where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'desc')->first();

        $detail = AssetEstimateDetail::where('asset_id', $info->id)->where('sort_order', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('parent_id', "0")->where('group_type', "estimate")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'detail' , 'pr' , 't' , 'institution'];

        $file = 'default.dashboard.expenses.index-estimate';

        return view($file, compact($arr))->render();
    }


    /**
     * index
     *
     * @return void
     */
    public function strategyload(Request $request)
    {
        $pr = $request->input('pr');

        if($pr == 1){

            $chackDay = $request->input('chackDay');

            $resp = ['chackDay' => $chackDay]; 

        }elseif($pr == 2){

            $chackDay = $request->input('chackDay');

            $chackDayNum = $request->input('chackDayNum');

            $day = $chackDayNum.'-'.$chackDay.'-01';

            $resp = ['chackDay' => $day]; 

        }else{
            $chackDay = $request->input('chackDay');

            $resp = ['chackDay' => $chackDay]; 

        }

        return response()->json($resp, 200);
    }


    public function institution(Request $request)
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $t = $request->input('t');
        $pr = $request->input('pr');
        
       
        $info = AssetMonth::where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'desc')->first();

        $detail = AssetMonthDetail::where('asset_id', $info->id)->where('sort_order', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('parent_id', "0")->where('group_type', "asset")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'detail' , 'pr' , 't' , 'institution'];

        $file = 'default.dashboard.expenses.index-institution';

        return view($file, compact($arr))->render();
    }


    public function incomes(Request $request)
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $t = $request->input('t');
        $pr = $request->input('pr');
        
       
        $info = AssetFund::where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'asc')->get();

        $institution = DataSetting::where('parent_id', "0")->where('group_type', "income")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'pr' , 't' , 'institution'];

        $file = 'default.dashboard.expenses.index-incomes';

        return view($file, compact($arr))->render();
    }


    public function fund(Request $request)
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $t = $request->input('t');
        $pr = $request->input('pr');
        
       
        $info = AssetFund::where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'asc')->get();

        $institution = DataSetting::where('parent_id', "0")->where('group_type', "fund")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'pr' , 't' , 'institution'];

        $file = 'default.dashboard.expenses.index-fund';

        return view($file, compact($arr))->render();
    }
}
