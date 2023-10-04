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
                                <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-employees-save" id="frm-employees-save" enctype="multipart/form-data">
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
                                <p>@include('default.office.hr.employee.include.tab-addresses')</p>
                            </div>

                            <div class="tab-pane @if($t == 'family') show active @endif" id="update-family">
                                <p>@include('default.office.hr.employee.include.table-family')</p>
                            </div>

                            <div class="tab-pane @if($t == 'educations') show active @endif" id="update-educations">
                                <p>@include('default.office.hr.employee.include.table-educations')</p>
                            </div>

                            <div class="tab-pane @if($t == 'experience') show active @endif" id="update-experience">
                                <p>@include('default.office.hr.employee.include.table-experiences')</p>
                            </div>
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
@endsection
