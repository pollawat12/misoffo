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
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่าย</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <span id="loadPurchase">
            <?php $noN = 0; ?>
            @if (!empty($purchases))
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แจ้งเตือนค่าใช้จ่าย</i>
                                </h4>
                                <p class="sub-header"></p>
                            </div>
                        </div>

                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">วันที่รายงาน</th>
                                    <th width="15%">จัดซื้อ จัดจ้าง</th>
                                    <th width="15%">ข้อความ</th>
                                    <th width="15%">สถานะ</th>
                                    <th style="width: 8%">จัดการ</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($purchases as $purchase)
                                <?php $noN++; ?>
                                <tr>
                                    <td class="align-middle" style="width:5%">{{$noN}}</td>
                                    <td class="align-middle">{{getDateShow($purchase['purchases_status_date'])}}</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_name']}}</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_message']}} @if($purchase['purchases_status_file'] != NULL) <br /> <a href="{{url('')}}/{{$purchase['purchases_status_file']}}" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลดเอกสาร</i> </a> @endif</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_update']}}</td>
                                    <td style="width:10%">
                                        <select name="input_action" class="form-control btn-action-new">
                                            <option value="">เลือก</option>
                                            <option value="{{$purchase['purchases_id']}}" data-original-title="show" data-id="{{$purchase['id']}}">ดูรายละเอียด</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end row -->
            @endif
        </span>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ค่าใช้จ่าย </i> </h4>

                    <form action="{{url('office/expenses/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <input type="hidden" name="input[type_id]" value="{{$t}}">

                        <input type="hidden" name="input[institution]" value="0">

                        <input type="hidden" name="input[year_id]" id="year_id" value="{{$id}}">

                        <input type="hidden" name="input[purchases_id]" id="purchases_id" value="0">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dob">วันที่ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป" name="input[created_at]" value="{{getDateFormatToInputThai(date('Y-m-d'))}}" disabled>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dob">ลงวันที่ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป" name="input[date_report]">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year_id_n">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id_n]" id="year_id_n" class="form-control" style="height: 45px;" disabled>
                                        <option value="">--เลือก--</option>
                                        @if (count($Year) > 0)
                                        @foreach($Year as $keyyear => $valyear)
                                        <option value="{{$valyear->id}}" @if($valyear->id == $t) selected @endif>{{$valyear->in_year}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id_n" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year_budget">ค่าใช้จ่าย (ประจำเดือนปี) <code>*</code></label>
                                    <select name="input[year_budget]" id="year_budget" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="10">ตุลาคม {{$Yearname->in_year - 1}}</option>
                                        <option value="11">พฤศจิกายน {{$Yearname->in_year - 1}}</option>
                                        <option value="12">ธันวาคม {{$Yearname->in_year - 1}}</option>
                                        <option value="1">มกราคม {{$Yearname->in_year}}</option>
                                        <option value="2">กุมภาพันธ์ {{$Yearname->in_year}}</option>
                                        <option value="3">มีนาคม {{$Yearname->in_year}}</option>
                                        <option value="4">เมษายน {{$Yearname->in_year}}</option>
                                        <option value="5">พฤษภาคม {{$Yearname->in_year}}</option>
                                        <option value="6">มิถุนายน {{$Yearname->in_year}}</option>
                                        <option value="7">กรกฎาคม {{$Yearname->in_year}}</option>
                                        <option value="8">สิงหาคม {{$Yearname->in_year}}</option>
                                        <option value="9">กันยายน {{$Yearname->in_year}}</option>
                                    </select>
                                    <small id="year_budget" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year_id">หน่วยงาน <code>*</code></label>
                                    <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyinstitution => $valinstitution)
                                        <?php $infoInstitution = \App\Models\DataSetting::find((int) $valinstitution['institution_id']); ?>
                                        <option value="{{$valinstitution['institution_id']}}">{{$infoInstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ<code>*</code></label>
                                    <select name="input[budget_categroy]" id="budget_categroy" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                    <select name="input[budget_type]" id="budget_type" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_number">ID Invoice <code>*</code></label>
                                    <input type="text" name="input[page_number]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="page_number" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expense_item">เลขที่ใบแจ้งหนี้ </label>
                                    <input type="text" name="input[expense_item]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="expense_item" class="form-text text-muted"></small>
                                </div>
                            </div>

                        </div>

                        
                        <span id="loadproject">

                            <input type="hidden" name="input[projects_id]" id="projects_id" value="0">
                        </span>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pay_for">จ่ายให้ (หน่วยงาน/บริษัท) <code>*</code></label>
                                    <select name="input[pay_for]" id="pay_for" class="form-control" style="height: 45px;">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="expenses_amount">จำนวนเงิน (ก่อน Vat 7%) </label>
                                    <input type="text" name="input[expenses_amount]" class="form-control" id="expenses_amount" placeholder="" style="height: 45px;" value="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="interest_amount">บวก Vat 7%</label>
                                    <input type="text" name="input[interest_amount]" id="interest_amount" class="form-control" placeholder="" style="height: 45px;" value="0.00">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="money_in_amount">ค่าใช้จ่าย (รวม) </label>
                                    <input type="text" name="input[money_in_amount]" id="money_in_amount" class="form-control" placeholder="" style="height: 45px;" value="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deduct_amount">หัก 1% ณ ที่จ่าย (บาท) </label>
                                    <input type="text" name="input[deduct_amount]" id="deduct_amount"  class="form-control" placeholder="" style="height: 45px;" value="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sum_amount">จำนวนเงินจ่ายเช็ค </label>
                                    <input type="text" name="input[sum_amount]" id="sum_amount" class="form-control" placeholder="" style="height: 45px;" value="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cost_detail">รายละเอียด</label>
                                    <textarea name="input[cost_detail]" class="form-control"></textarea>
                                    <small id="durable_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">หมายเหตุ</label>
                                    <textarea name="input[note]" class="form-control"></textarea>
                                    <small id="note" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="budget_file">แนบ เอกสาร </label>
                                    <input type="file" name="budget_file" class="filestyle" placeholder="" style="height: 45px;">
                                    <small id="budget_file" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/expenses/all')}}?t=0&pr=0" class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/expenses')}}/all?t=0&pr=0"></div>

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

    $(document).on("change", "#year_id", function() {
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/getNew/info/?t=statementtype&id=" + _itemValue + '&parentId=0';

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html  ;
        $.get(_url, function(data) {
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#institution_id", function() {
        var _itemValue = $(this).val();
        var _id = $("#year_id_n").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=statementtypeNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data) {
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#year_id", function() {
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=statementtype&id=" + _itemValue + '&parentId=0';

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data) {
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_categroy", function() {
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=budgetNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');
        $("#projects_id").html('<option value="">--เลือก--</option><option value="0">สำนักงาน</option>');
        $.get(_url, function(data) {
            $("#budget_type").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_type", function() {
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();

        $('#loadproject').load('{{URL('office/expenses/loadproject')}}' + '/' + _itemValue + '/' + _id);
    });

    $(document).on("change", "#projects_id", function() {
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();

        $('#loadtype').load('{{URL('office/expenses/loadtype')}}' + '/' + _itemValue + '/' + _id);
    });

    $(document).on("change", "#projects_id_1", function() {
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();

        $('#loadtype1').load('{{URL('office/expenses/loadtype1')}}' + '/' + _itemValue + '/' + _id);
    });

    $(function() {


        $.validator.setDefaults({
            submitHandler: function() {
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
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });


    $(document).on('change', '.btn-action-new', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        if (title == 'add') {
            $.get(_url, function(res) {
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        } else if (title == 'edit') {

            $('#con-close-modal').modal('show');

            var _url = $("#div-data-url-new").attr("data-url") + "/get/info/?id=" + id + "&type=" + title;

            $.get(_url, function(res) {
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_file").val(res.info.purchases_status_file);
                $("#frm-save #input-purchases_status_to").val(res.info.purchases_status_to);
                $("#frm-save #input-purchases_status_update").val(res.info.purchases_status_update);
                $("#frm-save #input-purchases_status_date").val(res.info.purchases_status_date);
                $("#frm-save #input-is_status").val(res.info.is_status);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        } else if (title == 'show') {
            // window.open('{{URL('office/purchases/show')}}'+ '/' + values, '_blank');
            $("#frm-save #purchases_id").val(id);
            $('#loadPurchase').load('{{URL('office/purchases/loadPurchase')}}' + '/' + id);
        } else {

        }

    });


    $(document).on("keyup", "#expenses_amount", function() {
        let _itemValue = $(this).val();

        let vat = ((_itemValue * 7) / 100).toFixed(2);

        let sum = (Number(_itemValue) + Number(vat)).toFixed(2);

        let sumvat = ((sum * 1) / 100).toFixed(2);

        let sumTotal = (Number(sum) - Number(sumvat)).toFixed(2);

        $("#interest_amount").val(vat);

        $("#money_in_amount").val(sum);

        $("#deduct_amount").val(sumvat);

        $("#sum_amount").val(sumTotal);
    });
</script>
@endsection