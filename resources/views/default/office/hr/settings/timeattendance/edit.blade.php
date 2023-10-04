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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">ลงเวลาปฏิบัติงาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งค่า ลงเวลาปฏิบัติงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ตั้งค่า ลงเวลาปฏิบัติงาน</i> </h4>

                    <form action="{{url('office/hr/setting/time-attendance/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">

                        <input type="hidden" name="edit_id" value="{{ $id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="input-name">ชื่อตารางเวลา <code>*</code></label>
                                            <input type="text" name="name" class="form-control" id="input-name" placeholder="ชื่อตารางเวลา" style="height: 42px;" value="{{ $info->name }}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-check_in">เวลาเข้างาน <code>*</code></label>
                                            <input type="text" name="check_in" class="form-control" id="input-check_in" placeholder="เวลาเข้างาน" style="height: 42px;" value="{{$info->check_in}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-check_out">เวลาเลิกงาน <code>*</code></label>
                                            <input type="text" name="check_out" class="form-control" id="input-check_out" placeholder="เวลาเลิกงาน" style="height: 42px;" value="{{$info->check_out}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-time_late_number">สายได้ (นาที) <code>*</code></label>
                                            <input type="text" name="time_late_number" class="form-control" id="input-time_late_number" placeholder="0" style="height: 42px;" value="{{$info->time_late_number}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-time_exit_number">ออกก่อนได้ (นาที) <code>*</code></label>
                                            <input type="text" name="time_exit_number" class="form-control" id="input-time_exit_number" placeholder="0" style="height: 42px;" value="{{$info->time_exit_number}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="input-start_check_in">เริ่มเข้างานได้ตั้งแต่ </label>
                                            <input type="text" name="start_check_in" class="form-control" id="input-start_check_in" placeholder="0" style="height: 42px;" value="{{$info->time_exit_number}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="input-limit_not_over_check_out">ให้เลิกงานภายในเวลา </label>
                                            <input type="text" name="limit_not_over_check_out" class="form-control" id="input-limit_not_over_check_out" placeholder="0" style="height: 42px;" value="{{$info->limit_not_over_check_out}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="input-office_distance">ระยะทางไม่เกิน (เมตร) </label>
                                            <input type="text" name="office_distance" class="form-control" id="input-office_distance" placeholder="0" style="height: 42px;" value="{{$info->office_distance}}">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>




                            </div>




                            <div class="col-md-6"></div>
                        </div>



                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/hr/employees')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/hr/setting/time-attendance')}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(function () {
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });

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

        $('#frm-save').validate({
            rules: {
                'name': {
                    required: true
                }
            },
            messages: {
                'name': {
                    required: "กรุณาระบุ"
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
            }
        });
    });
</script>
@endsection