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

                    <form action="{{url('office/budget/expenses/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <input type="hidden" name="input[projects_id]" value="{{$projectsId}}">
                        <?php foreach($detail as $keydetail => $valDetail);?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">แผนงาน/โครงการ : {{$valDetail['project_name']}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่รายงาน </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_report]" value="{{getDateFormatToInputThai($info->date_report)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_number">เลขเอกสาร <code>*</code></label>
                                    <input type="text" name="input[page_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->page_number}}">
                                    <small id="page_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="petition_number">เลขฏีกา </label>
                                    <input type="text" name="input[petition_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->petition_number}}">
                                    <small id="petition_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cut_top_number">เลขที่ตัดยอด </label>
                                    <input type="text" name="input[cut_top_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->cut_top_number}}">
                                    <small id="cut_top_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="expense_item">รายการรายจ่าย </label>
                                    <textarea name="input[expense_item]" class="form-control">{{$info->expense_item}}</textarea>
                                    <small id="expense_item" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php $budgetCategroys = \App\Models\DataSetting::where('group_type','statementtype')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                    <select name="input[budget_categroy]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($budgetCategroys))
                                        @foreach ($budgetCategroys as $budgetCategroy)
                                            <option value="{{$budgetCategroy['id']}}"  @if($budgetCategroy['id'] == $info->budget_categroy) selected @endif>{{$budgetCategroy['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_type">ประเภทรายจ่าย <code>*</code></label>
                                    <select name="input[cost_type] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="1" @if(1 == $info->cost_type) selected @endif>ตั้งเบิก</option>
                                        <option value="2" @if(2 == $info->cost_type) selected @endif>คืนเงิน</option>
                                    </select>
                                    <small id="cost_type" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_amount">จำนวน </label>
                                    <input type="text" name="input[cost_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->cost_amount}}">
                                    <small id="cost_amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_sum">รวมเดือน </label>
                                    <input type="text" name="input[cost_sum]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->cost_sum}}">
                                    <small id="cost_sum" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php $institutions = \App\Models\DataSetting::where('group_type','institution')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="institution">หน่วยงานที่รับผิดชอบ </label>
                                    <select name="input[institution]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($institutions))
                                        @foreach ($institutions as $institution)
                                            <option value="{{$institution['id']}}" @if($institution['id'] == $info->institution) selected @endif>{{$institution['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php $costCategroys = \App\Models\DataSetting::where('group_type','categorybudget')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="cost_categroy">ประเภท </label>
                                    <select name="input[cost_categroy]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($costCategroys))
                                        @foreach ($costCategroys as $costCategroy)
                                            <option value="{{$costCategroy['id']}}" @if($costCategroy['id'] == $info->cost_categroy) selected @endif>{{$costCategroy['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status_approved">สถานะอนุมัติ <code>*</code></label>
                                    <select name="input[status_approved] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="0" @if(0 == $info->status_approved) selected @endif>ยังไม่ยันยืน</option>
                                        <option value="1" @if(1 == $info->status_approved) selected @endif>ยันยืน</option>
                                    </select>
                                    <small id="status_approved" class="form-text text-muted"></small>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary" id="button_budget_sub">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/budget/expenses/show')}}/{{$projectsId}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/edit')}}/{{$id}}/{{$projectsId}}"></div>

        <div id="div-data-url" data-url="{{url('office/budget/expenses/')}}"></div>
    </div>
</div>

<div id="con-close-modal-budget" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/budget/expenses/bugSave')}}" method="POST" name="frm-budget-save" id="frm-budget-save" enctype="multipart/form-data">
            <input type="hidden" id="input-budget-action" name="action" value="add">
            <input type="hidden" id="input-budget-edit_id" name="edit_id" value="0">

            <input type="hidden" name="input1[projects_id]" value="{{$projectsId}}">

            <input type="hidden" name="input1[parent_id]" value="{{$id}}">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ข้อมูลค่าใช้จ่ายโครงการ</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="expense_item">รายการรายจ่าย </label>
                                <textarea name="input1[expense_item]" class="form-control" id="input-budget-expense_item"></textarea>
                                <small id="expense_item" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                <input type="text" name="input1[budget_categroy]" class="form-control" placeholder="" id="input-budget-budget_categroy" style="height: 45px;">
                                <small id="budget_categroy" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost_type">ประเภทรายจ่าย <code>*</code></label>
                                <select name="input1[cost_type] " class="form-control" style="height: 45px;" id="input-budget-cost_type">
                                    <option value="">--เลือก--</option>
                                    <option value="1">ตั้งเบิก</option>
                                    <option value="2">คืนเงิน</option>
                                </select>
                                <small id="cost_type" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost_amount">จำนวน </label>
                                <input type="text" name="input1[cost_amount]" class="form-control" id="input-budget-cost_amount" placeholder="" style="height: 45px;">
                                <small id="cost_amount" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institution">หน่วยงานที่รับผิดชอบ </label>
                                <input type="text" name="input1[institution]" class="form-control" id="input-budget-institution" placeholder="" style="height: 45px;">
                                <small id="institution" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost_categroy">ประเภท </label>
                                <input type="text" name="input1[cost_categroy]" class="form-control" id="input-budget-cost_categroy" placeholder="" style="height: 45px;">
                                <small id="cost_categroy" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_approved">สถานะอนุมัติ <code>*</code></label>
                                <select name="input1[status_approved] " class="form-control" style="height: 45px;" id="input-budget-status_approved">
                                    <option value="">--เลือก--</option>
                                    <option value="0">ยังไม่ยันยืน</option>
                                    <option value="1">ยันยืน</option>
                                </select>
                                <small id="status_approved" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                    <button type="submit" id="button_budget" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->

@endsection

@section('js')
<!-- Required datatable js -->
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
