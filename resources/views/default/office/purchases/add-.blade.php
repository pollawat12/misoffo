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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบจัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item active">ข้อมูลจัดซื้อ - จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เพิ่มจัดซื้อ - จัดจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{url('office/purchases/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลจัดซื้อ - จัดจ้าง</i> </h4>

                        
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchases_name">เรื่อง <code>*</code></label>
                                        <input type="text" name="input[purchases_name]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="purchases_name" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_order_number">เลขที่ใบสั่งซื้อ/จ้าง <code>*</code></label>
                                        <span id="purchases_order_number">
                                            <input type="text" name="input[purchases_order_number]"  class="form-control" placeholder="" style="height: 45px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่ </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[purchases_invoice_date]">
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
                                        <label for="purchases_fiscal_year">ปีงบประมาณ </label>
                                        <span id="purchases_fiscal_year">
                                            <input type="text" name="input[purchases_fiscal_year]"  class="form-control" placeholder="" style="height: 45px;">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_allocated_budget">งบประมาณที่ได้รับจัดสรรร</label>
                                        <input type="text" name="input[purchases_allocated_budget]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="purchases_allocated_budget" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_middle_price">ราคากลาง </label>
                                        <input type="text" name="input[purchases_middle_price]" class="form-control" placeholder="" style="height: 45px;">
                                        <small id="purchases_middle_price" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_method"> วิธีการจัดซื้อ จัดจ้าง</label>
                                        <select name="input[purchases_method]" id="purchases_method" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($purchasesmethod) > 0)
                                            @foreach($purchasesmethod as $keypurchasesmethod => $valpurchasesmethod)
                                            <option value="{{$valpurchasesmethod->id}}">{{$valpurchasesmethod->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
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
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลเจ้าหน้าที่ตรวจสอบ</i> <button type="button" class="btn btn-success btn-sm add_field_button">เพิ่มเจ้าหน้าที่</button></h4>

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_inspector">ชื่อเจ้าหน้าที่ ตรวจสอบ <code>*</code> </label>
                                        <select name="purchases_inspector[]" id="purchases_inspector" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($employees) > 0)
                                            @foreach($employees as $valemployees)
                                            <option value="{{$valemployees['id']}}">{{$valemployees['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="position_id"> ตำแหน่ง </label>
                                        <select name="position_id[]" id="position_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            <option value="1">ประธานกรรมการ</option>
                                            <option value="2">กรรมการ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="input_fields_wrap">

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchases_purchasing_status"> สถานะจัดซื้อ - จัดจ้าง </label>
                                        <select name="input[purchases_purchasing_status]" id="purchases_purchasing_status" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($purchasesstatus) > 0)
                                            @foreach($purchasesstatus as $keypurchasesstatus => $valpurchasesstatus)
                                            <option value="{{$valpurchasesstatus->id}}">{{$valpurchasesstatus->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่ ตรวจสอบ </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[purchases_check_date]">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchases_note">หมายเหตุ</label>
                                        <textarea  name="input[purchases_note]" class="form-control"></textarea>
                                        <small id="purchases_note" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="purchases_company" value="">
                            <input type="hidden" name="purchases_contract_number" value="">
                            <input type="hidden" name="purchases_contract_date" value="">
                            <input type="hidden" name="purchases_contract_expiration_date" value="">
                            <input type="hidden" name="purchases_contract_amount" value="">
                            <input type="hidden" name="purchases_margin_type" value="">
                            <input type="hidden" name="purchases_bank" value="">
                            <input type="hidden" name="purchases_account_number" value="">
                            <input type="hidden" name="purchases_contrac_dated" value="">
                            <input type="hidden" name="purchases_insurance_amount" value="">
                            <input type="hidden" name="purchases_warranty_start" value="">
                            <input type="hidden" name="purchases_warranty_end" value="">
                            <input type="hidden" name="purchases_date_committee" value="">
                            <input type="hidden" name="purchases_date_return_due" value="">

                            <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> บันทึก</i>
                                    </button>
                                    {{-- <a href="#update-detail" data-toggle="tab" aria-expanded="false"><button type="button" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> รายละเอียดการสั่งซื้อ</i>
                                    </button></a> --}}
                                    <a href="{{URL('office/purchases/lists')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>                                
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/purchases/lists')}}"></div>

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
                'input[purchases_name]': {
                    required: true
                },
                // 'input[durable_serial]': {
                //     required: true
                // },
                // 'input[category_id]': {
                //     required: true
                // },
                // 'input[typedata_id]': {
                //     required: true
                // },
                // 'input[unitcount_id]': {
                //     required: true
                // },
                // 'input[durable_received_date]': {
                //     required: true
                // },
                // 'input[durable_purchase]': {
                //     required: true
                // }
            },
            messages: {
                'input[purchases_name]': {
                    required: "กรุณากรอกเรื่อง"
                },
                // 'input[durable_serial]': {
                //     required: "กรุณากรอก Serial Number"
                // },
                // 'input[category_id]': {
                //     required: "กรุณาเลือก หมวดหมู่"
                // },
                // 'input[typedata_id]': {
                //     required: "กรุณาเลือก ประเภท"
                // },
                // 'input[unitcount_id]': {
                //     required: "กรุณาเลือก หน่วยนับ"
                // },
                // 'input[durable_received_date]': {
                //     required: "กรุณากรอก วันที่ได้รับ"
                // },
                // 'input[durable_purchase]': {
                //     required: "กรุณากรอก ใบจัดซื้อ-จัดจ้าง"
                // }
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

<script type="text/javascript">

$(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button"); 
    var fname_lname_new = '<div class="row"><div class="col-md-6" ><div class="form-group"><select name="purchases_inspector[]" id="purchases_inspector" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){ ?><option value="<?php echo $valemployees['id']; ?>"><?php echo $valemployees['name'] ?></option><?php } }?></select></div></div><div class="col-md-5" ><div class="form-group"><select name="position_id[]" id="position_id" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 45px;margin-block:30px;"> ลบ </button></div>';
    var x = 1;
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; //text box increment
            $(wrapper).append(fname_lname_new); 
        }
    });

    $(wrapper).on("click",".remove_field", function(e){             e.preventDefault(); $(this).parent().remove(); x--;
    })
});
</script>
@endsection
