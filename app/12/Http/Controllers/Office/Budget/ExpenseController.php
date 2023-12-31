<?php

namespace App\Http\Controllers\Office\Budget;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\Project;
use App\Models\YearBudget;
use App\Models\Budget;
use App\Models\BudgetYear;
use App\Models\BudgetYearDetail;
use App\Models\BudgetImport;
use App\Models\Incomes;
use App\Models\DataSetting;
use App\Models\PurchasesStatus;

class ExpenseController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $items = Budget::getDataAll($id , '0');

        $arr = ['project' , 'items' , 'id'];

        // display
        $file = 'default.office.budget.expense.index';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $projects = Project::getDataAll();

        $arr = ['projects'];

        // display
        $file = 'default.office.budget.expense.projectall';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectall()
    {
        $projects = Project::getDataAll();

        $arr = ['projects'];

        // display
        $file = 'default.office.budget.expense.all';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $detail = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['Project' , 'Year' , 'id' , 'detail'];

        // display
        $file = 'default.office.budget.expense.add';

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
            $data = $request->input;

            $result = Budget::inserRow($data , true);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $projectsId, Request $request)
    {
        $items = Budget::getDataDetail($id);

        $arr = ['items' , 'projectsId'];

        // display
        $file = 'default.office.budget.expense.show';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , $projectsId, Request $request)
    {
        $info = Budget::find((int) $id);

        $detail = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $items = Budget::getDataAll($projectsId , $id);

        $arr = ['id' , 'projectsId' , 'detail' , 'info' ,'Project' , 'Year' , 'items'];

        // display
        $file = 'default.office.budget.expense.edit';

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

            $result = Budget::updateRow($data, $id);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = Budget::deleteRow($id);

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buginfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        $uid = $request->input('id');
        $type = $request->input('type');

        if($uid != 0){

            $user = Budget::where('id',$uid)->get();
            foreach ($user as $row);

            $dataTmp = [
                'date_report' => ($row->date_report) ? getDateFormatToInput($row->date_report) : null,
                'page_number' => $row->page_number,
                'petition_number' => $row->petition_number,
                'cut_top_number' => $row->cut_top_number,
                'expense_item' => $row->expense_item,
                'budget_categroy' => $row->budget_categroy,
                'cost_type' => $row->cost_type,
                'cost_amount' => $row->cost_amount,
                'cost_sum' => $row->cost_sum,
                'institution' => $row->institution,
                'cost_categroy' => $row->cost_categroy,
                'status_approved' => $row->status_approved,
                'edit_id' => $row->id,
            ];

        }else{

            $dataTmp = [];     
        }

        $json = ['status' => false, 'info' => $dataTmp];

        return response()->json($json, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bugSave(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $action = $request->action;
            $data = $request->input1;

            if($id == 0){

                $result = Budget::inserRow($data , true);

            }else{

                $result = Budget::updateRow($data, $id);
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function yearlists()
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $institutionId = $info['institution_id'];

        $year = BudgetYear::getdata();

        $project = BudgetYear::getdata((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('institution_id', $institutionId)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchases = PurchasesStatus::getData((int) $id , (int) 1);

        $arr = ['project' , 'id' , 'year' , 'budget' , 'statementtype' , 'purchases' , 'detail' , 'institution' , 'institutionId' ];

        // display
        $file = 'default.office.budget.expense.budgetYearNew';

        return view($file, compact($arr))->render();
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function year($id , $institutionId)
    {
        $year = BudgetYear::getdata();

        $project = BudgetYear::getdata((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('institution_id', $institutionId)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchases = PurchasesStatus::getData((int) $id , (int) 1);

        $arr = ['project' , 'id' , 'year' , 'budget' , 'statementtype' , 'purchases' , 'detail' , 'institution' , 'institutionId'];

        // display
        $file = 'default.office.budget.expense.budgetYearNew';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function yearAdd()
    {
        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $info = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();

        $arr = ['info' , 'statementtype' , 'budget' , 'institution'];

        // display
        $file = 'default.office.budget.expense.budgetYearAdd';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function yearsave(Request $request)
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
                $statementtype_id = $request->statementtype_id;
                $budget_id = $request->budget_id;
                $sum_total = $request->sum_total;
                $numOil = count($statementtype_id);

                $process = BudgetYearDetail::where('budget_year_id', $id)->delete();

                $result = BudgetYear::updateRow($data, $id);

                for ($i=0; $i < $numOil; $i++) { 
                    $resultDetail = BudgetYearDetail::inserRow($statementtype_id[$i] , $budget_id[$i] , $sum_total[$i] , $result);
                }

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
            

            $result = BudgetYearDetail::inserRow('' , $statementtype_id , '0' , '0' , '0' , $sum_total_statement , $id , '0' , true);

            $budgets = DataSetting::where('group_type', "budget")->where('data_value', $statementtype_id)->where('is_deleted', '0')->where('is_active','1')->get();

            foreach($budgets as $budget => $valuebudget){ 

                $result1 = BudgetYearDetail::inserRow($budgetcategory[$valuebudget->id] , $statementtype_id , $budgetcategoryid[$valuebudget->id] , '0' , '0' , $sum_total_budgetcategory[$valuebudget->id] , $id , $result , true);

                $costCategroys = DataSetting::where('group_type', "budgetcategory")->where('parent_id', $valuebudget->id)->where('is_deleted', '0')->where('is_active','1')->get();
                
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

            if ($result) {
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
    public function yearEdit($id)
    {
        $info = BudgetYear::find((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution'];

        // display
        $file = 'default.office.budget.expense.budgetYearEdit';

        return view($file, compact($arr))->render();
    }

    public function yearRepost($id , $institutionId)
    {
        $info = BudgetYear::find((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = BudgetYear::getdata();

        $yearsDetail = YearBudget::where('id', $info->year_id)->where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('institution_id', $institutionId)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution' , 'institutionId' , 'yearsDetail'];

        // display
        $file = 'default.office.budget.expense.budgetYearRepost';

        return view($file, compact($arr))->render();
    }


    public function yearRepostLists()
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $infod);

        $id = $infod['id'];

        $institutionId = $infod['institution_id'];

        $info = BudgetYear::find((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = BudgetYear::getdata();

        $yearsDetail = YearBudget::where('id', $info->year_id)->where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('institution_id', $institutionId)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['info' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail' , 'institution' , 'institutionId' , 'yearsDetail'];

        // display
        $file = 'default.office.budget.expense.budgetYearRepost';

        return view($file, compact($arr))->render();
    }

    public function yearShow($id)
    {
    
        $project = BudgetYear::getdata((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['project' , 'id' , 'year' , 'budget' , 'statementtype' , 'detail'];

        // display
        $file = 'default.office.budget.expense.budgetYearShow';

        return view($file, compact($arr))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function yearDelete($id)
    {
        $process = BudgetYear::deleteRow($id);

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function yearLoadcategory($id, $num , $title , Request $request)
    {
        $items = DataSetting::where('group_type', "budget")->where('data_value', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'num' , 'items' , 'title'];
        
        // display
        $file = 'default.office.budget.expense.yearLoadcategory';

        return view($file, compact($arr))->render();
    }

    public function yearLoadbudget(Request $request)
    {
        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['statementtype'];
        
        // display
        $file = 'default.office.budget.expense.yearLoadbudget';

        return view($file, compact($arr))->render();
    }


    public function yearLoaddate($id , $yearid , $num ,Request $request)
    {
        $items = BudgetYearDetail::where('parent_id', $id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'num' , 'id' , 'yearid'];
        
        // display
        $file = 'default.office.budget.expense.yearLoaddate';

        return view($file, compact($arr))->render();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id , $projectsId, Request $request)
    {
        $info = Budget::find((int) $id);

        $detail = Project::where('id',$projectsId)->where('is_deleted', '0')->where('is_active','1')->get();

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $items = Budget::getDataAll($projectsId , $id);

        $arr = ['id' , 'projectsId' , 'detail' , 'info' ,'Project' , 'Year' , 'items'];

        // display
        $file = 'default.office.budget.expense.detail';

        return view($file, compact($arr))->render();
    }

    public function printing($id)
    {
        if($id != 'all'){
            $project = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

            $items = Budget::getDataAll($id , '0');

            $arr = ['project' , 'items' , 'id'];

            // display
            $file = 'default.office.budget.expense.printing';

        }else{

            $items = Budget::getDataAll();

            $arr = ['items'];

            // display
            $file = 'default.office.budget.expense.printingAll';

        }
        
        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importindex()
    {  
        $reports = BudgetImport::getItems();
        $arr = ['reports'];

        // display
        $file = 'default.office.budget.expense.import.index';
        
        return view($file, compact($arr))->render();
    }


    /**
     * importform
     *
     * @param  mixed $request
     * @return void
     */
    public function importform(Request $request)
    {
        $arr = [];

        // display
        $file = 'default.office.budget.expense.import.import-file';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function budget()
    {
        $year = BudgetYear::getdata();

        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 3);

        $project = BudgetYear::getdata((int) $id);

        $items = Budget::getDataYearAll($id , '0');

        $arr = ['project' , 'items' , 'id' , 'purchases' , 'year'];

        // display
        $file = 'default.office.budget.expense.budgetcharges';
        
        return view($file, compact($arr))->render();
    }


    public function budgetshow($id)
    {
        $year = BudgetYear::getdata();

        $purchases = PurchasesStatus::getData((int) $id , (int) 3);

        $project = BudgetYear::getdata((int) $id);

        $items = Budget::getDataYearAll($id , '0');

        $arr = ['project' , 'items' , 'id' , 'purchases' , 'year'];

        // display
        $file = 'default.office.budget.expense.budgetcharges';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function budgetcreate($id)
    {
        $info = BudgetYear::find((int) $id);

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchases = PurchasesStatus::getData((int) $id , (int) 3);

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['Year' , 'id' , 'info' , 'purchases' , 'institution'];

        // display
        $file = 'default.office.budget.expense.budgetadd';

        return view($file, compact($arr))->render();
    }

    public function budgetdedit($id , $projectsId, Request $request)
    {
        $info = BudgetYear::find((int) $projectsId);

        $detail = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $items = Budget::find((int) $id);

        $arr = ['id' , 'projectsId' , 'detail' , 'info' ,'Project' , 'Year' , 'items'];

        // display
        $file = 'default.office.budget.expense.budgetedit';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectcreate()
    {
        $year = BudgetYear::getdata();

        $arr = ['year'];

        // display
        $file = 'default.office.budget.expense.projectadd';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function projectstore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            $result = Project::inserRow($data , true);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectedit($id)
    {   
        $info = Project::find((int) $id);

        $year = BudgetYear::getdata();

        // $statementtype = BudgetYearDetail::selectRaw('count(*) AS cnt, statementtype_id')->where($conditions)->groupBy('statementtype_id');

        // $budget = BudgetYearDetail::selectRaw('count(*) AS cnt, budget_id')->where($conditions)->groupBy('budget_id');

        $arr = ['year' , 'info' , 'id' ];

        // display
        $file = 'default.office.budget.expense.projectedit';

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectupdate(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;    

            $result = Project::updateRow($data, $id);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    public function getProject(Request $request) 
    {
        $id = $request->id;
        $parentId = $request->parentId;
        $type = $request->t;

        $html = '';

        switch ($type) {
            case 'statementtype':
                $html = '<option value="0">--เลือก--</option>';
                $items = \App\Models\BudgetYearDetail::getSelect('statementtype' , $id , $parentId);

                if (!empty($items)) {
                    foreach ($items as $item) {
                        $html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                    }
                }
                break;
                
            case 'budget':
                $html = '<option value="0">--เลือก--</option>';
                $items = \App\Models\BudgetYearDetail::getSelect('budget' , $id , $parentId);

                if (!empty($items)) {
                    foreach ($items as $item) {
                        $html .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                    }
                }
                break;

            case 'project':
                    $html = '<option value="0">--เลือก--</option><option value="0">สำนักงาน</option>';
                    $items = \App\Models\Project::where('in_year', $parentId)->where('budget_type', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                    $no = 0;
                    if (!empty($items)) {
                        foreach ($items as $item) {

                            if($no == 0){ $sta = 'selected'; }
                            $html .= '<option value="'.$item['id'].'" '.$item['sta'].' >'.$item['project_name'].'</option>';
                        $no++;}
                    }
                    break;

            
        }

        return response()->json(['elem_html' => $html], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectdestroy($id)
    {
        $process = Project::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function budgetrepost($id=0)
    {
        

        if($id == '0'){

            $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
            foreach ($infos as $info);
            $id = $info['id'];
            
        }else{

            
             $id = $id;
        }

        $year = BudgetYear::getdata();

        $project = BudgetYear::getdata((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $details = Budget::where('year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchases = PurchasesStatus::getData((int) $id , (int) 1);

        $arr = ['project' , 'id' , 'year' , 'budget' , 'statementtype' , 'details'];

        // display
        $file = 'default.office.budget.expense.budgetrepost';

        return view($file, compact($arr))->render();
        
    }
    

    public function budgetloadproject($id , $yearid , Request $request)
    {
        $info = BudgetYearDetail::find((int) $id);

        $budgetId = $info->budget_id;

        if($info->budget_id == '325'){

            $items = Project::where('in_year', $yearid)->where('budget_type', $id)->where('is_deleted', '0')->where('is_active','1')->get();
        }else{

            $items = BudgetYearDetail::where('parent_id', $id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();
        }

        $arr = ['items' , 'id' , 'yearid' , 'budgetId'];
        
        // display
        $file = 'default.office.budget.expense.budgetloadproject';

        return view($file, compact($arr))->render();
    }


    public function budgetloadtype($id , $yearid , Request $request)
    {
        $items = BudgetYearDetail::where('parent_id', $id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'id' , 'yearid'];
        
        // display
        $file = 'default.office.budget.expense.budgetloadtype';

        return view($file, compact($arr))->render();
    }


    public function budgetloadtype1($id , $yearid , Request $request)
    {
        $items = BudgetYearDetail::where('parent_id', $id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'id' , 'yearid'];
        
        // display
        $file = 'default.office.budget.expense.budgetloadtype1';

        return view($file, compact($arr))->render();
    }


    public function budgetloadtype2($id , $yearid , Request $request)
    {
        $items = BudgetYearDetail::where('parent_id', $id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'id' , 'yearid'];
        
        // display
        $file = 'default.office.budget.expense.budgetloadtype2';

        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function budgetexport($id=0)
    {
        

        if($id == '0'){

            $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
            foreach ($infos as $info);
            $id = $info['id'];
            
        }else{

            
             $id = $id;
        }

        $year = BudgetYear::getdata();

        $project = BudgetYear::getdata((int) $id);

        $budget = DataSetting::where('group_type', "budget")->where('is_deleted', '0')->where('is_active','1')->get();

        $statementtype = DataSetting::where('group_type', "statementtype")->where('is_deleted', '0')->where('is_active','1')->get();

        $details = Budget::where('year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchases = PurchasesStatus::getData((int) $id , (int) 1);

        $arr = ['project' , 'id' , 'year' , 'budget' , 'statementtype' , 'details'];

        // display
        $file = 'default.office.budget.expense.budgetexport';

        return view($file, compact($arr))->render();
        
    }
}
