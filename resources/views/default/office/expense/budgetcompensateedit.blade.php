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
                            <li class="breadcrumb-item active">งบประมาณ > เงินชดเชย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เงินชดเชย</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">

                    <form action="{{url('office/expenses/compensate/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <input type="hidden" name="input[type_id]" value="{{$t}}">


                        <div class="media-body">
                            <h6 class="header-title mb-1 font-size-16 mt-3">เพิ่มข้อมูล เงินชดเชย</h6>
                            <hr class="hr-form-all">

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="compensate_num" class="col-form-label label-step">เลขที่หนังสือกรมสรรพสามิต
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="input[compensate_num]" class="form-control" id="compensate_num" placeholder="" style="height: 45px;" value="{{$info->compensate_num}}"> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="compensate_payfor" class="col-form-label label-step">บริษัท/หน่วยงาน
                                            <span class="text-danger">*</span></label>
                                            <select name="input[compensate_payfor]" id="compensate_payfor" class="form-control" style="height: 45px;">
                                                <option value="0">--เลือก--</option>
                                                @if (count($company) > 0)
                                                @foreach($company as $keycompany => $valcompany)
                                                <option value="{{$valcompany->id}}" @if($info->compensate_payfor == $valcompany->id) selected @endif>{{$valcompany->company_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="compensate_date" class="col-form-label label-step">ลงวันที่ <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป"  name="input[compensate_date]"  value="@if ($info->compensate_date != NULL){{getDateFormatToInputThai($info->compensate_date)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 mb-2">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">แนบไฟล์
                                            <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="file" name="filestyleicon" class="filestyle" id="filestyleicon">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <div class="form-group">
                                        <label for="compensate_status" class="col-form-label label-step">สถานะ
                                            <span class="text-danger">*</span></label>
                                        <select name="input[compensate_status]" id="compensate_status" class="form-control" style="height: 45px;">
                                            <option value="">เลือก</option>
                                            <option value="1" @if($info->compensate_status == 1) selected @endif>กำลังดำเนินการ</option>
                                            <option value="2" @if($info->compensate_status == 2) selected @endif>ดำเนินการเสร็จสิ้น</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            น้ำมันแก๊สโซฮอล E20
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oile20_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_oile20_liter]" class="form-control" id="compensate_oile20_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_oile20_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oile20_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_oile20_price]" class="form-control" id="compensate_oile20_price" placeholder="" style="height: 45px;" value="{{$info->compensate_oile20_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            น้ำมันแก๊สโซฮอล อี 85
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oile85_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_oile85_liter]" class="form-control" id="compensate_oile85_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_oile85_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oile85_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_oile85_price]" class="form-control" id="compensate_oile85_price" placeholder="" style="height: 45px;" value="{{$info->compensate_oile85_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            น้ำมันดีเซลหมุนเร็วธรรมดา
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oild_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_oild_liter]" class="form-control" id="compensate_oild_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_oild_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oiled_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_oiled_price]" class="form-control" id="compensate_oiled_price" placeholder="" style="height: 45px;" value="{{$info->compensate_oiled_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            น้ำมันดีเซลหมุนเร็ว B 10
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oild10_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_oild10_liter]" class="form-control" id="compensate_oild10_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_oild10_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oild10_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_oild10_price]" class="form-control" id="compensate_oild10_price" placeholder="" style="height: 45px;" value="{{$info->compensate_oild10_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            น้ำมันดีเซลหมุนเร็ว B 20
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oild20_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_oild20_liter]" class="form-control" id="compensate_oild20_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_oild20_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_oild20_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_oild20_price]" class="form-control" id="compensate_oild20_price" placeholder="" style="height: 45px;" value="{{$info->compensate_oild20_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-6">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            ก๊าซปิโตรเลียมเหลว (LPG)
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_lpg_liter" class="col-form-label label-step">ปริมาณ
                                                        (ลิตร)</label>
                                                    <input type="text" name="input[compensate_lpg_liter]" class="form-control" id="compensate_lpg_liter" placeholder="" style="height: 45px;" value="{{$info->compensate_lpg_liter}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="compensate_lpg_price" class="col-form-label label-step">จำนวนเงินขอรับชดเชย
                                                        (บาท)</label>
                                                    <input type="text" name="input[compensate_lpg_price]" class="form-control" id="compensate_lpg_price" placeholder="" style="height: 45px;" value="{{$info->compensate_lpg_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            บันทึก
                                        </button>
                                        <a href="{{URL('office/expenses/compensate/all')}}?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class="mdi mdi-backspace-outline"> ยกเลิก</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/expenses/compensate')}}/all?t=0&pr=0"></div>

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

    $(document).on("change", "#year_id", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/getNew/info/?t=statementtype&id=" + _itemValue + '&parentId=0';

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#institution_id", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id_n").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=statementtypeNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#year_id", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=statementtype&id=" + _itemValue + '&parentId=0';

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_categroy", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=budgetNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');
        $("#projects_id").html('<option value="">--เลือก--</option><option value="0">สำนักงาน</option>');
        $.get(_url, function(data){
            $("#budget_type").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_type", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        
        $('#loadproject').load('{{URL('office/expenses/loadproject')}}' + '/' + _itemValue + '/' + _id);
    });

    $(document).on("change", "#projects_id", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        
        $('#loadtype').load('{{URL('office/expenses/loadtype')}}' + '/' + _itemValue + '/' + _id);
    });

    $(document).on("change", "#projects_id_1", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        
        $('#loadtype1').load('{{URL('office/expenses/loadtype1')}}' + '/' + _itemValue + '/' + _id);
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
                'input[date_report]': {
                    required: true
                },
                'input[page_number]': {
                    required: true
                },
                'input[budget_categroy]': {
                    required: true
                },
                'input[cost_type]': {
                    required: true
                }
            },
            messages: {
                'input[date_report]': {
                    required: "กรุณาเลือกวันที่รายงาน"
                },
                'input[page_number]': {
                    required: "กรุณาเลือกเลขเอกสาร"
                },
                'input[budget_categroy]': {
                    required: "กรุณาเลือกประเภทงบ"
                },
                'input[cost_type]': {
                    required: "กรุณาเลือกประเภทรายจ่าย"
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
    

    $(document).on('change', '.btn-action-new', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        if(title == 'add'){
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        }else if(title == 'edit'){

            $('#con-close-modal').modal('show'); 

            var _url = $("#div-data-url-new").attr("data-url")+"/get/info/?id="+id+"&type="+title;

            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_file").val(res.info.purchases_status_file);
                $("#frm-save #input-purchases_status_to").val(res.info.purchases_status_to);
                $("#frm-save #input-purchases_status_update").val(res.info.purchases_status_update);
                $("#frm-save #input-purchases_status_date").val(res.info.purchases_status_date);
                $("#frm-save #input-is_status").val(res.info.is_status);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(title == 'show'){
            // window.open('{{URL('office/purchases/show')}}'+ '/' + values, '_blank');
            $("#frm-save #purchases_id").val(id);
            $('#loadPurchase').load('{{URL('office/purchases/loadPurchase')}}' + '/' + id);
        }else{
            
        }
        
    });

</script>
@endsection
