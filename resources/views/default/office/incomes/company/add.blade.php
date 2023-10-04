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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบัญชีและการเงิน</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">ข้อมูลบริษัท (ค้าน้ำมัน)</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่ม ข้อมูลบริษัท (ค้าน้ำมัน)</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{url('office/incomes/settings/company/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลบริษัท (ค้าน้ำมัน)</i> </h4>

                        
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="oil_id"> ชื่อบริษัท</label>
                                        <input type="text" name="input[company_name]"  class="form-control" placeholder="" style="height: 45px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_address">ที่อยู่</label>
                                        <textarea  name="input[company_address]" class="form-control"></textarea>
                                        <small id="company_address" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="oil_id"> ชื่อผู้ติดต่อ</label>
                                        <input type="text" name="input[company_contact]"  class="form-control" placeholder="" style="height: 45px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_tel">เบอร์โทรศัพท์</label>
                                        <input type="text" name="input[company_tel]"  class="form-control" placeholder="" style="height: 45px;" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_email">อีเมล</label>
                                        <input type="text" name="input[company_email]"  class="form-control" placeholder="" style="height: 45px;" >
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> บันทึก</i>
                                    </button>
                                    <a href="{{URL('office/incomes/settings/company/lists')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>

        </form>                                
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/incomes/settings/company/lists')}}"></div>

        <div data-url="{{URL('/')}}" id="base-url-api"></div>
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
                'input[oil_id]': {
                    required: true
                },
            },
            messages: {
                'input[oil_id]': {
                    required: "กรุณาเลือก"
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
