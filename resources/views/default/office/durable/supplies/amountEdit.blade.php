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
                        <input type="hidden" name="edit_id" value="{{$id}}">
                        <input type="hidden" name="input[value_id]" value="{{$amount->durable_id}}">
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
                                        <option value="{{$val->id}}" @if($val->id == $info->unitcount_id) selected @endif>{{$val->name}}</option>
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
                                    <label for="amount_num">เลขที่ใบสำคัญ <code>*</code></label>
                                    <input type="text" name="input[amount_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_number}}">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_name">รับจาก</code></label>
                                    <input type="text" name="input[amount_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_name}}">
                                    <small id="amount_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_file">ไฟล์เอกสาร<code>*</code></label>
                                    <input type="file" name="input[invoice_file]" class="filestyle" placeholder="" style="height: 45px;">
                                    <small id="invoice_file" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่รับ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[amount_date]" value="{{getDateFormatToInputThai($amount->amount_date)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">ราคา <code>*</code></label>
                                    <input type="text" name="input[amount_price]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_price}}">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num_in">VAT 7%</code></label>
                                    <input type="text" name="input[amount_vat]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_vat}}">
                                    <small id="amount_num_in" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">ราคาสุทธิ <code>*</code></label>
                                    <input type="text" name="input[amount_sum]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_sum}}">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num_in">จำนวนรับ</code></label>
                                    <input type="text" name="input[amount_num]" class="form-control" placeholder="" style="height: 45px;" value="{{$amount->amount_num}}">
                                    <small id="amount_num_in" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_project">โครงการ </label>
                                    <select class="form-control" name="input[borrow_project]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        <option value="0" @if(0 == $amount->project_id) selected @endif>สำนักงาน</option>
                                        @if (count($project) > 0)
                                        @foreach($project as $key2 => $val2)
                                        <option value="{{$val2->id}}" @if($val2->id == $amount->project_id) selected @endif>{{$val2->project_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="money_id">ประเภทเงิน </label>
                                    <select name="input[money_id]" id="money_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($money) > 0)
                                        @foreach($money as $keyMoney => $valMoney)
                                        <option value="{{$valMoney->id}}" @if($valMoney->id == $amount->money_id) selected @endif>{{$valMoney->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/amount')}}/{{$amount->durable_id}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/amount')}}/{{$amount->durable_id}}?t={{$t}}&pr={{$pr}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

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
