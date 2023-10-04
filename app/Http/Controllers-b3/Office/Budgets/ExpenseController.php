<?php

namespace App\Http\Controllers\Office\Budgets;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\Budget;
use App\Models\Project;
use App\Models\YearBudget;
use App\Models\BudgetsCosts;
use App\Models\BudgetYear;
use App\Models\BudgetYearDetail;
use App\Models\BudgetImport;
use App\Models\Incomes;
use App\Models\DataSetting;
use App\Models\PurchasesStatus;
use App\Models\BudgetCertificateCompany;

use App\Models\BudgetsrDetail;
use App\Models\BudgetsrDetailYear;
use App\Models\BudgetsTemplate;
use App\Models\BudgetsCostsOil;

class ExpenseController extends Base
{

    public function loadbudget(Request $request)
    {

        $arr = [];
        
        // display
        $file = 'default.office.budgets.expense.loadbudget';

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
            

            $result = BudgetsrDetail::inserRowNew($data , true);

            if ($result) {

                $result2 = BudgetsrDetailYear::inserRowNew($data , $result , true);

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
            

            
        }

        return response()->json($resp, 200);
    }


    public function loadbudgetEdit($id , $num , Request $request)
    {

        $info = BudgetsrDetail::find((int) $id);

        $items = BudgetsrDetailYear::where('budgets_detail_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'info' , 'num' , 'items'];
        
        // display
        $file = 'default.office.budgets.expense.loadbudgetEdit';

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
            $edit_detail_id = $request->edit_detail_id;
            $data = $request->input;    

            $result = BudgetsrDetail::updateRowNew($data, $id);

            if ($result) {

                $result2 = BudgetsrDetailYear::updateRowNew($data , $edit_detail_id , true);

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
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
        $process = BudgetsrDetail::deleteRow($id);

        return redirect()->back();
    }

    public function loadbudgetAdd($id , $num , Request $request)
    {

        $checkNum = BudgetsrDetail::where('parent_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $sum = count($checkNum) + 1;

        $info = BudgetsrDetail::find((int) $id);

        $arr = ['id' , 'num' , 'sum' , 'info'];
        
        // display
        $file = 'default.office.budgets.expense.loadbudgetAdd';

        return view($file, compact($arr))->render();
    }
}
