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
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> การอนุมัติการลา</i> </h4>

                    <form action="{{url('office/hr/leave/sub/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <div class="row">
                            <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_id">เจ้าหน้าที่ <code>*</code></label>
                                                <select name="input[user_id]" class="form-control" style="height: 45px;">
                                                    <option value="">--เลือก--</option>
                                                    @if (count($employees) > 0)
                                                    @foreach($employees as $val1)
                                                    <option value="{{$val1['id']}}" @if($val1['id'] == $info->users_id) selected @endif>{{$val1['name']}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <small id="user_id" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="leave_type">ประเภทการลา <code>*</code></label>
                                                <select name="input[leave_type]" class="form-control" id="leave_type" style="height: 45px;">
                                                    <option value="">--เลือก--</option>
                                                    @if (count($categoryLeave) > 0)
                                                    @foreach($categoryLeave as $key => $val)
                                                    <option value="{{$val->id}}" @if($val->id == $info->leave_type) selected @endif>{{$val->name}}</option>
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
                                                        <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_resign]" value="{{getDateFormatToInputThai($info->date_resign)}}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span id="leave_load">
                                           <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="represent_name">ผู้ปฎิบัติงานแทน</label>
                                                        <input type="text" name="input[represent_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->represent_name}}">
                                                        <small id="represent_name" class="form-text text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="represent_tel">เบอร์โทรติดต่อ</label>
                                                        <input type="text" name="input[represent_tel]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->represent_tel}}">
                                                        <small id="represent_tel" class="form-text text-muted"></small>
                                                    </div>
                                                </div>
                                           </div>
                                    </span>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">วันที่เริ่มลา </label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_start]" value="{{getDateFormatToInputThai($info->date_start)}}">
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
                                                        <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_end]" value="{{getDateFormatToInputThai($info->date_end)}}">
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
                                                <textarea  name="input[note]" class="form-control">{{$info->note}}</textarea>
                                                <small id="note" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>

                                    @if($t == 'admin')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="is_approved">สถานะการอนุมัติการลา <code>*</code></label>
                                                    @if($info->is_approved == '1')
                                                        <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            <option value="2">อนุมัติ</option>
                                                            <option value="4">ไม่อนุมัติ</option>
                                                        </select>
                                                    @elseif($info->is_approved == '2')    
                                                        <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            <option value="3">อนุมัติ</option>
                                                            <option value="4">ไม่อนุมัติ</option>
                                                        </select>
                                                    @elseif($info->is_approved == '3')
                                                        <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            <option value="3">อนุมัติ</option>
                                                            <option value="4">ไม่อนุมัติ</option>
                                                        </select>
                                                    @elseif($info->is_approved == '4')
                                                        <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            <option value="1">อนุมัติ</option>
                                                            <option value="4">ไม่อนุมัติ</option>
                                                        </select>
                                                    @else  
                                                        <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            <option value="1">อนุมัติ</option>
                                                            <option value="4">ไม่อนุมัติ</option>
                                                        </select>
                                                    @endif
                                                    <small id="is_approved" class="form-text text-muted"></small>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" name="input[is_approved]" value="">
                                    @endif
                                        </div>
                                    </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        @if($t == 'admin')
                         <a href="{{URL('office/hr/leave/all')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>   
                        @else
                            <a href="{{URL('office/hr/leave/sub')}}/{{$info->users_id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>   
                        @endif
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        @if($t == 'admin')
            <div id="url-redirect-back" data-url="{{url('office/hr/leave/all')}}"></div>
        @else
            <div id="url-redirect-back" data-url="{{url('office/hr/leave/sub')}}/{{$id}}"></div>
        @endif

        <div data-url="{{URL('/')}}" id="base-url-api"></div>
    </div>
</div>
@endsection

@section('js')
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

        var _url = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values;

        $.get(_url, function(data){
            $("#leave_load").html(data.elem_html);
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
