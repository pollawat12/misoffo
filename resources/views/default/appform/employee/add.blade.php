@extends('default.layouts.appform')

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
                                <a href="#employees" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'general' || $t == 'leave' || $t == 'money' || $t == 'courses'  || $t == 'access' || $t == 'works-detail' || $t == 'works-contract'  || $t == 'transfer') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">ข้อมูลทั่วไป</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#update-addresses" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'addresses') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">ที่อยู่</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-family" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'family') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">ครอบครัว</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-educations" data-toggle="tab" aria-expanded="true" class="nav-link @if($t == 'educations') active @endif">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                    <span class="d-none d-sm-block">การศึกษา</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-experience" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'experience') active @endif ">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">ประสบการณ์ทำงาน</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane @if($t == 'general' || $t == 'leave' || $t == 'money' || $t == 'courses'  || $t == 'access' || $t == 'works-detail' || $t == 'works-contract'  || $t == 'transfer') show active @endif" id="employees">
                                <form action="{{url('appform/sub/save')}}" method="POST" name="frm-employees-save" id="frm-employees-save" enctype="multipart/form-data">
                                    <input type="hidden" name="action_name" value="general">
                                    <input type="hidden" name="input[user_id]" value="{{$id}}">
                                    <p>
                                        @foreach ($employees as $employee)

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-2" >
                                                        <input type="hidden" name="edit_id" value="{{$employee['id']}}">
                                                        @if(!empty($employee['avatar_image']))
                                                            <div class="col-md-12" >
                                                                <img src="{{ URL($employee['avatar_image']) }}" class="img-thumbnail" alt="..." style="max-height: 260px !important; width:auto; ">
                                                            </div>
                                                        @else
                                                            <div class="col-md-12" >
                                                                <img src="{{url('assets/default')}}/images/profile.png" class="img-thumbnail" alt="..." style="max-height: 260px !important; width:auto; ">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row ml-1">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <?php $prenames = \App\Models\DataSetting::where('group_type','prename')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                                                    <label for="prename">คำนำหน้า <code>*</code></label>
                                                                    <select name="input[prename]" class="form-control" style="height: 45px;">
                                                                        <option value="">--เลือก--</option>
                                                                        @if (!empty($prenames))
                                                                        @foreach ($prenames as $prename)
                                                                            <option value="{{$prename['id']}}" @if($prename['id'] == $employee['prename']) selected @endif>{{$prename['name']}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                            
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="firstname">ชื่อ <code>*</code></label>
                                                                    <input type="text" class="form-control" name="input[firstname]" placeholder="" value="{{$employee['firstname']}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lastname">นามสกุล <code>*</code></label>
                                                                    <input type="text" class="form-control" name="input[lastname]" placeholder="" value="{{$employee['lastname']}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="firstname_en">ชื่อ (ENG) <code>*</code></label>
                                                                    <input type="text" class="form-control" name="input[firstname_en]" placeholder="" value="{{$employee['firstname_en']}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lastname_en">นามสกุล (ENG) <code>*</code></label>
                                                                    <input type="text" class="form-control" name="input[lastname_en]" placeholder="" value="{{$employee['lastname_en']}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="nickname">ชื่อเล่น </label>
                                                                    <input type="text" class="form-control" name="input[nickname]" placeholder="" value="{{$employee['nickname']}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="dob">วันเกิด </label>
                                                                    <div>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[dob]" value="@if($employee['dob'] != NULL){{getDateFormatToInputThai($employee['dob'])}} @endif">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                            </div>
                                                                        </div><!-- input-group -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="card_no">รหัสบัตรประชาชน </label>
                                                                    <input type="text" class="form-control" name="input[card_no]" placeholder="" value="{{$employee['card_no']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $genders = getGender(); ?> 
                                                    <label for="gender">เพศ </label>
                                                    <select name="input[gender]" class="form-control" style="height: 45px;">
                                                        <option value="">--เลือก--</option>
                                                        @foreach($genders as $keyGender => $valGender)
                                                            <option value="{{$keyGender}}" @if($keyGender == $employee['gender']) selected @endif>{{$valGender}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $bloods = getBloodGroup(); ?>
                                                    <label for="blood_type">กรุ๊ปเลือด </label>
                                                    <select name="input[blood_type]" class="form-control" style="height: 45px;">
                                                        <option value="">--เลือก--</option>
                                                        @foreach($bloods as $keyBlood => $valBlood)
                                                            <option value="{{$keyBlood}}" @if($keyBlood == $employee['blood_type']) selected @endif>{{$valBlood}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="weight">น้ำหนัก (กก.)</label>
                                                    <input type="text" class="form-control" name="input[weight]" placeholder="" value="{{$employee['weight']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="height">ส่วนสูง (ซม.)</label>
                                                    <input type="text" class="form-control input-format-3digit" name="input[height]" placeholder="" value="{{$employee['height']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="has_race">เชื้อชาติ </label>
                                                    <input type="text" class="form-control" name="input[has_race]" placeholder="" value="{{$employee['has_race']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="has_nationality">สัญชาติ </label>
                                                    <input type="text" class="form-control" name="input[has_nationality]" placeholder="" value="{{$employee['has_nationality']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $religions = getReligion(); ?>
                                                    <label for="has_religion">ศาสนา </label>
                                                    <select name="input[has_religion]" class="form-control" style="height: 45px;">
                                                        <option value="">--เลือก--</option>
                                                        @foreach($religions as $keyReligion => $valReligion)
                                                            <option value="{{$keyReligion}}" @if($keyReligion == $employee['has_religion']) selected @endif>{{$valReligion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $maritial = getMaritialStatus(); ?>
                                                    <label for="maritial_status">สถานะภาพ </label>
                                                    <select name="input[maritial_status]" class="form-control" style="height: 45px;">
                                                        <option value="">--เลือก--</option>
                                                        @foreach($maritial as $keyMaritial => $valMaritial)
                                                            <option value="{{$keyMaritial}}" @if($keyMaritial == $employee['maritial_status']) selected @endif>{{$valMaritial}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tel">เบอร์โทรศัทพ์ </label>
                                                    <input type="text" class="form-control" name="input[tel]" placeholder="" value="{{$employee['tel']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile">เบอร์มือถือ </label>
                                                    <input type="text" class="form-control input-format-mobile" name="input[mobile]" placeholder="" value="{{$employee['mobile']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fax">FAX. </label>
                                                    <input type="text" class="form-control" name="input[fax]" placeholder="" value="{{$employee['fax']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">E-Mail </label>
                                                    <input type="email" class="form-control" name="input[email]" placeholder="" value="{{$employee['email']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="line_id">LINE ID </label>
                                                    <input type="text" class="form-control" name="input[line_id]" placeholder="" value="{{$employee['line_id']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="avatar_image">รูปภาพ </label>
                                                    <input type="file" class="filestyle" name="upfile" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" id="button_employees" class="btn btn-primary"><i class="mdi mdi-database-plus"></i><br>&nbsp;บันทึก</button>
                                                <a href="{{URL('office/hr/employees')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-reverse-outline"></i><br>&nbsp; ยกเลิก</a>
                                            </div>
                                        </div>
                                    </p>
                                    @endforeach
                                </form>
                            </div>

                            <div class="tab-pane @if($t == 'addresses') show active @endif" id="update-addresses">
                                <p>@include('default.appform.employee.include.tab-addresses')</p>
                            </div>

                            <div class="tab-pane @if($t == 'family') show active @endif" id="update-family">
                                <p>@include('default.appform.employee.include.table-family')</p>
                            </div>

                            <div class="tab-pane @if($t == 'educations') show active @endif" id="update-educations">
                                <p>@include('default.appform.employee.include.table-educations')</p>
                            </div>

                            <div class="tab-pane @if($t == 'experience') show active @endif" id="update-experience">
                                <p>@include('default.appform.employee.include.table-experiences')</p>
                            </div>
                        </div>


                        
                    </div>
                </div> <!-- end col -->

            </div>
            <div id="url-redirect-back" data-url="{{url('appform/add')}}/{{$id}}?t=general"></div>
            <div id="url-addresses-back" data-url="{{url('appform/add')}}/{{$id}}?t=addresses"></div>
            <div id="url-family-back" data-url="{{url('appform/add')}}/{{$id}}?t=family"></div>
            <div id="url-works-detail-back" data-url="{{url('appform/add')}}/{{$id}}?t=works-detail"></div>
            <div id="url-works-contract-back" data-url="{{url('appform/add')}}/{{$id}}?t=works-contract"></div>
            <div id="url-educations-back" data-url="{{url('appform/add')}}/{{$id}}?t=educations"></div>
            <div id="url-experience-back" data-url="{{url('appform/add')}}/{{$id}}?t=experience"></div>
            <div id="url-transfer-back" data-url="{{url('appform/add')}}/{{$id}}?t=transfer"></div>
            <div id="url-leave-back" data-url="{{url('appform/add')}}/{{$id}}?t=leave"></div>
            <div id="url-money-back" data-url="{{url('appform/add')}}/{{$id}}?t=money"></div>
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

            }else{

            }

        }else if(values != ''){
            window.location='{{URL('appform/deleted')}}'+ '/' + id + '/{{$id}}/' + title;
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


        }else{

        }
        
    });
</script>
@endsection
