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
                <div class="col-lg-12">
                    <div class="card-box">

                        <div class="media-body">
                            <h6 class="header-title mb-1 font-size-16">ขั้นตอนการทำงาน งานจัดซื้อจัดจ้าง-ข้อมูลและสถานะงาน</h6>
                            <hr class="hr-form-all">

                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="box-main-step" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=1&pr=0'">
                                        <div class="icon-num-step">
                                            <div class="num-step-cus">
                                                1
                                            </div>
                                        </div>
                                        <div class="content-step">
                                            ขออนุมัติหลักการ
                                        </div>

                                        <div class="icon-check-step">
                                            <i class="fas fa-check icon-check-step-cus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>

                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 col-sm-12">
                                    <div <?php if($info->purchases_status < 1 ){ ?> class="box-main-step-off"  <?php }elseif($info->purchases_status == 1){ ?> class="box-main-step-on" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=2&pr=0'" <?php }elseif( $info->purchases_status > 1){ ?>  class="box-main-step" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=2&pr=0'" <?php } ?>>
                                        <div class="icon-num-step">
                                            <div <?php if($info->purchases_status < 1 ){ ?> class="num-step-cus-off"  <?php }elseif($info->purchases_status == 1){ ?> class="num-step-cus" <?php }elseif( $info->purchases_status > 1){ ?> class="num-step-cus" <?php } ?>>
                                                2
                                            </div>
                                        </div>
                                        <div <?php if($info->purchases_status < 1 ){ ?> class="content-step-off"  <?php }elseif($info->purchases_status == 1){ ?> class="content-step" <?php }elseif( $info->purchases_status > 1){ ?> class="content-step" <?php } ?>>
                                            รายงานขอซื้อขอจ้าง
                                        </div>

                                        <?php if($info->purchases_status < 1 ){ ?> 
                                        <?php }elseif($info->purchases_status == 1){ ?> 
                                        <?php }elseif( $info->purchases_status > 1){ ?> 
                                            <div class="icon-check-step">
                                                <i class="fas fa-check icon-check-step-cus"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>

                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 col-sm-12">
                                    <div <?php if($info->purchases_status < 2 ){ ?> class="box-main-step-off"  <?php }elseif($info->purchases_status == 2){ ?> class="box-main-step-on" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=3&pr=0'" <?php }elseif( $info->purchases_status > 2){ ?>  class="box-main-step" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=3&pr=0'" <?php } ?>>
                                        <div class="icon-num-step">
                                            <div <?php if($info->purchases_status < 2 ){ ?> class="num-step-cus-off"  <?php }elseif($info->purchases_status == 2){ ?> class="num-step-cus" <?php }elseif( $info->purchases_status > 2){ ?> class="num-step-cus" <?php } ?>>
                                                3
                                            </div>
                                        </div>
                                        <div <?php if($info->purchases_status < 2 ){ ?> class="content-step-off"  <?php }elseif($info->purchases_status == 2){ ?> class="content-step" <?php }elseif( $info->purchases_status > 2){ ?> class="content-step" <?php } ?> >
                                            รายงานผลการพิจารณา/สั่งซื้อสั่งจ้าง
                                        </div>

                                        <?php if($info->purchases_status < 2 ){ ?> 
                                        <?php }elseif($info->purchases_status == 2){ ?> 
                                        <?php }elseif( $info->purchases_status > 2){ ?> 
                                            <div class="icon-check-step">
                                                <i class="fas fa-check icon-check-step-cus"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>

                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 col-sm-12">
                                    <div <?php if($info->purchases_status < 3 ){ ?> class="box-main-step-off"  <?php }elseif($info->purchases_status == 3){ ?> class="box-main-step-on" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=4&pr=0'" <?php }elseif( $info->purchases_status > 3){ ?>  class="box-main-step" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=4&pr=0'" <?php } ?>>
                                        <div class="icon-num-step">
                                            <div <?php if($info->purchases_status < 3 ){ ?> class="num-step-cus-off"  <?php }elseif($info->purchases_status == 3){ ?> class="num-step-cus" <?php }elseif( $info->purchases_status > 3){ ?> class="num-step-cus" <?php } ?>>
                                                4
                                            </div>
                                        </div>
                                        <div <?php if($info->purchases_status < 3 ){ ?> class="content-step-off"  <?php }elseif($info->purchases_status == 3){ ?> class="content-step" <?php }elseif( $info->purchases_status > 3){ ?> class="content-step" <?php } ?>>
                                            สัญญา/ใบสั่งซื้อสั่งจ้าง
                                        </div>

                                        <?php if($info->purchases_status < 3 ){ ?> 
                                        <?php }elseif($info->purchases_status == 3){ ?>
                                        <?php }elseif( $info->purchases_status > 3){ ?> 
                                            <div class="icon-check-step">
                                                <i class="fas fa-check icon-check-step-cus"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>

                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 col-sm-12">
                                    <div <?php if($info->purchases_status < 4 ){ ?> class="box-main-step-off"  <?php }elseif($info->purchases_status == 4){ ?> class="box-main-step-on" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=5&pr=0'" <?php }elseif( $info->purchases_status > 4){ ?>  class="box-main-step" onclick="window.location.href='{{URL('office/purchase/edit')}}/{{$id}}?t=5&pr=0'" <?php } ?> >
                                        <div class="icon-num-step">
                                            <div <?php if($info->purchases_status < 4 ){ ?> class="num-step-cus-off"  <?php }elseif($info->purchases_status == 4){ ?> class="num-step-cus" <?php }elseif( $info->purchases_status > 4){ ?> class="num-step-cus" <?php } ?> >
                                                5
                                            </div>
                                        </div>
                                        <div <?php if($info->purchases_status < 4 ){ ?> class="content-step-off"  <?php }elseif($info->purchases_status == 4){ ?> class="content-step" <?php }elseif( $info->purchases_status > 4){ ?> class="content-step" <?php } ?> >
                                            ตรวจรับงาน/เบิกจ่าย
                                        </div>

                                        <?php if($info->purchases_status < 4 ){ ?> 
                                        <?php }elseif($info->purchases_status == 4){ ?> 
                                        <?php }elseif( $info->purchases_status > 4){ ?> 
                                            <div class="icon-check-step">
                                                <i class="fas fa-check icon-check-step-cus"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>

                            </div>

                        </div>

                    </div>
                </div> <!-- end col -->
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
                            <label for="lastname">เรื่อง </label>
                            <input type="text" class="form-control" name="input[purchases_status_name]" id="input-purchases_status_name" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="lastname">รายละเอียด </label>
                            <textarea  name="input[purchases_status_message]" id="input-purchases_status_message" class="form-control"></textarea>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lastname">จำนวนเงิน </label>
                            <input type="text" class="form-control" name="input[purchases_status_pay]" id="input-purchases_status_pay" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                $("#frm-save #input-purchases_status_name").val('');
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_pay").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        }else{
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_name").val(res.info.purchases_status_name);
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_pay").val(res.info.purchases_status_pay);
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
                $("#frm-save #input-purchases_status_name").val('');
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_pay").val('');
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
                $("#frm-save #input-purchases_status_name").val(res.info.purchases_status_name);
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_pay").val(res.info.purchases_status_pay);
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
