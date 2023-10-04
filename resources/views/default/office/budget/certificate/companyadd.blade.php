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
                            <li class="breadcrumb-item active">บริษัท/ผู้ค้า</li>
                        </ol>
                    </div>
                    <h4 class="page-title">บริษัท/ผู้ค้า</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/certificate/company/save')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล บริษัท/ผู้ค้า</i> </h4>

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name">ชื่อบริษัท/ผู้ค้า <code>*</code></label>
                                        <input type="text" name="input[company_name]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_name" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_num">เลขที่จดทะเบียน <code>*</code></label>
                                        <input type="text" name="input[company_num]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_num" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">วันที่จดทะเบียน <code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[company_date]" >
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
                                        <label for="company_bank_num">บัญชีเลขที่</label>
                                        <input type="text" name="input[company_bank_num]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_bank_num" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_bank_name">ธนาคาร </label>
                                        <input type="text" name="input[company_bank_name]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_bank_name" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_bank_account">ชื่อบัญชี </label>
                                        <input type="text" name="input[company_bank_account]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_bank_account" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_bank_branch">สาขา </label>
                                        <input type="text" name="input[company_bank_branch]" class="form-control" placeholder="" style="height: 45px;" > 
                                        <small id="company_bank_branch" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_contact">ชื่อผู้ติดต่อ </label>
                                        <input type="text" name="input[company_contact]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="company_contact" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_tel">เบอร์โทรติดต่อ </label>
                                        <input type="text" name="input[company_tel]" class="form-control" placeholder="" style="height: 45px;" > 
                                        <small id="company_tel" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_file">แนบ เอกสาร </label>
                                        <input type="file" name="company_file" class="filestyle" placeholder="" style="height: 45px;">
                                        <small id="company_file" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/budget/certificate/company')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>
                    </div>
                </div>
                <!-- end col -->

            </div>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/certificate/company')}}"></div>

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

<script type="text/javascript">

$(document).on("change", "#certificate_payfor", function(){
    var _itemValue = $(this).val();

    $('#loadDetail').load('{{URL('office/budget/certificate/get/loadDetail')}}' + '/' + _itemValue);
});


</script>
@endsection
