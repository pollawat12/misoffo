@extends('default.layouts.main')

@section('css')
{{-- <link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="{{ url('assets/js/datepicker-th/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">จองรถยนต์ส่วนกลาง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่มข้อมูล จองรถยนต์ส่วนกลาง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4>ผู้ขอใช้รถ</h4>
                    <form action="{{url('office/services/reserve-car/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="edit_id" value="0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="owner_name">ชื่อ - นามสกุล<code>*</code></label>
                                    <input type="text" name="owner_name" class="form-control" id="owner_name" value="{{ $auth_info['user_name'] }}" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departments_id">สำนักงาน</label>
                                    <select name="departments_id" class="form-control" id="departments_id">
                                        <option value="">ระบุ</option>
                                        @if ($department_works)
                                        @foreach ($department_works as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="groups_id">กลุ่มงาน</label>
                                    <select name="groups_id" class="form-control" id="groups_id">
                                        <option value="">ระบุ</option>
                                        @if ($group_works)
                                        @foreach ($group_works as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">วันที่ขอใช้</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="date_start" value="<?=date('d/m').'/'.(date('Y')+543)?>" id="datepicker-autoclose22" readonly data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>


                        </div>
                        <h4>วัตถุประสงค์</h4> 
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meeting_category">เพื่อ</label>
                                    <select name="meeting_category" class="form-control" id="meeting_category">
                                        <option value="">ระบุ</option>
                                        <option value="1">ปฏิบัติงานนอกสถานที่</option>
                                        <option value="2">รับ-ส่ง เอกสาร/สิ่งของ</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="time_category">ลักษณะการใช้รถ</label>
                                    <select name="time_category" class="form-control" id="time_category">
                                        <option value="">ระบุ</option>
                                        <option value="1">ขาไป</option>
                                        <option value="2">ขากลับ</option>
                                        <option value="3">เดินทางไปและกลับ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">วันที่เริ่มต้น</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="date_start" value="<?=date('d/m').'/'.(date('Y')+543)?>" id="datepicker-autoclose22" readonly data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">วันที่เสร็จสิ้น</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="date_end" value="<?=date('d/m').'/'.(date('Y')+543)?>" id="datepicker-autoclose" readonly data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-2">
                                <div class="form-group">
                                    <label for="time_start">เวลาไป</label>
                                    <input type="text" class="form-control" name="time_start" id="time_start"  data-toggle="input-mask" data-mask-format="00:00">
                                    <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="time_end">เวลากลับ</label>
                                    <input type="text" class="form-control" name="time_end" id="time_end"  data-toggle="input-mask" data-mask-format="00:00">
                                    <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="meeting_room_id">ทะเบียนรถ</label>
                                    <select name="meeting_room_id" class="form-control" id="meeting_room_id">
                                        <option value="">ระบุ</option>
                                        @if ($rooms)
                                        @foreach ($rooms as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="personal_category">จำนวนคนนั่ง </label>
                                    <select name="personal_category" class="form-control" id="personal_category">
                                        <option value="">ระบุ</option>
                                        <option value="1">ไม่มี</option>
                                        <option value="2">มี</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="personal_nums">จำนวนคน</label>
                                    <input type="text" name="personal_nums" class="form-control" id="personal_nums" placeholder="" value="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="owner_tel">เบอร์โทร (ผู้ขอใช้) </label>
                                    <input type="text" name="owner_tel" class="form-control" id="owner_tel" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อเรื่อง</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail">สถานที่/จุดหมาย(ระบุรายละเอียด)</label>
                                    <textarea name="detail" id="detail" cols="30" rows="3"></textarea>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/services/reserve-car')}}"  class="btn btn-secondary"><i class="fas fa-arrow-left"> ยกเลิก</i></a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>
<div></div>
@endsection

@section('js')
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> --}}
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>
<script src="{{url('assets/default')}}/libs/switchery/switchery.min.js"></script>

<!-- Plugins js -->
<script src="{{url('assets/default')}}/libs/jquery-mask-plugin/jquery.mask.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        height: 400,
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        forced_root_block : "",
        branding: false,
        force_br_newlines : true,
        force_p_newlines : false,
    });

    $(".datepicker-autoclose").datepicker({
        language:'th-th',
        thaiyear: true,
        autoclose: !0,
        todayHighlight: !0
    });

    $(document).ready(function () {
        $('[data-toggle="input-mask"]').each(function (a, e) {
            var t = $(e).data("maskFormat"),
                n = $(e).data("reverse");
            null != n ? $(e).mask(t, {
                reverse: n
            }) : $(e).mask(t)
        })
    }), jQuery(function (a) {
        a(".autonumber").autoNumeric("init")
    });

    $(function () {
        $('[data-plugin="switchery"]').each(function (a, n) {
            new Switchery($(this)[0], $(this).data())
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    // window.location.reload();
                    window.location.href = "{{ url('office/services/reserve-car') }}";
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }
        
        $('#frm-save').validate({
            rules: {

                'meeting_category': {
                    required: true
                },
                'title': {
                    required: true
                },
                'meeting_room_id': {
                    required: true
                },
                'meeting_type_id': {
                    required: true
                },
                'date_start': {
                    required: true
                },
                'date_end': {
                    required: true
                
                },
                'time_category': {
                    required: true
                },
                'time_start': {
                    required: true
                },
                'time_end': {
                    required: true
                },
                'personal_category': {
                    required: true
                },
                'owner_name': {
                    required: true
                },
                'personal_nums': {
                    required: true
                },
                'departments_id': {
                    required: true
                },
                'groups_id': {
                    required: true
                }
            },
            messages: {

                'meeting_category': {
                    required: "กรุณากรอกข้อมูล"
                },

                'title': {
                    required: "กรุณากรอกข้อมูล"
                },
                'meeting_room_id': {
                    required: "กรุณากรอกข้อมูล"
                },
                'meeting_type_id': {
                    required: "กรุณากรอกข้อมูล"
                },
                'date_start': {
                    required: "กรุณากรอกข้อมูล"
                },
                'date_end': {
                    required: "กรุณากรอกข้อมูล"
                },
                'time_category': {
                    required: "กรุณากรอกข้อมูล"
                },
                'time_start': {
                    required: "กรุณากรอกข้อมูล"
                },
                'time_end': {
                    required: "กรุณากรอกข้อมูล"
                },
                'personal_category': {
                    required: "กรุณากรอกข้อมูล"
                },
                'owner_name': {
                    required: "กรุณากรอกข้อมูล"
                },
                'personal_nums': {
                    required: "กรุณากรอกข้อมูล"
                },
                'departments_id': {
                    required: "กรุณากรอกข้อมูล"
                },
                'groups_id': {
                    required: "กรุณากรอกข้อมูล"
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
