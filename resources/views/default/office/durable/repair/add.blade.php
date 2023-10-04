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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ซ่อมแซม</a></li>
                            <li class="breadcrumb-item active">ข้อมูลซ่อมแซม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เพิ่มซ่อมแซม</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ซ่อมแซม</i> </h4>

                    <form action="{{url('office/durable/repair/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="durable_id">ครุภัณฑ์ </label>
                                                <select class="form-control" name="input[durable_id]" data-toggle="select2">
                                                    <option value="">--เลือก--</option>
                                                    @if (count($item) > 0)
                                                    @foreach($item as $key => $val)
                                                    <option value="{{$val->id}}">{{$val->durable_number}} || {{$val->durable_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob">วันที่แจ้งซ่อม </label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_report]" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_sum">ราคารวม <code>*</code></label>
                                                <input type="text" name="input[price_sum]" class="form-control" placeholder="" style="height: 45px;">
                                                <small id="price_sum" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_name">ชื่อผู้แจ้งซ่อม <code>*</code></label>
                                                <input type="text" name="input[user_name]" class="form-control" placeholder="" style="height: 45px;">
                                                <small id="user_name" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_approved">สถานะอนุมัติ <code>*</code></label>
                                                <select name="input[is_approved] " class="form-control"] style="height: 45px;">
                                                    <option value="">--เลือก--</option>
                                                    <option value="0">อนุมัติการซ่อมแซม</option>
                                                    <option value="1">ไม่อนุมัติการซ่อมแซม</option>
                                                </select>
                                                <small id="is_approved" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note">รายละเอียดเพิ่มเติม</label>
                                                <textarea  name="input[note]" class="form-control"></textarea>
                                                <small id="note" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/repair')}}?t=repair&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/repair/')}}/?t={{$t}}&pr={{$pr}}"></div>

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
                'input[durable_id]': {
                    required: true
                }
            },
            messages: {
                'input[durable_id]': {
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
