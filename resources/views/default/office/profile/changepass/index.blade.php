@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ข้อมูลของฉัน</a></li>
                            <li class="breadcrumb-item active">เปลี่ยนรหัสผ่าน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เปลี่ยนรหัสผ่าน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เปลี่ยนรหัสผ่าน</i> </h4>

                    <form action="{{url('office/my/changepass/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">รหัสผ่านเดิม <code>*</code></label>
                                            <input type="password" name="old_password" class="form-control" id="input-old_password" placeholder="">
                                            <small id="emailHelp" class="form-text text-muted" style="font-size: 14px !important;">สามารถใช้อักษร A-Z a-z 0-9 ความยาว 4-20 ตัวอักษร</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">รหัสผ่านใหม่ <code>*</code></label>
                                            <input type="password" name="new_password" class="form-control" id="input-new_password" placeholder="">
                                            <small id="emailHelp" class="form-text text-muted" style="font-size: 14px !important;">สามารถใช้อักษร A-Z a-z 0-9 ความยาว 4-20 ตัวอักษร</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ยืนยันรหัสผ่าน <code>*</code></label>
                                            <input type="password" name="conf_password" class="form-control" id="input-conf_password" placeholder="">
                                            <small id="emailHelp" class="form-text text-muted" style="font-size: 14px !important;">สามารถใช้อักษร A-Z a-z 0-9 ความยาว 4-20 ตัวอักษร</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('dashboard')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>

<div id="url-redirect-back" data-url="{{url('dashboard')}}"></div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(function() {

        function callBackFunc(data) {
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

        $.validator.addMethod("pwcheck",function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[A-Z]/.test(value);
        });

        $('#frm-save').validate({
            rules: {
                'old_password': {
                    required: true,
                    minlength: 5
                },
                'new_password': {
                    required: true,
                    minlength: 5
                },
                'conf_password': {
                    required: true,
                    minlength: 5,
                    equalTo: "#input-new_password"
                }
            },
            messages: {
                'old_password': {
                    required: "กรุณากรอกรหัสผ่านเดิม"
                },
                'new_password': {
                    required: "กรุณากรอกรหัสผ่านใหม่"
                },
                'conf_password': {
                    required: "กรุณากรอกยืนยันรหัสผ่าน",
                    equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>
@endsection
