<?php

namespace App\Http\Controllers\Office\Budgets;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\DataSetting;
use App\Models\YearBudget;
use App\Models\BudgetsYearSet;
use App\Models\BudgetYear;
use App\Models\BudgetYearDetail;

use App\Models\BudgetsrDetail;
use App\Models\BudgetsrDetailYear;

use App\Imports\BudgetsImport;
use Maatwebsite\Excel\Facades\Excel;

class InstitutionController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');

        // display
        $budgets = DataSetting::find((int) $budgetsid);

        $Years = YearBudget::find((int) $yearid);

        $infos = BudgetYear::where('budgets_id', $budgetsid)->where('year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'DESC')->get();

        $arr = ['infos' , 'id' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

        // display
        $file = 'default.office.budgets.institution.index';
        
        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');

        $budget = DataSetting::where('group_type', "budgets")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $info = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();
        
        $budgets = DataSetting::find((int) $budgetsid);

        $Years = YearBudget::find((int) $yearid);

        $arr = ['info' , 'statementtype' , 'budget' , 'institution' , 'id' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

        // display
        $file = 'default.office.budgets.institution.add';

        return view($file, compact($arr))->render();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;
            

            if($id == 0){
                $result = BudgetYear::inserRow($data , true);

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
                }

            }else{

                $result = BudgetYear::updateRow($data, $id);

                if(isset($request->statementtype_id)){

                    $statementtype_id = $request->statementtype_id;
                    $budget_id = $request->budget_id;
                    $sum_total = $request->sum_total;
                    $numOil = count($statementtype_id);

                    $process = BudgetYearDetail::where('budget_year_id', $id)->delete();

                    for ($i=0; $i < $numOil; $i++) { 
                        $resultDetail = BudgetYearDetail::inserRow($statementtype_id[$i] , $budget_id[$i] , $sum_total[$i] , $result);
                    }

                }
                

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $id];
                }
            }
            

            
        }

        return response()->json($resp, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
        $institutionid = $request->input('id');
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');

        $info = BudgetYear::find((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $budgetTitles = DataSetting::where('group_type', "budgets")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetsrDetail::where('budgettype_id', $id)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $budgets = DataSetting::find((int) $budgetsid);

        $Years = YearBudget::find((int) $yearid);

        $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution' , 'budgetTitles' , 'institutionid' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

        // display
        $file = 'default.office.budgets.institution.edit';

        return view($file, compact($arr))->render();
    }


    /**
     * importform
     *
     * @return void
     */
    public function importform($id , Request $request)
    {
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');
        $institutionid = $request->input('id');

        $budgets = DataSetting::find((int) $budgetsid);

        $Years = YearBudget::find((int) $yearid);

        $info = BudgetYear::find((int) $id);

        # code...
        $arr = ['id' , 'budgetsid' , 'yearid' , 'institutionid' , 'budgets' , 'Years' , 'info'];
        $file = 'default.office.budgets.institution.imports';

        return view($file, compact($arr))->render();
    }

    /**
     * invimport
     *
     * @param  mixed $request
     * @return void
     */
    public function importsave(Request $request)
    {
        set_time_limit(0);

        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            // -- upload file --//
            $fileTmp = $request->file('file_upload');

            $id = $request->input('id');
            $budgetsid = $request->input('budgetsid');
            $yearid = $request->input('yearid');
            $institutionid = $request->input('institutionid');
            $importResult = Excel::import(new BudgetsImport($id , $budgetsid , $yearid , $institutionid), $fileTmp);

            if ($importResult) {

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }
        
        return response()->json($resp, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function views($id , $insid , Request $request)
    {
        $institutionid = $request->input('id');
        $budgetsid = $request->input('budgetsid');
        $yearid = $request->input('yearid');
        $institutionId = $request->input('institutionid');

        $yearsDetail = YearBudget::where('id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $budgets = DataSetting::find((int) $budgetsid);

        $year = BudgetYear::getdata();

        $budgets = BudgetYear::find((int) $insid);

        $info = BudgetsrDetail::find((int) $id);

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['budgets' , 'info' , 'institutionId' , 'budgetsid' , 'yearid' , 'id' , 'insid' , 'yearsDetail' , 'institution' , 'year'];

        // display
        $file = 'default.office.budgets.institution.views';

        return view($file, compact($arr))->render();
    }
    
}
