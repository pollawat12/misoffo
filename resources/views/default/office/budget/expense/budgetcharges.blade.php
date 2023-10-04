@extends('default.layouts.main')

@section('css')
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
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
        
        <?php $noN = 0;?>
        @if (!empty($purchases))    
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แจ้งเตือนค่าใช้จ่าย</i></h4>
                                <p class="sub-header"></p>
                            </div>
                        </div>
                        
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">วันที่รายงาน</th>
                                    <th width="15%">เรื่อง</th>
                                    <th width="10%">แนบไฟล์</th>
                                    <th width="15%">สถานะ</th>
                                    <th style="width: 8%">จัดการ</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($purchases as $purchase)
                                <?php $noN++;?>
                                <tr>
                                    <td class="align-middle" style="width:5%">{{$noN}}</td>
                                    <td class="align-middle">{{getDateShow($purchase['purchases_status_date'])}}</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_message']}}</td>
                                    <td class="align-middle" style="width:20%">@if($purchase['purchases_status_file'] != NULL) <a href="{{url('')}}/{{$purchase['purchases_status_file']}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลด</i> </a> @endif</td>
                                    <td class="align-middle" style="width:20%">{{$purchase['purchases_status_update']}}</td>
                                    <td style="width:10%">
                                        <select name="input_action" class="form-control btn-action-new">
                                            <option value="">เลือก</option>
                                            <option value="{{$purchase['purchases_id']}}" data-original-title="show" data-id="{{$purchase['id']}}">ดูรายละเอียด</option>
                                            <option value="edit" data-original-title="edit" data-id="{{$purchase['id']}}">อัพเดทสถานะ</option>
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
        <?php foreach ($infos as $info);?>
        <span id="loadBudget">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">

                        <div class="row mb-3">
                            <div class="col-10">
                                
                            </div>
                            <div class="col-2 text-right">
                                <select name="year_id_n" id="year_id_n" class="form-control" style="height: 40px; ">
                                    <option value="">--เลือก--</option>
                                    @if (count($year) > 0)
                                    @foreach($year as $valyear)
                                    <option value="{{$valyear['year_id']}}" @if($valyear['year_id'] == $info['year_id']) selected @endif>{{$valyear['year_name']}}</option>
                                    @endforeach
                                    @endif
                                </select>  
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-10">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ค่าใช้จ่าย</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{url('office/budget/expenses/charges/add')}}/{{$id}}/?t={{$t}}&pr={{$pr}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">วันที่รายงาน</th>
                                    <th width="10%">เลขที่เช็ค</th>
                                    <th width="10%">รายการ / หมวดที่จ่าย</th>
                                    <th width="10%">จ่ายให้ (บริษัท)</th>
                                    <th width="20%">รายการรายจ่าย</th>
                                    <th width="10%">ประเภทงบ</th>
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
                                    <td class="align-middle">{{$item['page_number']}}</td>
                                    <td class="align-middle">{{$item['expense_item']}}</td>
                                    <td class="align-middle">
                                        <?php
                                            $budgets= \App\Models\BudgetCertificateCompany::where('id', $item['pay_for'])->get();
                                            if (!empty($budgets)){
                                                foreach ($budgets as $rowsbudget){
                                                    echo $rowsbudget['company_name'];
                                                }

                                            }else{

                                                echo '';
                                            }
                                            
                                        ?>
                                    </td>
                                    <td class="align-middle">{{$item['project_name']}}</td>
                                    <td class="align-middle">{{$item['budget_categroy']}}</td>
                                    <td class="align-middle">{{number_format($item['expenses_amount'],2,'.',',')}}</td>
                                    <td>
                                        <select name="input_action" class="form-control btn-action"  data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" >ดูรายละเอียด</option> 
                                            <option value="detail">ค่าใช้จ่ายย่อย</option>--}}
                                            <option value="charges/edit" >แก้ไข</option>
                                            <option value="charges/deleted" >ลบ</option>
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
        </span>
        <div id="div-data-url-new" data-url="{{url('office/purchases')}}"></div>     
        
        <div id="div-data-url" data-url="{{url('office/budget/expenses/charges')}}/{{$id}}"></div>   
    </div>
</div>


<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <form action="{{url('office/purchases/status/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">

        <input type="hidden" name="edit_id" id="input-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลอัพเดทสถานะ</h4>
            </div>
            <?php 
                $purchasesstatus = \App\Models\DataSetting::where('group_type','purchasesstatus')->where('is_deleted', '0')->where('is_active','1')->get();
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="lastname">ข้อความ </label>
                            <input type="text" class="form-control" name="input[purchases_status_message]" id="input-purchases_status_message" placeholder="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">สถานะ </label>
                            <div>
                                <div class="input-group">
                                    <select name="input[is_status]" class="form-control" id="input-is_status" style="height: 45px;">
                                        <option value="2">อยู่ระหว่างดำเนินการ</option>
                                        <option value="1">ดำเนินการ</option>
                                        <option value="3">แล้วเส็จ</option>
                                        <option value="0">ยกเลิก</option>
                                    </select>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="group_no">ส่งถึง </label>
                            <select name="input[purchases_status_to]" class="form-control" id="input-purchases_status_to" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                <option value="1">งบประมาณ</option>
                                <option value="2">บัญชี</option>
                                <option value="3">การเงิน</option>
                                <option value="4">ครุภัณฑ์</option>
                            </select>
                        </div>
                    </div>
                </div>
               
                <?php 
                    $auth_info = session('auth_info');
                ?>
                <input type="hidden" name="input[user_id]" value="{{$auth_info['user_id']}}">
                <input type="hidden" name="input[purchases_id]" value="{{$id}}">
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
<!-- Required datatable js -->
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


    $(document).on('change', '.btn-action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/budget/expenses')}}'+ '/' + values + '/' + id + '/{{$id}}/?t={{$t}}&pr={{$pr}}';
        } 
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
            window.open('{{URL('office/purchases/show')}}'+ '/' + values, '_blank');
        }else{
            
        }
        
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

        $('#frm-save').validate({
            rules: {
                'input[purchases_status_message]': {
                    required: true
                }
            },
            messages: {
                'input[purchases_status_message]': {
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

                ajaxSubmitFormImage("frm-save", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });


    $(document).on('change', '#year_id_n', function(params) {
        let values = $(this).val();

        window.location='{{URL('office/budget/expenses/charges')}}'+ '/' +values;
        
    });
</script>
@endsection


