@extends('default.layouts.main')

@section('css')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ยุทธศาสตร์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ราคาปิโตรเลียม</a></li>
                            <li class="breadcrumb-item active">PLATT'S CRUDE OIL PRICES  </li>
                        </ol>
                    </div>
                    <h4 class="page-title">นำเข้าข้อมูล PLATT'S CRUDE OIL PRICES</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-icon alert-info text-info alert-dismissible fade show p-3" role="alert" style="color: black !important;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-information mr-2"></i>
                    <strong>แจ้งเตือน!</strong> กำลังทำการอัพโหลดไฟล์ข้อมูล PLATT'S CRUDE OIL PRICES
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> นำเข้าข้อมูล PLATT'S CRUDE OIL PRICES</i> </h4>

                    <form action="{{url('office/strategic/oil/import/save')}}?t={{$t}}&pr={{$pr}}" enctype="multipart/form-data" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>ไฟล์เอกสาร <code>*</code></p>
                                    <input type="file" class="form-control" name="file_upload" id="file_upload">
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/strategic/oil/lists')}}?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class="mdi mdi-keyboard-backspace"> ย้อนกลับ</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>

<div id="redirect-to-report-file" data-url="{{URL('office/strategic/oil/lists')}}?t={{$t}}&pr={{$pr}}"></div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>

$(function () {
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var redirectURL = $("#redirect-to-report-file").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    // window.location.reload();
                    window.location = redirectURL;
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {//time_no  budget_year
                'file_upload': {
                    required: true
                }
            },
            messages: {
                'file_upload': {
                    required: "กรุณาแนบไฟล์"
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
