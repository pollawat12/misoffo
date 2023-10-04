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
                            <li class="breadcrumb-item active">การเงิน > ใบสำคัญจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ใบสำคัญจ่าย</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/certificate/save')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ใบสำคัญจ่าย</i> </h4>

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">

                            <input type="hidden" name="input[type_id]" value="{{$t}}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_id">ID <code>*</code></label>
                                        <input type="text" name="input[certificate_id]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="certificate_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_num">เลขที่ <code>*</code></label>
                                        <input type="text" name="input[certificate_num]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="certificate_num" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">วันที่ <code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[certificate_date]" value="{{getDateFormatToInputThai(date('Y-m-d'))}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <fieldset class="mb-4 fieldset-custom">
                                <legend>
                                    บริษัท/ผู้ค่ำ
                                </legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_payfor">จ่ายให้ (บริษัท/ผู้ค้า) <code>*</code></label>
                                            <select name="input[certificate_payfor]" id="certificate_payfor" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($company) > 0)
                                                @foreach($company as $keycompany => $valcompany)
                                                <option value="{{$valcompany->id}}">{{$valcompany->company_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small id="year_id" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_type">ประเภทการจ่าย <code>*</code></label>
                                            <select name="input[certificate_type]" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                <option value="1">โอนเงินผ่านระบบผ่านอิเล็กทรอนิกส์</option>
                                                <option value="2">เงินสด</option>
                                                <option value="3">เช็ค</option>
                                            </select>
                                            <small id="certificate_type" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_num">บัญชีเลขที่</label>
                                            <input type="text" name="input[certificate_bank_num]" id="input-certificate_bank_num" class="form-control" placeholder="" style="height: 45px;">
                                            <small id="certificate_bank_num" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_name">ธนาคาร </label>
                                            <input type="text" name="input[certificate_bank_name]" id="input-certificate_bank_name" class="form-control" placeholder="" style="height: 45px;">
                                            <small id="certificate_bank_name" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_account">ชื่อบัญชี </label>
                                            <input type="text" name="input[certificate_bank_account]" id="input-certificate_bank_account" class="form-control" placeholder="" style="height: 45px;">
                                            <small id="certificate_bank_account" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_branch">สาขา </label>
                                            <input type="text" name="input[certificate_bank_branch]" id="input-certificate_bank_branch" class="form-control" placeholder="" style="height: 45px;" > 
                                            <small id="certificate_bank_branch" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_check_num">เช็คเลขที่ </label>
                                        <input type="text" name="input[certificate_check_num]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_check_num" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">ลงวันที่ </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[certificate_check_date]">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_organizer">ผู้จัดทำ </label>
                                        <input type="text" name="input[certificate_organizer]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_organizer" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_inspector">ผู้ตรวจ </label>
                                        <input type="text" name="input[certificate_inspector]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_inspector" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_approver">ผู้อนุมัติ </label>
                                        <input type="text" name="input[certificate_approver]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_approver" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_payer">ผู้จ่ายเงิน </label>
                                        <input type="text" name="input[certificate_payer]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_payer" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_recipient">ผู้รับเอกสาร </label>
                                        <input type="text" name="input[certificate_recipient]" class="form-control" placeholder="" style="height: 45px;"> 
                                        <small id="certificate_recipient" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_file">แนบ เอกสาร </label>
                                        <input type="file" name="certificate_file" class="filestyle" placeholder="" style="height: 45px;">
                                        <small id="certificate_file" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end col -->

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลรายละเอียด</i> </h4>
                                <span id="loadDetail">
                                    
                                </span>


                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/budget/certificate/all')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/certificate/all')}}"></div>

        <div data-url="{{URL('office/budget/certificate')}}" id="base-url-api"></div>
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
                },
                'input[certificate_type]': {
                    required: true
                }
            },
            messages: {
                'input[certificate_id]': {
                    required: "กรุณากรอกข้อมูล"
                },
                'input[certificate_type]': {
                    required: "กรุณาเลือกข้อมูล"
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


    var _url = $("#base-url-api").attr("data-url")+"/get/info/?id="+_itemValue;

    $.get(_url, function(res){
        $("#frm-save #input-certificate_bank_num").val(res.info.company_bank_num);
        $("#frm-save #input-certificate_bank_name").val(res.info.company_bank_name);
        $("#frm-save #input-certificate_bank_account").val(res.info.company_bank_account);
        $("#frm-save #input-certificate_bank_branch").val(res.info.company_bank_branch);
    }, "json");
});


</script>
@endsection
