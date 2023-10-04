@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">บันทึกเวลาทำงาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ค่าตอบแทนรายเดือน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                 <div class="row mb-3">
                    <div class="col-8">
                        <h4 class="header-title">รายการข้อมูล :: ค่าตอบแทน</h4>
                        <p class="sub-header"></p>         
            </div>
                                <form action="{{url('office/hr/time_attendances/paymonth/search')}}" method="GET" name="frm-search" id="frm-search">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if (count($data_pay) > 0)
                                            @foreach($data_pay as $val)
                                                <?php
                                                    $checked = [];
                                                    if(!empty($_GET['input'])){
                                                        $checked= $_GET['input'];
                                                        //$checked = $_GET['input'];
                                                       // array_push($checked,$_GET['input']);
                                                    }
                                                

                                                ?>
                                                    <div class="col-auto">
                                                        <div class="form-check form-check-inline">
                                                             <div class="checkbox checkbox-primary">
                                                                <input type="checkbox" id="{{$val->id}}" name="input[type_id_{{$val->id}}]" value="{{$val->id}}" @if(in_array($val->id, $checked)) {{'checked'}}@endif>
                                                                <label for="{{$val->id}}">{{$val->name}}</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                            @endforeach
                                        @endif

                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dob"> </label>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark">
                                                            <i class="mdi mdi-database-plus"> ค้นหา</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                    
                    
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 2%" rowspan="2">ลำดับ</th>
                                <th style="width: 3%" rowspan="2">รายชื่อ</th>
                                <th style="width: 50%" colspan="5">ค่าตอบแทน</th>
                                <th style="width: 20%" colspan="5">กองทุนสำรองเลี้ยงชีพ</th>
                                <th style="width: 20%" colspan="1">สินเชื่อธนาคารออม</th>
                                <th style="width: 20%" colspan="1">ภาษีเงินได้ หัก ณ ที่จ่าย</th>
                                <th style="width: 15%" rowspan="1">ค่าตอบแทนจ่ายจริง</th>
                              
                            </tr>

                            <tr>
                                
                                <th style="width: 10%">เงินเดือน</th>
                                <th style="width: 10%">ประโยชน์ตอบแทนอื่น</th>
                                <th style="width: 10%">ค่าทำงานในวันหยุด/ค่าล่วงเวลา</th>
                                <th style="width: 10%">ค่าครองชีพ</th>
                                <th style="width: 10%">รวมค่าตอบแทน</th>
                                <th style="width: 5%">%เงินสะสม</th>
                                <th style="width: 5%">หักเงินสะสม</th>
                                <th style="width: 5%">%เงินสมทบ</th> 
                                <th style="width: 5%">บวกเงินสมทบ</th>
                                <th style="width: 5%">รวมนำส่งกองทุน</th>
                                <th style="width: 5%">หักชำระหนี้</th>
                                <th style="width: 5%">หักชำระภาษี</th>
                                <th style="width: 5%">ค่าตอบแทนจ่ายจริง</th>
                            </tr>
                        </thead>

                        <tbody id="table">
                            
                        </tbody>
                        
                    </table>
                </div>
              
            </div>
        </div> <!-- end row -->
       
    
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
            x = x.replace(pattern, "$1,$2");
            return x;
        }
    
    $(document).ready(function () {
        var html = "";
        var data = <?php echo json_encode($employees); ?>;
        // console.log(data);


        let pay_month772 = <?php echo json_encode($pay_month772); ?>;
        // console.log(pay_month772);

        let pay_month785 = <?php echo json_encode($pay_month785); ?>;
        // console.log(pay_month785);

        let pay_month786 = <?php echo json_encode($pay_month786); ?>;
        // console.log(pay_month786);


        let pay_month787 = <?php echo json_encode($pay_month787); ?>;
        // console.log(pay_month787);


        let pay_month790 = <?php echo json_encode($pay_month790); ?>;
         console.log(pay_month790);


         let Fund = <?php echo json_encode($Fund); ?>;
         console.log(Fund);

      
        const element = document.getElementById("table");
        // console.log(element);
        for (let i = 1; i < data.length; i++) {
           // console.log(data[i]);
            html += "<tr>";
            html += "<td>"+i+"</td>" ;
            html += "<td>"+data[i].name+"</td>" ;
            // console.log(data[i].id);
            
            let pay772Data = pay_month772.find(x => x.users_id == data[i].id);

            let sumv1 = 0;
            if(pay772Data  != null){
            html += "<td>"+numberWithCommas(pay772Data.pay_sum)+"</td>" ;
            sumv1 = sumv1 + parseInt(pay772Data.pay_sum);
            }else{
            html += "<td>-</td>" ;
            }


            let pay785Data = pay_month785.find(x => x.users_id == data[i].id);

            if(pay785Data  != null){
            html += "<td>"+numberWithCommas(pay785Data.pay_sum)+"</td>" ;
            sumv1 = sumv1 + parseInt(pay785Data.pay_sum);
            }else{
            html += "<td>-</td>" ;
            }



            let pay786Data = pay_month786.find(x => x.users_id == data[i].id);

            if(pay786Data  != null){
            html += "<td>"+numberWithCommas(pay786Data.pay_sum)+"</td>" ;
            sumv1 = sumv1 + parseInt(pay786Data.pay_sum);
            }else{
            html += "<td>-</td>" ;
            }



            let pay787Data = pay_month787.find(x => x.users_id == data[i].id);

            if(pay787Data  != null){
            html += "<td>"+numberWithCommas(pay787Data.pay_sum)+"</td>" ;
            sumv1 = sumv1 + parseInt(pay787Data.pay_sum);
            
            }else{
            html += "<td>-</td>" ;
            }

            html += "<td>"+numberWithCommas(sumv1)+"</td>" ;



            let pay790Data = pay_month790.find(x => x.users_id == data[i].id);

            if(pay790Data  != null){
                console.log(pay790Data.pay_sum);
                let vat = 0;
                let sum = 0;
                let fundPercent = 0;
                if(parseInt(pay790Data.pay_sum) < 17000){

                     vat = (pay790Data.pay_sum * 3) / 100;
                     sum = (pay790Data.pay_sum) / 100;
                    console.log(vat);
                    console.log(sum);

                }else
                {
                    console.log(pay790Data.pay_sum);
                    const filteredHomes = Fund.filter(x => parseInt(x.value_min) <= parseInt(pay790Data.pay_sum)  && parseInt(x.value_max) >= parseInt(pay790Data.pay_sum)  );
                    console.log(filteredHomes);


                    fundPercent = filteredHomes[0].value_percent;
                    vat = (pay790Data.pay_sum * 3) / 100;
                    sum = (pay790Data.pay_sum* fundPercent) / 100;
                    console.log(vat);
                    console.log(sum);

                    total = vat + sum
                }
            html += "<td>"+fundPercent+"</td>" ;
            html += "<td>"+numberWithCommas(vat)+"</td>" ;
            html += "<td>"+fundPercent+"</td>" ;
            html += "<td>"+numberWithCommas(sum)+"</td>" ;
            html += "<td>"+numberWithCommas(total)+"</td>" ;
            
            }else{
            html += "<td>-</td>" ;
            html += "<td>-</td>" ;
            html += "<td>-</td>" ;
            html += "<td>-</td>" ;
            html += "<td>-</td>" ;
            
            }
    
            html += "<td>-</td>";
            html += "<td>-</td>";
            html += "<td>-</td>";
           
            html += "</tr>";
           
        } 
        element.innerHTML += html;


      


        $("#datatable").DataTable({
            "ordering": false,
            "pageLength": 25,
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


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });
    });

</script>
@endsection
