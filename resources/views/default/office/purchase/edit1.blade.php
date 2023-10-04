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
                        <h6 class="header-title mb-1 font-size-16 mt-1">ขออนุมัติหลักการ</h6>
                        <hr class="hr-form-all">
                        <form action="{{url('office/purchase/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">
                        
                        <input type="hidden" name="input[purchases_status]" value="1">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[purchases_name]" id="inputEmail4" placeholder="" style="height: 45px;" value="{{$info->purchases_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">บันทึกเลขที่
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[purchases_order_number]" id="inputEmail4" placeholder="" style="height: 45px;" value="{{$info->purchases_order_number}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">วันที่ <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date]" value="@if ($info->purchases_invoice_date != NULL){{getDateFormatToInputThai($info->purchases_invoice_date)}} @endif">
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
                                            class="col-form-label label-step">งบประมาณที่ได้รับ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[purchases_allocated_budget]" id="inputEmail4" placeholder="" style="height: 45px;" value="{{$info->purchases_allocated_budget}}">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">อ้างอิงมติ
                                            กบน./อบน. <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="input[purchases_refer]" id="inputEmail4" placeholder="" style="height: 45px;" value="{{$info->purchases_refer}}">
                                    </div>
                                </div> -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                        <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($Year) > 0)
                                            @foreach($Year as $keyyear => $valyear)
                                                <option value="{{$valyear->id}}" @if($valyear->id == $info->year_id) selected @endif>{{$valyear->in_year}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="institution_id">หน่วยงาน <code>*</code></label>
                                        <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($institution) > 0)
                                            @foreach($institution as $keyinstitution => $valinstitution)
                                            <option value="{{$valinstitution->id}}" @if($valinstitution->id == $info->institution_id) selected @endif>{{$valinstitution->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="institution_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="budget_categroy">ประเภทงบ<code>*</code></label>
                                        <?php 
                                    
                                        $statementtypes = \App\Models\BudgetsrDetail::getSelect('statementtype' , $info->institution_id , $info->year_id);
                                        ?>
                                        <select name="input[budget_categroy]" id="budget_categroy" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            <?php

                                                if (!empty($statementtypes)) {
                                                    foreach ($statementtypes as $statementtype) {
                                                        if(strlen($statementtype['sortorder']) == 1){
                                            ?>
                                                            <option value="<?php echo $statementtype['id']; ?>" @if($statementtype['id'] == $info->budget_categroy) selected @endif><?php echo $statementtype['name'];?></option>
                                            <?php
                                                        }
                                                    }
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="budget_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                        <?php 

                                            $budgetNews = \App\Models\BudgetsrDetail::where('id', $info->budget_categroy)->where('is_deleted', '0')->where('is_active','1')->get();
                                            foreach ($budgetNews as $budgetNew);

                                            $budgets = \App\Models\BudgetsrDetail::getSelectNew('budgetNew' , $info->budget_categroy , $budgetNew['sort_order'], $budgetNew['institution_id'], $budgetNew['budget_year_id']);
                                        
                                        // $budgets = \App\Models\BudgetsrDetail::getSelect('budgetNew' , $items->budget_categroy , $t);
                                        ?>
                                        <select name="input[budget_type]" id="budget_type" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            <?php

                                                if (!empty($budgets)) {
                                                    foreach ($budgets as $budget) {
                                            ?>
                                                        <option value="<?php echo $budget['id']; ?>" @if($budget['id'] == $info->budget_type) selected @endif><?php echo $budget['name'];?></option>
                                            <?php
                                                    }
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span id="loadproject">
                                        <div class="form-group">
                                            <label for="purchases_refer">รายการค่าใช่จ่าย <code>*</code></label>
                                            <?php
                                                $detailitems = \App\Models\BudgetsrDetail::where('parent_id', $info->budget_type)->where('is_deleted', '0')->where('is_active','1')->get();
                                            
                                            ?>
                                            <select name="input[purchases_refer]" id="purchases_refer" class="form-control" style="height: 45px;" >
                                                <option value="">--เลือก--</option>
                                                <?php
                                                    if (!empty($detailitems)) {
                                                        foreach ($detailitems as $detailitem) {

                                                            $costtypes = \App\Models\BudgetsrDetail::where('parent_id', $detailitem['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                ?>
                                                            <option value="{{$detailitem['id']}}" @if($detailitem['id'] == $info->purchases_refer) selected @endif>{{$detailitem['name']}}</option>  
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
                                    </span>
                                </div>

                                <div class="col-lg-12">
                                    <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                            class="text-danger">*</span></div>
                                    <div class="form-group">
                                        <input type="file" class="filestyle" name="purchases_file" id="filestyleicon">
                                    </div>
                                </div>
                                

                                <!-- คณะกรรมการ -->
                                <div class="col-lg-12">
                                    <div class="label-step mt-3 mb-2">คณะกรรมการ
                                        TOR/ราคากลาง <span class="text-danger">*</span></div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="radio" name="input[purchases_board]" class="custom-control-input" id="Check1" value="0" @if(0 == $info->purchases_board) checked @endif>
                                        <label class="custom-control-label" for="Check1">ไม่มี</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" name="input[purchases_board]" class="custom-control-input" id="Check2" value="1" @if(1 == $info->purchases_board) checked @endif>
                                        <label class="custom-control-label" for="Check2">มี ระบุ จำนวน .....
                                            คน</label>
                                    </div>

                                    
                                    <div class="title-aad-name mt-2 mb-2">
                                        <div class="label-step mt-2 mb-2">ระบุ รายชื่อ</div>
                                        <button type="button" class="btn btn-info waves-effect waves-light clicker" value="1">
                                            <i class="mdi mdi-plus"></i> เพิ่มรายชื่อ
                                        </button>
                                    </div>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 input_fields_wrap">
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
                                                    $purchasesOfficers = \App\Models\PurchasesOfficer::where('purchases_id', $id)->where('group_id', '1')->where('is_deleted', '0')->where('is_active','1')->get();
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
                                                                        <option value="2" @if(2 == $purchasesOfficer->position_id) selected @endif>กรรมการ</option>
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
                                        <input type="file" class="filestyle" name="purchases_file1" id="filestyleicon">
                                    </div>
                                    <div class="comment-file">
                                        1.หนังสือขออนุมัติ 2.
                                        คำสั่งแต่งตั้ง (แนบได้มากกว่า 1 ไฟล์)
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

$(document).on('change', '#year_id', function(params) {
    let values = $(this).val();

    var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=yearNew&id=" + values + '&parentId=489';

    $("#institution_id").html('<option value="">--เลือก--</option>');
    $.get(_url, function(data){
        $("#institution_id").html(data.elem_html);
    }, "json");
    
    
});

$(document).on("change", "#institution_id", function(){
    var _itemValue = $(this).val();
    var _id = $("#year_id").val();
    var _url = $("#base-url-api").attr("data-url") + "/office/expenses/project/get/info/?t=statementtypeNew&id=" + _itemValue + '&parentId=' + _id;

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
    
    $('#loadproject').load('{{URL('office/expenses/loadprojectpurchase')}}' + '/' + _itemValue + '/' + _id);
});

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
</script>
@endsection
