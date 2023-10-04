@extends('default.layouts.main')

@section('css')
{{-- <link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="{{ url('assets/js/datepicker-th/bootstrap-datepicker.min.css') }}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ประเมินผล</a></li>
                            <li class="breadcrumb-item active">ตั้งค่า</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่ม หมวดหมู่ตัวชี้วัด</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล</i> </h4>

                    <form action="{{url('office/settings/meeting_room/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="lv" value="1">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">หมวดหมู่ตัวชี้วัด <code>*</code></label>
                                    <select name="is_deleted" class="form-control" id="input-is_deleted" style="height: 40px;">
                                        <option value="0">-หมวดหมู่หลัก-</option>
                                        <option value="0">เปิดใช้งาน</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">หมวดหมู่ตัวชี้วัด <code>*</code></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sort_order">ลำดับ </label>
                                    <input type="text" name="sort_order" class="form-control" id="sort_order" placeholder="" value="0">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="input-is_deleted">สถานะใช้งาน </label>
                                    <select name="is_deleted" class="form-control" id="input-is_deleted" style="height: 40px;">
                                        <option value="0">เปิดใช้งาน</option>
                                        <option value="1">ปิดใช้งาน</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/settings/meeting_room')}}"  class="btn btn-secondary"><i class="fas fa-arrow-left"></i> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>
<div id="div-redirect-back" data-url="{{ URL('office/settings/meeting_room') }}"></div>
@endsection

@section('js')
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> --}}
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>



<script>
    $(".datepicker-autoclose").datepicker({
        language:'th-th',
        thaiyear: true,
        autoclose: !0,
        todayHighlight: !0
    });

    $(function () {

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();
            var __url = $("#div-redirect-back").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.href = __url;
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'name': {
                    required: true
                }
            },
            messages: {
                'name': {
                    required: "กรุณากรอกห้องประชุม"
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

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>
@endsection
