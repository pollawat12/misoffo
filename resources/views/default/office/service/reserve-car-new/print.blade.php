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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบจองรถยนต์ส่วนกลาง</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายการจองรถ</a></li>
                            <li class="breadcrumb-item active">ใบขออนุญาตใช้รถ</li>
                        </ol>
                    </div> 
                    <h4 class="page-title">ใบขออนุญาตใช้รถส่วนกลาง</h4> 
                </div>
            </div> 
        </div>
        <!-- end page title -->

        <?php foreach ($items as $item); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">

                            <h4 class="font-16 mb-3 text-center">ใบขออนุญาตใช้รถส่วนกลาง</h4>
                            <h4 class="font-16 mb-3 text-center">ทะเบียน</h4>
                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">เรียนผู้อำนวยการกองทุนน้ำมันเชื้อเพลิง
                                    </h6>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2">ชื่อ-นามสกุล
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float">{{$item->owner_name}}</p>
                                           
                                        </span>
                                    </h6>
                                </div>

                                <div class="col-auto">
                                    <h6 class="font-16 mb-2">กลุ่มงาน
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float">{{$item->owner_name}}</p>
                                        </span>
                                    </h6>
                                </div>


                                <div class="col-auto">
                                    <h6 class="font-16 mb-2">สำนัก
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-16  mb-2 mr-2">ขออนุญาตใช้รถยนต์ส่วนกลาง โดยมีรายละเอียดดังนี้
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row">
                                <h6 class="font-16  mb-2 mr-2">วัตถุประสงค์
                                    <span class="ml-2 position-relative">
                                        ..................................................................................
                                        <p class="text-float"></p>
                                    </span>
                                </h6>
                                <h6 class="font-16  mb-2">สถานที่/จุดหมาย
                                    <span class="ml-2  position-relative">
                                        ..................................................................................................................................................................
                                        <p class="text-float">{{$item->detail}}</p>
                                    </span>
                                </h6>
                            </div>


                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">ลักษณะการใช้รถ
                                        <span class="text-ml-2 position-relative">
                                            .....................................................
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-16  mb-2 mr-2">วันที่เริ่มต้น
                                        <span class="text-ml-2 position-relative">
                                            .........................................................
                                           
                                        </span>
                                    </h6>
                                </div>

                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">เวลาเริ่ม
                                        <span class="text-ml-2 position-relative">
                                            .........................................
                                            
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">วันที่เสร็จสิ้น
                                        <span class="text-ml-2 position-relative">
                                            .........................................................
                                           
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">เวลาเสร็จสิ้น
                                        <span class="text-ml-2 position-relative">
                                            .........................................
                                            
                                        </span>
                                    </h6>
                                </div> 
                            </div>



                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">จำนวนคนนั่ง
                                        <span class="text-ml-2 position-relative">
                                            ........................................
                                            
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-16 mb-2 mr-2">รายชื่อ ได้แก่
                                        <span class="text-ml-2 position-relative">
                                            ...................................................................................................................................................................................................................
                                        
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="p-4">
                                <h4 class="font-16 mb-3 text-center">บันทึกการใช้รถยนต์ส่วนกลาง</h4>
                            </div>
                            <div class="from-row">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color custom-table">เวลาไป</th>
                                            <th class="text-color-td table-border-color custom-table">เลขไมล์เมื่อออกเดินทาง</th>
                                            <th class="text-color-td table-border-color custom-table">เวลากลับ</th>
                                            <th class="text-color-td table-border-color custom-table">เลขไมล์เมื่อกลับถึงสำนักงาน</th>
                                            <th class="text-color-td table-border-color custom-table">รวมระยะทาง</th>
                                            <th class="text-color-td table-border-color custom-table">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tbody>
                                              <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>  
                                        </tbody>
                                </table>

                            </div>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-14 mt-5 mr-2">ลงชื่อ
                                        <span class="text-ml-2 position-relative">
                                            ........................................................................................
                                        </span>
                                        <span class="text-ml-2 position-relative">
                                            พนักงานขับรถ
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2">
                                        <span class="text-ml-2 position-relative">
                                        (....................................................................................)
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                  
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>
<div></div>



        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
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
                    required: "กรุณากรอกฝ่ายงาน"
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
</script>
@endsection
