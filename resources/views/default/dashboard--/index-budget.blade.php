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
                            <li class="breadcrumb-item active">ภาพรวมงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ภาพรวมงบประมาณ</h4>
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

        <!-- end page title -->
        <div class="row">
                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->

                                <div class="chart mt-3" id="column-chart" style="height: 450px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="column-chart-1" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h4 class="header-title font-size-18 text-center"><img class="icon-img mr-1"
                                        src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg"> หน่วยงาาน
                                    สำนักงานกองทุนน้ำมันเชื้อเพลิง</h4>
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    แผนการใช้เงินกองทุนน้ำมันเชื้อเพลิง ปี 2565</h4>



                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-border-color nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash"
                                                    rowspan="2" colspan="3">
                                                    รายการ</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash"
                                                    colspan="4">
                                                    ไตรมาส 1 ปีงบประมาณ 2565</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash"
                                                    colspan="4">
                                                    ไตรมาส 2 ปีงบประมาณ 2565</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash"
                                                    colspan="4">
                                                    ไตรมาส 3 ปีงบประมาณ 2565</th>
                                                <th class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash"
                                                    colspan="4">
                                                    ไตรมาส 4 ปีงบประมาณ 2565</th>

                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ต.ค. 64</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    พ.ย. 64</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ธ.ค. 64</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    รวมไตรมาส</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ม.ค. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ก.พ. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    มี.ค. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    รวมไตรมาส</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    เม.ย. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    พ.ค. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    มิ.ย. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    รวมไตรมาส</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ก.ค. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ส.ค. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    ก.ย. 65</th>
                                                <th
                                                    class="text-center font-size-17 text-color-td vertical-center table-border-color padding-table-dash">
                                                    รวมไตรมาส</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th
                                                    class="text-color-td border-top border-none-b border-none-r text-center padding-table-dash font-16 table-bgcolor-dash-o">
                                                    1</th>
                                                <th class="text-color-td border-top border-none-b border-none-r padding-table-dash font-16 table-bgcolor-dash-o"
                                                    colspan="2">
                                                    งบบุคลากร</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-top border-none-b table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-blue border-none-tb text-center padding-table-dash font-16">
                                                    1.1</th>
                                                <th
                                                    class="text-blue border-none-tb text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    1.1</th>
                                                <th
                                                    class="text-blue border-none-tb padding-table-dash font-16 table-bgcolor-dash-b">
                                                    เงินเดือน</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                            </tr>

                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.1.1</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - เจ้าหน้าที่ 22 คน</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    2,360,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.1.2</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าช่วยเหลือค่าครองชีพ</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.1.3</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าตอบแทนพื้นฐานผู้อำนวยการ+ประโยชน์ตอบแทน</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <!-- จบ 1.1 -->

                                            <tr>
                                                <th
                                                    class="text-blue border-none-b text-center padding-table-dash font-16">
                                                    1.2</th>
                                                <th
                                                    class="text-blue border-none-tb text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    1.2</th>
                                                <th
                                                    class="text-blue border-none-tb padding-table-dash font-16 table-bgcolor-dash-b">
                                                    ค่าสวัสดิการ</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    360,215.13</th>
                                            </tr>

                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.2.1</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - กองทุนสำรองเลี้ยงชีพ</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.2.2</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าตอบแทนผันแปร (Performance)</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    1.2.3</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าประกันสุขภาพ (ประกันชีวิตแบบกลุ่ม)</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-danger border-right-n padding-table-dash text-center">
                                                    1.2.4</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่ารักษาพยาบาล</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-danger border-right-n padding-table-dash text-center">
                                                    1.2.5</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าตรวจสุขภาพประจำปี</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <!-- จบ 1.2 -->

                                            <tr>
                                                <th
                                                    class="text-color-td border-none-b border-none-r text-center padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2</th>
                                                <th class="text-color-td border-none-b border-none-r padding-table-dash font-16 table-bgcolor-dash-o"
                                                    colspan="2">
                                                    งบดำเนินงาน</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-color-td border-none-tb table-border-color padding-table-dash font-16 table-bgcolor-dash-o">
                                                    2,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-blue border-none-tb text-center padding-table-dash font-16">
                                                    2.1</th>
                                                <th
                                                    class="text-blue border-none-tb text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2.1</th>
                                                <th
                                                    class="text-blue border-none-tb padding-table-dash font-16 table-bgcolor-dash-b">
                                                    ค่าตอบแทน ใช้สอย และวัสดุ</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-blue border-none-tb table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-b">
                                                    2,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-success border-none-b border-right-n text-center padding-table-dash font-16">
                                                    2.1.1</th>
                                                <th
                                                    class="text-success border-none-tb text-center padding-table-dash font-16 table-bgcolor-dash-gr">
                                                    2.1.1</th>
                                                <th
                                                    class="text-success border-none-tb padding-table-dash font-16 table-bgcolor-dash-gr">
                                                    ค่าตอบแทน</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    2.1.1.1</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash">
                                                    (1) ค่าเบี้ยประชุม</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    2.1.1.1.1</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - กบน.</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    2.1.1.1.2</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - อนุกรรมาร (ตรวจสอบ อบน. กม. ประเมินผลฯ บุคลากร)</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    2.1.1.2</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash">
                                                    (2) ค่าล่วงเวลา</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-success border-none-b border-right-n text-center padding-table-dash font-16">
                                                    2.1.2</th>
                                                <th
                                                    class="text-success border-none-tb text-center padding-table-dash font-16 table-bgcolor-dash-gr">
                                                    2.1.2</th>
                                                <th
                                                    class="text-success border-none-tb padding-table-dash font-16 table-bgcolor-dash-gr">
                                                    ค่าใช้สอย</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                                <th
                                                    class="text-success border-none-tb table-border-color text-right padding-table-dash table-bgcolor-dash-gr">
                                                    2,360,215.13</th>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash text-center">
                                                    2.1.2.1</td>
                                                <td
                                                    class="text-color-td-sub border-right-n padding-table-dash">
                                                </td>
                                                <td
                                                    class="text-color-td-sub border-r padding-table-dash-sub">
                                                    - ค่าเช่าทรัพน์สินที่อาคาร ENCO</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    0,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                                <td
                                                    class="text-color-td-sub border-r text-right padding-table-dash">
                                                    60,215.13</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                text: 'บาท'
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
            name: 'รายจ่าย',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'รายรับ',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
</script>
@endsection