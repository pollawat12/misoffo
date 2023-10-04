@extends('default.layouts.main')

@section('css')
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{url('assets/default/css/jquery.stickytable.min.css')}}">
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php $noN = 0;?>
        @if (!empty($purchases))    
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แจ้งเตือนงบประมาณ</i></h4>
                                <p class="sub-header"></p>
                            </div>
                        </div>
                        
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">วันที่รายงาน</th>
                                    <th width="15%">ข้อความ</th>
                                    <th width="10%">แนบไฟล์</th>
                                    <th width="15%">ส่งถึง</th>
                                    <th width="15%">สถานะ</th>
                                    <th style="width: 8%">จัดการ</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($purchases as $purchase)
                                <?php $noN++;?>
                                <tr>
                                    <td class="align-middle" style="width:5%">{{$noN}}</td>
                                    <td class="align-middle">{{getDateShow($purchase['purchases_status_date'])}}</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_message']}}</td>
                                    <td class="align-middle" style="width:20%">@if($purchase['purchases_status_file'] != NULL) <a href="{{url('')}}/{{$purchase['purchases_status_file']}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลด</i> </a> @endif</td>
                                    <td class="align-middle" style="width:20%">@if($purchase['purchases_status_to'] == 1) งบประมาณ @elseif($purchase['purchases_status_to'] == 2) บัญชี @elseif($purchase['purchases_status_to'] == 3) การเงิน @elseif($purchase['purchases_status_to'] == 4) ครุภัณฑ์ @endif</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_update']}}</td>
                                    <td style="width:10%">
                                        <select name="input_action" class="form-control btn-action-new">
                                            <option value="">เลือก</option>
                                            <option value="{{$purchase['purchases_id']}}" data-original-title="show" data-id="{{$purchase['id']}}">ดูรายละเอียด</option>
                                            <option value="edit" data-original-title="edit" data-id="{{$purchase['id']}}">อัพเดทสถานะ</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end row -->
        @endif 

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียดงบประมาณ</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-6 text-right">
                                
                                
                            </div>
                        </div>
                        <?php foreach($project as $keydetail => $valDetail);?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                    <select name="year_id_n" id="year_id_n" class="form-control" style="height: 40px; width: 55%;">
                                        <option value="">--เลือก--</option>
                                        @if (count($year) > 0)
                                        @foreach($year as $valyear)
                                        <option value="{{$valyear['id']}}" @if($valyear['id'] == $id) selected @endif>{{$valyear['year_name']}}</option>
                                        @endforeach
                                        @endif
                                    </select> 
                                    
                                </div>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">งบประมาณ (ได้รับการอนุมัติจริง)</h4>
                                    <label for="exampleInputEmail1"> {{number_format($valDetail['budget_money'],2,'.',',')}}</label>
                                    
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="form-group">
                                <a href="{{url('office/budget/expenses/export')}}/{{$id}}" class="btn btn-primary"><i class="mdi mdi-table-large"> นำออกข้อมูล</i></a>
                                </div>
                            </div>
                        </div>
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i> </h4>
                            
                                <div class="no-padding sticky-table sticky-headers sticky-rtl-cells">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th width="1%" rowspan="2">ลำดับ</th>
                                                <th width="5%" rowspan="2">เลขที่ (เช็ค)</th>
                                                <th width="4%" rowspan="2">วันที่ เดือน ปี (ทำเรื่อง)</th>
                                                <th width="5%" rowspan="2">รายงาน / หมวกที่จ่าย</th>
                                                <th width="5%" rowspan="2">จ่ายให้</th>
                                                <th width="6%" rowspan="2">ค่าใช้จ่าย</th>
                                                <th width="6%" rowspan="2">หัก ณ ที่จ่าย</th>
                                                <th width="6%" rowspan="2">จ่าย สกนช.</th>
                                                <th width="6%" rowspan="2">จ่าย กองทุนน้ำมันเชื้อเพลิง</th>
                                                <th width="6%" rowspan="2">เงินเข้า</th>
                                                <th width="9%" colspan="3">การรับเงิน (บาท)</th>
                                                <th width="15%" colspan="5">จำนวนเงิน-ค่าใช้จ่ายปีงบ 63 (บาท)</th>
                                                <th width="15%" colspan="5">จำนวนเงิน-ค่าใช้จ่ายปีงบ 64 (บาท)</th>
                                                <th width="15%" colspan="5">จำนวนเงิน-ค่าใช้จ่ายกองทุนน้ำมันเชื้อเพลิง (บาท)</th>
                                                <th width="9%" colspan="3">เงินฝากธนาคารคงเหลือ (บาท)</th>
                                                <th width="4%" rowspan="2">หมายเหตุ</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 3%">เงินฝากธนาคาร</th>
                                                <th style="width: 3%">ดอกเบี้ย</th>
                                                <th style="width: 3%">รวม</th>
                                                <th style="width: 3%">1. งบบุคลากร</th>
                                                <th style="width: 3%">2. งบดำเนินงาน</th>
                                                <th style="width: 3%">3. งบลงทุน</th>
                                                <th style="width: 3%">4. งบรายจ่ายอื่น</th>
                                                <th style="width: 3%">รวม</th>
                                                <th style="width: 3%">1. งบบุคลากร</th>
                                                <th style="width: 3%">2. งบดำเนินงาน</th>
                                                <th style="width: 3%">3. งบลงทุน</th>
                                                <th style="width: 3%">4. งบรายจ่ายอื่น</th>
                                                <th style="width: 3%">รวม</th>
                                                <th style="width: 3%">1. ชดเชย/คืน</th>
                                                <th style="width: 3%">2. โครงการ</th>
                                                <th style="width: 3%">3. งบบริหาร</th>
                                                <th style="width: 3%">4. รายจ่ายอื่น</th>
                                                <th style="width: 3%">รวม</th>
                                                <th style="width: 3%">รับ</th>
                                                <th style="width: 3%">จ่าย</th>
                                                <th style="width: 3%">รวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 0;    
                                                $sumTotal[] =  '0' ;
                                                $sumCK1 =  '0' ;
                                                $sumCK2 =  '0' ;
                                            ?>
                                            @if (!empty($details))
                                            @foreach ($details as $detail)
                                            <?php 
                                                
                                                $sum63 = 0;
                                                $sum64 = 0;
                                                $sumPay = 0;
                                                $sumPay1 = 0;
                                                
                                            ?>
                                            <?php

                                                $costCategroys = \App\Models\BudgetYearDetail::find((int) $detail['budget_categroy']);

                                                $strDate = explode("-", $detail['date_report']);
                                            ?>
                                            <?php $no++;?>
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$detail['page_number']}}</td>
                                                    <td>{{getDateShow($detail['date_report'])}}</td>
                                                    <td>{{$detail['expense_item']}}</td>
                                                    <td>{{$detail['pay_for']}}</td>
                                                    <td>{{number_format($detail['expenses_amount'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['deduct_amount'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['pay_NHSO'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['pay_oil'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['money_in_amount'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['bank_amount'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['interest_amount'],2,'.',',')}}</td>
                                                    <td>{{number_format($detail['sum_amount'],2,'.',',')}}</td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '60'){
                                                                    if($detail['pay_oil'] == 1 && $strDate[0] == '2020'){

                                                                        $sum63 += $detail['pay_oil'];
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{

                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }

                                                            }else{

                                                                echo '0.00';
                                                            }

                                                            
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '62'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                                                                        $sum63 += $detail['pay_oil'];

                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{

                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }

                                                            }else{

                                                                echo '0.00';
                                                            }

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '308'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                                                                        $sum63 += $detail['pay_oil'];
                                                                        
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{

                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }

                                                            }else{

                                                                echo '0.00';
                                                            }    
                                                        ?>
                                                    
                                                    </td>
                                                    <td>
                                                        
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '315'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2020'){

                                                                        $sum63 += $detail['pay_oil'];

                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{

                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }

                                                            }else{

                                                                echo '0.00';
                                                            } 

                                                        ?>

                                                    </td>
                                                    <td>
                                                            <?php

                                                                    echo number_format($sum63,2,'.',',');
                                                            
                                                            ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '60'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2021'){

                                                                        $sum64 += $detail['pay_oil'];
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{

                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }
                                                            }else{

                                                                echo '0.00';
                                                            } 

                                                            
                                                            
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){
                                                                if($costCategroys->statementtype_id == '62'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2021'){
    
                                                                        $sum64 += $detail['pay_oil'];
    
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{
    
                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{
    
                                                                    echo '0.00';
                                                                }

                                                            }else{

                                                                echo '0.00';
                                                            } 

                                                            

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($costCategroys->statementtype_id == '308'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2021'){
    
                                                                        $sum64 += $detail['pay_oil'];
                                                                        
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{
    
                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{
    
                                                                    echo '0.00';
                                                                }
                                                            }else{

                                                                echo '0.00';
                                                            } 

                                                            

                                                        ?>
                                                    
                                                    </td>
                                                    <td>
                                                        
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){
                                                                if($costCategroys->statementtype_id == '315'){
                                                                    if($detail['cost_type'] == 1 && $strDate[0] == '2021'){
    
                                                                        $sum64 += $detail['pay_oil'];
    
                                                                        echo number_format($detail['pay_oil'],2,'.',',');      
                                                                    }else{
    
                                                                        echo '0.00';
                                                                    }
                                                                        
                                                                }else{
    
                                                                    echo '0.00';
                                                                }
                                                                
                                                            }else{

                                                                echo '0.00';
                                                            }

                                                            

                                                        ?>

                                                    </td>
                                                    <td>
                                                            <?php

                                                                    echo number_format($sum64,2,'.',',');
                                                            
                                                            ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){
                                                                
                                                                if($detail['cost_type'] == 2){

                                                                    $sumPay += $detail['pay_oil'];

                                                                    echo number_format($detail['pay_oil'],2,'.',',');      
                                                                }else{

                                                                    echo '0.00';
                                                                }
                                                                
                                                            }else{

                                                                echo '0.00';
                                                            }
                                                        
                                                        
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){

                                                                if($detail['cost_type'] == 3){
                                                                    $sumPay1 += $detail['pay_oil'];
    
                                                                    echo number_format($detail['pay_oil'],2,'.',',');
                                                                        
                                                                }else{
    
                                                                    echo '0.00';
                                                                }
                                                                
                                                            }else{

                                                                echo '0.00';
                                                            }
                                                    
                                                        
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                            if($detail['budget_categroy'] != '0'){
                                                                if($detail['cost_type'] == 4){
                                                                    $sumPay1 += $detail['pay_oil'];
    
                                                                    echo number_format($detail['pay_oil'],2,'.',',');
                                                                        
                                                                }else{
    
                                                                    echo '0.00';
                                                                }
                                                                
                                                            }else{

                                                                echo '0.00';
                                                            }
                                                        
                                                            
                                                        
                                                        ?>  
                                                    </td>
                                                    <td>
                                                    <?php

                                                            if($detail['budget_categroy'] != '0'){
                                                                
                                                                if($detail['cost_type'] == 5){
                                                                    $sumPay1 += $detail['pay_oil'];

                                                                    echo number_format($detail['pay_oil'],2,'.',',');
                                                                        
                                                                }else{

                                                                    echo '0.00';
                                                                }
                                                                
                                                            }else{

                                                                echo '0.00';
                                                            }
                                                        
                                                    
                                                    ?>     

                                                    </td>
                                                    <td>
                                                        <?php

                                                            echo number_format($sumPay + $sumPay1,2,'.',',');

                                                        ?>

                                                    </td>
                                                    <td>
                                                    <?php

                                                        echo number_format($sumPay,2,'.',',');
                                                        $sumCK2 += $sumPay;
                                                    ?>

                                                    </td>
                                                    <td>
                                                    <?php

                                                        echo number_format($sum63 + $sum64 + $sumPay1,2,'.',',');
                                                        $sumCK1 += $sum63 + $sum64  + $sumPay1;
                                                    ?>

                                                    </td>
                                                    <td>

                                                    <?php

                                                        if($no != 1){ 

                                                            $sum = ($valDetail['budget_money'] - $sumCK1) + $sumCK2;  

                                                            echo number_format($sum,2,'.',',');
                                                        }else{ 
                                                            echo number_format(($sumPay + $valDetail['budget_money']) - ($sum63 + $sum64  + $sumPay1),2,'.',','); 
                                                        };
                                                        
                                                        
                                                    ?>

                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            @endif   
                                        </tbody>
                                    </table>
                                </div>

                                
                        
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>
        <!-- end row -->
        <div id="div-data-url-new" data-url="{{url('office/purchases')}}"></div>     
        
        <div id="div-data-url" data-url="{{url('office/budget/expenses/reposts')}}/{{$id}}"></div>  

        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/reposts')}}/"></div>
    </div>
</div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <form action="{{url('office/purchases/status/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">

        <input type="hidden" name="edit_id" id="input-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลอัพเดทสถานะ</h4>
            </div>
            <?php 
                $purchasesstatus = \App\Models\DataSetting::where('group_type','purchasesstatus')->where('is_deleted', '0')->where('is_active','1')->get();
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="lastname">ข้อความ </label>
                            <input type="text" class="form-control" name="input[purchases_status_message]" id="input-purchases_status_message" placeholder="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">สถานะ </label>
                            <div>
                                <div class="input-group">
                                    <select name="input[is_status]" class="form-control" id="input-is_status" style="height: 45px;">
                                        <option value="2">อยู่ระหว่างดำเนินการ</option>
                                        <option value="1">ดำเนินการ</option>
                                        <option value="3">แล้วเส็จ</option>
                                        <option value="0">ยกเลิก</option>
                                    </select>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="group_no">ส่งถึง </label>
                            <select name="input[purchases_status_to]" class="form-control" id="input-purchases_status_to" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                <option value="1">งบประมาณ</option>
                                <option value="2">บัญชี</option>
                                <option value="3">การเงิน</option>
                                <option value="4">ครุภัณฑ์</option>
                            </select>
                        </div>
                    </div>
                </div>
               
                <?php 
                    $auth_info = session('auth_info');
                ?>
                <input type="hidden" name="input[user_id]" value="{{$auth_info['user_id']}}">
                <input type="hidden" name="input[purchases_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->
@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>

    $(document).on('change', '.btn-action-new', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        if(title == 'add'){
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        }else if(title == 'edit'){

            $('#con-close-modal').modal('show'); 

            var _url = $("#div-data-url-new").attr("data-url")+"/get/info/?id="+id+"&type="+title;

            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_file").val(res.info.purchases_status_file);
                $("#frm-save #input-purchases_status_to").val(res.info.purchases_status_to);
                $("#frm-save #input-purchases_status_update").val(res.info.purchases_status_update);
                $("#frm-save #input-purchases_status_date").val(res.info.purchases_status_date);
                $("#frm-save #input-is_status").val(res.info.is_status);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(title == 'show'){
            window.open('{{URL('office/purchases/show')}}'+ '/' + values, '_blank');
        }else{
            
        }
        
    });

    $('#button_add').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.href = urlRedirect;
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[purchases_status_message]': {
                    required: true
                }
            },
            messages: {
                'input[purchases_status_message]': {
                    required: "กรุณากรอก"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });


    $(document).on('change', '#year_id_n', function(params) {
        let values = $(this).val();

        window.location='{{URL('office/budget/expenses/reposts')}}'+ '/' +values;
        
    });
</script>

@endsection
