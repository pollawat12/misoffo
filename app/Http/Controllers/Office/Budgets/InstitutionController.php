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

use App\Models\BudgetsTemplate;

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

        if($budgetsid == 9999){

            $infos = BudgetYear::where('budgets_id', $budgetsid)->where('year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'DESC')->get();

            $arr = ['infos' , 'id' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

            // display
            $file = 'default.office.budgets.institution.index-9999';

        }else{

            $infos = BudgetYear::where('budgets_id', $budgetsid)->where('year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'DESC')->get();

            $arr = ['infos' , 'id' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

            // display
            $file = 'default.office.budgets.institution.index';

        }

        
        
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

        if($budgetsid == 9999){

            $Years = YearBudget::find((int) $yearid);

            $arr = ['info' , 'statementtype' , 'budget' , 'institution' , 'id' , 'budgetsid' , 'yearid' , 'Years'];

            // display
            $file = 'default.office.budgets.institution.add-9999';


        }else{

            $budgets = DataSetting::find((int) $budgetsid);

            $Years = YearBudget::find((int) $yearid);

            $arr = ['info' , 'statementtype' , 'budget' , 'institution' , 'id' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

            // display
            $file = 'default.office.budgets.institution.add';

        }
        
        

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

                // if(isset($request->statementtype_id)){

                //     $statementtype_id = $request->statementtype_id;
                //     $budget_id = $request->budget_id;
                //     $sum_total = $request->sum_total;
                //     $numOil = count($statementtype_id);

                //     $process = BudgetYearDetail::where('budget_year_id', $id)->delete();

                //     for ($i=0; $i < $numOil; $i++) { 
                //         $resultDetail = BudgetYearDetail::inserRow($statementtype_id[$i] , $budget_id[$i] , $sum_total[$i] , $result);
                //     }

                // }
                

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $id];
                }
            }
            

            
        }

        return response()->json($resp, 200);
    }

    public function yearsubsave(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->budget_year_id;
            $statementtype_id = $request->statementtype_id;
            $sum_total_statement = $request->sum_total_statement;

            $budgetcategory = $request->budgetcategory;
            $budgetcategoryid = $request->budgetcategoryid;
            $sum_total_budgetcategory = $request->sum_total_budgetcategory;

            $budgetcategoryDetail = $request->budgetcategoryDetail;
            $sumtotalbudgetcategory = $request->sum_total_budgetcategoryDetail;
            

            $budgets = BudgetsTemplate::where('parent_id', $statementtype_id)->where('is_deleted', '0')->where('is_active','1')->get();

            foreach($budgets as $budget => $valuebudget){ 

                $result1 = BudgetsrDetail::inserRow($budgetcategory[$valuebudget->id] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , '0' , '0' , $sum_total_budgetcategory[$valuebudget->id] , $id , true);

                $costCategroys = BudgetsTemplate::where('parent_id', $valuebudget->id)->where('is_deleted', '0')->where('is_active','1')->get();
                
                if(count($costCategroys) == 0){  

                    $CategoryDetail = $budgetcategoryDetail[$valuebudget->id];
                    $sumBudgetcategory = $sumtotalbudgetcategory[$valuebudget->id];

                    $numCategoryDetail = count($CategoryDetail);
                    for ($i=0; $i < $numCategoryDetail; $i++) { 
                        
                        $result2 = BudgetYearDetail::inserRow($CategoryDetail[$i] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , '0' , '0' , $sumBudgetcategory[$i] , $id , $result1 , true);
                    }
                }else{

                    $budgettype = $request->budgettype;
                    $budgettypeid = $request->budgettypeid;
                    $sum_total_budgettype = $request->sum_total_budgettype;

                    $budgettypeDetail = $request->budgettypeDetail;
                    $sumtotalbudgettype = $request->sum_total_budgettypeDetail;

                    foreach($costCategroys as $costCategroys => $valcostCategroys){

                        $result3 = BudgetYearDetail::inserRow($budgettype[$valcostCategroys->id] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , $budgettypeid[$valcostCategroys->id] , '0' , $sum_total_budgettype[$valcostCategroys->id] , $id , $result1 , true);

                        $costbudgettype = DataSetting::where('group_type', "budgettype")->where('parent_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();

                        if(count($costbudgettype) == 0){ 

                            $TypeDetail = $budgettypeDetail[$valcostCategroys->id];
                            $sumBudgettype = $sumtotalbudgettype[$valcostCategroys->id];

                            $numCategorytype = count($TypeDetail);
                            for ($j=0; $j < $numCategorytype; $j++) { 
                                
                                $result4 = BudgetYearDetail::inserRow($TypeDetail[$j] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , $budgettypeid[$valcostCategroys->id] , '0' , $sumBudgettype[$j] , $id , $result3 , true);
                            }

                        }else{

                            $budgettype1 = $request->budgettype1;
                            $budgettypeid1 = $request->budgettypeid1;
                            $sum_total_budgettype1 = $request->sum_total_budgettype1;

                            $budgettypeDetail1 = $request->budgettypeDetail1;
                            $sumtotalbudgettype1 = $request->sum_total_budgettypeDetail1;

                            foreach($costbudgettype as $costbudgettype => $valcostbudgettype){

                                $result5 = BudgetYearDetail::inserRow($budgettype1[$valcostbudgettype->id] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , $budgettypeid[$valcostCategroys->id] , $budgettypeid1[$valcostbudgettype->id] , $sum_total_budgettype1[$valcostbudgettype->id] , $id , $result3 , true);

                                $TypeDetail1 = $budgettypeDetail1[$valcostbudgettype->id];
                                $sumBudgettype1 = $sumtotalbudgettype1[$valcostbudgettype->id];

                                $numCategorytype1 = count($TypeDetail1);
                                for ($z=0; $z < $numCategorytype1; $z++) { 

                                    $result6 = BudgetYearDetail::inserRow($TypeDetail1[$z] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , $budgettypeid[$valcostCategroys->id] , $budgettypeid1[$valcostbudgettype->id] , $sumBudgettype1[$z] , $id , $result5 , true);
                                }
                            }

                        }

                    }

                }
            }

            if ($result1) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $id];
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

        $detail = BudgetsrDetail::where('budgettype_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        if($budgetsid == 9999){

            $Years = YearBudget::find((int) $yearid);

            $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution' , 'budgetTitles' , 'institutionid' , 'budgetsid' , 'yearid' , 'Years'];

            $file = 'default.office.budgets.institution.edit-9999';
        }else{

            $budgets = DataSetting::find((int) $budgetsid);

            $Years = YearBudget::find((int) $yearid);
    
            $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution' , 'budgetTitles' , 'institutionid' , 'budgetsid' , 'yearid' , 'budgets' , 'Years'];

            $file = 'default.office.budgets.institution.edit';

        }

        // display
        

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;    

            $result = BudgetYear::updateRow($data, $id);

            if ($result) {

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
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

        $info = BudgetYear::find((int) $insid);

        $detail = BudgetsrDetail::where('id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['budgets' , 'info' , 'institutionId' , 'budgetsid' , 'yearid' , 'id' , 'insid' , 'detail' , 'yearsDetail' , 'institution' , 'year'];

        // display
        $file = 'default.office.budgets.institution.views';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewsall($id , Request $request)
    {
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

        $detail = BudgetsrDetail::where('budgettype_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['budgets' , 'info' , 'institutionId' , 'budgetsid' , 'detail' , 'yearid' , 'id' , 'insid' , 'yearsDetail' , 'institution' , 'year'];

        // display
        $file = 'default.office.budgets.institution.viewsall';

        return view($file, compact($arr))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = BudgetYear::deleteRow($id);

        return redirect()->back();
    }
    
}
