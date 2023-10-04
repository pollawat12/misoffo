@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item active">การเงิน > ใบสำคัญจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ใบสำคัญจ่าย</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">
                            <div class="font-15 mb-3 text-right color-text">ID :
                                <span class="ml-2 position-relative">
                                ............................................
                                                            <p class="text-float">{{$info->certificate_id}}</p>
                                </span>
                            </div>

                            <h4 class="font-16 mb-3 text-center">สำนักงานกองทุนน้ำมันเชื้อเพลิง</h4>
                            <h4 class="font-16 mb-2 text-center">ใบสำคัญจ่าย</h4>
                            <div class="font-15 mb-3 text-right color-text">เลขที่
                                <span class="ml-2 position-relative">
                                ............................................
                                                            <p class="text-float">{{$info->certificate_num}}</p>
                                </span>
                            </div>
                            <div class="font-15 mb-3 text-right color-text">วันที่
                                <span class="ml-2 position-relative">
                                ............................................
                                                            <p class="text-float">{{getDateFormatToInputThai($info->certificate_date)}}</p>
                                </span>
                            </div>

                            <?php
                                $company = \App\Models\BudgetCertificateCompany::where('id', $info->certificate_payfor)->get();
                                foreach($company as $val)
                            ?>

                            <h4 class="font-16 mb-4">จ่ายให้ : <span class="ml-2 font-17">{{$val['company_name']}}</span></h4>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" type="checkbox" checked="checked" @if(1 == $info->certificate_type) checked @endif>
                                        <label for="checkbox1" class="label-check-pv mr-3">
                                            โอนเงินผ่านระบบอิเล็กทรอนิกส์
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2 mr-2">บัญชีเลขที่
                                        <span class="ml-2 position-relative">
                                            ........................................................................................
                                            <p class="text-float">{{$info->certificate_bank_num}}</p>
                                        </span>
                                    </h4>
                                    <h4 class="font-15 mb-2 mt-3 mr-2">ชื่อบัญชี 
                                        <span class="ml-2 position-relative">
                                        ........................................................................................
                                            <p class="text-float">{{$info->certificate_bank_name}}</p>
                                        </span>
                                    </h4>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2">ธนาคาร 
                                        <span class="ml-2 position-relative">
                                        ........................................................................................
                                            <p class="text-float">{{$info->certificate_bank_account}}</p>
                                        </span>
                                    </h4>
                                    <h4 class="font-15 mb-2 mt-3 mr-2">สาขา 
                                        <span class="ml-2 position-relative">
                                        ........................................................................................
                                            <p class="text-float">{{$info->certificate_bank_branch}}</p>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" type="checkbox" @if(2 == $info->certificate_type) checked @endif>
                                        <label for="checkbox2" class="label-check-pv mr-3" >
                                            เงินสด
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" type="checkbox" @if(3 == $info->certificate_type) checked @endif>
                                        <label for="checkbox1" class="label-check-pv mr-3">
                                            เช็คเลขที่ 
                                                <span class="ml-2 position-relative">
                                                ...................................
                                                    <p class="text-float">{{$info->certificate_check_num}}</p>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2 mr-2">ลงวันที่ 
                                            <span class="ml-2 position-relative">
                                            ........................................
                                                    <p class="text-float">{{getDateFormatToInputThai($info->certificate_check_date)}}</p>
                                            </span>ธนาคารกรุงไทย
                                        จำกัด (มหาชน) สาขาถนนศรีอยุธยา
                                    </h4>
                                </div>
                            </div>

                            <div class="table-responsive mt-2">

                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 5%;" class="text-color-td table-border-color">
                                                ลำดับ</th>
                                            <th style="width: 50;" class="text-color-td table-border-color">
                                                รายการ</th>
                                            <th class="text-color-td table-border-color">จำนวนเงิน</th>
                                            <th class="text-color-td table-border-color">VAT 7%</th>
                                            <th class="text-color-td table-border-color">รวมค่าใช้จ่าย</th>
                                            <th class="text-color-td table-border-color">หัก ภาษี ณ ที่จ่าย
                                                1 %</th>
                                            <th class="text-color-td table-border-color">
                                                คิดเป็นเงินที่จะจ่าย</th>
                                            <th class="text-color-td table-border-color">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                            // $Dinfos = \App\Models\BudgetsCertificateDetail::select(DB::raw('budgets_costs.year_budget'))->leftJoin('budgets_costs', 'budgets_certificate_detail.budget_costs_id', '=', 'budgets_costs.id')->where('budgets_certificate_detail.certificate_id', $id)->where('budgets_certificate_detail.is_deleted', '0')->where('budgets_certificate_detail.is_active','1')->groupBy('budgets_costs.year_budget')->orderBy('budgets_costs.year_budget', 'ASC')->get();

                                            // for ($i=10; $i <= 12; $i++) { 
                                                

                                                // $Dinfos = \App\Models\BudgetsCertificateDetail::select(DB::raw('budgets_costs.year_budget'))->leftJoin('budgets_costs', 'budgets_certificate_detail.budget_costs_id', '=', 'budgets_costs.id')->where('budgets_certificate_detail.certificate_id', $id)->where('budgets_costs.year_budget', $i)->where('budgets_certificate_detail.is_deleted', '0')->where('budgets_certificate_detail.is_active','1')->groupBy('budgets_costs.year_budget')->orderBy('budgets_costs.year_budget', 'ASC')->get();
                                                // $items = BudgetsCertificateDetail::where('certificate_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                // if (count($Dinfos) > 0){

                                                    // $Dinfos = \App\Models\BudgetsCertificateDetail::find((int) $id);
                                        ?>
                                                    <!-- <tr>
                                                        <td class="border-rl"></td>
                                                        <th class="text-color-td border-rl">เดือน พฤศจิกายน 2563</th>
                                                        <td class="border-rl"></td>
                                                        <td class="border-rl"></td>
                                                        <td class="border-rl"></td>
                                                        <td class="border-rl"></td>
                                                        <td class="border-rl"></td>
                                                        <td class="border-rl">งบปี 64</td>
                                                    </tr> -->
                                                        <?php 
                                                            $noitem = 0;
                                                            $sum = 0;
                                                            $sum1 = 0;
                                                            $sum2 = 0;
                                                            $sum3 = 0;
                                                            $sum4 = 0;
                                                        ?>
                                                        @if (!empty($items))
                                                        @foreach ($items as $item)
                                                        <?php $noitem++;?>
                                                        <?php 
                                                        
                                                            $Dinfos = \App\Models\BudgetsCosts::find((int) $item['budget_costs_id']);

                                                            $Details = \App\Models\BudgetsrDetail::find((int) $Dinfos->projects_id);
                                                        ?>
                                                        <tr>
                                                            <td class="text-center border-rl">{{$noitem}}</td>
                                                            <td class="text-color-td border-rl">{{$Details->name}}</td>
                                                            <td class="text-color-td text-right border-rl">{{number_format($item['certificate_detail_money'],2,'.',',')}}<?php $sum += $item['certificate_detail_money'];?></td>
                                                            <td class="text-color-td text-right border-rl">{{number_format(($item['certificate_detail_money'] * 7) / 100,2,'.',',')}}<?php $sum1 += ($item['certificate_detail_money'] * 7) / 100;?></td>
                                                            <td class="text-color-td text-right border-rl">{{number_format($item['certificate_detail_money'] + ($item['certificate_detail_money'] * 7) / 100,2,'.',',')}}<?php $sum2 += $item['certificate_detail_money'] + ($item['certificate_detail_money'] * 7) / 100;?></td>
                                                            <td class="text-color-td text-right border-rl">{{number_format($item['certificate_detail_tax'],2,'.',',')}}<?php $sum3 += $item['certificate_detail_tax'];?></td>
                                                            <td class="text-color-td text-right border-rl">{{number_format(($item['certificate_detail_money'] + ($item['certificate_detail_money'] * 7) / 100) - $item['certificate_detail_tax'],2,'.',',')}}<?php $sum4 += ($item['certificate_detail_money'] + ($item['certificate_detail_money'] * 7) / 100) - $item['certificate_detail_tax'];?></td>
                                                            <td class="text-color-td text-right border-rl"></td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                        <tr>
                                                            <th class="text-color-td table-border-color border-rl"></th>
                                                            <th class="text-color-td table-border-color border-rl"></th>
                                                            <th class="text-color-td text-right table-border-color">
                                                            {{number_format($sum,2,'.',',')}}</th>
                                                            <th class="text-color-td text-right table-border-color">
                                                            {{number_format($sum1,2,'.',',')}}</th>
                                                            <th class="text-color-td text-right table-border-color">
                                                            {{number_format($sum2,2,'.',',')}}</th>
                                                            <th class="text-color-td text-right table-border-color">
                                                            {{number_format($sum3,2,'.',',')}}
                                                            </th>
                                                            <th class="text-color-td text-right table-border-color">
                                                            {{number_format($sum4,2,'.',',')}}</th>
                                                            <th class="text-color-td table-border-color">(a)</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="5"
                                                                class="text-center text-color-td border-none-brl">
                                                                รวมเป็นจำนวนเงินที่ต้องจ่าย
                                                                (ห้าแสนเก้าพันห้าสิบเจ็ดบาทยี่สิบห้าสตางค์)</th>
                                                            <th class="text-color-td text-right table-border-color border-double-bottom">{{number_format($sum3,2,'.',',')}}
                                                            </th>
                                                            <th class="text-color-td text-right table-border-color border-double-bottom">
                                                            {{number_format($sum4,2,'.',',')}}</th>
                                                            <th class="text-color-td border-none-brl">(a)+(b)</th>
                                                        </tr>
                                        <?php
                                            //     }
                                            // }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-row mt-3">
                                        <div class="col-auto">
                                            <h4 class="font-16 mb-2 mr-3">คำอธิบาย : </h4>
                                        </div>
                                        <div class="col-auto">
                                            @if (!empty($items))
                                                @foreach ($items as $itemD)
                                                <?php $DinfoDs = \App\Models\BudgetsCosts::find((int) $itemD['budget_costs_id']); ?>
                                                    <h4 class="font-15 mb-2 mr-2"><i
                                                            class="fas fa-circle mr-1 font-size-12"></i>
                                                        ตามใบแจ้งหนี้เลขที่ <span class="ml-3">{{$DinfoDs->expense_item}}</span>
                                                        <span class="ml-3">ลงวันที่  {{getDateTimeTH($DinfoDs->date_report , false , false)}}</span>
                                                    </h4>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>


                                    
                                    
                                    <h4 class="font-15 mb-2 mr-2 text-ol-ml-mt"><i
                                            class="fas fa-circle mr-1 font-size-12"></i>
                                        หนังสือรายงานผลการตรวจรับพัสดุ+ขออนุมัติเบิกจ่าย เลขที่ สกนช.(บก.)
                                    </h4>         
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="fieldset-custom-text mt-5">
                                        <div class="text-center">
                                            <h4 class="font-15 mb-2">งานพัสดุ</h4>
                                            <h4 class="font-15 mb-4">
                                                ได้รับรายละเอียดการจ่ายเงินเรียบร้อยแล้ว</h4>
                                            <h4 class="font-15 mb-2">ลงชื่อ
                                                ............................................</h4>
                                            <h4 class="font-15 mb-2">วันที่
                                                ............................................</h4>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จัดทำ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้ตรวจ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้อนุมัติ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จ่ายเงิน</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">
                            <div class="font-15 mb-3 text-right color-text">ID :
                            {$info->certificate_id}}</div>
                            <h4 class="font-16 mb-3 text-center">สำนักงานกองทุนน้ำมันเชื้อเพลิง</h4>
                            <h4 class="font-16 mb-2 text-center">ใบสำคัญจ่าย</h4>
                            <div class="font-15 mb-3 text-right color-text">เลชที่
                            {{$info->certificate_num}}</div>
                            <div class="font-15 mb-3 text-right color-text">วันที่
                            {{getDateFormatToInputThai($info->certificate_date)}}</div>
                            <h4 class="font-16 mb-4">จ่ายให้ : <span class="ml-2 font-17"><?php
                                            $company = \App\Models\BudgetCertificateCompany::where('id', $info->certificate_payfor)->get();
                                            foreach($company as $val)
                                        ?>
                                        {{$val['company_name']}} </span></h4>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" type="checkbox" checked="checked" @if(1 == $info->certificate_type) checked @endif>
                                        <label for="checkbox1" class="font-15 font-checkbox mr-3">
                                            โอนเงินผ่านระบบอิเล็กทรอนิกส์
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2 mr-2">บัญชีเลขที่ <span class="ml-2">
                                    {{$info->certificate_bank_num}}</span>
                                    </h4>
                                    <h4 class="font-15 mb-2 mt-3 mr-2">ชื่อบัญชี <span class="text-ml-25">
                                    {{$info->certificate_bank_name}}</span>
                                    </h4>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2">ธนาคาร <span class="ml-2">
                                    {{$info->certificate_bank_account}}</span>
                                    </h4>
                                    <h4 class="font-15 mb-2 mt-3 mr-2">สาขา <span class="text-ml-25">
                                    {{$info->certificate_bank_branch}}</span>
                                    </h4>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" type="checkbox" @if(2 == $info->certificate_type) checked @endif>
                                        <label for="checkbox2" class="font-15 font-checkbox mr-3">
                                            เงินสด
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" type="checkbox" @if(3 == $info->certificate_type) checked @endif>
                                        <label for="checkbox1" class="font-15 font-checkbox mr-3">
                                            เช็คเลขที่ <span class="text-ml-25">
                                                ...................................</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="font-15 mb-2 mr-2">ลงวันที่ <span class="ml-2">
                                            .......................................</span> ธนาคารกรุงไทย
                                        จำกัด (มหาชน) สาขาถนนศรีอยุธยา
                                    </h4>
                                </div>
                            </div>

                            <div class="table-responsive mt-2">

                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 5%;" class="text-color-td table-border-color">
                                                ลำดับที่</th>
                                            <th style="width: 70%;" class="text-color-td table-border-color">
                                                รายการ</th>
                                            <th style="width: 10%;" class="text-color-td table-border-color">จำนวนเงิน</th>
                                            <th class="text-color-td table-border-color">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-color border-rl text-center">1</td>
                                            <td class="text-color-td border-rl">ค่าบริการต้นไม้ประดับ พร้อมคอนเทนเนอร์ใส่ต้นไม้</td>
                                            <td class="text-color border-rl text-right">4,940.00</td>
                                            <td rowspan="7" class="text-color border-rl border-bottom">งบปี 64</td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl"></td>
                                            <td class="text-color-td border-rl">(จำนวน 19 ต้น)</td>
                                            <td class="text-color border-rl"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl"></td>
                                            <td class="text-color-td border-rl">เดือน พฤศจิกายน 2563</td>
                                            <td class="text-color border-rl text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl"></td>
                                            <td class="text-color-td border-rl"><span class="font-weight-600">บวก</span> <span class="ml-5">VAT 7%</span></td>
                                            <td class="text-color border-rl text-right text-underline">345.80</td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl"></td>
                                            <th class="text-color-td border-rl text-right">รวมค่าใช้จ่าย</th>
                                            <td class="text-color border-rl text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl"></td>
                                            <td class="text-color-td border-rl"><span class="font-weight-600">หัก</span>  <span class="ml-5">ภาษี ณ ที่จ่าย 1 %</span></td>
                                            <td class="text-color border-rl text-right text-underline">(49.40)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-color border-rl border-bottom" style="height: 50px !important;"></td>
                                            <td class="text-color-td border-rl border-bottom"></td>
                                            <td class="text-color border-rl border-bottom"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2"
                                                class="text-right text-color-td border-none-brl">
                                                รวมเป็นจำนวนเงินที่ต้องจ่าย
                                                (ห้าพันสองร้อยสามสิบหกบาทสี่สิบสตางค์)</th>
                                            <th class="text-color-td text-right table-border-color border-double-bottom">5,236.40
                                            </th>
                                            <th class="text-color-td border-none-brl"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row mt-3">
                                        <div class="col-auto">
                                            <h4 class="font-16 mb-2 mr-3">คำอธิบาย : </h4>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="font-15 mb-2 mr-2"><i
                                                    class="fas fa-circle mr-1 font-size-12"></i>
                                                ตามใบแจ้งหนี้เลขที่ 103795 ลงวันที่ 26 พฤศจิกายน 2563
                                            </h4>
                                            <h4 class="font-15 mb-2 mr-2"><i
                                                    class="fas fa-circle mr-1 font-size-12"></i>
                                                รายงานผลตรวจรับ+อนุมัติเบิกจ่าย เลขที่ สกนช. (บก.) 448/2563 ลงวันที่ 4 ธันวาคม 2563
                                            </h4>
                                            <h4 class="font-15 mb-2 mr-2"><i
                                                    class="fas fa-circle mr-1 font-size-12"></i>
                                                (สำเนา) แบบแจ้งข้อมูลการรับเงินโอนผ่านระบบ KTB Corporate Online
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จัดทำ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้ตรวจ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้อนุมัติ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จ่ายเงิน</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div> -->

    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });


    $(function () {

        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-redirect-back").attr("data-url");

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
                'input[certificate_id]': {
                    required: true
                }
            },
            messages: {
                'input[certificate_id]': {
                    required: "กรุณากรอกข้อมูล"
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
            }
        });
    });
    

</script>

<script type="text/javascript">

$(document).on("change", "#certificate_payfor", function(){
    var _itemValue = $(this).val();

    $('#loadDetail').load('{{URL('office/budget/certificate/get/loadDetail')}}' + '/' + _itemValue);
});


</script>
@endsection
