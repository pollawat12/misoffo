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
<?php $usersid = Session()->get('auth_info'); ?>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">บุคลากร</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่ม ประวัติพนักงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">เพิ่ม ประวัติพนักงาน</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'general' || $t == 'addresses' || $t == 'family' || $t == 'educations' || $t == 'experience') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">ข้อมูลส่วนตัว</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-works" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'works' || $t == 'works-contract' || $t == 'works-detail' || $t == 'transfer') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">การทำงาน</span>
                                </a>
                            </li>           

                            <li class="nav-item">
                                <a href="#update-leave" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'leave') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">ประวัติการลา </span>
                                </a>
                            </li>
                            <?php if($id == $usersid['user_id'] || $usersid['user_id'] == '145') : ?>
                            <li class="nav-item">
                                <a href="#update-money" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'money') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block">การปรับเงินเดือน </span>
                                </a>
                            </li>
                            <?php endif;?>
                            <li class="nav-item">
                                <a href="#update-courses" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'courses') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block">การฝึกอบรม</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-access" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'access') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block">ประวัติการใช้งาน</span>
                                </a>
                            </li>
                            <?php if($id == $usersid['user_id'] || $usersid['user_id'] == '145') : ?>
                            <li class="nav-item">
                                <a href="#update-benefits" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'benefits') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block"> ค่าตอบแทน </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#update-welfare" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'welfare') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block"> สวัสดิการ </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#update-credentials" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'credentials') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                    <span class="d-none d-sm-block"> ขอหนังสือรับรอง </span>
                                </a>
                            </li>

                            
                            <?php endif;?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane @if($t == 'general' || $t == 'addresses' || $t == 'family' || $t == 'educations' || $t == 'experience') show active @endif" id="general">
                                <p>@include('default.office.hr.employee.include.table-general')</p>
                            </div>

                            <div class="tab-pane @if($t == 'works' || $t == 'works-contract' || $t == 'works-detail' || $t == 'transfer') show active @endif" id="update-works">
                                <p>@include('default.office.hr.employee.include.table-works')</p>
                            </div>

                            <div class="tab-pane @if($t == 'leave') show active @endif" id="update-leave">
                                <p>@include('default.office.hr.employee.include.table-leave')</p>
                            </div>

                            <?php if($id == $usersid['user_id'] || $usersid['user_id'] == '145') : ?>
                            <div class="tab-pane @if($t == 'money') show active @endif" id="update-money">
                                <p>@include('default.office.hr.employee.include.table-money')</p>
                            </div>
                            <?php endif;?>
                            <div class="tab-pane @if($t == 'courses') show active @endif" id="update-courses">
                                <p>@include('default.office.hr.employee.include.table-courses')</p>
                            </div>

                            <div class="tab-pane @if($t == 'access') show active @endif" id="update-access">
                                <p>@include('default.office.hr.employee.include.table-access')</p>
                            </div>
                            <?php if($id == $usersid['user_id'] || $usersid['user_id'] == '145') : ?>
                            <div class="tab-pane @if($t == 'benefits') show active @endif" id="update-benefits">
                                <p>@include('default.office.hr.employee.include.table-benefits')</p>
                            </div>
                            <div class="tab-pane @if($t == 'welfare') show active @endif" id="update-welfare">
                                <p>@include('default.office.hr.employee.include.table-welfare')</p>
                            </div>
                            <div class="tab-pane @if($t == 'credentials') show active @endif" id="update-credentials">
                                <p>@include('default.office.hr.employee.include.table-credentials')</p>
                            </div>

                            <div class="tab-pane @if($t == 'paymouth') show active @endif" id="update-paymouth">
                                <p>@include('default.office.hr.employee.include.table-paymouth')</p>
                            </div>


                            <?php endif;?>
                        </div>


                        
                    </div>
                </div> <!-- end col -->

            </div>
            <div id="url-redirect-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=general"></div>
            <div id="url-addresses-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=addresses"></div>
            <div id="url-family-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=family"></div>
            <div id="url-works-detail-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=works-detail"></div>
            <div id="url-works-contract-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=works-contract"></div>
            <div id="url-educations-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=educations"></div>
            <div id="url-experience-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=experience"></div>
            <div id="url-transfer-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=transfer"></div>
            <div id="url-leave-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=leave"></div>
            <div id="url-money-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=money"></div>
            <div id="url-benefits-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=benefits"></div>
            <div id="url-welfare-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=welfare"></div>
            <div id="url-welfare-back" data-url="{{url('office/hr/employees/add')}}/{{$id}}?t=credentials"></div>
        <!-- end row -->
            <div id="div-data-url" data-url="{{url('office/hr/employees')}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>


