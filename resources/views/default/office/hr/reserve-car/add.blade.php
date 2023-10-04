@extends('default.layouts.main')

@section('css')
    <link href="{{ url('assets/default') }}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/js/plugins/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ url('assets/js/datepicker-th/bootstrap-datepicker.min.css') }}">
 

    <link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/default')}}/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://demos.codexworld.com/multi-select-dropdown-list-with-checkbox-jquery/js/multiselect/jquery.multiselect.css">
    <style>

        input, select {
        height: 50px !important;
        }

        .ms-options-wrap > .ms-options > ul input[type="checkbox"] {
            margin: 0 5px 0 0;
            position: absolute;
            left: 4px;
            top: 5px;           
        }

        .ms-options-wrap > .ms-options > ul li input[type="checkbox"] {
            margin: 0 5px 0 0;
            position: absolute;
            left: 4px;
            top: 0px;           
        }
</style>
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
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">สรุปภาพรวม</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">รายการจองรถยนต์</a></li>
                                    <li class="breadcrumb-item active">ข้อมูลการจองรถยนต์</li>
                                </ol>
                            </div>
                            <h4 class="page-title">เพิ่มข้อมูลการจองรถยนต์</h4>
                        </div>
                    </div>
                </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus"
                                style="font-size: 16px !important; "> ยื่น การจองรถยนต์ส่วนกลาง</i> </h4>
                        <form action="{{ url('office/hr/reserve-car/sub/save') }}" method="POST" autocomplete="off"
                            name="frm-save" id="frm-save">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">
                            <input type="hidden" name="input[user_id]" id="user_id"value="{{ $id }}">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="owner_name">ผู้ขอใช้รถ<code>*</code></label>
                                        <input type="text" name="owner_name" class="form-control" id="owner_name" value="{{ $auth_info['user_name'] }}" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">ตำแหน่ง</label>
                                        <div>

                                            <div class="input-group">
                                                <input type="text" name="" class="form-control" id="" placeholder="">
                                                <small id="emailHelp" class="form-text text-muted"></small>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="groups_id">กลุ่มงาน <code>*</code></label>
                                        <select name="input[groups_id]" class="form-control" id="groups_id">
                                            <option value="">ระบุ</option>
                                            @if ($groupWork_boss)
                                            @foreach ($groupWork_boss as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="departments_id">สำนักงาน <code>*</code></label>
                                        <select name="input[departments_id]" class="form-control" id="departments_id">
                                            <option value="">ระบุ</option>
                                            @if ($department_boss)
                                            @foreach ($department_boss as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="meeting_type_id">ประเภทการจอง <code>*</code></label>
                                        <select name="input[meeting_type_id]" class="form-control" id="meeting_type_id">
                                            <option value="">ระบุ</option>
                                            @if ($meeting_types)
                                            @foreach ($meeting_types as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="purpose_car">วัตถุประสงค์<code>*</code></label>
                                        <select name="input[purpose_car]" class="form-control" id="purpose_car">
                                            <option value="">ระบุ</option>
                                            <option value="รับ-ส่งเจ้าหน้าที่">รับ-ส่งเจ้าหน้าที่</option>
                                            <option value="รับ-ส่งเอกสาร/สิ่งของ">รับ-ส่งเอกสาร/สิ่งของ</option>
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="car_type">ลักษณะการใช้รถ <code>*</code></label>
                                        <select name="input[car_type]" class="form-control" id="car_type">
                                            <option value="">ระบุ</option>
                                            <option value="ส่ง - เที่ยวเดียว">เดินทางเฉพาะขาไป</option>
                                            <option value="ส่งแล้ว - ให้มารับกลับ">เดินทางเฉพาะขากลับ</option>
                                            <option value="ส่งแล้ว - รอรับกลับ">เดินทางไป-กลับ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">วันที่ยื่น</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="pointer-events:none;background-color: #f2f2f2"
                                                    placeholder="วว/ดด/ปปปป" name="input[date_resign]"
                                                    value="{{ getDateFormatToInputThai(date('Y-m-d')) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">วันที่เดินทาง<code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="input[date_start]" value="<?=date('d/m').'/'.(date('Y')+543)?>" id="datepicker-autoclose22" readonly data-provide="datepicker" data-date-language="th-th">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">วันที่เสร็จสิ้น <code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="input[date_end]" value="<?=date('d/m').'/'.(date('Y')+543)?>" id="datepicker-autoclose" readonly data-provide="datepicker" data-date-language="th-th">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="time_start">เวลาไป <code>*</code></label>
                                        <input type="text" class="form-control" name="input[time_start]" id="time_start"  data-toggle="input-mask" data-mask-format="00:00">
                                        <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="time_end">เวลากลับ <code>*</code></label>
                                        <input type="text" class="form-control" name="input[time_end]" id="time_end"  data-toggle="input-mask" data-mask-format="00:00">
                                        <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เรื่อง<code>*</code></label>
                                        <input type="text" name="input[title]" class="form-control" id="title" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail">สถานที่ <code>*</code></label>
                                        <input type="text" name="input[detail]" class="form-control" id="detail" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                    
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="person_category">จำนวนคนนั่ง <code>*</code></label>
                                    <select name="input[person_category]" class="form-control" id="person_category">
                                        <option value="">ระบุ</option>
                                        <option value="ไม่มี">ไม่มี</option>
                                        <option value="มี">มี</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employees">ระบุรายชื่อ <code>*</code></label>
                                    <select name="employees[]" multiple id="employees" class="form-control" id="employees">
                                        @if ($employees)
                                        @foreach ($employees as $val)
                                        <option  onclick="xxx()" value="{{ $val['name'] }}">{{ $val['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="personal_nums">จำนวนคน <code>*</code></label>
                                    <input type="text" name="input[personal_nums]" class="form-control" id="personal_nums" placeholder="" value="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="driver">ผู้ร่วมเดินทาง<code>*</code></label>
                                    <input type="text" name="input[driver]" class="form-control" id="driver" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file_attach">แนบไฟล์</label>
                                    <input type="file" class="filestyle" name="input[file_attach]" placeholder="">
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="comment">หมายเหตุ</label>
                                    <input type="text"  name="input[comment]" class="form-control" id="comment" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department">เบอร์โทร</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" name="input[owner_tel]" class="form-control" id="owner_tel" placeholder="">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div> 
                    
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="division_user_id">ผอ.กลุ่มงาน<code>*</code> </label>
                                        <select name="input[division_user_id]" id="division_user_id" class="form-control"
                                            style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($groupWork_boss) > 0)
                                                @foreach ($groupWork_boss as $key => $val)
                                                    <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                @endforeach
                                                <option value="99">อื่นๆ</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="department_user_id">ผอ.สำนัก<code>*</code> </label>
                                        <select name="input[department_user_id]" id="department_user_id"
                                            class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($department_boss) > 0)
                                                @foreach ($department_boss as $key => $val)
                                                    @if ($val->id != 1)
                                                        <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="director_user_id">ผอ.สำนักงานกองทุนน้ำมันเชื้อเพลิง
                                            <code>*</code></label>
                                        <select name="input[director_user_id]" id="director_user_id" class="form-control"
                                            style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($boss_misoffo) > 0)
                                                @foreach ($boss_misoffo as $key => $val)
                                                    <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                         

                            @if ($id == '0')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="is_approved">อนุมัติการจองรถยนต์ส่วนกลาง<code>*</code></label>
                                            <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                <option value="1">อนุมัติ</option>
                                                <option value="2">ไม่อนุมัติ</option>
                                            </select>
                                            <small id="is_approved" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="input[is_approved]" value="">
                            @endif

                            <span id="load_button">
                                <button type="submit" id="button_sub" class="btn btn-primary"> <i
                                        class="mdi mdi-database-plus"> บันทึก</i>

                                </button>
                            </span>
                            @if ($id != '0')
                                @if ($typeid != '0')
                                    <a href="{{ URL('office/hr/reserve-car-work') }}/{{ $id }}/?t=user"
                                        class="btn btn-secondary"><i
                                            class=" mdi mdi-backspace-outline
                                    ">
                                            ยกเลิก</i></a>
                                @else
                                    <a href="{{ URL('office/hr/reserve-car/sub') }}/{{ $id }}"
                                        class="btn btn-secondary"><i
                                            class=" mdi mdi-backspace-outline
                                    ">
                                            ยกเลิก</i></a>
                                @endif
                            @else
                                <a href="{{ URL('office/hr/reserve-car/all') }}" class="btn btn-secondary"><i
                                        class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                            @endif
                    </form>

                    </div>
                
                </div>
                    <!-- end col -->
            </div>
                <!-- end row -->
                @if ($id == 0)
                    <div id="url-redirect-back" data-url="{{ url('office/hr/reserve-car/all') }}"></div>
                @else
                    <div id="url-redirect-back" data-url="{{ url('office/hr/reserve-car/sub') }}/{{ $id }}"></div>
                @endif
                   <div data-url="{{ URL('/') }}" id="base-url-api"></div>
        </div>
    </div>
    @endsection

    @section('js')
        <script src="{{ url('assets/default') }}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

        <script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
        <script src="{{ url('assets/default') }}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

        <script src="{{ url('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/validate/validate.js') }}"></script>

        <script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script src="https://demos.codexworld.com/multi-select-dropdown-list-with-checkbox-jquery/js/multiselect/jquery.multiselect.js"></script>

        <script>
            $(".datepicker-autoclose").datepicker({
                language: 'th',
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


            $('#employees').multiselect({
            columns: 1,
            texts: {
            placeholder: 'เลือกรายชื่อ',
            search     : 'ค้นหา'
            },
            search: true,
            selectAll: true 
            });


            $(function() {

                $.validator.setDefaults({
                    submitHandler: function() {
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
                'input[title]': {
                    required: true
                },
                'input[purpose_car]': {
                    required: true
                },
                'input[detail]': {
                    required: true
                },
                'input[meeting_room_id]': {
                    required: true
                },
                'input[meeting_type_id]': {
                    required: true
                },
                'input[car_type]': {
                    required: true
                },
                'input[date_start]': {
                    required: true
                },
                'input[date_end]': {
                    required: true
                },
                'input[time_start]': {
                    required: true
                },
                'input[time_end]': {
                    required: true
                },
                'input[person_category]': {
                    required: true
                },
                'input[owner_name]': {
                    required: true
                },
                'input[personal_nums]': {
                    required: true
                },
                'input[departments_id]': {
                    required: true
                },
                'input[groups_id]': {
                    required: true
                }
            },
            messages: {
                'input[title]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[purpose_car]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[detail]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[meeting_room_id]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[meeting_type_id]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[car_type]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[date_start]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[date_end]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[time_start]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[time_end]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[person_category]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[owner_name]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[personal_nums]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[departments_id]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[groups_id]': {
                    required: "กรุณากรอกข้อมูล"
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
                    }




                });



            });
        </script>
    @endsection
