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
                    <h4 class="page-title">แก้ไข พัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล พัสดุ/อุปกรณ์</i> </h4>

                    <form action="{{url('office/durable/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">
                        <input type="hidden" name="input[lotid]" value="1">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_name">พัสดุอุปกรณ์ <code>*</code></label>
                                    <input type="text" name="input[durable_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_name}}">
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="typedata_id">ประเภท <code>*</code></label>
                                    <select name="input[typedata_id]" class="form-control" style="height: 45px;">
                                        <option value="1">--เลือก--</option>
                                        @if (count($typedata) > 0)
                                        @foreach($typedata as $key1 => $val1)
                                        <option value="{{$val1->data_value}}" @if($val1->data_value == $info->typedata_id) selected @endif>{{$val1->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="typedata_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_brand">ยี่ห้อ <code>*</code></label>
                                    <input type="text" name="input[durable_brand]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_brand}}">
                                    <small id="durable_brand" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                    <select name="input[unitcount_id]" class="form-control" style="height: 45px;">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_storage_location">สถานที่จัดเก็บ <code>*</code></label>
                                    <input type="text" name="input[durable_storage_location]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_storage_location}}">
                                    <small id="durable_storage_location" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/lists')}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
