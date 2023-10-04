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

                            <?php $sumprice = 0; ?>
                            @if (!empty($items))
                                @foreach ($items as $item)
                                    <?php
                                        $row = \App\Models\BudgetsCostsOil::find((int) $item->budget_costs_id);

                                        // $sumprice = ($row->compensate_oile20_price * $row->compensate_oile20_liter) + ($row->compensate_oile85_price * $row->compensate_oile85_liter) + ($row->compensate_oiled_price * $row->compensate_oiled_liter) + ($row->compensate_oild10_price + $row->compensate_oild10_liter) + ($row->compensate_oild20_price * $row->compensate_oild20_liter) + ($row->compensate_lpg_price * $row->compensate_lpg_liter);
                                        $sumprice = $row->compensate_oile20_price + $row->compensate_oile85_price + $row->compensate_oiled_price + $row->compensate_oild10_price + $row->compensate_oild20_price + $row->compensate_lpg_price;
                                    ?>
                                @endforeach
                            @endif

                            <div class="table-responsive mt-2">

                                <table class="table table-borderless mb-0">
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
                                            <td class="text-color-td border-rl text-center">1</td>
                                            <td class="text-color-td border-rl">เบิกเงินชดเชยจากกองทุนน้ำมันเชื้อเพลิง</td>
                                            <td class="text-color-td border-rl text-right">{{number_format($sumprice,2,'.',',')}}</td>
                                            <td rowspan="7" class="text-color border-rl border-bottom"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl">{{$info->certificate_note}}</td>
                                            <td class="text-color-td border-rl"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl text-right">จำนวนเงินรวม</td>
                                            <td class="text-color-td border-rl text-right">{{number_format($sumprice,2,'.',',')}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl"></td>
                                            <td class="text-color-td border-rl text-right"><span class="font-weight-600 text-underline">หัก</span> ภาษีหัก ณ ที่จ่าย 1 %</td>
                                            <td class="text-color-td border-rl text-right text-underline">({{number_format(($sumprice * 1)/100,2,'.',',')}})</td>
                                        </tr>
                                        <tr>
                                            <td class="text-color-td border-rl border-bottom"></td>
                                            <th class="text-color-td border-rl text-right border-bottom">รวมทั้งสิ้น</th>
                                            <th class="text-color-td border-rl text-right border-bottom">{{number_format( $sumprice - (($sumprice * 1)/100),2,'.',',')}}</th>
                                        </tr>
                                        <?php

                                            $sumall = $sumprice - (($sumprice * 1)/100);

                                            function Convert($amount_number)
                                            {
                                                $amount_number = number_format($amount_number, 2, ".","");
                                                $pt = strpos($amount_number , ".");
                                                $number = $fraction = "";
                                                if ($pt === false) 
                                                    $number = $amount_number;
                                                else
                                                {
                                                    $number = substr($amount_number, 0, $pt);
                                                    $fraction = substr($amount_number, $pt + 1);
                                                }
                                                
                                                $ret = "";
                                                $baht = ReadNumber ($number);
                                                if ($baht != "")
                                                    $ret .= $baht . "บาท";
                                                
                                                $satang = ReadNumber($fraction);
                                                if ($satang != "")
                                                    $ret .=  $satang . "สตางค์";
                                                else 
                                                    $ret .= "ถ้วน";
                                                return $ret;
                                            }
                                        
                                            function ReadNumber($number)
                                            {
                                                $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
                                                $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
                                                $number = $number + 0;
                                                $ret = "";
                                                if ($number == 0) return $ret;
                                                if ($number > 1000000)
                                                {
                                                    $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
                                                    $number = intval(fmod($number, 1000000));
                                                }
                                                
                                                $divider = 100000;
                                                $pos = 0;
                                                while($number > 0)
                                                {
                                                    $d = intval($number / $divider);
                                                    $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : 
                                                        ((($divider == 10) && ($d == 1)) ? "" :
                                                        ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
                                                    $ret .= ($d ? $position_call[$pos] : "");
                                                    $number = $number % $divider;
                                                    $divider = $divider / 10;
                                                    $pos++;
                                                }
                                                return $ret;
                                            }
                                        
                                        
                                        ?>
                                        <tr>
                                            <th colspan="2"
                                                class="text-right text-color-td table-border-color table-bgcolor-body">
                                                รวมเป็นจำนวนเงินที่ต้องจ่ายเช็ค
                                                ({{Convert($sumall)}})</th>
                                            <th class="text-color-td text-right table-border-color table-bgcolor-body">{{number_format( $sumprice - (($sumprice * 1)/100),2,'.',',')}}
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
                                        <?php $no = 0;?>   
                                        @if (!empty($items))
                                            @foreach ($items as $itemd)
                                            <?php $no++;?>
                                            <?php $rowd = \App\Models\BudgetsCostsOil::find((int) $itemd->budget_costs_id); ?>
                                                <h4 class="font-15 mb-2 mr-2">
                                                    {{$no}}. หนังสือกรมสรรพสามิตที่ {{$rowd->compensate_num}} <span class="ml-3">ลงวันที่ {{getDateTimeTH($rowd->compensate_date , false , false)}}</span>
                                                </h4>
                                            @endforeach
                                        @endif
                                            <h4 class="font-15 mb-2 mr-2">
                                                (รวม {{$no}} เรื่อง)
                                            </h4>
                                            <h4 class="font-15 mb-2 mr-2 mt-3"><i
                                                    class="fas fa-circle mr-1 font-size-12"></i>
                                                (สำเนา) แบบแจ้งข้อมูลการรับเงินโอนผ่านระบบ KTB Corporate Online
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จัดทำ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้ตรวจ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้อนุมัติ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จ่ายเงิน</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้รับเอกสาร</h4>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">
                            <h4 class="font-16 mb-2 text-center">สำนักงานกองทุนน้ำมันเชื้อเพลิง</h4>
                            <h4 class="font-16 mb-2 text-center">สรุปรายละเอียดใบขอรับเงินชดเชยจากกองทุนน้ำมันเชื้อเพลิง</h4>
                            <h4 class="font-16 mb-4 text-center">รายบริษัท  <span class="ml-2"> </span></h4>

                            <div class="table-responsive mt-2">

                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color nowrap vertical-center" rowspan="2">
                                                ลำดับที่</th>
                                            <th class="text-color-td table-border-color nowrap vertical-center" rowspan="2">
                                                เลขที่หนังสือกรมสรรพสามิต</th>
                                            <th class="text-color-td table-border-color nowrap vertical-center" rowspan="2">ลงวันที่</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">น้ำมันแก๊สโซฮอล E20</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">น้ำมันแก๊สโซฮอล อี 85</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">น้ำมันดีเซลหมุนเร็วธรรมดา</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">น้ำมันดีเซลหมุนเร็ว B 10</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">น้ำมันดีเซลหมุนเร็ว B 20</th>
                                            <th class="text-color-td table-border-color nowrap" colspan="2">ก๊าซปิโตรเลียมเหลว (LPG)</th>
                                            <th class="text-color-td table-border-color table-bgcolor-body nowrap" colspan="2">จำนวนรวม</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)</div>
                                            </th>
                                            <th class="text-color-td table-border-color nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                            <th class="text-color-td table-border-color table-bgcolor-body nowrap">
                                                <div>ปริมาณ</div>
                                                <div>(ลิตร)/(กิโลกรัม)</div>
                                            </th>
                                            <th class="text-color-td table-border-color table-bgcolor-body nowrap">
                                                <div>จำนวนเงินขอรับชดเชย</div>
                                                <div>(บาท)</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                            
                                            $nof = 0;
                                            $oilliter1 = 0;
                                            $oilprice1 = 0;
                                            $oilliter2 = 0;
                                            $oilprice2 = 0;
                                            $oilliter3 = 0;
                                            $oilprice3 = 0;
                                            $oilliter4 = 0;
                                            $oilprice4 = 0;
                                            $oilliter5 = 0;
                                            $oilprice5 = 0;
                                            $oilliter6 = 0;
                                            $oilprice6 = 0;
                                            $oilliterall = 0;
                                            $oilpriceall = 0;
                                        ?>   
                                        @if (!empty($items))
                                            @foreach ($items as $itemf)
                                            <?php $nof++;?>
                                            <?php $rowf = \App\Models\BudgetsCostsOil::find((int) $itemf->budget_costs_id); 

                                                        $pricef = $rowf->compensate_oile20_price + $rowf->compensate_oile85_price + $rowf->compensate_oiled_price + $rowf->compensate_oild10_price + $rowf->compensate_oild20_price + $rowf->compensate_lpg_price;

                                                        $literf = $rowf->compensate_oile20_liter + $rowf->compensate_oile85_liter + $rowf->compensate_oiled_liter + $rowf->compensate_oild10_liter + $rowf->compensate_oild20_liter + $rowf->compensate_lpg_liter;

                                                        $oilpriceall += $pricef;
                                                        $oilliterall += $literf;
                                            ?>          
                                                <tr>
                                                    <td class="text-color-td table-border-color text-center">{{$nof}}</td>
                                                    <td class="text-color-td table-border-color">{{$rowf->compensate_num}}</td>
                                                    <td class="text-color-td table-border-color text-center nowrap">{{getDateTimeTH($rowf->compensate_date , false , true)}}</td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oile20_liter,2,'.',',')}} <?php $oilliter1 +=  $rowf->compensate_oile20_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oile20_price,2,'.',',')}} <?php $oilprice1 +=  $rowf->compensate_oile20_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oile85_liter,2,'.',',')}} <?php $oilliter2 +=  $rowf->compensate_oile85_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oile85_price,2,'.',',')}} <?php $oilprice2 +=  $rowf->compensate_oile85_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oiled_liter,2,'.',',')}} <?php $oilliter3 +=  $rowf->compensate_oiled_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oiled_price,2,'.',',')}} <?php $oilprice3 +=  $rowf->compensate_oiled_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oild10_liter,2,'.',',')}} <?php $oilliter4 +=  $rowf->compensate_oild10_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oild10_price,2,'.',',')}} <?php $oilprice4 +=  $rowf->compensate_oild10_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oild20_liter,2,'.',',')}} <?php $oilliter5 +=  $rowf->compensate_oild20_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_oild20_price,2,'.',',')}} <?php $oilprice5 +=  $rowf->compensate_oild20_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_lpg_liter,2,'.',',')}} <?php $oilliter6 +=  $rowf->compensate_lpg_liter; ?></td>
                                                    <td class="text-color-td table-border-color text-right">{{number_format($rowf->compensate_lpg_price,2,'.',',')}} <?php $oilprice6 +=  $rowf->compensate_lpg_price; ?></td>
                                                    <td class="text-color-td table-border-color text-right table-bgcolor-body">{{number_format($literf,2,'.',',')}}</td>
                                                    <td class="text-color-td table-border-color text-right table-bgcolor-body">{{number_format($pricef,2,'.',',')}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td class="text-color-td table-border-color text-center" colspan="2">รวม</td>
                                            <td class="text-color-td table-border-color text-center nowrap"></td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter1,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice1,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter2,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice2,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter3,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice3,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter4,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice4,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter5,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice5,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilliter6,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right">{{number_format($oilprice6,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right table-bgcolor-body">{{number_format($oilliterall,2,'.',',')}}</td>
                                            <td class="text-color-td table-border-color text-right table-bgcolor-body">{{number_format($oilliterall,2,'.',',')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-5">
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้จัดทำ</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้ทาน</h4>
                                        <h4 class="font-15 mb-2">__________________________________</h4>
                                        <h4 class="font-15 mb-2">........../........../..........</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center">
                                        <h4 class="font-15 mb-2">ผู้ตรวจ</h4>
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
