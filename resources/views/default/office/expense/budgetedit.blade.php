@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่ายโครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่ายโครงการ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ค่าใช้จ่ายโครงการ</i> </h4>
                    <form action="{{url('office/expenses/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <input type="hidden" name="input[type_id]" value="{{$t}}">


                        <input type="hidden" name="input[institution]" value="0">

                        <input type="hidden" name="input[year_id]" id="year_id" value="{{$projectsId}}">

                        <input type="hidden" name="input[purchases_id]" id="purchases_id" value="0">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dob">วันที่ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" style="height: 45px;"  placeholder="วว/ดด/ปปปป"  name="input[created_at]" value="{{getDateFormatToInputThai($items->created_at)}}" disabled>
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
                                            <input type="text" class="form-control datepicker-autoclose" style="height: 45px;"  placeholder="วว/ดด/ปปปป"  name="input[date_report]" value="{{getDateFormatToInputThai($items->date_report)}}">
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
                                        <option value="{{$valyear->id}}" @if($valyear->id == $items->year_id) selected @endif>{{$valyear->in_year}}</option>
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
                                        <option value="10" @if(10 == $items->year_budget) selected @endif>ตุลาคม {{$Yearname->in_year - 1}}</option>
                                        <option value="11" @if(11 == $items->year_budget) selected @endif>พฤศจิกายน {{$Yearname->in_year - 1}}</option>
                                        <option value="12" @if(12 == $items->year_budget) selected @endif>ธันวาคม {{$Yearname->in_year - 1}}</option>
                                        <option value="1" @if(1 == $items->year_budget) selected @endif>มกราคม {{$Yearname->in_year}}</option>
                                        <option value="2" @if(2 == $items->year_budget) selected @endif>กุมภาพันธ์ {{$Yearname->in_year}}</option>
                                        <option value="3" @if(3 == $items->year_budget) selected @endif>มีนาคม {{$Yearname->in_year}}</option>
                                        <option value="4" @if(4 == $items->year_budget) selected @endif>เมษายน {{$Yearname->in_year}}</option>
                                        <option value="5" @if(5 == $items->year_budget) selected @endif>พฤษภาคม {{$Yearname->in_year}}</option>
                                        <option value="6" @if(6 == $items->year_budget) selected @endif>มิถุนายน {{$Yearname->in_year}}</option>
                                        <option value="7" @if(7 == $items->year_budget) selected @endif>กรกฎาคม {{$Yearname->in_year}}</option>
                                        <option value="8" @if(8 == $items->year_budget) selected @endif>สิงหาคม {{$Yearname->in_year}}</option>
                                        <option value="9" @if(9 == $items->year_budget) selected @endif>กันยายน {{$Yearname->in_year}}</option>
                                    </select>
                                    <small id="year_budget" class="form-text text-muted"></small>
                                </div>
                            </div> 
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_number">ID Invoice <code>*</code></label>
                                    <input type="text" name="input[page_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->page_number}}">
                                    <small id="page_number" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expense_item">เลขที่ใบแจ้งหนี้ </label>
                                    <input type="text" name="input[expense_item]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->expense_item}}">
                                    <small id="expense_item" class="form-text text-muted"></small>
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
                                        <option value="{{$valinstitution->id}}" @if($valinstitution->id == $items->institution) selected @endif>{{$valinstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                    <?php 
                                    
                                    $statementtypes = \App\Models\BudgetsrDetail::getSelect('statementtype' , $items->institution , $t);
                                    ?>
                                    <select name="input[budget_categroy]" id="budget_categroy" class="form-control" style="height: 45px;" >
                                        <option value="">--เลือก--</option>
                                        <?php

                                            if (!empty($statementtypes)) {
                                                foreach ($statementtypes as $statementtype) {
                                                    if(strlen($statementtype['sortorder']) == 1){
                                        ?>
                                                        <option value="<?php echo $statementtype['id']; ?>" @if($statementtype['id'] == $items->budget_categroy) selected @endif><?php echo $statementtype['name'];?></option>
                                        <?php
                                                    }
                                                }
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                    <?php 

                                        $budgetNews = \App\Models\BudgetsrDetail::where('id', $items->budget_categroy)->where('is_deleted', '0')->where('is_active','1')->get();
                                        foreach ($budgetNews as $budgetNew);

                                        $budgets = \App\Models\BudgetsrDetail::getSelectNew('budgetNew' , $items->budget_categroy , $budgetNew['sort_order'], $budgetNew['institution_id'], $budgetNew['budget_year_id']);
                                    
                                    // $budgets = \App\Models\BudgetsrDetail::getSelect('budgetNew' , $items->budget_categroy , $t);
                                    ?>
                                    <select name="input[budget_type]" id="budget_type" class="form-control" style="height: 45px;" >
                                        <option value="">--เลือก--</option>
                                        <?php

                                            if (!empty($budgets)) {
                                                foreach ($budgets as $budget) {
                                        ?>
                                                    <option value="<?php echo $budget['id']; ?>" @if($budget['id'] == $items->budget_type) selected @endif><?php echo $budget['name'];?></option>
                                        <?php
                                                }
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <span id="loadproject">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projects_id">รายการค่าใช่จ่าย <code>*</code></label>
                                        <?php
                                            $detailitems = \App\Models\BudgetsrDetail::where('parent_id', $items->budget_type)->where('is_deleted', '0')->where('is_active','1')->get();
                                        
                                        ?>
                                        <select name="input[projects_id]" id="projects_id" class="form-control" style="height: 45px;" >
                                            <option value="">--เลือก--</option>
                                            <?php
                                                if (!empty($detailitems)) {
                                                    foreach ($detailitems as $detailitem) {

                                                        $costtypes = \App\Models\BudgetsrDetail::where('parent_id', $detailitem['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                            ?>
                                                        <option value="{{$detailitem['id']}}" @if($detailitem['id'] == $items->projects_id) selected @endif>{{$detailitem['name']}}</option>  
                                            <?php
                                                    if(count($costtypes) > 0){
                                                        $no2 = 1;
                                                        foreach($costtypes as $costtype => $valcosttype){

                                                            $costtypes1 = \App\Models\BudgetsrDetail::where('parent_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                
                                            ?>
                                                            <option value="{{$valcosttype->id}}"><span style='margin: 0 0 0 60px'>{{$valcosttype->name}}</span></option>  
                                            <?php
                                                                if(count($costtypes1) > 0){
                                                                    $no3 = 1;
                                                                    foreach($costtypes1 as $costtype1 => $valcosttype1){
                                            ?>
                                                                        <option value="{{$valcosttype1->id}}"><span style='margin: 0 0 0 90px'>{{$valcosttype1->name}}</span></option> 
                                            <?php

                                                                    }

                                                                }
                                                        }

                                                    }
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </span>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pay_for">จ่ายให้ (หน่วยงาน/บริษัท) <code>*</code></label>
                                    <select name="input[pay_for]" id="pay_for" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($company) > 0)
                                        @foreach($company as $keycompany => $valcompany)
                                        <option value="{{$valcompany->id}}" @if($valcompany->id == $items->pay_for) selected @endif>{{$valcompany->company_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="expenses_amount">จำนวนเงิน (ก่อน Vat 7%) </label>
                                    <input type="text" name="input[expenses_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->expenses_amount}}"> 
                                    <small id="expenses_amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="interest_amount">บวก Vat 7%</label>
                                    <input type="text" name="input[interest_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->interest_amount}}"> 
                                    <small id="interest_amount" class="form-text text-muted"></small>
                                </div>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pay_NHmoney_in_amountSO">ค่าใช่จ่าย (รวม) </label>
                                    <input type="text" name="input[money_in_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->money_in_amount}}"> 
                                    <small id="money_in_amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deduct_amount">หัก 1% ณ ที่จ่าย (บาท) </label>
                                    <input type="text" name="input[deduct_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->deduct_amount}}"> 
                                    <small id="deduct_amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sum_amount">จำนวนเงินจ่ายเช็ค </label>
                                    <input type="text" name="input[sum_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$items->sum_amount}}"> 
                                    <small id="sum_amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cost_detail">รายละเอียด</label>
                                    <textarea  name="input[cost_detail]" class="form-control">{{$items->cost_detail}}</textarea>
                                    <small id="durable_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">หมายเหตุ</label>
                                    <textarea  name="input[note]" class="form-control">{{$items->note}}</textarea>
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
                        <a href="{{URL('office/expenses/all')}}?t=0&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
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
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $("#datatable").DataTable();

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
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

</script>

<script>

    $('#button_budget_sub').click(function(){ 

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
                }
            },
            messages: {
                'input[date_report]': {
                    required: "กรุณากรอกคำนำหน้า"
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

    $('.btn-action-add').click(function(){

       $('#con-close-modal-budget').modal('show'); 

        var _url = $("#div-data-url").attr("data-url")+"/get/buginfo/?id=0&type=add";

        $.get(_url, function(res){
                $("#frm-budget-save #input-budget-action").val('add');
                $("#frm-budget-save #input-budget-edit_id").val('0');
                $("#frm-budget-save #input-budget-date_report").val('');
                $("#frm-budget-save #input-budget-page_number").val('');
                $("#frm-budget-save #input-budget-petition_number").val('');
                $("#frm-budget-save #input-budget-expense_item").val('');
                $("#frm-budget-save #input-budget-budget_categroy").val('');
                $("#frm-budget-save #input-budget-cost_type").val('');
                $("#frm-budget-save #input-budget-cost_amount").val('');
                $("#frm-budget-save #input-budget-cost_sum").val('');
                $("#frm-budget-save #input-budget-institution").val('');
                $("#frm-budget-save #input-budget-cost_categroy").val('');
                $("#frm-budget-save #input-budget-status_approved").val('');
            }, "json");
    });

    $('.btn-action').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');
        var title = $(this).find(':selected').attr('data-original-title');
    
        if(title == 'view'){
            // $('#con-close-modal-objective'+id).modal('show'); 
        
        }else if(title == 'edit'){
            $('#con-close-modal-budget').modal('show'); 

            var _url = $("#div-data-url").attr("data-url")+"/get/buginfo/?id="+id+"&type="+title;

            $.get(_url, function(res){
                $("#frm-budget-save #input-budget-action").val(res.info.action);
                $("#frm-budget-save #input-budget-edit_id").val(res.info.edit_id);
                $("#frm-budget-save #input-budget-date_report").val(res.info.date_report);
                $("#frm-budget-save #input-budget-page_number").val(res.info.page_number);
                $("#frm-budget-save #input-budget-petition_number").val(res.info.petition_number);
                $("#frm-budget-save #input-budget-expense_item").val(res.info.expense_item);
                $("#frm-budget-save #input-budget-budget_categroy").val(res.info.budget_categroy);
                $("#frm-budget-save #input-budget-cost_type").val(res.info.cost_type);
                $("#frm-budget-save #input-budget-cost_amount").val(res.info.cost_amount);
                $("#frm-budget-save #input-budget-cost_sum").val(res.info.cost_sum);
                $("#frm-budget-save #input-budget-institution").val(res.info.institution);
                $("#frm-budget-save #input-budget-cost_categroy").val(res.info.cost_categroy);
                $("#frm-budget-save #input-budget-status_approved").val(res.info.status_approved);
            }, "json");

        }else if(values != ''){
            window.location='{{URL('office/budget/expenses/deleted')}}'+ '/' + id;
        }
    
        
    });

    $('#button_budget').click(function(){ 

        function callBackFuncInsertBudget(data) {
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

        $('#frm-budget-save').validate({
            rules: {
                'input1[expense_item]': {
                    required: true
                }
            },
            messages: {
                'input1[expense_item]': {
                    required: "กรุณากรอกรายการรายจ่าย"
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
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-budget-save", "json", callBackFuncInsertBudget);
                return false;
            }
        });
    });
</script>
@endsection
