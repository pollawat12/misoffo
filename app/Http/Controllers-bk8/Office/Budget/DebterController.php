<?php

namespace App\Http\Controllers\Office\Budget;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Models\InvoiceSubject;
use App\Models\InvoiceDetail;
use App\Models\InvoiceHasReceipt;
use App\Libraries\MyUtilities;
use App\Libraries\MyNotification;

class DebterController extends Base 
{    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $reports = InvoiceSubject::getItems();
        $arr = ['reports'];

        // MyNotification::notiEmployeeLeaveApproved('อมรเทพ เอี่ยมแฟง', 'ลาป่วย', '01 มี.ค. 2564', '02 มี.ค. 2564', 1);
        // display
        $file = 'default.office.budget.debter.index';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $file = 'default.office.budget.debter.import-file';
        
        return view($file, compact($arr))->render();
    }
    
    /**
     * importformupdate
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function importformupdate($id,Request $request)
    {
        $subjectInfo = InvoiceSubject::find((int) $id);
        $invoices = InvoiceDetail::getInvoiceHasReceipt($id);

        $summary = self::getSummary($id);

        $arr = ['subjectInfo','invoices','id','summary'];

        // display
        $file = 'default.office.budget.debter.import-file-update';
        
        return view($file, compact($arr))->render();
    }
    
    /**
     * getSummary
     *
     * @param  mixed $reportId
     * @return void
     */
    public static function getSummary($reportId=0)
    {

        $summaryInfo = InvoiceDetail::getInvoiceSummay($reportId);

        $array = [
            'invoice_total' => $summaryInfo['invoice_total'],
            'invoice_wait' => $summaryInfo['invoice_wait'],
            'invoice_wait_total' => getNumberCurrency($summaryInfo['invoice_wait_total']),
            'invoice_grand_total' => getNumberCurrency($summaryInfo['invoice_grand_total'])
        ];


        return $array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = InvoiceSubject::deleteRow($id);

        return redirect()->back();
    }


    
    /**
     * destroyitem
     *
     * @param  mixed $request
     * @return void
     */
    public function destroyitem(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {

            $id = $request->input('del_id');
            
            $process = InvoiceDetail::deleteRow($id);

            $response = ['status' => true, 'msg' => 'ลบรายการสำเร็จ!'];
        }

        return response()->json($response, 200);
    }

    /**
     * edititem
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function edititem($id, Request $request)
    {
        $info = InvoiceDetail::find((int) $id);
        $recId = 0;

        $recInfo = InvoiceHasReceipt::where('invoice_details_id', (int) $id)->first();
        $recArray = [
            'receipt_code' => '',
            'water_cost' => 0,
            'conversation_cost' => 0,
            'addon_water_cost' => 0,
            'addon_conv_cost' => 0,
            'total_cost' => 0,
            'state_income_cost' => 0,
            'fund_income_cost' => 0,
            'net_income_cost' => 0
        ];
        if (!empty($recInfo)) {
            $recId = $recInfo->id;

            $recArray = [
                'receipt_code' => $recInfo->receipt_code,
                'water_cost' => $recInfo->water_cost,
                'conversation_cost' => $recInfo->conversation_cost,
                'addon_water_cost' => $recInfo->addon_water_cost,
                'addon_conv_cost' => $recInfo->addon_conv_cost,
                'total_cost' => $recInfo->total_cost,
                'state_income_cost' => $recInfo->state_income_cost,
                'fund_income_cost' => $recInfo->fund_income_cost,
                'net_income_cost' => $recInfo->net_income_cost
            ];
        }



        $arr = ['info', 'recId', 'recInfo' , 'recArray' ,'id'];

        // display
        $file = 'default.office.budget.debter.edit-invoice';
        
        return view($file, compact($arr))->render();

    }
    
    /**
     * edititemsave
     *
     * @param  mixed $request
     * @return void
     */
    public function edititemsave(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];


        if ($request->ajax() && $request->isMethod('post')) {
            $dataInv = $request->input('input');
            $dataRec = $request->input('input_rec');

            $invoiceId = $request->edit_id;
            $receiveId = $request->edit_rec_id;

            $inv_process = InvoiceDetail::find((int) $invoiceId);
            $inv_process->water_cost = $dataInv['water_cost'];
            $inv_process->conversation_cost = $dataInv['conversation_cost'];
            $inv_process->total_cost = $dataInv['total_cost'];
            $inv_process->updated_at = getDateNow();

            if ($inv_process->save()) {
                if ($receiveId > 0) {
                    $rec_process = InvoiceHasReceipt::find((int) $receiveId);
                    $rec_process->addon_water_cost = $dataRec['addon_water_cost'];
                    $rec_process->addon_conv_cost = $dataRec['addon_conv_cost'];
                    $rec_process->total_cost = $dataRec['total_cost'];
                    $rec_process->state_income_cost = $dataRec['state_income_cost'];
                    $rec_process->fund_income_cost = $dataRec['fund_income_cost'];
                    $rec_process->net_income_cost = $dataRec['net_income_cost'];
                    $rec_process->updated_at = getDateNow();
                    $rec_process->save();
                }

                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }

        }


        return response()->json($response, 200);
    }
}
