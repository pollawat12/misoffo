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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ยุทธศาสตร์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">เอทานอล-ไบโอดีเซล</a></li>
                            <li class="breadcrumb-item active">Exchange Rate  </li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข Exchange Rate  </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/strategic/oil/settings/update')}}" method="POST" name="frm-save" id="frm-save">
                     
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล Exchange Rate  </i> </h4>

                       <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}}">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[group_type]" id="group_type" value="{{$t}}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[period]" value="@if ($info->period != NULL){{getDateFormatToInputThai($info->period)}} @endif">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">ประเภทนามสกุลเงิน</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" name="input[currency_type]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->currency_type}}">
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">EXCHANGE RATE</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" name="input[rate]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->rate}}">
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-database-plus"> บันทึก</i>
                    </button>
                    <a href="{{URL('office/strategic/oil/settings/lists')}}/?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                        "> ยกเลิก</i></a>
            </div>
            <!-- end col -->

        </div>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/strategic/oil/settings/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

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
                    required: "กรุณากรอกประเภทค่าใช้จ่าย"
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
