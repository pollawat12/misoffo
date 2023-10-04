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
                    <form action="{{url('office/purchase/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <input type="hidden" name="input[purchases_status]" value="2">
                        <div class="media-body">
                            <h6 class="header-title mb-1 font-size-16  mt-1">รายงานขอซื้อขอจ้าง</h6>
                            <hr class="hr-form-all">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" name="input[purchases_name]" placeholder="" style="height: 45px;" value="{{$info->purchases_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">บันทึกเลขที่
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" name="input[purchases_order_number]" placeholder="" style="height: 45px;" value="{{$info->purchases_order_number}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">วันที่ <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_2]" value="@if ($info->purchases_invoice_date_2 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_2)}} @endif">
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
                                            class="col-form-label label-step">ราคากลาง <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_middle_price]" value="{{$info->purchases_middle_price}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">วิธีซื้อจ้าง <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_method]" value="{{$info->purchases_method}}">
                                    </div>
                                </div>
                                

                                <!-- คณะกรรมการซื้อ/จ้าง -->
                                <div class="col-lg-12">
                                    <div class="label-step mt-3 mb-2">คณะกรรมการซื้อ/จ้าง <span class="text-danger">*</span></div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="radio" class="custom-control-input" id="Check1" name="input[purchases_board_buy]" value="1" @if(1 == $info->purchases_board_buy) checked @endif>
                                        <label class="custom-control-label" for="Check1">ไม่มี</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" id="Check2" name="input[purchases_board_buy]" value="2" @if(2 == $info->purchases_board_buy) checked @endif>
                                        <label class="custom-control-label" for="Check2">มี ระบุ จำนวน .....
                                            คน</label>
                                    </div>

                                    <div class="title-aad-name mt-2 mb-2">
                                        <div class="label-step mt-2 mb-2">ระบุ รายชื่อ</div>
                                        <button type="button" class="btn btn-info waves-effect waves-light clicker" value="2">
                                            <i class="mdi mdi-plus"></i> เพิ่มรายชื่อ
                                        </button>
                                    </div>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-3 input_fields_wrap">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <!-- <th class="text-center text-white" style="width: 5%;">ลำดับ</th> -->
                                                    <th class="text-white" style="width: 60%">ชื่อ</th>
                                                    <th class="text-white" style="width: 25%;">ตำแหน่ง</th>
                                                    <th class="text-center text-white">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                    $purchasesOfficers = \App\Models\PurchasesOfficer::where('purchases_id', $id)->where('group_id', '2')->where('is_deleted', '0')->where('is_active','1')->get();
                                                    if(count($purchasesOfficers) > 0){
                                                        foreach($purchasesOfficers as $purchasesOfficer){
                                                ?>
                                                            <tr>
                                                                <!-- <td class="text-center">1</td> -->
                                                                <td>
                                                                    <select name="purchases_inspector[9][]" id="purchases_inspector" class="form-control" style="height: 45px;">
                                                                        <option value="">--เลือก--</option>
                                                                        @if (count($employees) > 0)
                                                                        @foreach($employees as $valemployees)
                                                                        <option value="{{$valemployees['id']}}" @if($valemployees['id'] == $purchasesOfficer->purchases_inspector) selected @endif>{{$valemployees['name']}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="position_id[9][]" id="position_id" class="form-control" style="height: 45px;">
                                                                        <option value="">--เลือก--</option>
                                                                        <option value="1" @if(1 == $purchasesOfficer->position_id) selected @endif>ประธานกรรมการ</option>
                                                                        <option value="2" @if(2 == $purchasesOfficer->position_id) selected @endif>เลขานุการ/กรรมการ</option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <!-- <button type="button" class="btn btn-danger waves-effect width-md waves-light">
                                                                        <i class="mdi mdi mdi-trash-can-outline"></i> ลบ
                                                                    </button> -->
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }

                                                    }
                                                
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                    <!-- คณะกรรมการตรวจรับ -->
                                    <div class="col-lg-12">
                                    <div class="label-step mb-2">คณะกรรมการตรวจรับ <span class="text-danger">*</span></div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="radio" class="custom-control-input" id="Check1" name="input[purchases_board_check]" value="0" @if(0 == $info->purchases_board_check) checked @endif>
                                        <label class="custom-control-label" for="Check1">ไม่มี</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" id="Check2" name="input[purchases_board_check]" value="1" @if(1 == $info->purchases_board_check) checked @endif>
                                        <label class="custom-control-label" for="Check2">มี ระบุ จำนวน .....
                                            คน</label>
                                    </div>

                                    <div class="title-aad-name mt-2 mb-2">
                                        <div class="label-step mt-2 mb-2">ระบุ รายชื่อ</div>
                                        <button type="button" class="btn btn-info waves-effect waves-light clicker2" value="3">
                                            <i class="mdi mdi-plus"></i> เพิ่มรายชื่อ
                                        </button>
                                    </div>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 input_fields_wrap2">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <!-- <th class="text-center text-white" style="width: 5%;">ลำดับ</th> -->
                                                    <th class="text-white" style="width: 60%">ชื่อ</th>
                                                    <th class="text-white" style="width: 25%;">ตำแหน่ง</th>
                                                    <th class="text-center text-white">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $purchasesOfficers1 = \App\Models\PurchasesOfficer::where('purchases_id', $id)->where('group_id', '3')->where('is_deleted', '0')->where('is_active','1')->get();
                                                    if(count($purchasesOfficers1) > 0){
                                                        foreach($purchasesOfficers1 as $purchasesOfficer1){
                                                ?>
                                                            <tr>
                                                                <!-- <td class="text-center">1</td> -->
                                                                <td>
                                                                    <select name="purchases_inspector[9][]" id="purchases_inspector" class="form-control" style="height: 45px;">
                                                                        <option value="">--เลือก--</option>
                                                                        @if (count($employees) > 0)
                                                                        @foreach($employees as $valemployees)
                                                                        <option value="{{$valemployees['id']}}" @if($valemployees['id'] == $purchasesOfficer1->purchases_inspector) selected @endif>{{$valemployees['name']}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="position_id[9][]" id="position_id" class="form-control" style="height: 45px;">
                                                                        <option value="">--เลือก--</option>
                                                                        <option value="1" @if(1 == $purchasesOfficer1->position_id) selected @endif>ประธานกรรมการ</option>
                                                                        <option value="2" @if(2 == $purchasesOfficer1->position_id) selected @endif>กรรมการ</option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <!-- <button type="button" class="btn btn-danger waves-effect width-md waves-light">
                                                                        <i class="mdi mdi mdi-trash-can-outline"></i> ลบ
                                                                    </button> -->
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }

                                                    }
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div for="inputEmail4" class="col-form-label label-step mt-2">แนบไฟล์ <span
                                            class="text-danger">*</span></div>
                                    <div class="form-group">
                                        <input type="file" class="filestyle" name="purchases_file3" id="filestyleicon">
                                    </div>
                                    <div class="comment-file">
                                        แนบได้มากกว่า 1 ไฟล์ เช่น TOR/ราคากลาง, รายงานขอซื้อขอจ้าง, คำสั่งแต่งตั้งกรรมการ
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
    var x = 2;
    $(".clicker").click(function (e) {

        let values = $(this).val();

        var wrapper = $(".input_fields_wrap"); 
        var fname_lname_new_2 = ' <tr><td><select name="purchases_inspector['+values+'][]" id="purchases_inspector" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){?><option value="<?php echo $valemployees['id'];?>"><?php echo $valemployees['name'];?></option><?php } }?></select></td><td><select name="position_id['+values+'][]" id="position_id" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></td><td class="text-center"><button type="button" class="btn btn-danger waves-effect width-md waves-light remove" value="'+values+'"><i class="mdi mdi mdi-trash-can-outline"></i> ลบ</button></td></tr>';
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


$(document).ready(function() {
    
    var max_fields      = 20; //maximum input boxes allowed   
    var x = 2;
    $(".clicker2").click(function (e) {

        let values = $(this).val();

        var wrapper = $(".input_fields_wrap2"); 
        var fname_lname_new_2 = ' <tr><td><select name="purchases_inspector['+values+'][]" id="purchases_inspector" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){?><option value="<?php echo $valemployees['id'];?>"><?php echo $valemployees['name'];?></option><?php } }?></select></td><td><select name="position_id['+values+'][]" id="position_id" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></td><td class="text-center"><button type="button" class="btn btn-danger waves-effect width-md waves-light remove2" value="'+values+'"><i class="mdi mdi mdi-trash-can-outline"></i> ลบ</button></td></tr>';
        e.preventDefault();
        if(x < max_fields){ 
            x++; //text box increment
            $(wrapper).append(fname_lname_new_2); 
        }

    });
});

$(document).on('click', '.remove2', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});
</script>
@endsection
