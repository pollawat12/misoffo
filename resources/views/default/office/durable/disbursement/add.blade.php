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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบครุภัณฑ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เบิกพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล พัสดุ/อุปกรณ์</i> </h4>

                    <form action="{{url('office/durable/disbursement/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="durable_type" value="{{$t}}">
                        <input type="hidden" name="input[location]" value="">
                        <input type="hidden" name="input[borrow_project]" value="0">
                        <input type="hidden" name="input[lotid]" value="1">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="value_id">พัสดุ/อุปกรณ์ <code>*</code></label>
                                    <select name="input[value_id]" class="form-control" id="value_id" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        @if (count($item) > 0)
                                        @foreach($item as $key => $val)
                                        <option value="{{$val->id}}">{{$val->durable_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_project">โครงการ </label>
                                    <select class="form-control" name="input[borrow_project]" id="borrow_project" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        {{-- <option value="0">สำนักงาน</option>
                                        @if (count($project) > 0)
                                        @foreach($project as $key2 => $val2)
                                        <option value="{{$val2->id}}">{{$val2->project_name}}</option>
                                        @endforeach
                                        @endif --}}
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_date">วันที่เบิกจ่าย <code>*</code></label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" name="input[amount_date]" id="datepicker-autoclose22" readonly="" value="{{getDateFormatToInputThai(date("Y-m-d"))}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_name">ชื่อผู้เบิก <code>*</code></label>
                                    <input type="text" name="input[user_name]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="institution">หน่วยงาน <code>*</code></label>
                                    <select class="form-control" name="input[institution]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyInstitution => $valInstitution)
                                        <option value="{{$valInstitution->id}}">{{$valInstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="affiliate">ฝ่าย <code>*</code></label>
                                    <input type="text" name="input[affiliate]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="affiliate" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">จำนวน  <code>*</code></label>
                                    <input type="text" name="input[amount_num]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="money_id">ประเภทเงิน </label>
                                    <select name="input[money_id]" id="money_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($money) > 0)
                                        @foreach($money as $keyMoney => $valMoney)
                                        <option value="{{$valMoney->id}}">{{$valMoney->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/disbursement')}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/disbursement')}}/?t={{$t}}&pr={{$pr}}"></div>

        <div data-url="{{URL('/')}}" id="base-url-api"></div>
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

        $(document).on("change", "#value_id", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=project&id=" + _itemValue;

            $.get(_url, function(data){
                $("#borrow_project").html(data.elem_html);
            }, "json");
        });
        
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
                },
                'input[amount_num]': {
                    required: true
                },
                
            },
            messages: {
                'input[value_id]': {
                    required: "กรุณาเลือกพัสดุ/อุปกรณ์"
                },
                'input[amount_num]': {
                    required: "กรุณากรอกจำนวน"
                },
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
