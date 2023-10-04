<?php

namespace App\Http\Controllers\Office\Expenses;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;

use App\Models\IncomeFinance;
use App\Imports\IncomeFinanceImport;
use Maatwebsite\Excel\Facades\Excel;

class IncomefinanceController extends Base
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        
        $t = $request->input('t');
        $pr = $request->input('pr');

        $infos = IncomeFinance::where('type_id', $t)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['infos','t','pr'];

        // display
        $file = 'default.office.expense.income.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $arr = ['t','pr'];

        
        // display
        $file = 'default.office.expense.income.add';

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
            
            $result = IncomeFinance::inserRow($data , true);

                
            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $info = IncomeFinance::find((int) $id);

        $t = $request->input('t');
        $pr = $request->input('pr');


        $arr = ['t','pr','info' , 'id'];

        // display
        $file = 'default.office.expense.income.edit';

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
            
            $result = IncomeFinance::updateRow($data, $id);

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
    public function destroy($id , Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $process = IncomeFinance::deleteRow($id);

        return redirect()->back();
    }


    /**
     * importform
     *
     * @return void
     */
    public function importform(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        # code...
        $arr = ['t','pr'];

        $file = 'default.office.expense.income.imports';

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
            $importResult = Excel::import(new IncomeFinanceImport($id), $fileTmp);

            if ($importResult) {

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }
        
        return response()->json($resp, 200);
    }
}
