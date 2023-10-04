@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">ข้อมูลสิทธิประโยชน์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูล <?php if($t == 'pay'){ echo 'ค่าตอบแทน'; }elseif($t == 'welfare'){ echo 'ข้อมูลสวัสดิการ'; }else{ echo 'ขอหนังสือรับรอง'; }?></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูล <?php if($t == 'pay'){ echo 'ค่าตอบแทน'; }elseif($t == 'welfare'){ echo 'ข้อมูลสวัสดิการ'; }else{ echo 'ขอหนังสือรับรอง'; }?></h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/settings/data/lists')}}/?t={{$t}}&pr=0" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> กลับไปที่ข้อมูล <?php if($t == 'pay'){ echo 'ค่าตอบแทน'; }elseif($t == 'welfare'){ echo 'ข้อมูลสวัสดิการ'; }else{ echo 'ขอหนังสือรับรอง'; }?> </i></a>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 20%">หัวข้อ</th>
                                <th style="width: 20%">เจ้าหน้าที่</th>
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr style="background: #f2f2f2; ">
                                <td class="align-middle">{{$items->name}} 
                                </td>
                                <td class="align-middle">
                                    <?php 
                                        $Diagrams = \App\Models\UserBenefits::where('type_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                                        $DiagramCount = $Diagrams->count();
                                        if($DiagramCount > 0){
                                            foreach ($Diagrams as $Diagram){

                                            $Users = \App\Models\UserInformation::where('users_id',$Diagram['user_id'])->get();
                                            foreach ($Users as $User);

                                            echo $User['firstname'].' '. $User['lastname'];
                                            ?>
                                                
                                                <a href="{{url('office/hr/benefits/deleted')}}/{{$Diagram['id']}}">ลบ</a> <br/>
                                            <?php
                                            }
                                        } 
                                    
                                    ?>

                                </td>
                                <td class="align-middle" style="width: 10%">
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <option value="add" data-id="{{$id}}">เจ้าหน้าที่ฝ่าย</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/benefits')}}/{{$id}}/?t={{$t}}&pr=0"></div>

        <div id="div-data-url" data-url="{{url('office/hr/benefits')}}"></div>

    </div>
</div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/benefits/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
        <input type="hidden" name="input[action]" id="input-action" >
        <input type="hidden" name="input[edit_id]" id="input-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูล เจ้าหน้าที่</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_id">เจ้าหน้าที่ </label>
                            <select name="input[user_id]" id="input-user_id" class="form-control" style="height: 45px;" data-toggle="select2">
                                <option value="">--เลือก--</option>
                                @if (count($employees) > 0)
                                @foreach($employees as $val1)
                                <option value="{{$val1['id']}}" >{{$val1['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_id">จำนวนเงิน </label>
                            <input type="text" name="input[pay_sum]" class="form-control" style="height: 45px;" id="input-pay_sum">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[type_id]" id="input-type_id" value="{{$id}}">
                
                <input type="hidden" name="input[category_name]" id="input-category_name" value="{{$t}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_action" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
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

<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>

<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>

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

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
</script>

<script>
    
    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'boss'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(values == 'add'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else{

        }
    });

    $('#button_action').click(function(){ 

        function callBackFuncInsert(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-redirect-back").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.href = urlRedirect;
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[user_id]': {
                    required: true
                }
            },
            messages: {
                'input[user_id]': {
                    required: "กรุณาเลือกเจ้าหน้า"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFuncInsert);
                return false;
            }
        });
    });
</script>
@endsection
