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
                            <li class="breadcrumb-item active">จองห้องประชุม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไขข้อมูล จองห้องประชุม</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล จองห้องประชุม</i> </h4>

                    <form action="{{url('office/services/reserve-meeting/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="edit_id" value="{{ $id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">หัวข้อการประชุม <code>*</code></label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ $info->title }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="meeting_room_id">ห้องประชุม <code>*</code></label>
                                    <select name="meeting_room_id" class="form-control" id="meeting_room_id">
                                        <option value="">ระบุ</option>
                                        @if ($rooms)
                                        @foreach ($rooms as $item)
                                        <option value="{{ $item->id }}" @if($info->meeting_room_id == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="meeting_type_id">ประเภทการประชุม <code>*</code></label>
                                    <select name="meeting_type_id" class="form-control" id="meeting_type_id">
                                        <option value="">ระบุ</option>
                                        @if ($meeting_types)
                                        @foreach ($meeting_types as $item)
                                        <option value="{{ $item->id }}" @if($info->meetIng_type_id == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departments_id">สำนักงาน <code>*</code></label>
                                    <select name="departments_id" class="form-control" id="departments_id">
                                        <option value="">ระบุ</option>
                                        @if ($department_works)
                                        @foreach ($department_works as $item)
                                        <option value="{{ $item->id }}" @if($info->departments_id == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="groups_id">กลุ่มงาน <code>*</code></label>
                                    <select name="groups_id" class="form-control" id="groups_id">
                                        <option value="">ระบุ</option>
                                        @if ($group_works)
                                        @foreach ($group_works as $item)
                                        <option value="{{ $item->id }}" @if($info->groups_id == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">วันที่เริ่มต้น <code>*</code></label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="date_start" value="<?=getDateFormatToInputThai($info->date_start)?>" id="datepicker-autoclose22" readonly data-provide="datepicker" data-date-language="th-th">
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
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="date_end" value="<?=getDateFormatToInputThai($info->date_end)?>" id="datepicker-autoclose" readonly data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_start">เวลาเริ่ม <code>*</code></label>
                                    <input type="text" class="form-control" name="time_start" id="time_start"  data-toggle="input-mask" value="{{ $info->time_start }}" data-mask-format="00:00">
                                    <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_end">เวลาเสร็จสิ้น <code>*</code></label>
                                    <input type="text" value="{{ $info->time_end }}" class="form-control" name="time_end" id="time_end"  data-toggle="input-mask" data-mask-format="00:00">
                                    <span class="font-13 text-muted">ตัวอย่าง "HH:MM"</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="personal_nums">จำนวนผู้เข้าร่วม <code>*</code></label>
                                    <input type="text" name="personal_nums" class="form-control" id="personal_nums" placeholder="" value="{{ $info->personal_nums }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="owner_name">ผู้รับผิดชอบ <code>*</code></label>
                                    <input type="text" name="owner_name" class="form-control" id="owner_name" placeholder="" value="{{ $info->owner_name }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="owner_tel">เบอร์โทร (ผู้รับผิดชอบ) </label>
                                    <input type="text" value="{{ $info->owner_tel }}" name="owner_tel" class="form-control" id="owner_tel" placeholder="">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="accessory_items">อุปกรณ์ห้องประชุม <code>*</code></label>
                                    <select name="accessory_items" class="form-control" id="accessory_items">
                                        <option value="">ระบุ</option>
                                        @if ($meeting_items)
                                        @foreach ($meeting_items as $item)
                                        <option value="{{ $item->id }}" selected >{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail">รายละเอียด </label>
                                    <textarea name="detail" id="detail" cols="30" rows="3"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">{{ $info->detail }}</small>
                                </div>
                            </div>
                        </div> --}}
                            
                        {{-- <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">อุปกรณ์ห้องประชุม </label>
                                    <div class="row">
                                        @if ($meeting_items)
                                        @foreach ($meeting_items as $item)
                                        <div class="col-md-3 ">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <input type="checkbox" @if(in_array($item->id, $accessory_items)) checked @endif value="{{ $item->id }}" name="accessory_items[]" data-plugin="switchery" data-color="#039cfd" data-size="small"/>
                                                </div>
                                                <div class="col-md-10 ml-2">{{ $item->name }}</div>
                                            </div>
                                        </div>
                                        @endforeach

                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                   
                        @if($auth_info['user_id'] == 146)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status_approved">สถานะการอนุมัติ<code>*</code></label>
                                        <select name="status_approved" class="form-control" id="status_approved">
                                            <option value="" selected>เลือก</option>
                                            <option value="0" >รออนุมัติ</option>
                                            <option value="1" >อนุมัติ</option>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status_approved">ยอมรับการแก้ไข<code>*</code></label>
                                        <select name="status_approved" class="form-control" id="status_approved">
                                            <option value="" selected>เลือก</option>
                                            <option value="0" >ยินยอม</option> 
                                        </select>  
                                    </div>
                                </div>
                            </div>
                        @endif
         

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/services/reserve-meeting')}}"  class="btn btn-secondary"><i class="fas fa-arrow-left"> ยกเลิก</i></a>
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
                    window.location.href = "{{ url('office/services/reserve-meeting') }}";
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }
        
        $('#frm-save').validate({
            rules: {
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
                'time_start': {
                    required: true
                },
                'time_end': {
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
                },

                'status_approved':{
                    required: true
                }
            },
            messages: {
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
                'time_start': {
                    required: "กรุณากรอกข้อมูล"
                },
                'time_end': {
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
                },

                'status_approved':{
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
