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
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูล ค่าใช้จ่ายโครงการ</i> </h4>

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
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่รายงาน</h4>
                                    <label for="exampleInputEmail1"> {{getDateShow($info->date_report)}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขเอกสาร</h4>
                                    <label for="exampleInputEmail1"> {{$info->page_number}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขฏีกา</h4>
                                    <label for="exampleInputEmail1"> {{$info->petition_number}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขที่ตัดยอด</h4>
                                    <label for="exampleInputEmail1"> {{$info->cut_top_number}}</label>
                                </div>
                            </div>
                        </div>
                        <?php 
                        
                        $statementtype = \App\Models\DataSetting::getNameDataByValueAndType($info->budget_categroy,'statementtype');
                        $institution = \App\Models\DataSetting::getNameDataByValueAndType($info->institution,'institution');
                        $categorybudget = \App\Models\DataSetting::getNameDataByValueAndType($info->cost_categroy,'categorybudget');

                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">รายการรายจ่าย</h4>
                                    <label for="exampleInputEmail1"> {{$info->expense_item}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ประเภทงบ</h4>
                                    <label for="exampleInputEmail1"> {{$statementtype}}</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ประเภทรายจ่าย</h4>
                                    <label for="exampleInputEmail1"> @if($info->cost_type == 1) ตั้งเบิก @else คืนเงิน @endif</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">จำนวน</h4>
                                    <label for="exampleInputEmail1">{{number_format($info->cost_amount,2,'.',',')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">หน่วยงานที่รับผิดชอบ</h4>
                                    <label for="exampleInputEmail1"> {{$institution}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ประเภท</h4>
                                    <label for="exampleInputEmail1"> {{$categorybudget}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">สถานะอนุมัติ</h4>
                                    <label for="exampleInputEmail1"> @if($info->status_approved == 1) ยันยืน @else ยังไม่ยันยืน @endif</label>
                                    {{-- <input type="text" class="form-control" value="@if($info->status_approved == 1) ยันยืน @else ยังไม่ยันยืน @endif" disabled>  --}}
                                </div>
                            </div>

                        </div>

                        <a href="{{URL('office/budget/expenses/edit')}}/{{$id}}/{{$projectsId}}"  class="btn btn-warning"><i class="mdi mdi-pencil-plus-outline"> แก้ไขข้อมูล</i></a>
                        <a href="{{URL('office/budget/expenses/show')}}/{{$projectsId}}"  class="btn btn-secondary"><i class="mdi mdi-backspace-outline"> ย้อนกลับ</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ค่าใช้จ่ายโครงการ</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            
                            {{-- <a href="{{url('office/budget/expenses/add')}}/{{$id}}" class="btn btn-secondary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a> --}}

                            <button class="btn btn-primary btn-action-add" type="button" data-id="{{$id}}"><i class="mdi mdi-file-plus-outline"></i> เพิ่มข้อมูล</button>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%">ลำดับ</th>
                                <th width="8%">วันที่รายงาน</th>
                                <th width="20%">รายการรายจ่าย</th>
                                <th width="10%">ประเภทรายจ่าย</th>
                                <th width="10%">จำนวน</th>
                                <th style="width: 8%">จัดการ</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{getDateShow($item['date_report'])}}</td>
                                <td class="align-middle">{{$item['expense_item']}}</td>
                                <td class="align-middle">@if ($item['cost_type'] == 1) ตั้งเบิก @else คืนเงิน @endif</td>
                                <td class="align-middle">{{number_format($item['cost_amount'],2,'.',',')}}</td>
                                <td>
                                    <select name="input_action" class="form-control btn-action">
                                        <option value="">เลือก</option>
                                        {{-- <option value="view" data-original-title="view" data-id="{{$item['id']}}">ดูรายละเอียด</option> --}}
                                        <option value="edit" data-original-title="edit" data-id="{{$item['id']}}">แก้ไข</option>
                                        <option value="delete" data-original-title="delete" data-id="{{$item['id']}}">ลบ</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/detail')}}/{{$id}}/{{$projectsId}}"></div>

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
                            <?php $budgetCategroys = \App\Models\DataSetting::where('group_type','statementtype')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                            <div class="form-group">
                                <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                <select name="input1[budget_categroy]" class="form-control" style="height: 45px;" id="input-budget-budget_categroy">
                                    <option value="">--เลือก--</option>
                                    @if (!empty($budgetCategroys))
                                    @foreach ($budgetCategroys as $budgetCategroy)
                                        <option value="{{$budgetCategroy['id']}}">{{$budgetCategroy['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost_type">ประเภทรายจ่าย <code>*</code></label>
                                <select name="input1[cost_type] " class="form-control" style="height: 45px;" id="input-budget-cost_type">
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
                                <input type="text" name="input1[cost_amount]" class="form-control" id="input-budget-cost_amount" placeholder="" style="height: 45px;">
                                <small id="cost_amount" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php $institutions = \App\Models\DataSetting::where('group_type','institution')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                            <div class="form-group">
                                <label for="institution">หน่วยงานที่รับผิดชอบ </label>
                                <select name="input1[institution]" class="form-control" style="height: 45px;" id="input-budget-institution">
                                    <option value="">--เลือก--</option>
                                    @if (!empty($institutions))
                                    @foreach ($institutions as $institution)
                                        <option value="{{$institution['id']}}" @if($institution['id'] == $info->institution) selected @endif>{{$institution['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php $costCategroys = \App\Models\DataSetting::where('group_type','categorybudget')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                            <div class="form-group">
                                <label for="cost_categroy">ประเภท </label>
                                <select name="input1[cost_categroy]" class="form-control" style="height: 45px;" id="input-budget-cost_categroy">
                                    <option value="">--เลือก--</option>
                                    @if (!empty($costCategroys))
                                    @foreach ($costCategroys as $costCategroy)
                                        <option value="{{$costCategroy['id']}}">{{$costCategroy['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_approved">สถานะอนุมัติ <code>*</code></label>
                                <select name="input1[status_approved] " class="form-control"] style="height: 45px;" id="input-budget-status_approved">
                                    <option value="">--เลือก--</option>
                                    <option value="0" @if(0 == $info->status_approved) selected @endif>ยังไม่ยันยืน</option>
                                    <option value="1" @if(1 == $info->status_approved) selected @endif>ยันยืน</option>
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

<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "oLanguage": {
                "sZeroRecords": "-ไม่พบรายการข้อมูล-",
                "sLengthMenu": "แสดง  _MENU_  รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
                "sSearch": "ค้นหา"
            }
        });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });


        // var a = $("#datatable-buttons").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // });
        // $("#key-table").DataTable({
        //     keys: !0
        // }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
        //     select: {
        //         style: "multi"
        //     }
        // }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });

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
                $("#frm-budget-save #input-budget-cost_amount").val('');
                $("#frm-budget-save #input-budget-cost_sum").val('');
                $("#frm-budget-save #input-budget-cost_categroy").val('');
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
