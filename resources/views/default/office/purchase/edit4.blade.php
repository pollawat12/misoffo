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
                            <li class="breadcrumb-item active">ข้อมูจัดซื้อ - จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข จัดซื้อ - จัดจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h6 class="header-title mb-1 font-size-16 mt-1">สัญญา/ใบสั่งซื้อสั่งจ้าง</h6>
                    <hr class="hr-form-all">
                    <form action="{{url('office/purchase/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <input type="hidden" name="input[purchases_status]" value="4">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_name]" value="{{$info->purchases_name}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="inputEmail4" class="col-form-label label-step">ประเภทสัญญา
                                    <span class="text-danger">*</span></label>
                                <div class="form-inline mb-2">
                                    <div class="form-group ml-2">
                                        <!-- new code -->
                                        <div class="radio radio-primary">
                                            <input id="radiobox1" type="radio" name="input[purchases_category_contract]" checked value="1" @if(1 == $info->purchases_category_contract) checked @endif>
                                            <label for="radiobox1">
                                                ใบสั่งซื้อสั่งจ้าง
                                            </label>
                                        </div>

                                        <!-- old code -->
                                        {{-- <div class="checkbox checkbox-primary">
                                            <input id="checkbox1" type="checkbox" name="input[purchases_category_contract]" value="1" @if(1 == $info->purchases_category_contract) checked @endif>
                                            <label for="checkbox1">
                                                ใบสั่งซื้อสั่งจ้าง
                                            </label>
                                        </div> --}}
                                    </div>
                                    <div class="form-group ml-3">
                                        <!-- new code -->
                                        <div class="radio radio-primary">
                                            <input id="radiobox2" type="radio" name="input[purchases_category_contract]" value="2" @if(2 == $info->purchases_category_contract) checked @endif>
                                            <label for="radiobox2">
                                                สัญญา
                                            </label>
                                        </div>

                                        <!-- old code -->
                                        {{-- <div class="checkbox checkbox-primary">
                                            <input id="checkbox2" type="checkbox" name="input[purchases_category_contract]" value="2" @if(2 == $info->purchases_category_contract) checked @endif>
                                            <label for="checkbox2">
                                                สัญญา
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">บันทึกเลขที่
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_order_number_no4]" value="{{$info->purchases_order_number}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">วันที่ <span
                                            class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_4]" value="@if ($info->purchases_invoice_date_4 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_4)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <?php
                                $purchasesOfficers1 = \App\Models\BudgetCertificateCompany::find((int) $info->purchases_offer_name);
                            ?>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">คู่สัญญา
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_pair_contract]" value="{{$purchasesOfficers1->company_name}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">เลขที่บัญชี
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_num_contract]" value="{{$purchasesOfficers1->company_num}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ที่อยู่ <span
                                            class="text-danger">*</span></label>
                                    <textarea name="input[purchases_add_contract]" id="" rows="5" class="form-control">{{$info->purchases_add_contract}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="inputEmail4" class="col-form-label label-step">หลักประกันสัญญา
                                    <span class="text-danger">*</span></label>
                                <div class="form-inline mb-2">
                                    <div class="form-group ml-2">
                                        <div class="radio radio-primary">
                                            <input id="radiobox3" type="radio" name="input[purchases_guarantee_contract]" value="1" @if(1 == $info->purchases_guarantee_contract) checked @endif>
                                            <label for="radiobox3">
                                                มี ระบุ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group ml-2">
                                        <label class="sr-only" for="exampleInputEmail21"></label>
                                        <input type="text" class="form-control" id="exampleInputEmail21"
                                            placeholder="" style="height: 45px;" name="input[purchases_guarantee_price_contract]" value="{{$info->purchases_guarantee_price_contract}}">
                                    </div>
                                    <div class="form-group ml-3">
                                        <div class="radio radio-primary">
                                            <input id="radiobox4" type="radio" name="input[purchases_guarantee_contract]" value="2" checked @if(2 == $info->purchases_guarantee_contract) checked @endif>
                                            <label for="radiobox4">
                                                ไม่มี
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="inputEmail4" class="col-form-label label-step">หลักประกันผลงาน
                                    <span class="text-danger">*</span></label>
                                <div class="form-inline mb-2">
                                    <div class="form-group ml-2">
                                        <div class="radio radio-primary">
                                            <input id="radiokbox5" type="radio" name="input[purchases_guarantee_performance]" value="1" @if(1 == $info->purchases_guarantee_performance) checked @endif>
                                            <label for="radiobox5">
                                                มี ระบุ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group ml-2">
                                        <label class="sr-only" for="exampleInputEmail21"></label>
                                        <input type="text" class="form-control" id="exampleInputEmail21"
                                            placeholder="" style="height: 45px;" name="input[purchases_guarantee_price_performance]" value="{{$info->purchases_guarantee_price_performance}}">
                                    </div>
                                    <div class="form-group ml-3">
                                        <div class="radio radio-primary">
                                            <input id="radiobox6" type="radio" name="input[purchases_guarantee_performance]" value="2" checked @if(2 == $info->purchases_guarantee_performance) checked @endif>
                                            <label for="radiobox6">
                                                ไม่มี
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="inputEmail4"
                                    class="col-form-label label-step">กำหนดส่งมอบงานและรายการส่งมอบ
                                    <span class="text-danger">*</span></label>
                                <div class="form-inline mb-2">
                                    <div class="form-group ml-2">
                                        <div class="radio radio-primary">
                                        {{-- <div class="checkbox checkbox-primary"> --}}
                                            <input id="radiobox7" type="radio" name="input[purchases_installment]" value="1" checked @if(1 == $info->purchases_installment) checked @endif>
                                            <label for="radiobox7">
                                                งวดเดียว วันที่ส่งมอบ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group ml-2">
                                        <label class="sr-only" for="exampleInputEmail21"></label>
                                        <!-- <div>
                                            <div class="input-group"> -->
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_installment_day]" value="@if ($info->purchases_installment_day != NULL){{getDateFormatToInputThai($info->purchases_installment_day)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                        <!-- </div> -->
                                        <!-- input-group -->
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group ml-2">
                                        <div class="radio radio-primary">
                                        {{-- <div class="checkbox checkbox-primary"> --}}
                                            <input id="radiobox8" type="radio" name="input[purchases_installment]" value="2" @if(2 == $info->purchases_installment) checked @endif>
                                            <label for="radiobox8">
                                                หลายงวด ระบุ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="title-aad-name mt-2 mb-2">
                                    <div class="label-step mt-2 mb-2">ระบุ งวดงาน</div>
                                    <button type="button" class="btn btn-info waves-effect waves-light clicker" value="1">
                                        <i class="mdi mdi-plus"></i> เพิ่มงวดงาน
                                    </button>
                                </div>
                                

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-3 input_fields_wrap">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center text-white" style="width: 8%;">งวดที่</th>
                                                <th class="text-white" style="width: 50%">รายการส่งมอบ</th>
                                                <th class="text-white">วันที่ส่งมอบ</th>
                                                <th class="text-white">จำนวนเงิน</th>
                                                <th class="text-center text-white">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(count($installments) > 0){
                                                    foreach($installments as $installment){
                                            ?>

                                                <tr>
                                                    <td class="text-center">
                                                    <input type="text" name="installment[9][]" id="position_id" class="form-control" placeholder="" style="height: 45px;" value="{{$installment['installment']}}">
                                                    </td>
                                                    <td>
                                                        <textarea name="detail[9][]" id="position_id" rows="3" class="form-control">{{$installment['detail']}}</textarea>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" style="height: 45px;" name="installment_date[1][]" value="@if ($installment['installment_date'] != NULL){{getDateFormatToInputThai($installment['installment_date'])}} @endif">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="exampleInputEmail21" placeholder="" name="installment_money[9][]" style="height: 45px;" value="{{$installment['installment_money']}}">
                                                    </td>
                                                    <td class="text-center">

                                                    </td>
                                                </tr>
                                            <?php
                                                    }

                                                }
                                            
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                <input type="text" name="installment[1][]" id="position_id" class="form-control" placeholder="" style="height: 45px;">
                                                </td>
                                                <td>
                                                    <textarea name="detail[1][]" id="position_id" rows="3" class="form-control"></textarea>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" style="height: 45px;" name="installment_date[1][]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i
                                                                        class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="exampleInputEmail21"
                                            placeholder="" name="installment_money[1][]" style="height: 45px;">
                                                </td>
                                                <td class="text-center">

                                                </td>
                                            </tr>

                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                        class="text-danger">*</span></div>
                                <div class="form-group">
                                    <input type="file" class="filestyle" name="purchases_file5" id="filestyleicon">
                                </div>
                                <div class="comment-file">
                                    แนบได้มากกว่า 1 ไฟล์ เช่น ใบสั่งซื้อสั่งจ้าง, สัญญา, หลักประกัน หลักฐาน
                                    แนบสัญญา ฯลฯ
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        บันทึก
                                    </button>
                                    <a href="{{URL('office/purchase/detail')}}/{{$id}}?t=1&pr=0"><button type="button" class="btn btn-secondary waves-effect waves-light">
                                            ยกเลิก
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->


        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{URL('office/purchase/detail')}}/{{$id}}?t=1&pr=0"></div>

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
                'input[purchases_category_contract]': {
                    required: true
                },
                'input[purchases_order_number_no4]': {
                    required: true
                },
                'input[purchases_invoice_date_4]': {
                    required: true
                },
                'input[purchases_pair_contract]': {
                    required: true
                },
                'input[purchases_num_contract]': {
                    required: true
                },
                'input[purchases_add_contract]': {
                    required: true
                },
                'input[purchases_guarantee_performance]': {
                    required: true
                },
                'input[purchases_guarantee_performance]': {
                    required: true
                },
                'input[purchases_installment]': {
                    required: true
                },
                'input[purchases_file5]': {
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
                'input[purchases_category_contract]': {
                    required: "กรุณาเลือกประเภทสัญญา"
                },
                'input[purchases_order_number_no4]': {
                    required: "กรุณากรอกบันทึกเลขที่"
                },
                'input[purchases_invoice_date_4]': {
                    required: "กรุณากรอกวันที่"
                },
                'input[purchases_pair_contract]': {
                    required: "กรุณากรอกคู่สัญญา"
                },
                'input[purchases_num_contract]': {
                    required: "กรุณากรอกเลขที่บัญชี"
                },
                'input[purchases_add_contract]': {
                    required: "กรุณากรอกที่อยู่"
                },
                'input[purchases_guarantee_performance]': {
                    required: "กรุณาเลือกหลักประกันสัญญา"
                },
                'input[purchases_guarantee_performance]': {
                    required: "กรุณาเลือกหลักประกันผลงาน"
                },
                'input[purchases_installment]': {
                    required: "กรุณากำหนดส่งมอบงาน"
                },
                'input[purchases_file5]': {
                    required: "กรุณาแนบไฟล์"
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
    var x = 2;
    $(".clicker").click(function (e) {

        let values = $(this).val();

        var wrapper = $(".input_fields_wrap"); 
        var fname_lname_new_2 = ' <tr><td class="text-center"><input type="text" name="installment['+values+'][]" id="position_id" class="form-control" placeholder="" style="height: 45px;"></td><td><textarea name="detail['+values+'][]" id="position_id" rows="3" class="form-control"></textarea></td><td><div><div class="input-group"><input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" style="height: 45px;" name="installment_date['+values+'][]"><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div></div></div></td><td><input type="text" class="form-control" id="exampleInputEmail21" placeholder="" name="installment_money['+values+'][]" style="height: 45px;"></td><td class="text-center"><button type="button" class="btn btn-danger waves-effect width-md waves-light remove" value="'+values+'"><i class="mdi mdi mdi-trash-can-outline"></i> ลบ</button></td></tr>';

        
        e.preventDefault();
        if(x < max_fields){ 
            x++; //text box increment
            $(wrapper).append(fname_lname_new_2); 
        }

    });
});

$(document).on('click', '.remove', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});

// $(document).on("change", "#purchases_pair_contract", function(){
//     var _itemValue = $(this).val();
    // var _id = $("#year_id").val();
    // var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/projectDDl/?t=statementtypeNew&institutionId=" + _itemValue + '&yearID=' + _id + '&budgetId=488';
    // var _url = $("#base-url-api").attr("data-url") + "/office/loadPurchase/{id}";
    // $("#purchases_num_contract").html('<option value="">--เลือก--</option>'); 

    // $("#budget_categroy").html('<option value="">--เลือก--</option>');
//     $.get(_url, function(data){
//         $("#purchases_num_contractget_categroy").html(data.elem_html);
//     }, "json");
// });

</script>
@endsection
