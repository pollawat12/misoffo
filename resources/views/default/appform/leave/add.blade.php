@extends('default.template')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายการลา</a></li>
                            <li class="breadcrumb-item active">ข้อมูลการลา</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เพิ่มข้อมูลการลา</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-icon alert-info text-info alert-dismissible fade show p-3" role="alert" style="color: black !important;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-information mr-2"></i>
                    <strong>ข้อมูลจำนวนวันลาคงเหลือ</strong> <span id="leave_num" style="font-weight:bold;color:red;"> </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ยื่นใบลา (ระเบียบการลา)</i> </h4>

                    <form action="{{url('office/hr/leave/sub/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id">เจ้าหน้าที่<code>*</code></label>
                                    @if($id != '0')
                                        <select name="input[user_id_new]" class="form-control" style="height: 45px;" disabled >
                                            <option value="">--เลือก--</option>
                                            @if (count($employees) > 0)
                                            @foreach($employees as $val1)
                                            <option value="{{$val1['id']}}" @if($val1['id'] == $id) selected @endif>{{$val1['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>    

                                        <input type="hidden" name="input[user_id]" id="user_id" value="{{$id}}">
                                    @else

                                        <select name="input[user_id]" id="user_id" class="form-control" style="height: 45px;" >
                                            <option value="">--เลือก--</option>
                                            @if (count($employees) > 0)
                                            @foreach($employees as $val1)
                                            <option value="{{$val1['id']}}" >{{$val1['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leave_type">ประเภทการลา <code>*</code> </label>
                                    <select name="input[leave_type]" id="leave_type" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($categoryLeave) > 0)
                                        @foreach($categoryLeave as $key => $val)
                                        <option value="{{$val->id}}" @if($val['id'] == $typeid) selected @endif>{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่กรอก </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_resign]" value="{{getDateFormatToInputThai(date("Y-m-d"))}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span id="leave_load">

                        </span>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่เริ่มลา </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่สิ้นสุด </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_end]" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">รายละเอียด</label>
                                    <textarea  name="input[note]" class="form-control"></textarea>
                                    <small id="note" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="faculty_name">แนบไฟล์ </label>
                                    <input type="file" class="filestyle" name="upfile_leave" placeholder="" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input id="input-transfer-is_present" name="input[is_present]" type="checkbox" value="1">
                                        <label for="input-transfer-is_present">
                                            ลาจากภายนอกสำนักงาน
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($id == '0')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_approved">สถานะการอนุมัติการลา <code>*</code></label>
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
                            <button type="submit" id="button_sub" class="btn btn-primary"> <i class="mdi mdi-database-plus"> บันทึก</i></button>
                        </span>
                        @if($id != '0')
                            @if($typeid != '0')
                                <a href="{{URL('office/hr/leave-work')}}/{{$id}}/?t=user"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>
                            @else
                                <a href="{{URL('office/hr/leave/sub')}}/{{$id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>    
                            @endif
                        @else
                            <a href="{{URL('office/hr/leave/all')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>    
                        @endif
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        @if($id == 0)
            <div id="url-redirect-back" data-url="{{url('office/hr/leave/all')}}"></div>
        @else
            <div id="url-redirect-back" data-url="{{url('office/hr/leave/sub')}}/{{$id}}"></div>
        @endif

        <div data-url="{{URL('/')}}" id="base-url-api"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });


    $(document).on('change', '#leave_type', function() {
        let values = $(this).val();

        let userid = $('#user_id').val();

        var _url = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values + '&type=0';

        var _urlCheckDay = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values + '&type=' + userid;

        $.get(_url, function(data){
            $("#leave_load").html(data.info);
        }, "json");

        $.get(_urlCheckDay, function(data){
            $("#leave_num").html(data.info);
            $("#load_button").html(data.checkIS);
        }, "json");

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
                'input[leave_type]': {
                    required: true
                },
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
            }
        });
    });
</script>
@endsection
