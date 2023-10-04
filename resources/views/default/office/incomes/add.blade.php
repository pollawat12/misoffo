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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายได้</a></li>
                            <li class="breadcrumb-item active">ข้อมูลรายได้</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เพิ่มรายได้</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{url('office/incomes/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลราคาน้ำมัน</i> </h4>

                        
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="incomes_company"> บริษัท</label>
                                        <select name="input[incomes_company]" id="incomes_company" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($company) > 0)
                                            @foreach($company as $keycompany => $valcompany)
                                            <option value="{{$valcompany->id}}">{{$valcompany->company_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[incomes_day]">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="incomes_status"> สถานะ</label>
                                        <select name="input[incomes_status]" id="incomes_status" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            <option value="1">ตราจสอบ</option>
                                            <option value="2">อนุมัติ</option>
                                            <option value="3">ยกเลิก</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="incomes_file">แนบไฟล์ </label>
                                        <input type="file" name="incomes_file" class="filestyle" placeholder="" style="height: 45px;">
                                        <small id="incomes_file" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="incomes_note">หมายเหตุ</label>
                                        <textarea  name="input[incomes_note]" class="form-control"></textarea>
                                        <small id="incomes_note" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการค่าน้ำมัน</i>  <button type="button" id="addRow" class="btn btn-success btn-sm">เพิ่ม</button> <button type="button" id="removeRow"  class="btn btn-danger btn-sm">ลบ</button></h4>
                            <span id="myTbl">
                                <div class="row fname" id="firstTr">
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label for="incomes_note">ประเภทน้ำมัน</label>   
                                            <select name="oil_type_id[]" id="oil_type_id" class="form-control" style="height: 40px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($oil) > 0)
                                                @foreach($oil as $keyoil => $valoil)
                                                <option value="{{$valoil->id}}">{{$valoil->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label for="incomes_note">จำนวนส่งออก</label>
                                            <input type="text" name="export_total[]"  class="form-control" placeholder="" style="height: 45px;">
                                            <small id="incomes_note" class="form-text text-muted"></small>    
                                        </div>
                                    </div>
                                </div>
                            </span>

                            <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> บันทึก</i>
                                    </button>
                                    <a href="{{URL('office/incomes/lists')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>                                
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/incomes/lists')}}"></div>

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
                'input[incomes_company]': {
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
                'input[incomes_company]': {
                    required: "กรุณาเลือก"
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
$(function(){
    $("#addRow").click(function(){
        $("#myTbl").append($("#firstTr").clone());
    });  
    
    $("#removeRow").click(function(){
        var len = $(".fname").length 
        if(len > 1 ){
            $(".fname:last").remove(); //ลบคลาส fname อันสุดท้าย
        }else{
            alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
        }
    });
});
</script>

@endsection
