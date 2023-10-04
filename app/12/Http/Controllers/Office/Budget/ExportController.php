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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ExportController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }


    public function budgetexport($id) {

        $details = Budget::where('year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:A2'); 
        $sheet->setCellValue('A1', 'ลำดับ');  
        $sheet->mergeCells('B1:B2');
        $sheet->setCellValue('B1', 'เลขที่ (เช็ค)');  
        $sheet->mergeCells('C1:C2');
        $sheet->setCellValue('C1', 'วันที่ เดือน ปี (ทำเรื่อง)');  
        $sheet->mergeCells('D1:D2');
        $sheet->setCellValue('D1', 'รายงาน / หมวกที่จ่าย');  
        $sheet->mergeCells('E1:E2');
        $sheet->setCellValue('E1', 'จ่ายให้');  
        $sheet->mergeCells('F1:F2');
        $sheet->setCellValue('F1', 'ค่าใช้จ่าย');  
        $sheet->mergeCells('G1:G2');
        $sheet->setCellValue('G1', 'หัก ณ ที่จ่าย');  
        $sheet->mergeCells('H1:H2');
        $sheet->setCellValue('H1', 'จ่าย สกนช.');  
        $sheet->mergeCells('I1:I2');
        $sheet->setCellValue('I1', 'จ่าย กองทุนน้ำมันเชื้อเพลิง');  
        $sheet->mergeCells('J1:J2');
        $sheet->setCellValue('J1', 'เงินเข้า');  
        $sheet->mergeCells('K1:M1');
        $sheet->setCellValue('K1', 'การรับเงิน (บาท)'); 
        $sheet->setCellValue('K2', 'เงินฝากธนาคาร'); 
        $sheet->setCellValue('L2', 'ดอกเบี้ย'); 
        $sheet->setCellValue('M2', 'รวม'); 
        $sheet->mergeCells('N1:R1');
        $sheet->setCellValue('N1', 'จำนวนเงิน-ค่าใช้จ่ายปีงบ 63 (บาท)'); 
        $sheet->setCellValue('N2', '1. งบบุคลากร'); 
        $sheet->setCellValue('O2', '2. งบดำเนินงาน'); 
        $sheet->setCellValue('P2', '3. งบลงทุน'); 
        $sheet->setCellValue('Q2', '4. งบรายจ่ายอื่น'); 
        $sheet->setCellValue('R2', 'รวม');
        $sheet->mergeCells('S1:W1');
        $sheet->setCellValue('S1', 'จำนวนเงิน-ค่าใช้จ่ายปีงบ 64 (บาท)'); 
        $sheet->setCellValue('S2', '1. งบบุคลากร'); 
        $sheet->setCellValue('T2', '2. งบดำเนินงาน'); 
        $sheet->setCellValue('U2', '3. งบลงทุน'); 
        $sheet->setCellValue('V2', '4. งบรายจ่ายอื่น'); 
        $sheet->setCellValue('W2', 'รวม');
        $sheet->mergeCells('X1:AB1');
        $sheet->setCellValue('X1', 'จำนวนเงิน-ค่าใช้จ่ายกองทุนน้ำมันเชื้อเพลิง (บาท)'); 
        $sheet->setCellValue('X2', '1. ชดเชย/คืน'); 
        $sheet->setCellValue('Y2', '2. โครงการ'); 
        $sheet->setCellValue('Z2', '3. งบบริหาร'); 
        $sheet->setCellValue('AA2', '4. รายจ่ายอื่น'); 
        $sheet->setCellValue('AB2', 'รวม');
        $sheet->mergeCells('AC1:AE1');
        $sheet->setCellValue('AC1', 'เงินฝากธนาคารคงเหลือ (บาท)'); 
        $sheet->setCellValue('AC2', 'รับ'); 
        $sheet->setCellValue('AD2', 'จ่าย'); 
        $sheet->setCellValue('AE2', 'รวม'); 
        $sheet->mergeCells('AF1:AF2');
        $sheet->setCellValue('AF1', 'หมายเหตุ');  
        
        
        $sumCK1 =  '0' ;
        $sumCK2 =  '0' ;            
		$no = 3;
		foreach($details as $detail){ 
            $sum63 = 0;
            $sum64 = 0;
            $sumPay = 0;
            $sumPay1 = 0;

            $costCategroys = BudgetYearDetail::find((int) $detail['budget_categroy']);

            $project = BudgetYear::getdata((int) $id);
            foreach($project as $keydetail => $valDetail);

            $strDate = explode("-", $detail['date_report']);
			$sheet->setCellValue('A' . $no, $no-2);
            $sheet->setCellValue('B' . $no, $detail['page_number']);
            $sheet->setCellValue('C' . $no, $detail['date_report']);
            $sheet->setCellValue('D' . $no, $detail['expense_item']);
            $sheet->setCellValue('E' . $no, $detail['pay_for']);
            $sheet->setCellValue('F' . $no, $detail['expenses_amount']);
            $sheet->setCellValue('G' . $no, $detail['deduct_amount']);
            $sheet->setCellValue('H' . $no, $detail['pay_NHSO']);
            $sheet->setCellValue('I' . $no, $detail['pay_oil']);
            $sheet->setCellValue('J' . $no, $detail['money_in_amount']);	
            $sheet->setCellValue('K' . $no, $detail['bank_amount']);
            $sheet->setCellValue('L' . $no, $detail['interest_amount']);
            $sheet->setCellValue('M' . $no, $detail['sum_amount']);

            if($costCategroys->statementtype_id == '60'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                    $sum63 += $detail['pay_oil'];

                    $sheet->setCellValue('N' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('N' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('N' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '62'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                    $sum63 += $detail['pay_oil'];

                    $sheet->setCellValue('O' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('O' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('O' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '308'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                    $sum63 += $detail['pay_oil'];

                    $sheet->setCellValue('P' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('P' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('P' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '315'){
                if($detail['pay_oil'] == 1 && $strDate[0] == '2020'){

                    $sum63 += $detail['pay_oil'];

                    $sheet->setCellValue('Q' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('Q' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('Q' . $no, '0.00');
            }

            $sheet->setCellValue('R' . $no, $sum63);

            

            if($costCategroys->statementtype_id == '60'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2021'){

                    $sum64 += $detail['pay_oil'];

                    $sheet->setCellValue('S' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('S' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('S' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '62'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2021'){

                    $sum64 += $detail['pay_oil'];

                    $sheet->setCellValue('T' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('T' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('T' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '308'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2021'){

                    $sum64 += $detail['pay_oil'];

                    $sheet->setCellValue('U' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('U' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('U' . $no, '0.00');
            }

            if($costCategroys->statementtype_id == '315'){
                if($detail['cost_type'] == 1 && $strDate[0] == '2021'){

                    $sum64 += $detail['pay_oil'];

                    $sheet->setCellValue('V' . $no, $detail['pay_oil']);      
                }else{

                    $sheet->setCellValue('V' . $no, '0.00');
                }
                    
            }else{

                $sheet->setCellValue('V' . $no, '0.00');
            }

            $sheet->setCellValue('W' . $no, $sum64);

            if($detail['cost_type'] == 2){

                $sumPay += $detail['pay_oil'];

                $sheet->setCellValue('X' . $no, $detail['pay_oil']);     
            }else{

                $sheet->setCellValue('X' . $no, '0.00');
            }

            if($detail['cost_type'] == 3){

                $sumPay1 += $detail['pay_oil'];

                $sheet->setCellValue('Y' . $no, $detail['pay_oil']);     
            }else{

                $sheet->setCellValue('Y' . $no, '0.00');
            }

            if($detail['cost_type'] == 4){

                $sumPay1 += $detail['pay_oil'];

                $sheet->setCellValue('Z' . $no, $detail['pay_oil']);     
            }else{

                $sheet->setCellValue('Z' . $no, '0.00');
            }

            if($detail['cost_type'] == 5){

                $sumPay1 += $detail['pay_oil'];

                $sheet->setCellValue('AA' . $no, $detail['pay_oil']);     
            }else{

                $sheet->setCellValue('AA' . $no, '0.00');
            }

            $sheet->setCellValue('AB' . $no, $sumPay + $sumPay1);

            $sheet->setCellValue('AC' . $no, $sumPay);

            $sheet->setCellValue('AD' . $no, $sum63 + $sum64 + $sumPay1);
            
            
            $sumCK1 += $sum63 + $sum64  + $sumPay1;
            $sumCK2 += $sumPay;
            
            if($no != 3){ 

                $sum = ($valDetail['budget_money'] - $sumCK1) + $sumCK2;  

                $sheet->setCellValue('AE' . $no, $sum);
            }else{ 

                $sum = ($sumPay + $valDetail['budget_money']) - ($sum63 + $sum64  + $sumPay1); 

                $sheet->setCellValue('AE' . $no, $sum);
            };

		$no++;}	

	    $Excel_writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="ExpensesData.xls"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$Excel_writer->save('php://output');
        return redirect(url('/')."/office/budget/expenses/reposts");   
		
    }
}
