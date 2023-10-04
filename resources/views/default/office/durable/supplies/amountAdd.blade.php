@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่มข้อมูล การรับพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล การรับพัสดุ/อุปกรณ์</i> </h4>

                    <form action="{{url('office/durable/amount/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="input[value_id]" value="{{$id}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_name">พัสดุอุปกรณ์ <code>*</code></label>
                                    <input type="text" name="input[durable_name]" class="form-control" placeholder="" disabled style="height: 45px;" value="{{$info->durable_name}}">
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                    <select name="input[unitcount_id]" class="form-control" style="height: 45px;" disabled>
                                        <option value="1">--เลือก--</option>
                                        @if (count($unitcount) > 0)
                                        @foreach($unitcount as $key => $val)
                                        <option value="{{$val->id}}" @if($val->id == $info->unitcount_id) selected @endif>{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="unitcount_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row"> 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($year))
                                            @foreach($year as $keyinfo => $valinfo)
                                                <option value="{{$valinfo->id}}">{{$valinfo->in_year}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="institution_id">หน่วยงาน <code>*</code></label>
                                    <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyinstitution => $valinstitution)
                                        <option value="{{$valinstitution->id}}">{{$valinstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="institution_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="durable_purchase">ใบจัดซื้อ-จัดจ้าง </label>
                                    <select name="input[durable_purchase]" id="durable_purchase" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                    <small id="durable_purchase_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="durable_company">ชื่อผู้ขาย</label>
                                    <input type="text" name="input[durable_company]" id="durable_company" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="durable_company_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">เลขที่ใบสำคัญ <code>*</code></label>
                                    <input type="text" name="input[amount_number]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_num" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_name">รับจาก</code></label>
                                    <input type="text" name="input[amount_name]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="amount_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_file">ไฟล์เอกสาร<code>*</code></label>
                                    <input type="file" name="input[invoice_file]" class="filestyle" placeholder="" style="height: 45px;">
                                    <small id="invoice_file" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่รับ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[amount_date]">
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
                                    <label for="amount_price">ราคา <code>*</code></label>
                                    <input type="text" name="input[amount_price]" class="form-control" id="amount_price" placeholder="" style="height: 45px;" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_num">จำนวนรับ</code></label>
                                    <input type="text" name="input[amount_num]" class="form-control" id="amount_num" placeholder="" style="height: 45px;">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_vat">VAT 7%</code></label>
                                    <input type="text" name="input[amount_vat]" class="form-control" id="amount_vat" placeholder="" style="height: 45px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_sum">ราคาสุทธิ <code>*</code></label>
                                    <input type="text" name="input[amount_sum]" class="form-control" id="amount_sum" placeholder="" style="height: 45px;">
                                </div>
                            </div>
                        </div>
                        
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_project">โครงการ </label>
                                    <select class="form-control" name="input[borrow_project]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        <option value="0">สำนักงาน</option>
                                        @if (count($project) > 0)
                                        @foreach($project as $key2 => $val2)
                                        <option value="{{$val2->id}}">{{$val2->project_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="money_id">ประเภทเงิน </label>
                                    <select name="input[money_id]" id="money_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($money) > 0)
                                        @foreach($money as $keyMoney => $valMoney)
                                        <option value="{{$valMoney->id}}">{{$valMoney->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/amount')}}/{{$id}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/amount')}}/{{$id}}?t={{$t}}&pr={{$pr}}"></div>

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

<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>

<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>

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
                'input[amount_num]': {
                    required: true
                }
            },
            messages: {
                'input[amount_num]': {
                    required: "กรุณากรอกจำนวน"
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

    $(document).on("keyup", "#amount_num", function(){
            let _itemNum = $(this).val();

            let _itemValue = $('#amount_price').val();

            let vat = (((_itemNum * _itemValue) * 7)/100).toFixed(2);
            
            let sum = (Number(_itemNum * _itemValue) + Number(vat)).toFixed(2);

            $("#amount_vat").val(vat);

            $("#amount_sum").val(sum);
        });


    $(document).on("change", "#institution_id", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();

        var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=institution&id=" + _itemValue + '&parentId=' + _id;

        $.get(_url, function(data){
            $("#durable_purchase").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_categroy", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/get/info/?t=budget&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');
        $("#projects_id").html('<option value="">--เลือก--</option><option value="0">สำนักงาน</option>');
        $.get(_url, function(data){
            $("#budget_type").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#durable_purchase", function(){
        var _itemValue = $(this).val();

        var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=purchase&id=" + _itemValue + '&parentId=0';

        $.get(_url, function(data){
            $("#durable_company").val(data.elem_html);
        }, "json");
    });
</script>
@endsection
