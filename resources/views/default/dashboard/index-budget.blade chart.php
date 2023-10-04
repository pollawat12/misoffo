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
      
        <!-- start Chart -->
 
        <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    แผนงบประมาณ ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->

                                <div class="chart mt-3" id="chart-all" style="height: 450px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.) ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->

                                <div class="chart mt-3" id="chart-1" style="height: 450px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    สำนักงานนโยบายและแผนพลังงาน (สนพ.) ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="chart-2" style="height: 450px;"></div>
                            </div>


                
                        </div>
                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    กรมสรรพสามิต ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="chart-3" style="height: 450px;"></div>
                            </div>
                        </div>

                        



                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    กรมศุลกากร ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="chart-4" style="height: 450px;"></div>
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
<script src="https://code.highcharts.com/modules/series-label.js"></script>
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


    Highcharts.chart('chart-all', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    yAxis: {
        title: {
            text: 'งบประมาณ'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
           
        }
    },
    series: [{
        name: 'งบบุคลากร',
        data: [{{$total_hr10}},{{$total_hr11}},{{$total_hr12}},{{$total_hr1}},{{$total_hr2}},{{$total_hr3}},{{$total_hr4}},{{$total_hr5}},{{$total_hr6}}
            ,{{$total_hr7}},{{$total_hr8}},{{$total_hr9}}
                ]
    }, {
        name: 'งบดำเนินงาน',
        data: [{{$total_op10}},{{$total_op11}},{{$total_op12}},{{$total_op1}},{{$total_op2}},{{$total_op3}},{{$total_op4}},{{$total_op5}},{{$total_op6}}
            ,{{$total_op7}},{{$total_op8}},{{$total_op9}}
                ]
    },{
        name: 'งบลงทุน',
        data: [{{$total_in10}},{{$total_in11}},{{$total_in12}},{{$total_in1}},{{$total_in2}},{{$total_in3}},{{$total_in4}},{{$total_in5}},{{$total_in6}}
            ,{{$total_in7}},{{$total_in8}},{{$total_in9}}
                ]
    },{
        name: 'งบรายจ่ายอื่น',
        data: [{{$office_1_other10}},{{$office_1_other11}},{{$office_1_other12}},{{$office_1_other1}},{{$office_1_other2}},{{$office_1_other3}}
        ,{{$office_1_other4}},{{$office_1_other5}},{{$office_1_other6}},{{$office_1_other7}},{{$office_1_other8}},{{$office_1_other9}}]
    }]
      
    
    });









    Highcharts.chart('chart-1', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    yAxis: {
        title: {
            text: 'งบประมาณ'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
           
        }
    },
    series: [{
        name: 'งบบุคลากร',
        data: [{{$office_1_Hr10}},{{$office_1_Hr11}},{{$office_1_Hr12}},{{$office_1_Hr1}},{{$office_1_Hr2}},{{$office_1_Hr3}},{{$office_1_Hr4}},
                {{$office_1_Hr5}},{{$office_1_Hr6}},{{$office_1_Hr7}},{{$office_1_Hr8}},{{$office_1_Hr9}}
              
                ]
    }, {
        name: 'งบดำเนินงาน',
        data: [{{$office_1_op10}},{{$office_1_op11}},{{$office_1_op12}},{{$office_1_op1}},{{$office_1_op2}},{{$office_1_op3}},{{$office_1_op4}},
                {{$office_1_op5}},{{$office_1_op6}},{{$office_1_op7}},{{$office_1_op8}},{{$office_1_op9}}
              
                ]
    },{
        name: 'งบลงทุน',
        data: [{{$office_1_invest10}},{{$office_1_invest11}},{{$office_1_invest12}},{{$office_1_invest1}},{{$office_1_invest2}},{{$office_1_invest3}},
                {{$office_1_invest4}},{{$office_1_invest5}},{{$office_1_invest6}},{{$office_1_invest7}},{{$office_1_invest8}},{{$office_1_invest9}},
                ]
    },{
        name: 'งบรายจ่ายอื่น',
        data: [{{$office_1_other10}},{{$office_1_other11}},{{$office_1_other12}},{{$office_1_other1}},{{$office_1_other2}},{{$office_1_other3}}
        ,{{$office_1_other4}},{{$office_1_other5}},{{$office_1_other6}},{{$office_1_other7}},{{$office_1_other8}},{{$office_1_other9}}]
    }]
      
    
    });


    Highcharts.chart('chart-2', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    yAxis: {
        title: {
            text: 'งบประมาณ'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
           
        }
    },
    series: [{
        name: 'งบบุคลากร',
        data: [{{$office_2_Hr10}},{{$office_2_Hr11}},{{$office_2_Hr12}},{{$office_2_Hr1}},{{$office_2_Hr2}},{{$office_2_Hr3}},{{$office_2_Hr4}},
                {{$office_2_Hr5}},{{$office_2_Hr6}},{{$office_2_Hr7}},{{$office_2_Hr8}},{{$office_2_Hr9}}
              
                ]
    }, {
        name: 'งบดำเนินงาน',
        data: [{{$office_2_op10}},{{$office_2_op11}},{{$office_2_op12}},{{$office_2_op1}},{{$office_2_op2}},{{$office_2_op3}},{{$office_2_op4}},
                {{$office_2_op5}},{{$office_2_op6}},{{$office_2_op7}},{{$office_2_op8}},{{$office_2_op9}}
              
                ]
    }]
    
    });







    Highcharts.chart('chart-3', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    yAxis: {
        title: {
            text: 'งบประมาณ'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
           
        }
    },
    series: [{
        name: 'งบบุคลากร',
        data: [{{$office_3_Hr10}},{{$office_3_Hr11}},{{$office_3_Hr12}},{{$office_3_Hr1}},{{$office_3_Hr2}},{{$office_3_Hr3}},{{$office_3_Hr4}}
                ,{{$office_3_Hr5}},{{$office_3_Hr6}},{{$office_3_Hr7}},{{$office_3_Hr8}},{{$office_3_Hr9}}
                ]
    }, {
        name: 'งบดำเนินงาน',
        data: [{{$office_3_op10}},{{$office_3_op11}},{{$office_3_op12}},{{$office_3_op1}},{{$office_3_op2}},{{$office_3_op3}},{{$office_3_op4}},
                {{$office_3_op5}},{{$office_3_op6}},{{$office_3_op7}},{{$office_3_op8}},{{$office_3_op9}}
              
                ]
    },{
        name: 'งบลงทุน',
        data: [{{$office_3_invest10}},{{$office_3_invest11}},{{$office_3_invest12}},{{$office_3_invest1}},{{$office_3_invest2}},{{$office_3_invest3}},
                {{$office_3_invest4}},{{$office_3_invest5}},{{$office_3_invest6}},{{$office_3_invest7}},{{$office_3_invest8}},{{$office_3_invest9}},
                ]
    }]
      
    
    });





    Highcharts.chart('chart-4', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
    },
    yAxis: {
        title: {
            text: 'งบประมาณ'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
           
        }
    },
    series: [{
        name: 'งบบุคลากร',
        data: [{{$office_4_Hr10}},{{$office_4_Hr11}},{{$office_4_Hr12}},{{$office_4_Hr1}},{{$office_4_Hr2}},{{$office_4_Hr3}},{{$office_4_Hr4}}
                ,{{$office_4_Hr5}},{{$office_4_Hr6}},{{$office_4_Hr7}},{{$office_4_Hr8}},{{$office_4_Hr9}}
                ]
    }, {
        name: 'งบดำเนินงาน',
        data: [{{$office_4_op10}},{{$office_4_op11}},{{$office_4_op12}},{{$office_4_op1}},{{$office_4_op2}},{{$office_4_op3}},{{$office_4_op4}},
                {{$office_4_op5}},{{$office_4_op6}},{{$office_4_op7}},{{$office_4_op8}},{{$office_4_op9}}
              
                ]
    }]
      
    
    });



    
































</script>

@endsection