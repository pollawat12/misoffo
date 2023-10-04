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

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตั้งงบประมาณ</i> </h4>

                        
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                        <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($year) > 0)
                                            @foreach($year as $keyyear => $valyear)
                                            <option value="{{$valyear->id}}" @if($valyear->id == $info->year_id) selected @endif>{{$valyear->in_year}}</option>
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
                                            <option value="{{$vabudgetTitles->id}}" @if($vabudgetTitles->id == $info->budgets_id) selected @endif>{{$vabudgetTitles->name}}</option>
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
                                    <a href="{{URL('office/budget/expenses/year/lists')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                    </div>
                </div>
                <!-- end col -->
            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i>  <button type="button" class="btn btn-success btn-sm" id="button_add_new">เพิ่มข้อมูล</button></h4>
                        
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
                                        <th width="5%">ลำดับ</th>
                                        <th >ประเภทงบ</th>
                                        <th style="width: 18%">จำนวนเงิน</th>
                                        <th style="width: 15%">จัดการ</th>
                                    </tr>
                                </thead>


                                

                                    <?php $no = 0;?>
                                    @if (!empty($detail))
                                    @foreach ($detail as $item)
                                    <?php $no++;?>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle" align="right">{{ $no }}</td>
                                            <?php 
                                            
                                                $statementtype = \App\Models\DataSetting::getNameDataByValueAndType($item['statementtype_id'],'statementtype');
                                            ?>
                                            <td class="align-middle"><a onclick="loaddate('{{$item['id']}}' , '{{$id}}' , '{{$no}}');" style="cursor: pointer;"> {{$statementtype}} </a></td>
                                            <td class="align-middle" align="right">{{number_format($item['sum_total'],2,'.',',')}}</td>
                                            <td>
                                                <select name="input_action" class="form-control " data-id="{{$item['id']}}">
                                                    <option value="">เลือก</option>
                                                    <option value="edit" >แก้ไข</option>
                                                    <option value="deleted" >ลบ</option>
                                                </select>
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
        <div id="div-data-url" data-url="{{url('office/budget/expenses/year/edit/get')}}/{{$id}}"></div>
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/year/lists')}}/{{$id}}"></div>
    </div>
</div>
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 70%;">
        <form action="{{url('office/budget/expenses/year/subsave')}}" method="POST" name="frm-save-new" id="frm-save-new" enctype="multipart/form-data">

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
</script>

<script type="text/javascript">

    $('#button_add_new').click(function(){

        $('#con-close-modal').modal('show'); 

        $('#loadbudgetyear').load('{{URL('office/budget/expenses/year/load/get/loadbudget')}}');
        
    });

    function loaddate(id , yearid , num){
        $('#loaddate'+id).load('{{URL('office/budget/expenses/year/load/get/loaddate')}}' + '/' + id + '/' + yearid + '/' + num);
    }
</script>
@endsection
