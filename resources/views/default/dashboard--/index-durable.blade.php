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
                            <li class="breadcrumb-item active">ภาพรวมพัสดุ/ครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ภาพรวมพัสดุ/ครุภัณฑ์</h4>
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
                        <div class="col-lg-4">
                            <div class="card-box height-box-dash" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-22 text-center">
                                    พัสดุ(ครุภัณฑ์และวัสดุ)</h4>
                                    <hr class="hr-dash">
                                <!-- <img class="graph-img-dash" src="{{url('assets/default')}}/images/layouts/graph-2.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="column-chart" style="height: 450px;"></div>
                                <!-- 
                                    1-ครุภัณฑ์สำนักงาน
                                    2-ไฟฟ้าและวิทยุ
                                    3-ครุภัณฑ์โฆษณาและเผยแพร่
                                    4-ครุภัณฑ์งานบ้านงานครัว
                                    5-คอมพิวเตอร์และอุปกรณ์ที่เกี่ยวข้อง
                                    6-โปรแกรมคอมพิวเตอร์
                                    7-ส่วนสำนักงานอาคาร
                                    8-ระบบโทรศัพท์และการสื่อสาร
                                 -->
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card-box height-box-dash" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-22 text-center">
                                    ค่าเสื่อมราคาและค่าตัดจำหน่าย</h4>
                                    <hr class="hr-dash">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-2.jpg" title="document.svg"> -->
                                            <div class="chart mt-3" id="column-chart-1" style="height: 450px;"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-2.jpg" title="document.svg"> -->
                                            <div class="chart mt-3" id="column-chart-2" style="height: 450px;"></div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3 font-22 text-center"><img class="icon-img mr-1"
                                        src="{{url('assets/default')}}/images/icons/document.svg"
                                        title="document.svg"> ค่าเสื่อมราคาและค่าตัดจำหน่าย</h4>


                                <div class="table-responsive">
                                    <table class="table m-0 table-colored-bordered table-border-color nowrap">
                                        <thead>
                                            <tr>
                                                <th class="font-size-17 text-color-td vertical-center table-border-color table-bgcolor-sum">ประเภท</th>
                                                <th class="font-size-17 text-color-td vertical-center table-border-color table-bgcolor-sum">จำนวน</th>
                                                <th class="font-size-17 text-color-td vertical-center table-border-color table-bgcolor-sum">อายุการให้ใช้ประโยชน์ (ปี)</th>
                                                <th class="font-size-17 text-color-td vertical-center table-border-color table-bgcolor-sum">อัตรค่าเสื่อมราคาต่อปี (ร้อยละ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-b">1-ครุภัณฑ์สำนักงาน</td>
                                                <td class="table-border-color text-color-td border-none-b">500.00</td>
                                                <td class="table-border-color text-color-td border-none-b">3/5</td>
                                                <td class="table-border-color text-color-td border-none-b">3.33% / 12.50%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">2-ไฟฟ้าและวิทยุ</td>
                                                <td class="table-border-color text-color-td border-none-tb">17.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">5</td>
                                                <td class="table-border-color text-color-td border-none-tb">20%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">3-ครุภัณฑ์โฆษณาและเผยแพร่</td>
                                                <td class="table-border-color text-color-td border-none-tb">5.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">5</td>
                                                <td class="table-border-color text-color-td border-none-tb">20%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">4-ครุภัณฑ์งานบ้านงานครัว</td>
                                                <td class="table-border-color text-color-td border-none-tb">3.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">2</td>
                                                <td class="table-border-color text-color-td border-none-tb">50%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">5-คอมพิวเตอร์และอุปกรณ์ที่เกี่ยวข้อง</td>
                                                <td class="table-border-color text-color-td border-none-tb">24.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">3</td>
                                                <td class="table-border-color text-color-td border-none-tb">3.33%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">6-โปรแกรมคอมพิวเตอร์</td>
                                                <td class="table-border-color text-color-td border-none-tb">16.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">3</td>
                                                <td class="table-border-color text-color-td border-none-tb">3.33%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">7-ส่วนสำนักงานอาคาร</td>
                                                <td class="table-border-color text-color-td border-none-tb">2,586.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">5</td>
                                                <td class="table-border-color text-color-td border-none-tb">20%</td>
                                            </tr>
                                            <tr>
                                                <td class="table-border-color text-color-td border-none-tb">8-ระบบโทรศัพท์และการสื่อสาร</td>
                                                <td class="table-border-color text-color-td border-none-tb">3.00</td>
                                                <td class="table-border-color text-color-td border-none-tb">8</td>
                                                <td class="table-border-color text-color-td border-none-tb">12.50%</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                { "width": "30%", "targets": 2 },
                { "width": "20%", "targets": 3 },
                { "width": "12%", "targets": 4 },
                { "width": "12%", "targets": 5 }
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
            name: 'ประเภท',
            colorByPoint: true,
            data: [{
                name: 'ครุภัณฑ์สำนักงาน',
                y: 500.00,
                sliced: true,
                selected: true
            },  {
                name: 'ไฟฟ้าและวิทยุ',
                y: 17.00
            },  {
                name: 'ครุภัณฑ์โฆษณาและเผยแพร่',
                y: 5.00
            }, {
                name: 'ครุภัณฑ์งานบ้านงานครัว',
                y: 3.00
            }, {
                name: 'คอมพิวเตอร์และอุปกรณ์ที่เกี่ยวข้อง',
                y: 24.00
            }, {
                name: 'โปรแกรมคอมพิวเตอร์',
                y: 16.00
            }, {
                name: 'ส่วนสำนักงานอาคาร',
                y: 2586.00
            }, {
                name: 'ระบบโทรศัพท์และการสื่อสาร',
                y: 3.00
            }]
        }]
    });

    Highcharts.chart('column-chart-1', {
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
            name: 'ประเภท',
            colorByPoint: true,
            data: [{
                name: 'ครุภัณฑ์สำนักงาน',
                y: 3.00,
                sliced: true,
                selected: true
            },  {
                name: 'ไฟฟ้าและวิทยุ',
                y: 5.00
            },  {
                name: 'ครุภัณฑ์โฆษณาและเผยแพร่',
                y: 5.00
            }, {
                name: 'ครุภัณฑ์งานบ้านงานครัว',
                y: 2.00
            }, {
                name: 'คอมพิวเตอร์และอุปกรณ์ที่เกี่ยวข้อง',
                y: 3.00
            }, {
                name: 'โปรแกรมคอมพิวเตอร์',
                y: 3.00
            }, {
                name: 'ส่วนสำนักงานอาคาร',
                y: 5.00
            }, {
                name: 'ระบบโทรศัพท์และการสื่อสาร',
                y: 8.00
            }]
        }]
    });


    Highcharts.chart('column-chart-2', {
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
            name: 'ประเภท',
            colorByPoint: true,
            data: [{
                name: 'ครุภัณฑ์สำนักงาน',
                y: 3.33,
                sliced: true,
                selected: true
            },  {
                name: 'ไฟฟ้าและวิทยุ',
                y: 20.00
            },  {
                name: 'ครุภัณฑ์โฆษณาและเผยแพร่',
                y: 20.00
            }, {
                name: 'ครุภัณฑ์งานบ้านงานครัว',
                y: 50.00
            }, {
                name: 'คอมพิวเตอร์และอุปกรณ์ที่เกี่ยวข้อง',
                y: 3.33
            }, {
                name: 'โปรแกรมคอมพิวเตอร์',
                y: 3.33
            }, {
                name: 'ส่วนสำนักงานอาคาร',
                y: 20.00
            }, {
                name: 'ระบบโทรศัพท์และการสื่อสาร',
                y: 12.50
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