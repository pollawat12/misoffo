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
                <div class="card-box height-box">
                    <h4 class="header-title mb-3 font-size-18 text-center">รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                    <img class="graph-img"
                            src="{{url('assets/default')}}/images/layouts/graph-1.jpg"
                            title="document.svg"> 
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-box height-box">
                    <h4 class="header-title mb-3 font-size-18 text-center">รายรับรายจ่ายกองทุนน้ำมันเชื้อเพลิง ประจำเดือน กันยายน 2565</h4>
                    <img class="graph-img"
                            src="{{url('assets/default')}}/images/layouts/graph-1.jpg"
                            title="document.svg"> 

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
                                    @if ($info)
                                        @foreach ($info as $infos)
                                            <th class="text-center font-size-17 text-color-td vertical-center table-border-color">{{getDateMonthTH($infos->asset_date)}}</th>
                                        @endforeach
                                    @endif
                                    
                                    <!-- <th class="text-center font-size-17 text-color-td vertical-center table-border-color">มิ.ย. 65</th>
                                    <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ก.ค. 65</th>
                                    <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ส.ค. 65</th>
                                    <th class="text-center font-size-17 text-color-td vertical-center table-border-color">ก.ย. 65</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                ?>
                                @if ($institution)
                                    @foreach ($institution as $item)
                                <?php $no++;?>
                                        <tr>
                                            <?php if($item['id'] == 914){ ?> 
                                                <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor-dash-p">{{$item['name']}}</th>
                                            <?php }elseif($item['id'] == 915){ ?> 
                                                <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor-dash-p">{{$item['name']}}</th>
                                            <?php }else{ ?> 
                                                <th class="border-top font-16 text-color-td border-none-b border-r padding-table-dash">{{$item['name']}}</th>
                                            <?php } ?>
                                            
                                            @if ($info)
                                                @foreach ($info as $infos1)
                                                    <td class="border-top text-color-td border-none-b border-r padding-table-dash text-right"></td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <?php             
                                            $valdetails = \App\Models\DataSetting::where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->where('data_value','1')->get();
                                            if (!empty($valdetails)){
                                                foreach ($valdetails as $valdetail){

                                                    // $FundDetail1 = \App\Models\AssetFundDetail::where('asset_id', $id)->where('type_id', $valdetail['id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                        ?>  
                                                    <tr>
                                                        <td class="text-color-td-sub border-none-tb border-r padding-table-dash">{{$valdetail['name']}}</th>
                                                        @if ($info)
                                                            @foreach ($info as $infos2)
                                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash"></td>
                                                            @endforeach
                                                        @endif
                                                    </tr>

                                        <?php 
                                                }
                                        ?>
                                            <?php if($item['id'] == '911' && !empty($valdetails)){ ?>

                                                <tr>
                                                    <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-g">รวมเงินเรียกเก็บเข้ากองทุน</th>
                                                    <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g"></th>
                                                </tr>

                                            <?php }elseif($item['id'] == '912' && !empty($valdetails)){ ?>

                                                <tr>
                                                    <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-g">รวมเงินจ่ายชดเชย</th>
                                                    <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g"></th>
                                                </tr>
                                            
                                            <?php } ?>
                                                
                                        <?php
                                            }        
                                        ?>


                                        <?php             
                                            $valdetails2 = \App\Models\DataSetting::where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->where('data_value','2')->get();
                                            if (!empty($valdetails2)){
                                                foreach ($valdetails2 as $valdetail2){

                                                    // $FundDetail1 = \App\Models\AssetFundDetail::where('asset_id', $id)->where('type_id', $valdetail['id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                        ?>  
                                                    <tr>
                                                        <td class="text-color-td-sub border-none-tb border-r padding-table-dash">{{$valdetail2['name']}}</th>
                                                        @if ($info)
                                                            @foreach ($info as $infos22)
                                                                <td class="text-color-td-sub border-none-tb border-r text-right padding-table-dash"></td>
                                                            @endforeach
                                                        @endif
                                                    </tr>

                                        <?php 
                                                }
                                        ?>
                                            <?php if($item['id'] == '911' && !empty($valdetails2)){ ?>

                                                <tr>
                                                    <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-p">รวมเงินสดรับ</th>
                                                    <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g"></th>
                                                </tr>

                                            <?php }elseif($item['id'] == '912' && !empty($valdetails2)){ ?>

                                                <tr>
                                                    <th class="text-color-td table-border-color text-center padding-table-dash font-16 table-bgcolor-dash-p">รวมเงินสดจ่าย</th>
                                                    <th class="text-color-td table-border-color text-right padding-table-dash table-bgcolor-dash-g"></th>
                                                </tr>
                                            
                                            <?php } ?>
                                                
                                        <?php
                                            }        
                                        ?>

                                        
                                    @endforeach
                                @endif
                                <tr>
                                    <th class="text-color-td table-border-color padding-table-dash font-16 table-bgcolor">เงินฝากปลายงวด</th>
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


    Highcharts.chart('column-chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        exporting:false,
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'รายรับ (ล้านบาท)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'รายรับ : <b>{point.y:.2f} ล้านบาท</b>'
        },
        series: [{
            name: 'รายรับ',
            data: [
                @if($income_info && count($income_info) > 0)
                @foreach($income_info as $arr)
                ['{{ $arr->label }}', {{ (float) $arr->amount}}],
                @endforeach
                @endif
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.2f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
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