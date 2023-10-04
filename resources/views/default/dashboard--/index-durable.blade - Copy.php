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
            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/document.svg" title="clock.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">ครุภัณฑ์ทั้งหมด</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->totals }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/ok.svg" title="advertising.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">สถานะคงคลัง</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->in_stock }}</span></h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/refresh.svg" title="paid.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">ถูกเบิก-ยืม</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->in_borrow }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/support.svg" title="timeline.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">ซ่อมแซม/ชำรุด</p>
                            <h2 class="mb-2"><span data-plugin="" style="font-size: 22px !important;">{{ $state_info->in_repairs }}</span></h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->






        {{-- <div class="row">
            <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="header-title">รายรับ-รายจ่าย ตามปีงบประมาณ</h4>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Lifetime total sales</p>
                                    <h3 class="text-danger"><i class="mdi mdi-arrow-down"></i> 256</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Income amounts</p>
                                    <h3 class="text-success"><i class="mdi mdi-arrow-up"></i> 39652</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Total visits</p>
                                    <h3 class="text-warning"><i class="mdi mdi-arrow-up"></i> 7852</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart mt-3" id="line-chart"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="header-title">รายรับ ตามปีงบประมาณ</h4>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Lifetime total sales</p>
                                    <h3 class="text-danger"><i class="mdi mdi-arrow-down"></i> 256</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Income amounts</p>
                                    <h3 class="text-success"><i class="mdi mdi-arrow-up"></i> 39652</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mt-4 mb-3">
                                    <p class="text-uppercase font-13 font-weight-medium">Total visits</p>
                                    <h3 class="text-warning"><i class="mdi mdi-arrow-up"></i> 7852</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart mt-3" id="column-chart"></div>
                </div>
            </div>
        </div> --}}
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="header-title">สรุปรายการครุภัณฑ์</h4>
                    <p class="sub-header">
                        
                    </p>

                    <table id="datatable" class="table table-colored-bordered  table-bordered-dark dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>วันที่</th>
                            <th>รายการ/หมวดหมู่</th>
                            <th>สถานะ</th>
                            <th>ราคา</th>
                            <th>ค่าเสื่อม</th>
                        </tr>
                        </thead>


                        <tbody>
                        @if ($items)
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['no'] }}</td>
                            <td>{{ $item['import_date'] }}</td>
                            <td>{{ $item['item_name'] }}</td>
                            <td>{!! $item['item_status'] !!}</td>
                            <td>{{ $item['item_price'] }}</td>
                            <td>{{ $item['item_dep_price'] }}</td>
                        </tr>
                        @endforeach
                        @endif
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->


        
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
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Shanghai', 24.2],
                ['Beijing', 20.8],
                ['Karachi', 14.9],
                ['Shenzhen', 13.7],
                ['Guangzhou', 13.1],
                ['Istanbul', 12.7],
                ['Mumbai', 12.4],
                ['Moscow', 12.2],
                ['São Paulo', 12.0],
                ['Delhi', 11.7],
                ['Kinshasa', 11.5],
                ['Tianjin', 11.2],
                ['Lahore', 11.1],
                ['Jakarta', 10.6],
                ['Dongguan', 10.6],
                ['Lagos', 10.6],
                ['Bengaluru', 10.3],
                ['Seoul', 9.8],
                ['Foshan', 9.3],
                ['Tokyo', 9.3]
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
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