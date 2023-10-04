@extends('default.layouts.main')

@section('css')
<!-- third party css -->
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
                            <li class="breadcrumb-item active">งบประมาณ > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budgets/institution/update')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตั้งงบประมาณ</i> </h4>

                        
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <input type="hidden" name="input[year_id]" value="{{$yearid}}">
                            <input type="hidden" name="input[budgets_id]" value="{{$budgetsid}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                        <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($year) > 0)
                                            @foreach($year as $keyyear => $valyear)
                                            <option value="{{$valyear->id}}" @if($valyear->id == $yearid) selected @endif>{{$valyear->in_year}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">หน่วยงาน <code>*</code></label>
                                        <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($institution) > 0)
                                            @foreach($institution as $keyinstitution => $valinstitution)
                                            <option value="{{$valinstitution->id}}" @if($valinstitution->id == $info->institution_id) selected @endif>{{$valinstitution->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">ประเภทงบ <code>*</code></label>
                                        <select name="input[budgets_id]" id="budgets_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($budgetTitles) > 0)
                                            @foreach($budgetTitles as $keybudgetTitles => $vabudgetTitles)
                                            <option value="{{$vabudgetTitles->id}}" <?php if($vabudgetTitles->id == $budgetsid){ echo 'selected';}?>>{{$vabudgetTitles->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label>
                                        <input type="text" name="input[budget_money]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->budget_money}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">ลักษณะโครงการ <code>*</code></label>
                                        <textarea name="input[description]" class="form-control">{{$info->description}}</textarea>
                                        <small id="description" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> บันทึก</i>
                                    </button>
                                    <a href="{{URL('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                    </div>
                </div>
                <!-- end col -->
            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i>  
                            <button type="button" class="btn btn-success btn-sm" id="button_insert"><i class="mdi mdi-database-plus"> เพิ่มรายการ</i></button>  
                            <a href="{{url('office/budgets/institution/all')}}/{{$id}}?yearid={{$yearid}}&budgetsid={{$budgetsid}}&institutionid={{$info->institution_id}}&id={{$id}}" target="_blank"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-file-multiple"> ดูรายการทั้งหมด</i></button></a></h4>
                        
                             <?php $no = 0;?>
                                <div class="input_fields_wrap">
                                @if (!empty($detail))
                                @foreach ($detail as $item)
                                <?php $no++;?>


                                @endforeach
                                @endif

                                
                            
                                </div>

                            
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th width="8%">ลำดับ</th>
                                        <th >ประเภทงบ</th>
                                        <th style="width: 15%">จัดการ</th>
                                    </tr>
                                </thead>


                                

                                    <?php $no = 0;?>
                                    @if (!empty($detail))
                                    @foreach ($detail as $item)
                                    <?php             
                                        $valdetails = \App\Models\BudgetsrDetailYear::where('budgets_detail_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                        if (!empty($valdetails)){
                                            foreach ($valdetails as $valdetail){

                                                if($valdetail['month_10'] == 0.00 && $valdetail['month_11'] == 0.00 && $valdetail['month_12'] == 0.00 && $valdetail['month_1'] == 0.00 && $valdetail['month_2'] == 0.00 && $valdetail['month_3'] == 0.00 && $valdetail['month_4'] == 0.00 && $valdetail['month_5'] == 0.00 && $valdetail['month_6'] == 0.00 && $valdetail['month_7'] == 0.00 && $valdetail['month_8'] == 0.00 && $valdetail['month_9'] == 0.00){
                                                    $checkMonth = 0;
                                                }else{
                                                    $checkMonth = 1;
                                                }
                                            }

                                        }
                                    ?>
                                    <?php $no++;?>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle" align="right">{{$item['sort_order']}}</td>
                                            <td class="align-middle">
                                                <?php if($checkMonth == 1):?>
                                                    <a href="{{url('office/budgets/institution/views')}}/{{$item['id']}}/{{$id}}?yearid={{$yearid}}&budgetsid={{$budgetsid}}&institutionid={{$info->institution_id}}&id={{$id}}"> {{$item['name']}}</a>
                                                <?php else: ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {{$item['name']}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="text-right">
                                                                <a onclick="PopupAdd('{{$item['id']}}' , '{{$item['parent_id']}}')"><button type="button" class="btn btn-primary" style="padding:1px 6px !important;">
                                                                    <i class="mdi mdi-plus"></i>
                                                                </button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    


                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- <select name="input_action" class="form-control " data-id="{{$item['id']}}">
                                                    <option value="">เลือก</option>
                                                    <option value="edit" >แก้ไข</option>
                                                    <option value="deleted" >ลบ</option>
                                                </select> -->

                                                <a onclick="PopupEdit('{{$item['id']}}' , '{{$item['parent_id']}}')"><button type="button" class="btn btn-warning waves-effect width-md waves-light">
                                                    <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                                </button></a>
                                                <a href="{{url('office/budgets/expenses/deleted')}}/{{$item['id']}}"><button type="button" class="btn btn-danger waves-effect width-md waves-light">
                                                    <i class="mdi mdi-trash-can-outline"></i> ลบ
                                                </button></a>
                                            </td>
                                        </tr> 
                                    </tbody>
                                    <tbody id="loaddate{{$item['id']}}">
                                                
                                    </tbody>
                                    @endforeach
                                    @endif
                                    
                               
                            </table>
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>
        <!-- end row -->
        <div id="div-data-url" data-url="{{url('office/budgets/institution/edit')}}/{{$id}}?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$yearid}}"></div>
        <div id="url-redirect-back" data-url="{{url('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$yearid}}"></div>
    </div>
</div>
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 95%;">
        <form action="{{url('office/budgets/institution/year/subsave')}}" method="POST" name="frm-save-new" id="frm-save-new" enctype="multipart/form-data">

        <input type="hidden" name="budget_year_id" id="input-budget_year_id"  value="{{$id}}">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyear">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->


<div id="con-close-new-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/budgets/expenses/save')}}" method="POST" name="frm-save-new-2" id="frm-save-new-2" enctype="multipart/form-data">

        <input type="hidden" name="input[institution_id]" id="input-institution_id"  value="{{$info->institution_id}}">
        <input type="hidden" name="input[budget_year_id]" id="input-budget_year_id"  value="{{$yearid}}">
        <input type="hidden" name="input[budgettype_id]" id="input-budgettype_id"  value="{{$id}}">
        <input type="hidden" name="input[budget_id]" id="input-budget_id"  value="{{$budgetsid}}">
        <input type="hidden" name="input[parent_id]" id="input-budget_id"  value="0">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyearNew">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add_new" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->


<div id="con-close-new-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 80%;">
        <form action="{{url('office/budgets/expenses/update')}}" method="POST" name="frm-save-edit" id="frm-save-edit" enctype="multipart/form-data">

        <input type="hidden" name="input[institution_id]" id="input-institution_id"  value="{{$info->institution_id}}">
        <input type="hidden" name="input[budget_year_id]" id="input-budget_year_id"  value="{{$yearid}}">
        <input type="hidden" name="input[budgettype_id]" id="input-budgettype_id"  value="{{$id}}">
        <input type="hidden" name="input[budget_id]" id="input-budget_id"  value="{{$budgetsid}}">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyearEditNew">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_edit_new" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->


<div id="con-close-new-Add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 80%;">
        <form action="{{url('office/budgets/expenses/save')}}" method="POST" name="frm-save-Add" id="frm-save-Add" enctype="multipart/form-data">

        <input type="hidden" name="input[institution_id]" id="input-institution_id"  value="{{$info->institution_id}}">
        <input type="hidden" name="input[budget_year_id]" id="input-budget_year_id"  value="{{$yearid}}">
        <input type="hidden" name="input[budgettype_id]" id="input-budgettype_id"  value="{{$id}}">
        <input type="hidden" name="input[budget_id]" id="input-budget_id"  value="{{$budgetsid}}">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyearAddNew">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add_new_2" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

@endsection

@section('js')


<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

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

    $(document).ready(function () {


        // $("#datatable").DataTable({
        //     "ordering": true,
        //     "pageLength": 25,
        //     "oLanguage": {
        //         "sZeroRecords": "-ไม่พบรายการข้อมูล-",
        //         "sLengthMenu": "แสดง  _MENU_  รายการ",
        //         "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
        //         "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
        //         "oPaginate": {
        //             "sFirst": "หน้าแรก",
        //             "sPrevious": "ก่อนหน้า",
        //             "sNext": "ถัดไป",
        //             "sLast": "หน้าสุดท้าย"
        //         },
        //         "sSearch": "ค้นหา"
        //     }
        // });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });
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
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกปีงบประมาณ"
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

    $('#button_add').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

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

        $('#frm-save-new').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
                    required: "กรุณากรอก"
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

                ajaxSubmitFormImage("frm-save-new", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });

    $('#button_add_new').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

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

        $('#frm-save-new-2').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
                    required: "กรุณากรอก"
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

                ajaxSubmitFormImage("frm-save-new-2", "json", callBackFuncInsertFamily);
                return false;
            }
        });

    });

    $('#button_edit_new').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

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

        $('#frm-save-edit').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
                    required: "กรุณากรอก"
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

                ajaxSubmitFormImage("frm-save-edit", "json", callBackFuncInsertFamily);
                return false;
            }
        });

    });

    $('#button_add_new_2').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

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

        $('#frm-save-Add').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
                    required: "กรุณากรอก"
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

                ajaxSubmitFormImage("frm-save-Add", "json", callBackFuncInsertFamily);
                return false;
            }
        });

    });
</script>

<script type="text/javascript">

    $('#button_insert').click(function(){

        $('#con-close-new-modal').modal('show');   

        // $('#loadbudgetyear').load('{{URL('office/expenses/year/load/get/loadbudget')}}');

        $('#loadbudgetyearNew').load('{{URL('office/budgets/expenses/loadbudget')}}');
        
    });

    function loaddate(id , yearid , num){
        $('#loaddate'+id).load('{{URL('office/expenses/year/load/get/loaddate')}}' + '/' + id + '/' + yearid + '/' + num);
    }


    function PopupEdit(id , num){

        // alert(num);

        // if(num == 0){

            $('#con-close-new-edit-modal').modal('show'); 

            // alert(id);
            $('#loadbudgetyearEditNew').load('{{URL('office/budgets/expenses/loadbudgetEdit')}}' + '/' + id + '/' + num);

        // }
        
    }


    function PopupAdd(id , num){

        $('#con-close-new-Add-modal').modal('show'); 

        // alert(id);
        $('#loadbudgetyearAddNew').load('{{URL('office/budgets/expenses/loadbudgetAdd')}}' + '/' + id + '/' + num);

    }
</script>
@endsection
