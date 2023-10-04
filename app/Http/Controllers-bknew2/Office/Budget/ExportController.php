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

            if($detail['budget_categroy'] != '0'){
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

            }else{

                $sheet->setCellValue('N' . $no, '0.00');
                $sheet->setCellValue('O' . $no, '0.00');
                $sheet->setCellValue('P' . $no, '0.00');
                $sheet->setCellValue('Q' . $no, '0.00');
            }

            $sheet->setCellValue('R' . $no, $sum63);

            
            if($detail['budget_categroy'] != '0'){
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
            }else{

                $sheet->setCellValue('S' . $no, '0.00');
                $sheet->setCellValue('T' . $no, '0.00');
                $sheet->setCellValue('U' . $no, '0.00');
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

    public function yearRepostExport($id , $institutionId) {

        $info = BudgetYear::find((int) $id);

        $yearsDetail = YearBudget::where('id', $info->year_id)->where('is_deleted', '0')->where('is_active','1')->get();
        foreach($yearsDetail as $keydetail => $valyear);

        $detail = BudgetYearDetail::where('budget_year_id', $id)->where('institution_id', $institutionId)->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $Checkyear = $valyear->in_year - 1;

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:A2'); 
        $sheet->setCellValue('A1', 'ลำดับ');  
        $sheet->mergeCells('B1:B2');
        $sheet->setCellValue('B1', 'เรายงาน');  
        $sheet->mergeCells('C1:F1');
        $sheet->setCellValue('C1', 'ไตรมาส 1 ปีงบประมาณ '.$valyear->in_year); 
        $sheet->setCellValue('C2', 'ต.ค. '.$Checkyear); 
        $sheet->setCellValue('D2', 'พ.ย.'.$Checkyear); 
        $sheet->setCellValue('E2', 'ธ.ค.'.$Checkyear); 
        $sheet->setCellValue('F2', 'รวมไตรมาส');
        $sheet->mergeCells('G1:J1');
        $sheet->setCellValue('G1', 'ไตรมาส 2 ปีงบประมาณ '.$valyear->in_year); 
        $sheet->setCellValue('G2', 'ม.ค. '.$valyear->in_year); 
        $sheet->setCellValue('H2', 'ก.พ. '.$valyear->in_year); 
        $sheet->setCellValue('I2', 'มี.ค '.$valyear->in_year); 
        $sheet->setCellValue('J2', 'รวมไตรมาส'); 
        $sheet->mergeCells('K1:N1');
        $sheet->setCellValue('K1', 'ไตรมาส 3 ปีงบประมาณ '.$valyear->in_year); 
        $sheet->setCellValue('K2', 'เม.ย. '.$valyear->in_year); 
        $sheet->setCellValue('L2', 'พ.ค. '.$valyear->in_year); 
        $sheet->setCellValue('M2', 'มิ.ย. '.$valyear->in_year); 
        $sheet->setCellValue('N2', 'รวมไตรมาส'); 
        $sheet->mergeCells('O1:R1');
        $sheet->setCellValue('O1', 'ไตรมาส 4 ปีงบประมาณ '.$valyear->in_year); 
        $sheet->setCellValue('O2', 'ก.ค. '.$valyear->in_year); 
        $sheet->setCellValue('P2', 'ส.ค. '.$valyear->in_year); 
        $sheet->setCellValue('Q2', 'ก.ย. '.$valyear->in_year); 
        $sheet->setCellValue('R2', 'รวมไตรมาส'); 
        $sheet->mergeCells('S1:S2'); 
        $sheet->setCellValue('S1', 'รวมรายจ่าย ปีงบประมาณ '.$valyear->in_year); 
        $sheet->mergeCells('T1:T2'); 
        $sheet->setCellValue('T1', 'งบประมาณที่ได้รับ');  
                   
		$no = 3;
		if(count($detail) > 0){
            foreach($detail as $details){ 

                $statementtype = DataSetting::getNameDataByValueAndType($details['statementtype_id'],'statementtype');

                $sum163 = 0;
                $sra163 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra163) > 0){
                    foreach($sra163 as $sra163s ){
                        $sum163 += $sra163s['pay_oil'];
                    }
                }

                $sum263 = 0;
                $sra263 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra263) > 0){
                    foreach($sra263 as $sra263s ){
                        $sum263 += $sra263s['pay_oil'];
                        
                    }
                }

                $sum363 = 0;
                $sra363 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra363) > 0){
                    foreach($sra363 as $sra363s ){
                        $sum363 += $sra363s['pay_oil'];
                        
                    }
                }

                $sum1 = $sum163+$sum263+$sum363;


                $sum164 = 0;
                $sra164 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra164) > 0){
                    foreach($sra164 as $sra164s ){
                        $sum164 += $sra164s['pay_oil'];
                    }
                }

                $sum264 = 0;
                $sra264 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra264) > 0){
                    foreach($sra264 as $sra264s ){
                        $sum264 += $sra264s['pay_oil'];
                    }
                }

                $sum364 = 0;
                $sra364 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra364) > 0){
                    foreach($sra364 as $sra364s ){
                        $sum364 += $sra364s['pay_oil'];
                    }
                }

                $sum2 = $sum164+$sum264+$sum364;

                $sum464 = 0;
                $sra464 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra464) > 0){
                    foreach($sra464 as $sra464s ){
                        $sum464 += $sra464s['pay_oil'];
                        
                    }
                }

                $sum564 = 0;
                $sra564 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra564) > 0){
                    foreach($sra564 as $sra564s ){
                        $sum564 += $sra564s['pay_oil'];
                    }
                }

                $sum664 = 0;
                $sra664 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra664) > 0){
                    foreach($sra664 as $sra664s ){
                        $sum664 += $sra664s['pay_oil'];
                        
                    }
                }

                $sum3 = $sum464+$sum564+$sum664;

                $sum764 = 0;
                $sra764 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra764) > 0){
                    foreach($sra764 as $sra764s ){
                        $sum764 += $sra764s['pay_oil'];
                        
                    }
                }

                $sum864 = 0;
                $sra864 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra864) > 0){
                    foreach($sra864 as $sra864s ){
                        $sum864 += $sra864s['pay_oil'];
                        
                    }
                }

                $sum964 = 0;
                $sra964 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if(count($sra964) > 0){
                    foreach($sra964 as $sra964s ){
                        $sum964 += $sra964s['pay_oil'];
                    }
                }

                $sum4 = $sum764+$sum864+$sum964;

                $sumTotal1 = $sum4+$sum3+$sum2+$sum1;

                $sheet->setCellValue('A' . $no, $no-2);
                $sheet->setCellValue('B' . $no, $statementtype);
                $sheet->setCellValue('C' . $no, $sum163);
                $sheet->setCellValue('D' . $no, $sum263);
                $sheet->setCellValue('E' . $no, $sum363);
                $sheet->setCellValue('F' . $no, $sum1);
                $sheet->setCellValue('G' . $no, $sum164);
                $sheet->setCellValue('H' . $no, $sum264);
                $sheet->setCellValue('I' . $no, $sum364);
                $sheet->setCellValue('J' . $no, $sum2);	
                $sheet->setCellValue('K' . $no, $sum464);
                $sheet->setCellValue('L' . $no, $sum564);
                $sheet->setCellValue('M' . $no, $sum664);
                $sheet->setCellValue('N' . $no, $sum3);
                $sheet->setCellValue('O' . $no, $sum764);
                $sheet->setCellValue('P' . $no, $sum864);
                $sheet->setCellValue('Q' . $no, $sum964);
                $sheet->setCellValue('R' . $no, $sum4);
                $sheet->setCellValue('S' . $no, $sumTotal1);
                $sheet->setCellValue('T' . $no, $details['sum_total']);

                $items = BudgetYearDetail::where('parent_id', $details['id'])->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

                if(count($items) > 0){ 
                    $no1 = $no + 1;
                    foreach($items as $item => $valItem){ 

                        $costCategroys = BudgetYearDetail::where('parent_id', $valItem->id)->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

                        $sum163 = 0;
                        $sra163 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra163) > 0){
                            foreach($sra163 as $sra163s ){
                                $sum163 += $sra163s['pay_oil'];
                            }
                        }

                        $sum263 = 0;
                        $sra263 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra263) > 0){
                            foreach($sra263 as $sra263s ){
                                $sum263 += $sra263s['pay_oil'];
                                
                            }
                        }

                        $sum363 = 0;
                        $sra363 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra363) > 0){
                            foreach($sra363 as $sra363s ){
                                $sum363 += $sra363s['pay_oil'];
                                
                            }
                        }

                        $sum1 = $sum163+$sum263+$sum363;


                        $sum164 = 0;
                        $sra164 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra164) > 0){
                            foreach($sra164 as $sra164s ){
                                $sum164 += $sra164s['pay_oil'];
                            }
                        }

                        $sum264 = 0;
                        $sra264 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra264) > 0){
                            foreach($sra264 as $sra264s ){
                                $sum264 += $sra264s['pay_oil'];
                            }
                        }

                        $sum364 = 0;
                        $sra364 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra364) > 0){
                            foreach($sra364 as $sra364s ){
                                $sum364 += $sra364s['pay_oil'];
                            }
                        }

                        $sum2 = $sum164+$sum264+$sum364;

                        $sum464 = 0;
                        $sra464 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra464) > 0){
                            foreach($sra464 as $sra464s ){
                                $sum464 += $sra464s['pay_oil'];
                                
                            }
                        }

                        $sum564 = 0;
                        $sra564 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra564) > 0){
                            foreach($sra564 as $sra564s ){
                                $sum564 += $sra564s['pay_oil'];
                            }
                        }

                        $sum664 = 0;
                        $sra664 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra664) > 0){
                            foreach($sra664 as $sra664s ){
                                $sum664 += $sra664s['pay_oil'];
                                
                            }
                        }

                        $sum3 = $sum464+$sum564+$sum664;

                        $sum764 = 0;
                        $sra764 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra764) > 0){
                            foreach($sra764 as $sra764s ){
                                $sum764 += $sra764s['pay_oil'];
                                
                            }
                        }

                        $sum864 = 0;
                        $sra864 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra864) > 0){
                            foreach($sra864 as $sra864s ){
                                $sum864 += $sra864s['pay_oil'];
                                
                            }
                        }

                        $sum964 = 0;
                        $sra964 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($sra964) > 0){
                            foreach($sra964 as $sra964s ){
                                $sum964 += $sra964s['pay_oil'];
                            }
                        }

                        $sum4 = $sum764+$sum864+$sum964;

                        $sumTotal1 = $sum4+$sum3+$sum2+$sum1;

                        $checkNo2 = $no -2;

                        $sheet->setCellValue('A' . $no1, $checkNo2.'.'.$no1);
                        $sheet->setCellValue('B' . $no1, $valItem->name);
                        $sheet->setCellValue('C' . $no1, $sum163);
                        $sheet->setCellValue('D' . $no1, $sum263);
                        $sheet->setCellValue('E' . $no1, $sum363);
                        $sheet->setCellValue('F' . $no1, $sum1);
                        $sheet->setCellValue('G' . $no1, $sum164);
                        $sheet->setCellValue('H' . $no1, $sum264);
                        $sheet->setCellValue('I' . $no1, $sum364);
                        $sheet->setCellValue('J' . $no1, $sum2);	
                        $sheet->setCellValue('K' . $no1, $sum464);
                        $sheet->setCellValue('L' . $no1, $sum564);
                        $sheet->setCellValue('M' . $no1, $sum664);
                        $sheet->setCellValue('N' . $no1, $sum3);
                        $sheet->setCellValue('O' . $no1, $sum764);
                        $sheet->setCellValue('P' . $no1, $sum864);
                        $sheet->setCellValue('Q' . $no1, $sum964);
                        $sheet->setCellValue('R' . $no1, $sum4);
                        $sheet->setCellValue('S' . $no1, $sumTotal1);
                        $sheet->setCellValue('T' . $no1, $valItem->sum_total);
                    }
                }

            $no++;}	
        }

	    $Excel_writer = new Xls($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="ExpensesData.xls"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$Excel_writer->save('php://output');
        return redirect(url('/')."/office/budget/expenses/reposts");   
		
    }
}
