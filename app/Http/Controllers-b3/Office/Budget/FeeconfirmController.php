<?php

namespace App\Http\Controllers\Office\Budget;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;
use App\Models\Project;
use App\Models\YearBudget;
use App\Models\Budget;
use App\Models\Disbursement;

class FeeconfirmController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::getDataAll();

        $years = YearBudget::getDataAll();

        $t = $request->input('t');

        // display

        if($t == 1){
            $arr = ['years' , 't'];
            $file = 'default.office.budget.fee_confirm.allYear';
        }else{
            $arr = ['projects' , 't'];
            $file = 'default.office.budget.fee_confirm.allProjects';
        }
        
        
        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $t = $request->input('t');
            
        // display
        if($t == 1){
            $years = YearBudget::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

            $items = Disbursement::getDataAll($id , $t);

            $arr = ['years' , 'items' , 'id'];

            $file = 'default.office.budget.fee_confirm.Year';

        }else{
            $project = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

            $items = Disbursement::getDataAll($id , $t);

            $arr = ['project' , 'items' , 'id'];

            $file = 'default.office.budget.fee_confirm.Projects';
        }
        
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,Request $request)
    {
        

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $t = $request->input('t');

        // display
        if($t == 1){
            $detail = YearBudget::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['detail' , 'Year' , 'Project' , 't' , 'id'];
            $file = 'default.office.budget.fee_confirm.addYear';
        }else{
            $detail = Project::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['detail' , 'Year' , 'Project' , 't' , 'id'];
            $file = 'default.office.budget.fee_confirm.addProjects';
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
            $data = $request->input;

            $result = Disbursement::inserRow($data);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
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
    public function views($id, $projectsId, Request $request)
    {
        $items = Budget::getDataDetail($id);

        $arr = ['items' , 'projectsId'];

        // display
        $file = 'default.office.budget.fee_confirm.show';
        
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
        $t = $request->input('t');

        $info = Disbursement::find((int) $id);

        $Project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        // display
        if($t == 1){
            $detail = YearBudget::where('id',$projectsId)->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['info' , 'detail' , 'Year' , 'Project' , 't' , 'id' , 'projectsId'];
            $file = 'default.office.budget.fee_confirm.editYear';
        }else{
            $detail = Project::where('id',$projectsId)->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['info' , 'detail' , 'Year' , 'Project' , 't' , 'id' , 'projectsId'];
            $file = 'default.office.budget.fee_confirm.editProjects';
        }

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

            $result = Disbursement::updateRow($data, $id);

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
        $process = Disbursement::deleteRow($id);

        return redirect()->back();
    }
}
