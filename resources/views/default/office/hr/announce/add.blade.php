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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ใบสมัครออนไลน์</a>
                            </li>
                            <li class="breadcrumb-item active">เพิ่มประกาศรับสมัครงาน
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่มประกาศรับสมัครงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <form action="{{url('office/hr/announce/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="sort_order" value="0">

                        <div class="media-body">
                            <h6 class="header-title mb-1 font-size-16 mt-3">
                                เพิ่ม ประกาศรับสมัครงาน</h6>
                            <hr class="hr-form-all">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputEmail4"
                                                    class="col-form-label label-step">เรื่อง
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="input[name]" id="name"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail4"
                                                    class="col-form-label label-step">วันที่เริ่มประกาศ <span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose"
                                                            placeholder="วว/ดด/ปปปป" name="input[day_start]">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail4"
                                                    class="col-form-label label-step">วันที่สิ้นสุดประกาศ <span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose"
                                                            placeholder="วว/ดด/ปปปป" name="input[day_end]">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail4"
                                            class="col-form-label label-step">คำอธิบายโดยย่อ</label>
                                        <textarea name="input[note]" id="" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ปีงบประมาณ
                                            <span class="text-danger">*</span></label>
                                        <select name="input[year_id]" id="year_id" class="form-control">
                                            <option value="">--เลือก--</option>
                                            @if (count($years) > 0)
                                            @foreach($years as $keyinfo => $valinfo)
                                            <option value="{{$valinfo->id}}">{{$valinfo->in_year}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">สถานะ
                                            <span class="text-danger">*</span></label>
                                        <select name="input[status_approved]" id="" class="form-control">
                                            <option value="0">เปิดใช้งาน</option>
                                            <option value="1">ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                            class="text-danger">*</span></div>
                                    <div class="form-group">
                                        <input type="file" name="file_work" class="filestyle" id="filestyleicon">
                                    </div>
                                </div>

                            </div>
                            <!-- </div> -->

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <a href="job-list.html">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            บันทึก
                                        </button>
                                    </a>
                                    
                                    <a href="{{URL('office/hr/announce')}}"><button type="button" class="btn btn-secondary waves-effect waves-light">
                                        ยกเลิก
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->

        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/announce')}}"></div>

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


    $(function() {

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
                    required: "กรุณากรอก"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>

@endsection