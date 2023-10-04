@extends('default.layouts.main')


@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แดชบอร์ด</a></li>
                            <li class="breadcrumb-item active">ภาพรวมรายรับ-รายจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ภาพรวมรายรับ-รายจ่าย</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-5"></div>
                        <div class="col-md-3">
                            <label for="">ระบุปีงบประมาณ :</label>
                            <select name="" class="form-control" id="">
                                <option value="">ระบุ</option>
                                <option value="2564" selected>ปี 2564</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-xl-4 col-sm-12">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/currency_exchange.svg" title="clock.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">รายรับทั้งหมด (ปี 2564)</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->income_totals }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-12">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/debt.svg" title="advertising.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">รายจ่ายทั้งหมด (ปี 2564)</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->expense_totals }}</span></h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-4 col-sm-12">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/planner.svg" title="paid.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">รายรับ (เดือนกันยายน)</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->income_month }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card-box height-box" style="height: 531px !important;">
                    <h4 class="header-title mb-3 font-size-18 text-center">รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                    <!-- <img class="graph-img" 
                            src="{{url('assets/default')}}/images/layouts/graph-1.jpg"
                            title="document.svg">-->
                            
                            <div class="chart mt-3" id="column-chart" style="height: 450px;"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-box height-box" style="height: 531px !important;">
                    <h4 class="header-title mb-3 font-size-18 text-center">รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                    <!-- <img class="graph-img" 
                            src="{{url('assets/default')}}/images/layouts/graph-1.jpg"
                            title="document.svg"> -->

                            <div class="chart mt-3" id="column-chart-1" style="height: 450px;"></div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title mb-3 font-size-18 text-center"><img class="icon-img mr-1"
                            src="{{url('assets/default')}}/images/icons/document.svg"
                            title="document.svg"> รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>


                            <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-border-color nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">รายการ</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">พ.ค. 65</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">มิ.ย. 65</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ก.ค. 65</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ส.ค. 65</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ก.ย. 65</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="border-top font-16 text-color-td border-none-b border-r padding-table-dash">รายรับจากน้ำมันเชื้อเพลิง</th>
                                                <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                                <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                                <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                                <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                                <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินรับจากการจัดเก็บน้ำมันเชื้อเพลิงประเภทต่างๆ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินรับคืนจากการปรับภาษีสรรพสามิต</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินเรี่ยไร(เงินที่ได้รับการสนับสนุนจาก บ. ปตท.)</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,000,000,000.00</td>
                                            </tr>
                                            <!-- จบก้อนแรก -->

                                            <tr>
                                                <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-g">รวมเงินเรียกเก็บเข้ากองทุน</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">ดอกเบี่ยรับเงินฝากธนาคาร</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">6,542,093.45 </td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินรับคืนและดอกผลจากงบโครงการ/งบบริหาร</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">รายได้อื่นๆ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">11,998.97</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">550,000.00</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">550,000.00</td>
                                            </tr>
                                            <!-- จบก้อน 2 -->

                                            <tr>
                                                <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-p">รวมเงินสดรับ</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th class="font-16 text-color-td border-none-tb border-r padding-table-dash">รายจ่ายชดเชยน้ำมันเชื้อเพลิง</th>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายชดเชย LPG ที่จำหน่ายในประเทศ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">3,012,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายชดเชย LPG โรงกลั่น</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายชดเชย LPG ที่ได้จากการสัมปทานตามกฎหมาย</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายชดเชย NGV</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายชดเชยน้ำมันเชื้อเพลิงประเภทต่างๆ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายเงินคืนให้ผู้ประกอบการ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">จ่ายเงินจากการปรับลดภาษีสรรพสามิต</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <!-- จบก้อน 3 -->

                                            <tr>
                                                <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-g">รวมเงินจ่ายชดเชย</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">ค่าใช้จ่ายสนับสนุนงบโครงการ/งบบริหาร</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">ค่าใช้จ่ายอื่นๆ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">1,012,360,215.13</td>
                                            </tr>
                                            <!-- จบก้อน 4 -->

                                            <tr>
                                                <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-p">รวมเงินสดจ่าย</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th class="font-16 text-color-td border-none-tb border-r padding-table-dash table-bgcolor-dash-b ">เงินสดรับ - จ่าย สุทธิ ก่อนเช็คระหว่างเรียกเก็บ</th>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash table-bgcolor-dash-b ">- 3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash table-bgcolor-dash-b ">- 3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash table-bgcolor-dash-b ">- 3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash table-bgcolor-dash-b ">- 3,012,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash table-bgcolor-dash-b ">- 3,012,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินรับจากรายการค้างรับ*</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เช็คสั่งจ่ายงวดปัจจุบันอยู่ระหว่างเรียกเก็บ</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เงินรับอยู่ระหว่างเรียกเก็บ*</td>
                                                <td class="text-danger border-none-tb border-r text-right padding-table-dash">(77,922,717.00)</td>
                                                <td class="text-danger border-none-tb border-r text-right padding-table-dash">(77,922,717.00)</td>
                                                <td class="text-danger border-none-tb border-r text-right padding-table-dash">(77,922,717.00)</td>
                                                <td class="text-danger border-none-tb border-r text-right padding-table-dash">(77,922,717.00)</td>
                                                <td class="text-danger border-none-tb border-r text-right padding-table-dash">(77,922,717.00)</td>
                                            </tr>
                                            <tr>
                                                <td class="text-color-td-sub border-none-tb border-r padding-table-dash">เช็คสั่งจ่ายงวดก่อนเรียกเก็บงวดปัจจุบัน</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">2,360,215.13</td>
                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash">-</td>
                                            </tr>
                                            <!-- จบก้อน 4 -->

                                            <tr>
                                                <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor-dash-p">เงินสดรับ (จ่าย) ประจำงวด</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">- 3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">- 3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">- 3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor-dash-p">เงินฝากยกมา</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-p">3,012,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor">เงินฝากปลายงวด</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor">3,012,360,215.13</th>
                                                <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor">3,012,360,215.13</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->


        
    </div> <!-- end container-fluid -->

