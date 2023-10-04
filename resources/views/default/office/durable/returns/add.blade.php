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
                            <li class="breadcrumb-item active">ยืมครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ยืมครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล การยืมครุภัณฑ์</i> </h4>

                    <form action="{{url('office/durable/activity/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="durable_type" value="{{$t}}">
                        <input type="hidden" name="input[durable_status]" id="durable_status" value="1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value_id">Serial Number <code>*</code></label>
                                    <select name="value_id" class="form-control" style="height: 45px;">
                                        <option value="0">--เลือก--</option>
                                        @if (count($item) > 0)
                                        @foreach($item as $key => $val)
                                        <option value="{{$val->id}}">{{$val->durable_serial}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="value_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value1_id">หมายเลขครุภัณฑ์ <code>*</code></label>
                                    <select name="value1_id" class="form-control" style="height: 45px;">
                                        <option value="0">--เลือก--</option>
                                        @if (count($item) > 0)
                                        @foreach($item as $key1 => $val1)
                                        <option value="{{$val1->id}}">{{$val1->durable_number}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="value_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_date">วันที่ได้รับ <code>*</code></label>
                                    <input type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" name="input[borrow_date]" id="datepicker-autoclose22" readonly="">
                                    <small id="borrow_date" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_user_name">ชื่อผู้ยืม <code>*</code></label>
                                    <input type="text" name="input[borrow_user_name]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="borrow_user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_institution">หน่วยงาน <code>*</code></label>
                                    <input type="text" name="input[borrow_institution]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="borrow_institution" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_affiliate">สังกัด <code>*</code></label>
                                    <input type="text" name="input[borrow_affiliate]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="borrow_affiliate" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_location">สถานที่ใช้งาน <code>*</code></label>
                                    <input type="text" name="input[borrow_location]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="borrow_location" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_detail">รายละเอียดเพิ่มเติม</label>
                                    <textarea name="input[borrow_detail]" class="form-control"></textarea>
                                    <small id="borrow_detail" class="form-text text-muted"></small>
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
        <div id="url-redirect-back" data-url="{{url('office/durable/activity')}}/?t={{$t}}&pr={{$pr}}"></div>
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
                'input[value_id]': {
                    required: true
                }
            },
            messages: {
                'input[value_id]': {
                    required: "กรุณาเลือกครุภัณฑ์"
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
