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
                            <li class="breadcrumb-item"><a href="{{url('/')}}">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">การฝึกอบรม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">SAVE</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <p>filesave</p>
        
    </div>
</div>

@endsection

@section('js')
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

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
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


        // var a = $("#datatable-buttons").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // });
        // $("#key-table").DataTable({
        //     keys: !0
        // }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
        //     select: {
        //         style: "multi"
        //     }
        // }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });




    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
            
        }else if(values != ''){
            window.location='{{URL('office/hr/course')}}'+ '/' + values + '/' + id;
        }    
    });




    
</script>

<script>

    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })



    // $(document).on('change', '.btn-action', function(params) {
    //     let id = $(this).find(':selected').attr('data-id');
    //     let values = $(this).val();
    //     let title = $(this).find(':selected').attr('data-original-title');

    //     if(values == 'view'){

    //         $('#con-close-modal-'+title).modal('show'); 

    //         var _url = $("#div-data-url").attr("data-url")+"/get/hrinfo/?id="+id+"&type="+title;

    //         if(title == 'course'){

    //             $.get(_url, function(res){
    //                 $("#frm-"+title+"-save #input-"+title+"-name").text(res.info.name);
    //                 $("#frm-"+title+"-save #input-"+title+"-budget_year").text(res.info.budget_year);
    //                 $("#frm-"+title+"-save #input-"+title+"-categroy").text(res.info.categroy);
    //                 $("#frm-"+title+"-save #input-"+title+"-date_start").text(res.info.date_start);
    //                 $("#frm-"+title+"-save #input-"+title+"-time_start").text(res.info.time_start);
    //                 $("#frm-"+title+"-save #input-"+title+"-place").text(res.info.place);
    //                 $("#frm-"+title+"-save #input-"+title+"-lecturer_name").text(res.info.lecturer_name);
    //             }, "json");

    //         }else{

    //         }
        
    //     }
    
    // });
    
</script>
@endsection
