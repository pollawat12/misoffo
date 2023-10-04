@extends('default.template')

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
                    <h4 class="page-title">แสดง การฝึกอบรม</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: การฝึกอบรม</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%"># ลำดับ</th>
                                <th style="width: 20%">ปีงบประมาณ</th>
                                <th style="width: 20%">หลักสูตรการฝึกอบรม</th>
                                <th style="width: 20%">ประเภทการฝึกอบรม</th>
                                <th style="width: 20%">วันที่ฝึกอบรม</th>
                                {{-- <th style="width: 10%">จำนวนรวม</th> --}}
                                <th style="width: 15%">จัดการ</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php $noCourses = 0;?>
                            @if (!empty($Courses))
                            @foreach ($Courses as $Course)
                            <?php $noCourses++;?>
                            <tr>
                                <td class="align-middle">{{$noCourses}}</td>
                                <td class="align-middle">{{$Course['budget_year']}}</td>
                                <td class="align-middle">{{$Course['name']}}</td>
                                <td class="align-middle">{{$Course['categroy']}}</td>
                                <td class="align-middle">{{getDateShow($Course['date_start'])}} - {{getDateShow($Course['date_end'])}}</td>
                                <td class="align-middle">
                                    <select name="input_action" class="form-control btn-action" >
                                        <option value="">เลือก</option>
                                        <option value="view" data-original-title="course" data-id="{{$Course['courses_id']}}">ดูรายละเอียด</option>
                                        {{-- <option value="edit" data-original-title="leave" data-id="{{$Course['id']}}">แก้ไข</option> --}}
                                        {{-- <option value="delete" data-original-title="leave" data-id="{{$Course['id']}}">ลบ</option> --}}
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

    </div>
</div>

<div id="con-close-modal-course" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-course-save" id="frm-course-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="course">

        <input type="hidden" name="edit_id" id="input-course-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">การฝึกอบรม </h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">หลักสูตรการฝึกอบรม</h4>
                            <label for="exampleInputEmail1" id="input-course-name"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                            <label for="exampleInputEmail1" id="input-course-budget_year"></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ประเภทการฝึกอบรม</h4>
                            <label for="exampleInputEmail1" id="input-course-categroy"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">วันที่เริ่มต้น - วันที่สิ้นสุด</h4>
                            <label for="exampleInputEmail1" id="input-course-date_start"> </label>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">เวลาที่เริ่มต้น - เวลาที่สิ้นสุด</h4>
                            <label for="exampleInputEmail1" id="input-course-time_start">  </label>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">สถานที่</h4>
                            <label for="exampleInputPassword1" id="input-course-place"> </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ผู้บรรยาย</h4>
                            <label for="exampleInputEmail1" id="input-course-lecturer_name"> </label>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->
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

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/hr/course')}}'+ '/' + values + '/' + id;
        }  
    });


    $(document).on('change', '.btn-action', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        if(values == 'view'){

            $('#con-close-modal-'+title).modal('show'); 

            var _url = $("#div-data-url").attr("data-url")+"/get/hrinfo/?id="+id+"&type="+title;

            if(title == 'course'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-name").text(res.info.name);
                    $("#frm-"+title+"-save #input-"+title+"-budget_year").text(res.info.budget_year);
                    $("#frm-"+title+"-save #input-"+title+"-categroy").text(res.info.categroy);
                    $("#frm-"+title+"-save #input-"+title+"-date_start").text(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-time_start").text(res.info.time_start);
                    $("#frm-"+title+"-save #input-"+title+"-place").text(res.info.place);
                    $("#frm-"+title+"-save #input-"+title+"-lecturer_name").text(res.info.lecturer_name);
                }, "json");

            }else{

            }
        
        }
    
    });
</script>
@endsection
