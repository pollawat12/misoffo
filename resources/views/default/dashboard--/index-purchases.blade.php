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
                            <li class="breadcrumb-item active">ภาพรวมจัดซื้อ-จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ภาพรวมจัดซื้อ-จัดจ้าง</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
{{-- 
        <div class="row">
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
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title mb-2 font-22 text-center">
                        จัดซื้อ - จัดจ้าง</h4>
                    <hr class="hr-dash">
                    <h4 class="header-title mb-3 font-20 text-center">
                        คารางแสดงร้อยละของงบประมาณจำแนกตามวิธีจัดซื้อจัดจ้าง ประจำปีงบประมาณ 2565</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table m-0 table-colored-bordered table-border-color nowrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                งบประมาณ</th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                <div>เชิญชวนทั่วไป</div>
                                                <div>(จ้างที่ปรึกษา)</div>
                                            </th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                e-bidding</th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                e-market</th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                วิธีคัดเลือก</th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                เฉพาะเจาะจง</th>
                                            <th
                                                class="font-size-17 text-color-td vertical-center border-none text-center padding-table-dash table-bgcolor-sum">
                                                ส่วนต่าง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                48,410,000</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                5,200,230</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                1,649,999.96
                                            </td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                -</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                30,000,000</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                9,987,361.04</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-dash-gr">
                                                1,572,409</td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                ร้อยละ</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                10.7%</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                3.4%
                                            </td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                -</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                62%</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                20.6%</td>
                                            <td
                                                class="text-color-td border-none text-center table-bgcolor-sum">
                                                3.2%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-3 text-center">
                                <!-- <img class="graph-img-s" src="{{url('assets/default')}}/images/layouts/graph-2.jpg"
                                title="document.svg"> -->
                                <div class="chart mt-3" id="column-chart" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        
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
                { "width": "15%", "targets": 2 },
                { "width": "30%", "targets": 3 },
                { "width": "20%", "targets": 4 },
                { "width": "12%", "targets": 5 },
                { "width": "12%", "targets": 6 }
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
    //             text: 'Population (millions)'
    //         }
    //     },
    //     legend: {
    //         enabled: false
    //     },
    //     tooltip: {
    //         pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    //     },
    //     series: [{
    //         name: 'Population',
    //         data: [
    //             ['Shanghai', 24.2],
    //             ['Beijing', 20.8],
    //             ['Karachi', 14.9],
    //             ['Shenzhen', 13.7],
    //             ['Guangzhou', 13.1],
    //             ['Istanbul', 12.7],
    //             ['Mumbai', 12.4],
    //             ['Moscow', 12.2],
    //             ['São Paulo', 12.0],
    //             ['Delhi', 11.7],
    //             ['Kinshasa', 11.5],
    //             ['Tianjin', 11.2],
    //             ['Lahore', 11.1],
    //             ['Jakarta', 10.6],
    //             ['Dongguan', 10.6],
    //             ['Lagos', 10.6],
    //             ['Bengaluru', 10.3],
    //             ['Seoul', 9.8],
    //             ['Foshan', 9.3],
    //             ['Tokyo', 9.3]
    //         ],
    //         dataLabels: {
    //             enabled: true,
    //             rotation: -90,
    //             color: '#FFFFFF',
    //             align: 'right',
    //             format: '{point.y:.1f}', // one decimal
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
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '',
            align: 'left'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'งบประมาณ',
            colorByPoint: true,
            data: [{
                name: 'เชิญชวนทั่วไป',
                y: 10.70,
                sliced: true,
                selected: true
            }, {
                name: 'e-bidding',
                y: 3.40
            }, {
                name: 'e-market',
                y: 0.00
            }, {
                name: 'วิธีคัดเลือก',
                y: 62.00
            }, {
                name: 'เฉพาะเจาะจง',
                y: 20.60
            }, {
                name: 'ส่วนต่าง',
                y: 3.20
            }]
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