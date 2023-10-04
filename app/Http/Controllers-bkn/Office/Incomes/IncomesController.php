<?php

namespace App\Http\Controllers\Office\Incomes;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\Incomes;
use App\Models\IncomesCompany;
use App\Models\IncomesOilPrice;
use App\Models\IncomesDetail;
use App\Models\DataSetting;
use App\Models\ProductPriceMovemrntReport;

class IncomesController extends Base 
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
        $items = Incomes::getData();

        $arr = ['items'];

        // display
        $file = 'default.office.incomes.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $company = IncomesCompany::where('is_deleted', '0')->where('is_active','1')->get();

        $oil = DataSetting::where('group_type', "typeoil")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['company' , 'oil'];
        
        // display
        $file = 'default.office.incomes.add';

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
            $oiltype = $request->oil_type_id;
            $export = $request->export_total;
            $numOil = count($oiltype);

            $result = Incomes::inserRow($data);

            for ($i=0; $i < $numOil; $i++) { 
                $resultDetail = IncomesDetail::inserRow($oiltype[$i] , $export[$i] , $result);
            }

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $info = Incomes::find((int) $id);

        $detail = IncomesDetail::where('incomes_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $oil = DataSetting::where('group_type', "typeoil")->where('is_deleted', '0')->where('is_active','1')->get();

        $company = IncomesCompany::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','company' , 'detail' , 'oil'];
        
        // display
        $file = 'default.office.incomes.edit';

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
            $oiltype = $request->oil_type_id;
            $export = $request->export_total;
            $numOil = count($oiltype);

            $process = IncomesDetail::where('incomes_id', $id)->delete();

            for ($i=0; $i < $numOil; $i++) { 
                $resultDetail = IncomesDetail::inserRow($oiltype[$i] , $export[$i] , $id);
            }

            $result = Incomes::updateRow($data, $id);

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
        $process = Incomes::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Show the form for report the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $report = ProductPriceMovemrntReport::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['report'];
        
        // display
        $file = 'default.office.incomes.report';

        return view($file, compact($arr))->render();
    }




    
}
