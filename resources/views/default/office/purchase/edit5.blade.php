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

                    <div class="media-body">
                        <h6 class="header-title mb-1 font-size-16 mt-3">ตรวจรับงาน/เบิกจ่าย</h6>
                        <hr class="hr-form-all">

                        <div class="row">

                            <div class="col-lg-12 mt-2">
                                <div class="row mb-3">
                                    <div class="col-10">
                                        <h4 class="header-title">
                                        </h4>
                                        <p class="sub-header"></p>
                                    </div>
                                    <div class="col-2 text-right">
                                    <a href="{{URL('office/purchase/detail')}}/{{$id}}?t=1&pr=0"><button type="button" class="btn btn-secondary waves-effect waves-light">
                                            ย้อนกลับ
                                        </button></a>
                                    </div>
                                </div>
                                <table id="datatable-buttons"
                                    class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">


                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center text-white" style="width: 5%;">งวดที่
                                            </th>
                                            <th class="text-white" style="width: 40%">รายการส่งมอบ</th>
                                            <th class="text-white">วันที่ส่งมอบ</th>
                                            <th class="text-white">จำนวนเงิน</th>
                                            <th class="text-white text-center">สถานะ</th>
                                            <th class="text-center text-white" style="width: 20%">จัดการ
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    <?php $no = 0;?>
                                    @if (!empty($installments))
                                    @foreach ($installments as $item)
                                    <?php $no++;?>
                                        <tr>
                                            <td class="align-middle text-center">{{$item['installment']}}</td>
                                            <td class="align-middle">{{$item['detail']}}</td>
                                            <td class="align-middle">{{getDateShow($item['installment_date'])}}</td>
                                            <td class="align-middle">{{number_format($item['installment_money'],2,'.',',')}}</td>
                                            <td class="align-middle text-center">
                                                <!-- <span class="badge badge-status-1 p-1 font-size-15">
                                                    ยกเลิก
                                                </span> -->
                                                <span class="badge badge-warning p-1 font-size-14">
                                                    กำลังดำเนินการ
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{URL('office/purchase/edit')}}/{{$id}}?t=6&pr=0">
                                                    <button type="button" class="btn btn-info waves-effect width-md waves-light">
                                                        <i class="mdi mdi-update"></i> อัพเดท
                                                    </button>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-primary waves-effect width-md waves-light" data-toggle="modal" data-target="#con-close-modal">
                                                    <i class="mdi mdi-cash-multiple"></i> เบิกจ่าย
                                                </button>
                                                <button type="button"
                                                    class="btn btn-danger waves-effect width-md waves-light">
                                                    <i class="mdi mdi-trash-can-outline"></i> ลบ
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end col -->
        </div>

        <div id="con-close-modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">เพิ่มข้อมูล บริษัท/ผู้ค้า</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('office/purchase/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                            <div class="media-body">
                                <h6 class="header-title mb-1 font-size-16 mt-1">ตรวจรับงาน</h6>
                                <hr class="hr-form-all">

                                
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="edit_id" value="{{$id}}">

                                    <input type="hidden" name="input[purchases_status]" value="5">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_name]" value="{{$info->purchases_name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="inputEmail4" class="col-form-label label-step">วันที่ตรวจรับ <span
                                                        class="text-danger">*</span></label>
                                                    <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_5]" value="@if ($info->purchases_invoice_date_5 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_5)}} @endif">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="inputEmail4"
                                                    class="col-form-label label-step">งวดที่ <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_num_installment]" value="{{$info->purchases_num_installment}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="inputEmail4" class="col-form-label label-step">ส่งมอบวันที่ <span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_51]" value="@if ($info->purchases_invoice_date_51 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_51)}} @endif">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="inputEmail4" class="col-form-label label-step">ผลการตรวจรับ <span
                                                        class="text-danger">*</span></label>
                                                <textarea name="input[purchases_detail_check]" id="" rows="5" class="form-control">{{$info->purchases_detail_check}}</textarea>
                                            </div>
                                        </div>
                                        

                                        <div class="col-lg-12">
                                            <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                                    class="text-danger">*</span></div>
                                            <div class="form-group">
                                                <input type="file" class="filestyle" id="filestyleicon">
                                            </div>
                                            <div class="comment-file">
                                                แนบได้มากกว่า 1 ไฟล์ เช่น รายงานผลการตรวจรับ
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>

                            <div class="media-body">
                                <h6 class="header-title mb-1 font-size-16 mt-5">เบิกจ่าย</h6>
                                <hr class="hr-form-all">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_name]" value="{{$info->purchases_name}}"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputEmail4" class="col-form-label label-step">วันที่ขออนุมัติเบิกจ่าย <span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_52]" value="@if ($info->purchases_invoice_date_52 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_52)}} @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">งวดที่ <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_numsuss_installment]" value="{{$info->purchases_numsuss_installment}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">ใบแจ้งหนี้เลขที่ <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_order_installment]" value="{{$info->purchases_order_installment}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">จำนวนเงิน <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_price_installment]" value="{{$info->purchases_price_installment}}"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                                class="text-danger">*</span></div>
                                        <div class="form-group">
                                            <input type="file" class="filestyle" id="filestyleicon">
                                        </div>
                                        <div class="comment-file">
                                            แนบได้มากกว่า 1 ไฟล์
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
                            </div>
                        
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light">บันทึก</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
        

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
    
    var x = 1;
    var add_button      = $(".add_field_button"); 
    $(add_button).click(function(e){ 

        var id = $(this).attr('data-id');

        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"+id); 
        
        var fname_lname_new = '<div class="row"><div class="col-md-6" ><div class="form-group"><select name="purchases_inspector['+id+'][]" id="purchases_inspector" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){ ?><option value="<?php echo $valemployees['id']; ?>"><?php echo $valemployees['name'] ?></option><?php } }?></select></div></div><div class="col-md-5" ><div class="form-group"><select name="position_id['+id+'][]" id="position_id" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 40px;margin-block:0px;"> ลบ </button></div>';
    
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
