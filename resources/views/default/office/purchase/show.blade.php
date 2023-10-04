@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบจัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item active">ข้อมูจัดซื้อ - จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">จัดซื้อ - จัดจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลจัดซื้อ - จัดจ้าง</i> </h4>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#update-name" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                    <span class="d-none d-sm-block">จัดซื้อ - จัดจ้าง</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#update-company" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">คู่สัญญา</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#update-inspector" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                    <span class="d-none d-sm-block">เจ้าหน้าที่ตรวจสอบ</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="update-name">
                                <p>
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="edit_id" value="{{$id}}">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">เรื่อง</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_name}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">เลขที่ใบสั่งซื้อ</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_order_number}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_invoice_date != NULL) {{getDateFormatToInputThai($info->purchases_invoice_date)}} @endif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_fiscal_year}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">งบประมาณที่ได้รับจัดสรรร</h4>
                                                <label for="exampleInputEmail1">{{number_format($info->purchases_allocated_budget,2,'.',',')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ราคากลาง</h4>
                                                <label for="exampleInputEmail1">{{number_format($info->purchases_middle_price,2,'.',',')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วิธีการจัดซื้อ จัดจ้าง</h4>
                                                @if (count($purchasesmethod) > 0)
                                                    @foreach($purchasesmethod as $keypurchasesmethod => $valpurchasesmethod)
                                                        <label for="exampleInputEmail1">@if($valpurchasesmethod->id == $info->purchases_method) {{$valpurchasesmethod->name}} @endif</label>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="update-company">
                                <p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ชื่อบริษัท/ห้าง/ร้าน</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_company}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">เลขที่สัญญา</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_contract_number}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่ทำสัญญา</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_contract_date != NULL) {{getDateFormatToInputThai($info->purchases_contract_date)}} @endif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่ครบกำหนดสัญญา</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_contract_expiration_date != NULL) {{getDateFormatToInputThai($info->purchases_contract_expiration_date)}} @endif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">จำนวนเงินตามสัญญา</h4>
                                                <label for="exampleInputEmail1">{{number_format($info->purchases_contract_amount,2,'.',',')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ประเภทหลักประกัน</h4>
                                                @if (count($purchasesmargin) > 0)
                                                    @foreach($purchasesmargin as $keypurchasesmargin => $valpurchasesmargin)
                                                        <label for="exampleInputEmail1">@if($valpurchasesmargin->id == $info->purchases_margin_type) {{$valpurchasesmargin->name}} @endif</label>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ธนาคาร</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_bank}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">เลขที่บัญชี</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_account_number}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ลงวันที่</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_contrac_dated != NULL) {{getDateFormatToInputThai($info->purchases_contrac_dated)}} @endif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">จำนวนเงินวางประกัน</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_insurance_amount}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ระยะเวลาการรับประกัน (เริ่มต้น)</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_warranty_start != NULL) {{getDateFormatToInputThai($info->purchases_warranty_start)}} @endif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">ระยะเวลาการรับประกัน (สิ้นสุด)</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_warranty_end != NULL) {{getDateFormatToInputThai($info->purchases_warranty_end)}} @endif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่กรรมการตรวจรับ</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_date_committee != NULL) {{getDateFormatToInputThai($info->purchases_date_committee)}} @endif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่ครบกำหนดคืน</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_date_return_due != NULL) {{getDateFormatToInputThai($info->purchases_date_return_due)}} @endif</label>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="tab-pane" id="update-inspector">
                                <p>
                                    <?php $no = 0;?>
                                    @if (!empty($detail))
                                        @foreach ($detail as $item)
                                        <?php $no++;?>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4 class="header-title" style="font-size:16px !important;">ชื่อเจ้าหน้าที่ ตรวจสอบ</h4>
                                                        @if (count($employees) > 0)
                                                            @foreach($employees as $valemployees)
                                                                <label for="exampleInputEmail1">@if($valemployees['id'] == $item['purchases_inspector']) {{$valemployees['name']}} @endif</label>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4 class="header-title" style="font-size:16px !important;">ตำแหน่ง</h4>
                                                            <label for="exampleInputEmail1">@if($item['position_id'] == 1) ประธานกรรมการ @elseif($item['position_id'] == 2) กรรมการ @endif</label>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">สถานะจัดซื้อ - จัดจ้าง</h4>
                                                @if (count($purchasesstatus) > 0)
                                                    @foreach($purchasesstatus as $keypurchasesstatus => $valpurchasesstatus)
                                                        <label for="exampleInputEmail1">@if($valpurchasesstatus->id == $info->purchases_purchasing_status) {{$valpurchasesstatus->name}} @endif</label>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">วันที่ ตรวจสอบ</h4>
                                                <label for="exampleInputEmail1">@if ($info->purchases_check_date != NULL) {{getDateFormatToInputThai($info->purchases_check_date)}} @endif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4 class="header-title" style="font-size:16px !important;">หมายเหตุ</h4>
                                                <label for="exampleInputEmail1">{{$info->purchases_note}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
            
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/purchases/lists')}}"></div>

        <div id="div-data-url" data-url="{{url('office/purchases/detail')}}/{{$id}}"></div>

        <div id="div-data-url-new" data-url="{{url('office/purchases')}}"></div>
    </div>
</div>


<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/purchases/sub/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">

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
                            <input type="text" class="form-control" name="input[purchases_status_message]" id="input-purchases_status_message" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่ </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-purchases_status_date" placeholder="วว/ดด/ปปปป"  name="input[purchases_status_date]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_name">แนบไฟล์ </label>
                            <input type="file" class="filestyle" name="upfile_purchases" id="input-purchases_status_file" placeholder="" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">สถานะ </label>
                            <div>
                                <div class="input-group">
                                    <select name="input[purchases_status_update]" class="form-control" id="input-purchases_status_update" style="height: 45px;">
                                        <option value="0">--เลือก--</option>
                                        @if (!empty($purchasesstatus))
                                        @foreach ($purchasesstatus as $purchasesstatuss)
                                            <option value="{{$purchasesstatuss['id']}}">{{$purchasesstatuss['name']}}</option>
                                        @endforeach
                                        @endif
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



<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

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
    });

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
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
</script>
<script type="text/javascript">

    $('.btn-action-add').click(function(){
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-original-title');
        
        $('#con-close-modal').modal('show'); 

        var _url = $("#div-data-url-new").attr("data-url")+"/get/info/?id="+id+"&type="+title;

        if(title == 'add'){
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        }else{
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_file").val(res.info.purchases_status_file);
                $("#frm-save #input-purchases_status_to").val(res.info.purchases_status_to);
                $("#frm-save #input-purchases_status_update").val(res.info.purchases_status_update);
                $("#frm-save #input-purchases_status_date").val(res.info.purchases_status_date);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");
        }
        
    });

    $(document).on('change', '.btn-action', function(params) {
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
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(title == 'del'){
            window.location='{{URL('office/purchases/sub/deleted')}}'+ '/' + id;
        }else{
            
        }
        
    });
</script>
@endsection