<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $(document).ready(function () {
        $(".datatable").DataTable({
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
    });


    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
    
</script>
<script>

    

</script>
<script type="text/javascript">
    $(function(){
        $('.input-format-mobile').mask('0-000-000-000');
        $('.input-format-3digit').mask('000');
    });

    $('#button_employees').click(function(){ 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // jQuery.validator.addMethod("uploadFile", function (val, element) {
        // var size = element.files[0].size;
        //     if (size > 5242880)// checks the file more than 1 MB
        //     {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // }, "รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF ขนาดไฟล์ไม่เกิน 5 MB."); 

        function callBackFuncInsertEmployee(data) {
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

        $('#frm-employees-save').validate({
            rules: {
                'input[prename]': {
                    required: true
                },
                // 'upfile': {
                //     extension:'jpeg,png,pdf,jpg,gif',
                // }
            },
            messages: {
                'input[prename]': {
                    required: "กรุณากรอกคำนำหน้า"
                },
                // 'upfile': {
                //     extension:'รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF',
                // }
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

                ajaxSubmitFormImage("frm-employees-save", "json", callBackFuncInsertEmployee);
                return false;
            }
        });
    });


    $('#button_addresses').click(function(){ 

        function callBackFuncInsertAddresses(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-addresses-back").attr("data-url");

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

        $('#frm-addresses-save').validate({
            rules: {
                'input[zipcode]': {
                    required: true
                }
            },
            messages: {
                'input[zipcode]': {
                    required: "กรุณากรอกรหัสไปรษณีย์"
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

                ajaxSubmitFormImage("frm-addresses-save", "json", callBackFuncInsertAddresses);
                return false;
            }
        });
    });

    $('#button_family').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-family-back").attr("data-url");

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

        $('#frm-family-save').validate({
            rules: {
                'input[firstname]': {
                    required: true
                },
                'input[relation_type]': {
                    required: true
                },
                'input[tax_no]': {
                    required: true
                }
            },
            messages: {
                'input[firstname]': {
                    required: "กรุณากรอกชื่อ"
                },
                'input[relation_type]': {
                    required: "กรุณากรอกความสัมพันธ์"
                },
                'input[tax_no]': {
                    required: "กรุณากรอกเบอร์โทรศัพท์"
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

                ajaxSubmitFormImage("frm-family-save", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });

    $('#button_works').click(function(){ 

        function callBackFuncInsertWorks(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-works-detail-back").attr("data-url");

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

        $('#frm-works-save').validate({
            rules: {
                'input[contract_type]': {
                    required: true
                }
            },
            messages: {
                'input[contract_type]': {
                    required: "กรุณาเลือกประเภทการจ้าง"
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

                ajaxSubmitFormImage("frm-works-save", "json", callBackFuncInsertWorks);
                return false;
            }
        });
    });

    $('#button_contract').click(function(){ 

        jQuery.validator.addMethod("uploadFile", function (val, element) {
        var size = element.files[0].size;
            if (size > 5242880)// checks the file more than 1 MB
            {
                return false;
            } else {
                return true;
            }
        }, "รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF ขนาดไฟล์ไม่เกิน 5 MB."); 

        function callBackFuncInsertContract(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-works-contract-back").attr("data-url");

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

        $('#frm-contract-save').validate({
            rules: {
                'input[duty_id]': {
                    required: true
                },
                // 'upfile_contract': {
                //     extension:'jpeg,png,pdf,jpg,gif',
                //     uploadFile:true,
                // }
            },
            messages: {
                'input[duty_id]': {
                    required: "กรุณาเลือกตำแหน่ง"
                },
                // 'upfile_contract': {
                //     extension:'รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF',
                // }
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

                ajaxSubmitFormImage("frm-contract-save", "json", callBackFuncInsertContract);
                return false;
            }
        });
    });

    $('#button_educations').click(function(){ 

        jQuery.validator.addMethod("uploadFile", function (val, element) {
        var size = element.files[0].size;
            if (size > 5242880)// checks the file more than 1 MB
            {
                return false;
            } else {
                return true;
            }
        }, "รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF ขนาดไฟล์ไม่เกิน 5 MB."); 

        function callBackFuncInsertEducations(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-educations-back").attr("data-url");

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

        $('#frm-educations-save').validate({
            rules: {
                'input[degress_no]': {
                    required: true
                },
                // 'upfile_education': {
                //     extension:'jpeg,png,pdf,jpg,gif',
                //     uploadFile:true,
                // }
            },
            messages: {
                'input[degress_no]': {
                    required: "กรุณาเลือกระดับการศึกษา"
                },
                // 'upfile_education': {
                //     extension:'รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF',
                // }
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

                ajaxSubmitFormImage("frm-educations-save", "json", callBackFuncInsertEducations);
                return false;
            }
        });
    });

    $('#button_experience').click(function(){ 

        function callBackFuncInsertExperience(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-experience-back").attr("data-url");

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

        $('#frm-experience-save').validate({
            rules: {
                'input[company]': {
                    required: true
                },
                'input[date_start]': {
                    required: true
                },
                // 'input[date_end]': {
                //     required: true
                // }
            },
            messages: {
                'input[company]': {
                    required: "กรุณากรอกชื่อบริษัท"
                },
                'input[date_start]': {
                    required: "กรุณากรอกวันที่เริ่ม"
                },
                // 'input[date_end]': {
                //     required: "กรุณากรอกวันที่สิ้นสุด"
                // }
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

                ajaxSubmitFormImage("frm-experience-save", "json", callBackFuncInsertExperience);
                return false;
            }
        });
    });

    $('#button_transfer').click(function(){ 

        jQuery.validator.addMethod("uploadFile", function (val, element) {
        var size = element.files[0].size;
            if (size > 5242880)// checks the file more than 1 MB
            {
                return false;
            } else {
                return true;
            }
        }, "รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF ขนาดไฟล์ไม่เกิน 5 MB."); 

        function callBackFuncInsertTransfer(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-transfer-back").attr("data-url");

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

        $('#frm-transfer-save').validate({
            rules: {
                'input[from_department]': {
                    required: true
                },
                // 'upfile_transfer': {
                //     extension:'jpeg,png,pdf,jpg,gif',
                //     uploadFile:true,
                // }
            },
            messages: {
                'input[from_department]': {
                    required: "กรุณาเลือกฝ่าย"
                },
                // 'upfile_transfer': {
                //     extension:'รูปแบบไฟล์ไม่ถูกต้อง อัพโหลดเฉพาะ JPG,GIF,PNG,PDF',
                // }
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

                ajaxSubmitFormImage("frm-transfer-save", "json", callBackFuncInsertTransfer);
                return false;
            }
        });
    });

    $('#button_leave').click(function(){ 

        function callBackFuncInsertLeave(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-leave-back").attr("data-url");

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

        $('#frm-leave-save').validate({
            rules: {
                'input[leave_type]': {
                    required: true
                }
            },
            messages: {
                'input[leave_type]': {
                    required: "กรุณาเลือกประเภทการลา"
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

                ajaxSubmitFormImage("frm-leave-save", "json", callBackFuncInsertLeave);
                return false;
            }
        });
    });

    $('#button_money').click(function(){ 

        function callBackFuncInsertMoney(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-money-back").attr("data-url");

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

        $('#frm-money-save').validate({
            rules: {
                'input[date_start]': {
                    required: true
                }
            },
            messages: {
                'input[date_start]': {
                    required: "กรุณาเลือกวันที่ปรับเงินเดือน"
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

                ajaxSubmitFormImage("frm-money-save", "json", callBackFuncInsertMoney);
                return false;
            }
        });
    });

    $('#button_benefits').click(function(){ 

        function callBackFuncInsertbenefits(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-benefits-back").attr("data-url");

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

        $('#frm-benefits-save').validate({
            rules: {
                'input[type_id]': {
                    required: true
                }
            },
            messages: {
                'input[type_id]': {
                    required: "กรุณาเลือกค่าตอบแทน"
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

                ajaxSubmitFormImage("frm-benefits-save", "json", callBackFuncInsertbenefits);
                return false;
            }
        });
    });

    $('#button_welfare').click(function(){ 

        function callBackFuncInsertwelfare(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-welfare-back").attr("data-url");

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

        $('#frm-welfare-save').validate({
            rules: {
                'input[type_id]': {
                    required: true
                }
            },
            messages: {
                'input[type_id]': {
                    required: "กรุณาเลือกสวัสดิการ"
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

                ajaxSubmitFormImage("frm-welfare-save", "json", callBackFuncInsertwelfare);
                return false;
            }
        });
    });

    $('#button_credentials').click(function(){ 

        function callBackFuncInsertcredentials(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-credentials-back").attr("data-url");

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

        $('#frm-credentials-save').validate({
            rules: {
                'input[type_id]': {
                    required: true
                }
            },
            messages: {
                'input[type_id]': {
                    required: "กรุณาเลือกสวัสดิการ"
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

                ajaxSubmitFormImage("frm-credentials-save", "json", callBackFuncInsertcredentials);
                return false;
            }
        });
    });
</script>

<script type="text/javascript">

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
        
        }else if(values == 'edit'){
            $('#con-close-modal-'+title).modal('show'); 

            var _url = $("#div-data-url").attr("data-url")+"/get/hrinfo/?id="+id+"&type="+title;

            if(title == 'works'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-contract_type").val(res.info.contract_type);
                    $("#frm-"+title+"-save #input-"+title+"-department_no").val(res.info.department_no);
                    $("#frm-"+title+"-save #input-"+title+"-group_no").val(res.info.group_no);
                    $("#frm-"+title+"-save #input-"+title+"-government_no").val(res.info.government_no);
                    $("#frm-"+title+"-save #input-"+title+"-government_number").val(res.info.government_number);
                    $("#frm-"+title+"-save #input-"+title+"-position_no").val(res.info.position_no);
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val(res.info.date_end);
                    $("#frm-"+title+"-save #input-"+title+"-date_resign").val(res.info.date_resign);
                    $("#frm-"+title+"-save #input-"+title+"-status_work").val(res.info.status_work);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'contract'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val(res.info.date_end);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-duty_id").val(res.info.duty_id);
                    $("#frm-"+title+"-save #input-"+title+"-government_number").val(res.info.government_number);
                    $("#frm-"+title+"-save #input-"+title+"-contracts_date").val(res.info.contracts_date);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'family'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-firstname").val(res.info.firstname);
                    $("#frm-"+title+"-save #input-"+title+"-lastname").val(res.info.lastname);
                    $("#frm-"+title+"-save #input-"+title+"-card_no").val(res.info.card_no);
                    $("#frm-"+title+"-save #input-"+title+"-relation_type").val(res.info.relation_type);
                    $("#frm-"+title+"-save #input-"+title+"-tax_no").val(res.info.tax_no);
                    $("#frm-"+title+"-save #input-"+title+"-contact_info").val(res.info.contact_info);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                    $("#frm-"+title+"-save #input-"+title+"-contact_info").attr(res.info.is_contact_info,'disabled');
                    $("#frm-"+title+"-save #input-"+title+"-is_present").prop('checked', res.info.is_present);
                }, "json");

            }else if(title == 'educations'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-degress_no").val(res.info.degress_no);
                    $("#frm-"+title+"-save #input-"+title+"-institute_name").val(res.info.institute_name);
                    $("#frm-"+title+"-save #input-"+title+"-faculty_name").val(res.info.faculty_name);
                    $("#frm-"+title+"-save #input-"+title+"-education_degree").val(res.info.education_degree);
                    $("#frm-"+title+"-save #input-"+title+"-education_branch").val(res.info.education_branch);
                    $("#frm-"+title+"-save #input-"+title+"-year_start").val(res.info.year_start);
                    $("#frm-"+title+"-save #input-"+title+"-year_end").val(res.info.year_end);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'experience'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-company").val(res.info.company);
                    $("#frm-"+title+"-save #input-"+title+"-address").val(res.info.address);
                    $("#frm-"+title+"-save #input-"+title+"-salary").val(res.info.salary);
                    $("#frm-"+title+"-save #input-"+title+"-position").val(res.info.position);
                    $("#frm-"+title+"-save #input-"+title+"-job_description").val(res.info.job_description);
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val(res.info.date_end);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'transfer'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-from_department").val(res.info.from_department);
                    $("#frm-"+title+"-save #input-"+title+"-to_department").val(res.info.to_department);
                    $("#frm-"+title+"-save #input-"+title+"-from_position").val(res.info.from_position);
                    $("#frm-"+title+"-save #input-"+title+"-to_position").val(res.info.to_position);
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val(res.info.date_end);
                    $("#frm-"+title+"-save #input-"+title+"-is_loan").val(res.info.is_loan);
                    $("#frm-"+title+"-save #input-"+title+"-leader_name").val(res.info.leader_name);
                    $("#frm-"+title+"-save #input-"+title+"-leader_tel").val(res.info.leader_tel);
                    $("#frm-"+title+"-save #input-"+title+"-leader_mobile").val(res.info.leader_mobile);
                    $("#frm-"+title+"-save #input-"+title+"-leader_email").val(res.info.leader_email);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                    $("#frm-"+title+"-save #input-"+title+"-is_present").prop('checked', res.info.is_present);
                    $("#frm-"+title+"-save #input-"+title+"-leader_name").attr(res.info.is_leader_name,'disabled');
                    $("#frm-"+title+"-save #input-"+title+"-leader_tel").attr(res.info.is_leader_tel,'disabled');
                    $("#frm-"+title+"-save #input-"+title+"-leader_mobile").attr(res.info.is_leader_mobile,'disabled');
                    $("#frm-"+title+"-save #input-"+title+"-leader_email").attr(res.info.is_leader_email,'disabled');
                }, "json");

            }else if(title == 'leave'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-leave_type").val(res.info.leave_type);
                    $("#frm-"+title+"-save #input-"+title+"-date_resign").val(res.info.date_resign);
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val(res.info.date_end);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'money'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val(res.info.date_start);
                    $("#frm-"+title+"-save #input-"+title+"-result_eval").val(res.info.result_eval);
                    $("#frm-"+title+"-save #input-"+title+"-salary_div").val(res.info.salary_div);
                    $("#frm-"+title+"-save #input-"+title+"-salary_number").val(res.info.salary_number);
                    $("#frm-"+title+"-save #input-"+title+"-salary_start").val(res.info.salary_start);
                    $("#frm-"+title+"-save #input-"+title+"-salary_end").val(res.info.salary_end);
                    $("#frm-"+title+"-save #input-"+title+"-salary_sum").val(res.info.salary_sum);
                    $("#frm-"+title+"-save #input-"+title+"-is_approved").val(res.info.is_approved);
                    $("#frm-"+title+"-save #input-"+title+"-note").val(res.info.note);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'benefits'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-type_id").val(res.info.type_id);
                    $("#frm-"+title+"-save #input-"+title+"-pay_sum").val(res.info.pay_sum);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'welfare'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-type_id").val(res.info.type_id);
                    $("#frm-"+title+"-save #input-"+title+"-pay_sum").val(res.info.pay_sum);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else if(title == 'credentials'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-type_id").val(res.info.type_id);
                    $("#frm-"+title+"-save #input-"+title+"-pay_sum").val(res.info.pay_sum);
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val(res.info.id);
                }, "json");

            }else{

            }
        }else if(values == 'viewmoney'){

            window.open('{{URL('office/hr/employees/views')}}' + '/{{$id}}'+ '/' + id + '/?t=money' , '_blank');

        }else if(values != ''){
            window.location='{{URL('office/hr/employees/deleted')}}'+ '/' + id + '/{{$id}}/' + title;
        }
    
    });

    $('.btn-action-add').click(function(){
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-original-title');
        
        $('#con-close-modal-'+title).modal('show'); 

        var _url = $("#div-data-url").attr("data-url")+"/get/hrinfo/?id="+id+"&type="+title;

        if(title == 'works'){
            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-contract_type").val('0');
                $("#frm-"+title+"-save #input-"+title+"-department_no").val('0');
                $("#frm-"+title+"-save #input-"+title+"-group_no").val('0');
                $("#frm-"+title+"-save #input-"+title+"-government_no").val('0');
                $("#frm-"+title+"-save #input-"+title+"-government_number").val('');
                $("#frm-"+title+"-save #input-"+title+"-position_no").val('0');
                $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_resign").val('');
                $("#frm-"+title+"-save #input-"+title+"-status_work").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");
        
        }else if(title == 'contract'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                    $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                    $("#frm-"+title+"-save #input-"+title+"-note").val('');
                    $("#frm-"+title+"-save #input-"+title+"-duty_id").val('');
                    $("#frm-"+title+"-save #input-"+title+"-government_number").val('');
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
                }, "json");

        }else if(title == 'family'){

                $.get(_url, function(res){
                    $("#frm-"+title+"-save #input-"+title+"-firstname").val('');
                    $("#frm-"+title+"-save #input-"+title+"-lastname").val('');
                    $("#frm-"+title+"-save #input-"+title+"-card_no").val('');
                    $("#frm-"+title+"-save #input-"+title+"-relation_type").val('');
                    $("#frm-"+title+"-save #input-"+title+"-tax_no").val('');
                    $("#frm-"+title+"-save #input-"+title+"-contact_info").val('');
                    $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
                }, "json");

        }else if(title == 'educations'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-degress_no").val('');
                $("#frm-"+title+"-save #input-"+title+"-institute_name").val('');
                $("#frm-"+title+"-save #input-"+title+"-faculty_name").val('');
                $("#frm-"+title+"-save #input-"+title+"-education_degree").val('');
                $("#frm-"+title+"-save #input-"+title+"-education_branch").val('');
                $("#frm-"+title+"-save #input-"+title+"-year_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-year_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");
        
        }else if(title == 'experience'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-company").val('');
                $("#frm-"+title+"-save #input-"+title+"-address").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary").val('');
                $("#frm-"+title+"-save #input-"+title+"-position").val('');
                $("#frm-"+title+"-save #input-"+title+"-job_description").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'transfer'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-from_department").val('');
                $("#frm-"+title+"-save #input-"+title+"-to_department").val('');
                $("#frm-"+title+"-save #input-"+title+"-from_position").val('');
                $("#frm-"+title+"-save #input-"+title+"-to_position").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-is_loan").val('');
                $("#frm-"+title+"-save #input-"+title+"-leader_name").val('');
                $("#frm-"+title+"-save #input-"+title+"-leader_tel").val('');
                $("#frm-"+title+"-save #input-"+title+"-leader_mobile").val('');
                $("#frm-"+title+"-save #input-"+title+"-leader_email").val('');
                $("#frm-"+title+"-save #input-"+title+"-leader_name").attr('disabled','disabled');
                $("#frm-"+title+"-save #input-"+title+"-leader_tel").attr('disabled','disabled');
                $("#frm-"+title+"-save #input-"+title+"-leader_mobile").attr('disabled','disabled');
                $("#frm-"+title+"-save #input-"+title+"-leader_email").attr('disabled','disabled');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'leave'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-leave_type").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-date_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'money'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-date_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-result_eval").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary_div").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary_number").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary_start").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary_end").val('');
                $("#frm-"+title+"-save #input-"+title+"-salary_sum").val('');
                $("#frm-"+title+"-save #input-"+title+"-is_approved").val('');
                $("#frm-"+title+"-save #input-"+title+"-note").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'benefits'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-type_id").val('');
                $("#frm-"+title+"-save #input-"+title+"-pay_sum").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'welfare'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-type_id").val('');
                $("#frm-"+title+"-save #input-"+title+"-pay_sum").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else if(title == 'credentials'){

            $.get(_url, function(res){
                $("#frm-"+title+"-save #input-"+title+"-type_id").val('');
                $("#frm-"+title+"-save #input-"+title+"-pay_sum").val('');
                $("#frm-"+title+"-save #input-"+title+"-edit_id").val('0');
            }, "json");

        }else{

        }
        
    });


    $(document).on("keyup", "#input-money-salary_div", function() {
        let _itemValue = $(this).val();

        let _itemSalary = $('#input-money-salary_start').val();

        let vat = ((_itemSalary * _itemValue)).toFixed(2);

        let sum = (Number(_itemSalary) + Number(vat)).toFixed(2);

        $("#input-money-salary_end").val(vat);

        $("#input-money-salary_sum").val(sum);
    });

    $(document).on("keyup", "#input-money-salary_start", function() {
        let _itemSalary = $(this).val();

        let _itemValue = $('#input-money-salary_div').val();

        let vat = ((_itemSalary * _itemValue)).toFixed(2);

        let sum = (Number(_itemSalary) + Number(vat)).toFixed(2);

        $("#input-money-salary_end").val(vat);

        $("#input-money-salary_sum").val(sum);
    });
</script>

@endsection
