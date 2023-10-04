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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">การเงิน > รายรับ - รายจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if($t == 1) รายรับ (IN) @elseif($t == 2) รายจ่าย (PN) @else ค้างจ่าย (RA) @endif</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/expenses/income/update')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล @if($t == 1) รายรับ (IN) @elseif($t == 2) รายจ่าย (PN) @else ค้างจ่าย (RA) @endif</i> </h4>

                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <input type="hidden" name="input[type_id]" value="{{$t}}">

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">วันที่ <code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป"  name="input[income_date]" value="@if ($info->income_date != NULL){{getDateFormatToInputThai($info->income_date)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="income_number">เลขที่ <code>*</code></label>
                                        <input type="text" name="input[income_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->income_number}}">
                                        <small id="income_number" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="number_sum">จำนวนเงิน <code>*</code></label>
                                        <input type="text" name="input[number_sum]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->number_sum}}">
                                        <small id="number_sum" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail">รายการ</label>
                                        <textarea  name="input[detail]" class="form-control">{{$info->detail}}</textarea>
                                        <small id="detail" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-database-plus"> บันทึก</i>
                            </button>
                            <a href="{{url('office/expenses/income/lists')}}/?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class="mdi mdi-keyboard-backspace"> ย้อนกลับ</i></a>
                    </div>
                </div>
                <!-- end col -->

                

            </div>
        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/expenses/income/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
                'input[certificate_id]': {
                    required: true
                }
            },
            messages: {
                'input[certificate_id]': {
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
            }
        });
    });
    

</script>
@endsection
