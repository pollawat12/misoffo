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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่มข้อมูล การรับพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล การรับพัสดุ/อุปกรณ์</i> </h4>

                    <form action="{{url('office/durable/amount/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="input[value_id]" value="{{$id}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_name">พัสดุอุปกรณ์ <code>*</code></label>
                                    <input type="text" name="input[durable_name]" class="form-control" placeholder="" disabled style="height: 45px;" value="{{$info->durable_name}}">
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                    <select name="input[unitcount_id]" class="form-control" style="height: 45px;" disabled>
                                        <option value="1">--เลือก--</option>
                                        @if (count($unitcount) > 0)
                                        @foreach($unitcount as $key => $val)
                                        <option value="{{$val->data_value}}" @if($val->data_value == $info->unitcount_id) selected @endif>{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="unitcount_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">จำนวน <code>*</code></label>
                                    <input type="text" name="input[amount_num]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num_in">จำนวนภายใน <code>(กรณีที่สามารถนับได้)</code></label>
                                    <input type="text" name="input[amount_num_in]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_num_in" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_date">วันที่ได้รับ <code>*</code></label>
                                    <input type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" name="input[amount_date]" id="datepicker-autoclose22" readonly="">
                                    <small id="amount_date" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_price">ราคา/หน่วย/ชุด/กลุ่ม <code>*</code></label>
                                    <input type="text" name="input[amount_price]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_price" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/amount')}}/{{$id}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/amount')}}/{{$id}}?t={{$t}}&pr={{$pr}}"></div>
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
                'input[amount_num]': {
                    required: true
                }
            },
            messages: {
                'input[amount_num]': {
                    required: "กรุณากรอกจำนวน"
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
