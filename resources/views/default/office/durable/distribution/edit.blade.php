@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบตัดจำหน่ายครุภัณฑ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตัดจำหน่ายครุภัณฑ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลตัดจำหน่ายครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข ตัดจำหน่ายครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตัดจำหน่ายครุภัณฑ์</i> </h4>

                    <form action="{{url('office/durable/activity/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="value_id" value="{{$id}}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[unitcount_id]" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">
                        <input type="hidden" name="input[durable_status]" id="durable_status" value="2">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_serial">Serial Number <code>*</code></label>
                                    <input type="text" class="form-control" placeholder="" name="input[durable_serial]"  value="{{$info->durable_serial}}" disabled>
                                    <small id="durable_serial" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_name">ชื่อตัดจำหน่ายครุภัณฑ์ <code>*</code></label>
                                    <input type="text" class="form-control" name="input[durable_serial]" value="{{$info->durable_name}}" disabled>
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_number">หมายเลขตัดจำหน่ายครุภัณฑ์ <code>*</code></label>
                                    <input type="text" name="input[durable_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_number}}" disabled>
                                    <small id="durable_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่จำหน่าย </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[distribution_date]" value="@if ($info->distribution_date != NULL){{getDateFormatToInputThai($info->distribution_date)}} @endif"  >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distribution_user_name">ชื่อจำหน่าย <code>*</code></label>
                                    <input type="text" name="input[distribution_user_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->distribution_user_name}}" >
                                    <small id="distribution_user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distribution_institution">หน่วยงาน <code>*</code></label>
                                    <input type="text" name="input[distribution_institution]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->distribution_institution}}">
                                    <small id="distribution_institution" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distribution_affiliate">สังกัด <code>*</code></label>
                                    <input type="text" name="input[distribution_affiliate]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->distribution_affiliate}}">
                                    <small id="distribution_affiliate" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="is_affiliate">สาเหตุการจำหน่ายครุภัณฑ์ <code>*</code></label>
                                    <div class="checkbox">
                                        <input id="input-is_affiliate_1" name="input[is_affiliate_1]" type="checkbox" @if(1 == $info->is_affiliate_1) checked @endif value="1">
                                        <label for="input-is_affiliate_1">
                                            ชำรุดเนื่องจาการใช้งาน
                                        </label>
                                        <input id="input-is_affiliate_2" name="input[is_affiliate_2]" type="checkbox" @if(1 == $info->is_affiliate_2) checked @endif value="1">
                                        <label for="input-is_affiliate_2">
                                            เสื่อมสภาพตามอายุการใช้งาน
                                        </label>

                                        <input id="input-is_affiliate_3" name="input[is_affiliate_3]" type="checkbox" @if(1 == $info->is_affiliate_3) checked @endif value="1">
                                        <label for="input-is_affiliate_3">
                                            สูญหาย
                                        </label>

                                        <input id="input-is_affiliate_4" name="input[is_affiliate_4]" type="checkbox" @if(1 == $info->is_affiliate_4) checked @endif value="1">
                                        <label for="input-is_affiliate_4">
                                            ไม่จำเป็นต้องใช้งาน
                                        </label>

                                        <input id="input-is_affiliate_5" name="input[is_affiliate_5]" type="checkbox" @if(1 == $info->is_affiliate_5) checked @endif value="1">
                                        <label for="input-is_affiliate_5">
                                            ไม่คุ้มค่าในการซ่อม
                                        </label>

                                        <input id="input-is_affiliate_6" name="input[is_affiliate_6]" type="checkbox" @if(1 == $info->is_affiliate_6) checked @endif value="1">
                                        <label for="input-is_affiliate_6">
                                            ซ่อมแซม
                                        </label>

                                        <input id="input-is_affiliate_7" name="input[is_affiliate_7]" type="checkbox" @if(1 == $info->is_affiliate_7) checked @endif value="1">
                                        <label for="input-is_affiliate_7">
                                            ใช้งานได้ปกติ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="distribution_number">หมายเลขจำหน่าย <code>*</code></label>
                                    <input type="text" name="input[distribution_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->distribution_number}}">
                                    <small id="distribution_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distribution_number">ชื่อผู้รับจำหน่าย <code>*</code></label>
                                    <input type="text" name="input[distribution_in_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->distribution_in_name}}">
                                    <small id="distribution_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่รับจำหน่าย </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[distribution_in_date]" value="@if ($info->distribution_in_date != NULL){{getDateFormatToInputThai($info->distribution_in_date)}} @endif">
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
                                    <label for="distribution_detail">สถานที่นำไปตัดจำหน่าย</label>
                                    <textarea name="input[distribution_location]" class="form-control">{{$info->distribution_location}}</textarea>
                                    <small id="distribution_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="distribution_detail">รายละเอียดเพิ่มเติม</label>
                                    <textarea name="input[distribution_detail]" class="form-control">{{$info->distribution_detail}}</textarea>
                                    <small id="distribution_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/activity')}}?t=distribution&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/activity')}}/?t={{$t}}&pr={{$pr}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>

<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(function () {


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
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกฝ่ายงาน"
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

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>
@endsection
