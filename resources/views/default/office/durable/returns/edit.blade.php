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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบครุภัณฑ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ครุภัณฑ์</a></li>
                            <li class="breadcrumb-item active">คืนครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">การคืนครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; ">ข้อมูล การคืนครุภัณฑ์</i> </h4>

                    <form action="{{url('office/durable/activity/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="value_id" value="{{$id}}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[unitcount_id]" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">
                        <input type="hidden" name="input[durable_status]" id="durable_status" value="0">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_name">ชื่อครุภัณฑ์<code>*</code></label>
                                    <input type="text" class="form-control" placeholder="" name="input[durable_name]"  value="{{$info->durable_name}}" disabled>
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_number">หมายเลขครุภัณฑ์ <code>*</code></label>
                                    <input type="text" name="input[durable_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_number}}" disabled>
                                    <small id="durable_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_serial">Serial Number <code>*</code></label>
                                    <input type="text" class="form-control" name="input[durable_serial]" value="{{$info->durable_serial}}" disabled>
                                    <small id="durable_serial" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_brand">ยี่ห้อ <code>*</code></label>
                                    <select name="input[durable_brand]" id="durable_brand" class="form-control" style="height: 45px;" disabled>
                                        <option value="">--เลือก--</option>
                                        @if (count($brand) > 0)
                                        @foreach($brand as $keyBrand => $valBrand)
                                        <option @if($valBrand->id == $info->durable_brand) selected @endif value="{{$valBrand->id}}">{{$valBrand->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่ยืม </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="dd/mm/yyyy"  name="input[borrow_date]" value="@if ($info->borrow_date != NULL){{getDateFormatToInputThai($info->borrow_date)}} @endif" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_user_name">ชื่อผู้ยืม <code>*</code></label>
                                    <input type="text" name="input[borrow_user_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->borrow_user_name}}" disabled>
                                    <small id="borrow_user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่คืน </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="dd/mm/yyyy"  name="input[returns_date]" value="@if ($info->returns_date != NULL){{getDateFormatToInputThai($info->returns_date)}} @endif">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="returns_user_name">ชื่อผู้คืน <code>*</code></label>
                                    <input type="text" name="input[returns_user_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->borrow_user_name}}">
                                    <small id="returns_user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="returns_institution">หน่วยงาน <code>*</code></label>
                                    <select class="form-control" name="input[returns_institution]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyInstitution => $valInstitution)
                                        <option value="{{$valInstitution->id}}" @if($valInstitution->id == $info->borrow_institution) selected @endif>{{$valInstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="returns_affiliate">สำนัก/กอง <code>*</code></label>
                                    <input type="text" name="input[returns_affiliate]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->borrow_affiliate}}">
                                    <small id="returns_affiliate" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_detail">รายละเอียดเพิ่มเติม</label>
                                    <textarea name="input[borrow_detail]" class="form-control">{{$info->borrow_detail}}</textarea>
                                    <small id="borrow_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_status">สถานะการยืม/คืน<code>*</code></label>
                                    <select name="input[durable_status] " class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="1" @if(1 == $info->durable_status) selected @endif>ยืม</option>
                                        <option value="0" @if(0 == $info->durable_status) selected @endif>คืน</option>
                                    </select>
                                    <small id="durable_status" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/activity')}}?t=borrow&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/activity')}}/?t=borrow&pr={{$pr}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

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
            }
        });
    });
</script>
@endsection
