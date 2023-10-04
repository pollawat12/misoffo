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
                    <form action=""></form>
                        <div class="col-lg-12">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    แผนงบประมาณ ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->

                                <div class="chart mt-3" id="chart-all" style="height: 450px;"></div>
                            </div>
                        </div>
                    </form>
                

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


                        <div class="col-lg-6">
                            <div class="card-box height-box" style="height: 531px !important;">
                                <h4 class="header-title mb-3 font-size-18 text-center">
                                    งบดำเนินงานกรมศุลกากร ปี 2565</h4>
                                <!-- <img class="graph-img" src="{{url('assets/default')}}/images/layouts/graph-1.jpg" title="document.svg"> -->
                                <div class="chart mt-3" id="chart-5" style="height: 450px;"></div>
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


    let budget_Hr = <?php echo json_encode($budget_hr); ?>;
         console.log(budget_Hr);

    let budget_Op = <?php echo json_encode($budget_op); ?>;
         console.log(budget_Op);

   let month10 = 0;
   let month11 = 0;
   let month12 = 0;
   let month1 = 0;
   let month2 = 0;
   let month3 = 0;
   let month4 = 0;
   let month5 = 0;
   let month6 = 0;
   let month7 = 0;
   let month8 = 0;
   let month9 = 0;

   //let sum10 = 0 ;

    budget_Hr.forEach(data_hr => {   
        month10 = month10 + parseInt(data_hr.month_10);
        month11 = month11 + parseInt(data_hr.month_11);
        month12 = month12 + parseInt(data_hr.month_12);
        month1 = month1 + parseInt(data_hr.month_1);
        month2 = month2  + parseInt(data_hr.month_2);
        month3 = month3  + parseInt(data_hr.month_3);
        month4 = month4  + parseInt(data_hr.month_4);
        month5 = month5  + parseInt(data_hr.month_5);
        month6 = month6  + parseInt(data_hr.month_6);
        month7 = month7  + parseInt(data_hr.month_7);
        month8 = month8  + parseInt(data_hr.month_8);
        month9 = month9  + parseInt(data_hr.month_9);
        console.log(data_hr.id);  
       // month.push(data_hr.month_10);

    });
  //  console.log(month);  
    console.log(month10);  
    console.log(month11);  
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
        data: [month10,month11,month12,month1,month2,month3,month4,month5,month6,month7,month8,month9]
    }, {
        name: 'งบดำเนินงาน',
        data: []
    },{
        name: 'งบลงทุน',
        data: []
    },{
        name: 'งบรายจ่ายอื่น',
        data: []
    }]
      
    
    });





</script>

@endsection