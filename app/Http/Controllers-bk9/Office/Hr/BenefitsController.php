<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Models\DataSetting; 
use App\Models\User; 
use App\Models\UserBenefits; 
use App\Models\BudgetsrFund; 

class BenefitsController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $items = DataSetting::find((int) $id);

        $employees = User::getEmployees();

        $funds = BudgetsrFund::where('behavior_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        // display

        if($pr == 'fund'){

            $arr = ['items','employees','t','pr', 'id' , 'funds'];

            $file = 'default.office.hr.benefits.fund';
        }else{
            $arr = ['items','employees','t','pr', 'id'];

            $file = 'default.office.hr.benefits.index';
        }
        

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSub($id)
    {
        $items = DataSetting::where('group_type', "department")->where('parent_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $arr = ['items' , 'employees' , 'id'];

        // display
        $file = 'default.office.hr.benefits.indexSub';

        return view($file, compact($arr))->render();
    }

    public function info(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $id = $request->input('id');
            $type = $request->input('type');

            if($type == 'boss'){

                $Leave = UserBenefits::where('type_id',$id)->where('level_id','1')->get();
                $LeaveCount = $Leave->count();

                if($LeaveCount > 0){
                    foreach ($Leave as $row);

                    $dataTmp = [
                        'user_id' => $row->user_id,
                        'category_name' => $row->category_name,
                        'type_id' => $row->type_id,
                        'id' => $row->id,
                        'action' => 'boss',
                    ];
                }else{

                    $dataTmp = [
                        'user_id' => '',
                        'category_name' => 1,
                        'type_id' => $id,
                        'id' => 0,
                        'action' => 'boss',
                    ];
                }

                

            }else{

                $dataTmp = [
                    'user_id' => '',
                    'category_name' => 1,
                    'type_id' => $id,
                    'id' => 0,
                    'action' => 'add',
                ];

            }
               
            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }


    public function store(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'boss'){

                if($data['edit_id'] == '0'){
                    $result = UserBenefits::insertRow($data);
                }else{
                    $result = UserBenefits::updateRow($data, $data['edit_id']);
                }
            }elseif($data['action'] == 'fund'){

                $result = BudgetsrFund::inserRowNew($data);

            }else{

                $result = UserBenefits::insertRow($data);

            }

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
        $process = UserBenefits::deleteRow($id);

        return redirect()->back();
    }

    public function destroyfund($id)
    {
        $process = BudgetsrFund::deleteRow($id);

        return redirect()->back();
    }
}