</div> <!-- end content -->

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{url('assets/default')}}/libs/jszip/jszip.min.js"></script>
<script src="{{url('assets/default')}}/libs/pdfmake/pdfmake.min.js"></script>
<script src="{{url('assets/default')}}/libs/pdfmake/vfs_fonts.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Google Charts js -->
<script>
    $(function(){
        $("#datatable").DataTable({
            "ordering": true,
            "autoWidth": false,
            "columnDefs": [
                { "width": "8%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "30%", "targets": 2 },
                { "width": "30%", "targets": 3 },
                { "width": "15%", "targets": 4 }
            ],
            "oLanguage": {
                "sZeroRecords": "-ไม่พบรายการข้อมูล-",
                "sLengthMenu": "แสดง  _MENU_  รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
                "sSearch": "ค้นหา"
            }
        });
    });


    // Highcharts.chart('column-chart', {
    //     chart: {
    //         type: 'column'
    //     },
    //     title: {
    //         text: ''
    //     },
    //     exporting:false,
    //     subtitle: {
    //         text: ''
    //     },
    //     xAxis: {
    //         type: 'category',
    //         labels: {
    //             rotation: -45,
    //             style: {
    //                 fontSize: '13px',
    //                 fontFamily: 'Verdana, sans-serif'
    //             }
    //         }
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: 'รายรับ (ล้านบาท)'
    //         }
    //     },
    //     legend: {
    //         enabled: false
    //     },
    //     tooltip: {
    //         pointFormat: 'รายรับ : <b>{point.y:.2f} ล้านบาท</b>'
    //     },
    //     series: [{
    //         name: 'รายรับ',
    //         data: [
    //             @if($income_info && count($income_info) > 0)
    //             @foreach($income_info as $arr)
    //             ['{{ $arr->label }}', {{ (float) $arr->amount}}],
    //             @endforeach
    //             @endif
    //         ],
    //         dataLabels: {
    //             enabled: true,
    //             rotation: -90,
    //             color: '#FFFFFF',
    //             align: 'right',
    //             format: '{point.y:.2f}', // one decimal
    //             y: 10, // 10 pixels down from the top
    //             style: {
    //                 fontSize: '13px',
    //                 fontFamily: 'Verdana, sans-serif'
    //             }
    //         }
    //     }]
    // });

    Highcharts.chart('column-chart', {
        chart: {
            type: 'spline'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            accessibility: {
                description: 'Months of the year'
            }
        },
        yAxis: {
            title: {
                text: 'บาท'
            },
            labels: {
                formatter: function () {
                    return this.value + '';
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'รายจ่าย',
            marker: {
                symbol: 'square'
            },
            data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, 26.4, 22.8, 17.5, 12.1, 7.6]

        }, {
            name: 'รายรับ',
            marker: {
                symbol: 'diamond'
            },
            data: [1.5, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
        }]
    });

    Highcharts.chart('column-chart-1', {
        chart: {
            type: 'spline'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            accessibility: {
                description: 'Months of the year'
            }
        },
        yAxis: {
            title: {
                text: 'บาท'
            },
            labels: {
                formatter: function () {
                    return this.value + '';
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'รายจ่าย',
            marker: {
                symbol: 'square'
            },
            data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, 26.4, 22.8, 17.5, 12.1, 7.6]

        }, {
            name: 'รายรับ',
            marker: {
                symbol: 'diamond'
            },
            data: [1.5, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
        }]
    });


    Highcharts.chart('line-chart', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        exporting:false,
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
</script>
@endsection