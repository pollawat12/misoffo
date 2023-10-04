@extends('default.layouts.main')


@section('css')
<!-- Plugin css -->
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
<style>
    
</style>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายงานยุทธศาสตร์</a>
                            </li>
                            <li class="breadcrumb-item active">สถานะการด้านน้ำมัน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายงานสถานะการด้านน้ำมัน</h4>
                </div>
            </div>
        </div> 
        <!-- end page title --> 
        <form method="POST" id="frm-save" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="pr" value="{{$pr}}">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box display-calendar">
                        <div class="text-center">
                            <div class="form-row">
                                <div class="col-auto">
                                    <label class="header-title font-size-16 mt-2 mr-1">ค้นหาจากวันที่</label>
                                </div>
                                <div class="col-auto">
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" id="chackDay" name="chackDay" value="{{getDateFormatToInputThai($chackDay)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text table-bgcolor"><i class="mdi mdi-calendar text-white"></i></span>
                                            </div>
                                        </div><!-- input-group -->
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
                        <h4 class="header-title mb-2 font-size-18 text-center">PRICE STRUCTURE OF PETROLEUM
                            PRODUCT IN BANGKOK</h4>
                        <div class="header-title text-center ml-2r mb-2 font-size-14">วันที่ 2 กุมภาพันธ์ 2565
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table m-0 table-colored-bordered table-border-color">
                                <thead>
                                    <tr>
                                        <th class="text-center font-size-13 text-color-td p-0"></th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ราคา ณ โรงกลั่น</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ภาษีสรรพสามิด</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ภาษีเทศบาล</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            กองทุนน้ำมันเชื้อเพลิง</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            กองทุนอนุรักษ์</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ราคาขายส่ง</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ภาษีมูลค่าเพิ่ม</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ราคาขายส่งรวมภาษีมูลค่าเพิ่ม</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ค่าการตลาด</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ภาษีค่าการตลาด</th>
                                        <th class="text-center font-size-13 text-color-td p-0 pt-1">
                                            ราคาขายปลีก</th>
                                    </tr>
                                    <tr class="table-bgcolor">
                                        <th class="text-center font-size-17 border-table vertical-center">
                                            <div>
                                                UNIT:BAHT / LITRE
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                EX-REFIN.
                                            </div>
                                            <div>
                                                (AVG)
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                TAX
                                            </div>
                                            <div>
                                                B./LITRE
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                M. TAX
                                            </div>
                                            <div>
                                                B./LITRE
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                OIL
                                            </div>
                                            <div>
                                                FUND
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                CONSV.
                                            </div>
                                            <div>
                                                FUND
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                WHOLESALE
                                            </div>
                                            <div>
                                                PRICE(WS)
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table vertical-center">
                                            <div>
                                                VAT
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table vertical-center">
                                            <div>
                                                WS&VAT
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table">
                                            <div>
                                                MARKETING
                                            </div>
                                            <div>
                                                MARGIN
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table vertical-center">
                                            <div>
                                                VAT
                                            </div>
                                        </th>
                                        <th class="text-center font-size-17 border-table vertical-center">
                                            <div>
                                                RETAIL
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-color-td table-bordered border-top">ULG</th>
                                        <td class="text-center text-color-td table-bordered border-top">22.3279
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">6.5000
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">0.6500
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">7.1800
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">0.0050
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">36.6629
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.5664
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">39.2293
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.5521
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">0.1786
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">41.9600
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">GASOHOL95 E10</th>
                                        <td class="text-center text-color-td table-bordered">22.1771</td>
                                        <td class="text-center text-color-td table-bordered">5.8500</td>
                                        <td class="text-center text-color-td table-bordered">0.5850</td>
                                        <td class="text-center text-color-td table-bordered">1.0200</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">29.6371</td>
                                        <td class="text-center text-color-td table-bordered">2.0746</td>
                                        <td class="text-center text-color-td table-bordered">31.7117</td>
                                        <td class="text-center text-color-td table-bordered">2.6526</td>
                                        <td class="text-center text-color-td table-bordered">0.1857</td>
                                        <td class="text-center text-color-td table-bordered">34.5500</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">GASOHOL95</th>
                                        <td class="text-center text-color-td table-bordered">21.7644</td>
                                        <td class="text-center text-color-td table-bordered">5.8500</td>
                                        <td class="text-center text-color-td table-bordered">0.5850</td>
                                        <td class="text-center text-color-td table-bordered">1.0200</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">29.2244</td>
                                        <td class="text-center text-color-td table-bordered">2.0457</td>
                                        <td class="text-center text-color-td table-bordered">31.2702</td>
                                        <td class="text-center text-color-td table-bordered">2.8129</td>
                                        <td class="text-center text-color-td table-bordered">0.1969</td>
                                        <td class="text-center text-color-td table-bordered">34.2800</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">GASOHOL95 E20</th>
                                        <td class="text-center text-color-td table-bordered">22.1859</td>
                                        <td class="text-center text-color-td table-bordered">5.2000</td>
                                        <td class="text-center text-color-td table-bordered">0.5200</td>
                                        <td class="text-center text-color-td table-bordered">1.0200</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">28.0309</td>
                                        <td class="text-center text-color-td table-bordered">1.9622</td>
                                        <td class="text-center text-color-td table-bordered">29.9931</td>
                                        <td class="text-center text-color-td table-bordered">3.2214</td>
                                        <td class="text-center text-color-td table-bordered">0.2255</td>
                                        <td class="text-center text-color-td table-bordered">34.4400</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">GASOHOL95 E85</th>
                                        <td class="text-center text-color-td table-bordered">24.5463</td>
                                        <td class="text-center text-color-td table-bordered">0.9750</td>
                                        <td class="text-center text-color-td table-bordered">0.0975</td>
                                        <td class="text-center text-danger table-bordered">- 4.5300</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">21.0938</td>
                                        <td class="text-center text-color-td table-bordered">1.4766</td>
                                        <td class="text-center text-color-td table-bordered">22.5703</td>
                                        <td class="text-center text-color-td table-bordered">3.8969</td>
                                        <td class="text-center text-color-td table-bordered">0.2728</td>
                                        <td class="text-center text-color-td table-bordered">26.7400</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">H-DIESEL B7</th>
                                        <td class="text-center text-color-td table-bordered">24.5967</td>
                                        <td class="text-center text-color-td table-bordered">5.9900</td>
                                        <td class="text-center text-color-td table-bordered">0.5990</td>
                                        <td class="text-center text-danger table-bordered">- 3.0900</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">28.1007</td>
                                        <td class="text-center text-color-td table-bordered">1.9671</td>
                                        <td class="text-center text-color-td table-bordered">30.678</td>
                                        <td class="text-center text-danger table-bordered">- 0.1194</td>
                                        <td class="text-center text-danger table-bordered">- 0.0084</td>
                                        <td class="text-center text-color-td table-bordered">29.9400</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">H-DIESEL</th>
                                        <td class="text-center text-color-td table-bordered">24.5967</td>
                                        <td class="text-center text-color-td table-bordered">5.9900</td>
                                        <td class="text-center text-color-td table-bordered">0.5990</td>
                                        <td class="text-center text-danger table-bordered">- 3.0900</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">28.1007</td>
                                        <td class="text-center text-color-td table-bordered">1.9671</td>
                                        <td class="text-center text-color-td table-bordered">30.678</td>
                                        <td class="text-center text-danger table-bordered">- 0.1194</td>
                                        <td class="text-center text-danger table-bordered">- 0.0084</td>
                                        <td class="text-center text-color-td table-bordered">29.9400</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">H-DIESEL B20</th>
                                        <td class="text-center text-color-td table-bordered">24.5967</td>
                                        <td class="text-center text-color-td table-bordered">5.9900</td>
                                        <td class="text-center text-color-td table-bordered">0.5990</td>
                                        <td class="text-center text-danger table-bordered">- 3.0900</td>
                                        <td class="text-center text-color-td table-bordered">0.0050</td>
                                        <td class="text-center text-color-td table-bordered">28.1007</td>
                                        <td class="text-center text-color-td table-bordered">1.9671</td>
                                        <td class="text-center text-color-td table-bordered">30.678</td>
                                        <td class="text-center text-danger table-bordered">- 0.1194</td>
                                        <td class="text-center text-danger table-bordered">- 0.0084</td>
                                        <td class="text-center text-color-td table-bordered">29.9400</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">FO 600 (1) 2%S</th>
                                        <td class="text-center text-color-td table-bordered">17.9398</td>
                                        <td class="text-center text-color-td table-bordered">0.6400</td>
                                        <td class="text-center text-color-td table-bordered">0.0640</td>
                                        <td class="text-center text-color-td table-bordered">0.0600</td>
                                        <td class="text-center text-color-td table-bordered">0.0700</td>
                                        <td class="text-center text-color-td table-bordered">18.7738</td>
                                        <td class="text-center text-color-td table-bordered">1.2855</td>
                                        <td class="text-center text-color-td table-bordered">19.6502</td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">FO 1500 (2) 2%S</th>
                                        <td class="text-center text-color-td table-bordered">17.1334</td>
                                        <td class="text-center text-color-td table-bordered">0.6400</td>
                                        <td class="text-center text-color-td table-bordered">0.0640</td>
                                        <td class="text-center text-color-td table-bordered">0.0600</td>
                                        <td class="text-center text-color-td table-bordered">0.0700</td>
                                        <td class="text-center text-color-td table-bordered">17.9674</td>
                                        <td class="text-center text-color-td table-bordered">1.2351</td>
                                        <td class="text-center text-color-td table-bordered">18.8788</td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                        <td class="text-center text-color-td table-bordered"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered">LPG (UNIT:BAHT/KILO)</th>
                                        <td class="text-center text-color-td table-bordered">26.8574</td>
                                        <td class="text-center text-color-td table-bordered">2.1700</td>
                                        <td class="text-center text-color-td table-bordered">0.2170</td>
                                        <td class="text-center text-danger table-bordered">- 14.8686</td>
                                        <td class="text-center text-color-td table-bordered">0.0000</td>
                                        <td class="text-center text-color-td table-bordered">14.3728</td>
                                        <td class="text-center text-color-td table-bordered">1.0063</td>
                                        <td class="text-center text-color-td table-bordered">15.3821</td>
                                        <td class="text-center text-color-td table-bordered">3.2566</td>
                                        <td class="text-center text-color-td table-bordered">0.2280</td>
                                        <td class="text-center text-color-td table-bordered">18.8667</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-3">
                            <div class="form-row">
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-3 font-size-14">อัตราแลกเปลี่ยน (รายวัน)
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">=
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">33.4062
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-title ml-1 font-size-14">BAHT/$
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-3 font-size-14">เอทานอล
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">=
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">25.60
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-title ml-1 font-size-14">BAHT/LITRE
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-3 font-size-14">ไบโอดีเซล
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">=
                                    </div>
                                </div>
                                <div class="col-auto mr-3">
                                    <div class="header-title ml-1 font-size-14">57.27
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-title ml-1 font-size-14">BAHT/LITRE
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table m-0 table-colored-bordered table-border-color">
                                <thead>
                                    <tr class="table-bgcolor">
                                        <th class="text-center font-size-17 border-table">

                                        </th>
                                        <th class="text-center font-size-17 table-bordered">

                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            2020
                                        </th>
                                        <th class="text-center font-size-17 border-right-2">
                                            2021
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Jun-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Jul-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Aug-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Sep-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Oct-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Nov-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Dec-21
                                        </th>
                                        <th class="text-center font-size-17 table-bordered">
                                            Jan-21
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-color-td table-bordered border-top border-right-2">
                                            AVERAGE MARKETING MARGIN OF GASOLINE,GASOHOL,DIESEL (BANGKOK)</th>
                                        <td class="text-center text-color-td table-bordered border-top">1.98
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.30
                                        </td>
                                        <td
                                            class="text-center text-color-td table-bordered border-top border-right-2">
                                            2.14</td>
                                        <td class="text-center text-color-td table-bordered border-top">2.25
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.18
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.30
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.00
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">1.22
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.36
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">2.36
                                        </td>
                                        <td class="text-center text-color-td table-bordered border-top">1.43
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered border-right-2">GROSS REFINERY
                                            MARGIN</th>
                                        <td class="text-center text-color-td table-bordered">1.18</td>
                                        <td class="text-center text-color-td table-bordered">0.70</td>
                                        <td class="text-center text-color-td table-bordered border-right-2">
                                            0.89</td>
                                        <td class="text-center text-color-td table-bordered">0.48</td>
                                        <td class="text-center text-color-td table-bordered">0.70</td>
                                        <td class="text-center text-color-td table-bordered">0.86</td>
                                        <td class="text-center text-color-td table-bordered">1.16</td>
                                        <td class="text-center text-color-td table-bordered">1.59</td>
                                        <td class="text-center text-color-td table-bordered">1.55</td>
                                        <td class="text-center text-color-td table-bordered">1.55</td>
                                        <td class="text-center text-color-td table-bordered">1.30</td>
                                    </tr>
                                    <tr>
                                        <th class="text-color-td table-bordered border-right-2">AVERAGE
                                            MARKETING MARGIN OF DIESEL (BANGKOK)</th>
                                        <td class="text-center text-color-td table-bordered">1.86</td>
                                        <td class="text-center text-color-td table-bordered">2.07</td>
                                        <td class="text-center text-color-td table-bordered border-right-2">
                                            1.76</td>
                                        <td class="text-center text-color-td table-bordered">1.86</td>
                                        <td class="text-center text-color-td table-bordered">1.79</td>
                                        <td class="text-center text-color-td table-bordered">1.34</td>
                                        <td class="text-center text-color-td table-bordered">1.04</td>
                                        <td class="text-center text-color-td table-bordered">0.73</td>
                                        <td class="text-center text-color-td table-bordered">2.36</td>
                                        <td class="text-center text-color-td table-bordered">2.36</td>
                                        <td class="text-center text-color-td table-bordered">0.78</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="header-title ml-5 font-size-14"><span class="text-danger mr-1">*</span>  ข้อมูลจำเป็นการประมาณการเบื้องต้น
                        </div>
                        <div class="header-title ml-3 font-size-14">หมายเหตุ : โครงสร้างราคาน้ำมันเชื้อเพลิงนี้จัดทำขึ้นเผยแพร่ให้สาธารณะใช้เพื่อการอ้างอิง มิใช่ราคาซื้อขายที่ภาครัฐกำหนด
                        </div>
                        <div class="title-cus ml-3 font-size-14">Remark : This retail price structure is only for public reference; it is not the government control price.
                        </div>    
                    </div>
                </div>
            </div>
            <!-- end row -->
        </form>
        
    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<div id="url-redirect-back" data-url="{{url('dashboard/strategy')}}?t={{$t}}&pr={{$pr}}"></div>

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/main.js') }}"></script>
<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/locales-all.js') }}"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });


    $(document).on("change", "#chackDay", function(){

        var urlRedirect = $("#url-redirect-back").attr("data-url");

        // alert('testtest');
        $.ajax({
            type: "POST",
            url: '{{url('dashboard/strategy/load')}}',
            data: $('#frm-save').serialize(),
            dataType: "json",
            success: function(msg){

                window.location.href = urlRedirect + '&chackdate=' + msg.chackDay;
            }
        });
    });
</script>
@endsection