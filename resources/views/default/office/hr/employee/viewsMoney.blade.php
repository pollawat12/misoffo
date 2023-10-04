@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ค่าตอบแทน</a></li>
                            <li class="breadcrumb-item active">ใบแจ้งเงินเดือน/ค่าจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ใบแจ้งเงินเดือน/ค่าจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4 position-relative">

                            <div class="btn-print">
                                <a href="{{url('office/hr/employees/print')}}/{{$usersid}}/{{$id}}/?t=money" target="_blank">
                                    <img src="{{url('assets/default')}}/images/icons/print.svg" alt="" class="icon-colored print-icon">
                                </a>
                            </div>

                            <div class="title-aad-name">
                                <h4 class="font-18 mb-3">สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)</h4>
                                <div class="btn btn-warning font-pay">
                                    ใบแจ้งเงินเดือน/ค่าจ้าง
                                    <div class="font-size-12">โปรดตรวจสอบและเก็บไว้เป็นหลักฐาน</div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">รหัสพนักงาน (EMP.No.) <span
                                            class="ml-3 font-14"> </span></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">ชื่อ (NAME) <span
                                            class="ml-3 font-14">{{$employees->firstname}}  {{$employees->lastname}}</span></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">ตำแหน่ง (POSITION) <span
                                            class="ml-3 font-14"> <?php if($dutyDetail){ foreach($dutyDetail as $dutyDetails);  echo $dutyDetails['position']; }?></span></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">สังกัด (DEPT.) <span
                                            class="ml-3 font-14"></span></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">ประจำงวด (FOR PERIOD) <span
                                            class="ml-3 font-14"> {{date('m');}}/<?php echo $date = date('Y') + 543;?></span></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="font-title-pay mb-2">วันที่จ่าย (Payroll Date) <span
                                            class="ml-3 font-14"> {{getDateTimeTH(date('Y-m-d') , false)}}</span></div>
                                </div>
                            </div>
                            <!-- <h4 class="font-16 mb-3 text-center">ใบแจ้งเงินเดือน/ค่าจ้าง</h4>
                            <h4 class="font-16 mb-3 text-center">ตำแหน่ง
                                ............................................</h4>
                            <h4 class="font-16 mb-3 text-center">วัน
                                ............................................
                                เวลา
                                ............................................ -->

                            <div class="table-responsive mt-2 mb-2">

                                <table class="table mb-0">
                                    <thead>
                                        <tr class="">
                                            <th style="width: 35%;"
                                                class="hl-color-tb border-tb border-l custom-table text-left">
                                                รายการรับ (INCOME)</th>
                                            <th style="width: 15%;"
                                                class="hl-color-tb border-tb custom-table text-right">
                                                บาท (Bath)</th>
                                            <th style="width: 30%;"
                                                class="border-tb border-l custom-table hl-color-tb text-left">
                                                รายการหัก (DEDUCTION)</th>
                                            <th style="width: 20%;"
                                                class="hl-color-tb border-tb border-r custom-table text-right">
                                                บาท (Bath)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-l border-none-tb text-left">เงินเดือน (Salary)
                                            </td>
                                            <td class="border-r border-none-tb text-right">{{number_format($evaluations->salary_sum,2,'.',',')}}</td>
                                            <td class="border-l border-none-tb text-left">ภาษี (Tax)</td>
                                            <td class="border-r border-none-tb text-right">-</td>
                                        </tr>
                                        <tr>
                                            <td class="border-l border-none-tb text-left">ค่าล่วงเวลา (Over
                                                Time)</td>
                                            <td class="border-r border-none-tb text-right">0</td>
                                            <td class="border-l border-none-tb text-left">เงินสะสมเข้ากองทุน
                                                PVD 3%</td>
                                            <td class="border-r border-none-tb text-right">750</td>
                                        </tr>
                                        <tr>
                                            <td class="border-l border-none-tb text-left">ค่าครองชีพ</td>
                                            <td class="border-r border-none-tb text-right"></td>
                                            <td class="border-l border-none-tb text-left">
                                                สินเชื่อธนาคารออมสิน</td>
                                            <td class="border-r border-none-tb text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="border-l border-none-tb text-left">รายได้อื่น (Other
                                                Income)</td>
                                            <td class="border-r border-none-tb text-rigdt">-</td>
                                            <td class="border-l border-none-tb text-left">หักอื่นๆ (Other
                                                Deduction)</td>
                                            <td class="border-r border-none-tb text-right">-</td>
                                        </tr>
                                        <tr>
                                            <td class="border-l border-none-tb text-left"></td>
                                            <td class="border-r border-none-tb text-right"></td>
                                            <td class="border-l border-none-tb text-left"></td>
                                            <td class="border-r border-none-tb text-right"></td>
                                        </tr>
                                        <tr>
                                            <td class="border-l border-tb text-left table-bgcolor-body">
                                                รวมรายได้ (TOTAL INCOME)</td>
                                            <td class="border-r border-tb table-bgcolor-body text-right">
                                                {{number_format($evaluations->salary_sum,2,'.',',')}}</td>
                                            <td class="border-l border-tb text-left table-bgcolor-body">
                                                รวมรายการหัก (TOTAL DEDUCTION)</td>
                                            <td class="border-r border-tb text-right table-bgcolor-body">
                                                750</td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="border-l border-none-t border-bottom border-double-bottom table-bgcolor text-left">
                                                รายได้สุทธิ (NET INCOME)</td>
                                            <td
                                                class="border-none-t border-bottom border-double-bottom table-bgcolor text-center" colspan="2">
                                                {{number_format($evaluations->salary_sum - 750,2,'.',',')}} บาท (Batd)</th>
                                            <td
                                                class="border-r border-none-t border-bottom border-double-bottom table-bgcolor text-right">
                                                สองหมื่นสี่พันสองร้อยห้าสิบบาทถ้วน</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

        </div> <!-- end row -->

    </div>
</div>

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

<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>

<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>

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
    
    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'boss'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(values == 'add'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else{

        }
    });

    $('#button_action').click(function(){ 

        function callBackFuncInsert(data) {
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
                'input[user_id]': {
                    required: true
                }
            },
            messages: {
                'input[user_id]': {
                    required: "กรุณาเลือกเจ้าหน้า"
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

                ajaxSubmitForm("frm-save", "json", callBackFuncInsert);
                return false;
            }
        });
    });
</script>
@endsection
