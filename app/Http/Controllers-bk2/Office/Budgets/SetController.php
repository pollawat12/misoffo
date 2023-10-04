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

class SetController extends Base
{
    public function index($id)
    {
        $years = YearBudget::getDataAll();

        $info = DataSetting::find((int) $id);

        $arr = ['years' , 'id' , 'info'];

        // display
        $file = 'default.office.budgets.set.index';
        
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
            $action = $request->action_name;
            $data = $request->input;

            if($id == 0){
                $result = BudgetsYearSet::insertRow($data);  
            }else{
                $result = BudgetsYearSet::updateRow($data, $id);
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
    }

    public function getinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $yearid = $request->input('yearid');
            $budgetsid = $request->input('budgetsid');
            $type = $request->input('type');


            if($type == 'budgets'){

                $Year = YearBudget::find((int) $yearid);
                    
                $items = BudgetsYearSet::where('year_id',$yearid)->where('budgets_id',$budgetsid)->first();
                if(isset($items)):

                    $dataTmp = [
                        'edit_id' => $items->id,
                        'year' => $yearid,
                        'money' => $items->budgets_money,
                        'name' => $Year->in_year,
                    ];

                else:

                    $dataTmp = [
                        'edit_id' => 0,
                        'year' => $yearid,
                        'money' => '',
                        'name' => $Year->in_year,
                    ];  

                endif;

            }else{

                $dataTmp = [];  

            }

            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }
}
