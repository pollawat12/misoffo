@extends('default.template')


@section('css')
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item active">งบประมาณ > รายได้</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข ใบแจ้งหนี้</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/debtors/import-form/update/item/edit/save')}}" method="POST" name="frm-save" id="frm-save">

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลใบแจ้งหนี้</i> </h4>

                    
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{ $id }}">
                        <input type="hidden" name="edit_rec_id" value="{{ $recId }}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">จังหวัด </label>
                                    <input type="text" name="input[province_name]" class="form-control" id="input-province_name" placeholder="" value="{{ $info->province_name }}" style="height: 45px;" readonly>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบแจ้งหนี้ </label>
                                    <input type="text" name="input[invoice_code]" class="form-control" id="input-invoice_code" placeholder="" style="height: 45px;" value="{{ $info->invoice_code }}" readonly>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">หมายเลขใบอนุญาต </label>
                                    <input type="text" name="input[license_code]" class="form-control" id="input-license_code" placeholder="" style="height: 45px;" value="{{ $info->license_code }}" readonly>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อผู้ได้รับใบอนุญาต <code>*</code></label>
                                    <input type="text" name="input[company]" value="{{ $info->company }}" class="form-control" id="input-company" placeholder="" readonly style="height: 45px;">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">หมายเลขบ่อหลัก <code>*</code></label>
                                    <input type="text" name="input[pond_master_no]" readonly value="{{ $info->pond_master_no }}" class="form-control" id="input-pond_master_no" placeholder="" style="height: 45px;">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ค่าอนุรักษ์ <code>*</code></label>
                                    <input type="text" name="input[conversation_cost]" value="{{ $info->conversation_cost }}" class="form-control" id="input-conversation_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ค่าใช้น้ำ <code>*</code></label>
                                    <input type="text" name="input[water_cost]" value="{{ $info->water_cost }}" class="form-control" id="input-water_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รวม <code>*</code></label>
                                    <input type="text" name="input[total_cost]" value="{{ $info->total_cost }}" class="form-control" id="input-total_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        
                    
                </div>
            </div>
            <!-- end col -->



            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลใบเสร็จรับเงิน</i> </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">วันที่ชำระ <code>*</code></label>
                                    <input type="text" name="input[payment_date]" readonly value="{{ $info->payment_date }}" class="form-control" id="input-payment_date" placeholder="" style="height: 45px;">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">เลขที่ใบเสร็จ <code>*</code></label>
                                    <input type="text" name="input_rec[receipt_code]" readonly value="{{ $recArray['receipt_code'] }}" class="form-control" id="input_rec-receipt_code" placeholder="" style="height: 45px;">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">เงินเพิ่มค่าอนุรักษ์ <code>*</code></label>
                                    <input type="text" name="input_rec[addon_conv_cost]" value="{{ $recArray['addon_conv_cost'] }}" class="form-control" id="input_rec-addon_conv_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">เงินเพิ่มค่าใช้น้ำ <code>*</code></label>
                                    <input type="text" name="input_rec[addon_water_cost]" value="{{ $recArray['addon_water_cost'] }}" class="form-control" id="input_rec-addon_water_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รวมเป็นเงิน <code>*</code></label>
                                    <input type="text" name="input_rec[total_cost]" value="{{ $recArray['total_cost'] }}" class="form-control" id="input_rec-total_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รายได้แผ่นดิน <code>*</code></label>
                                    <input type="text" name="input_rec[state_income_cost]" value="{{ $recArray['state_income_cost'] }}" class="form-control" id="input_rec-state_income_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">เข้ากองทุน <code>*</code></label>
                                    <input type="text" name="input_rec[fund_income_cost]" value="{{ $recArray['fund_income_cost'] }}"  class="form-control" id="input_rec-fund_income_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">รายได้สุทธิ <code>*</code></label>
                                    <input type="text" name="input_rec[net_income_cost]" value="{{ $recArray['net_income_cost'] }}"  class="form-control" id="input_rec-net_income_cost" placeholder="" style="height: 45px;" required>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href=""  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                </div>
            </div>


            </form>

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{ URL('office/budget/debtors/import-form/update') }}/{{ $info->invoice_subjects_id }}"></div>
    </div>
</div>
@endsection



@section('js')
<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>
<script>
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
            rules: {},
            messages: {},
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