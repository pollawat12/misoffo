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
                            <li class="breadcrumb-item active">บันทึกการใช้รถยนต์</li>
                        </ol>
                    </div> 
                    <h4 class="page-title">บันทึกการใช้รถยนต์</h4>  
                </div>
            </div> 
        </div>
        <!-- end page title -->

        <?php foreach ($items as $item); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL('office/service/reserve-car-new/print')}}"target="_blank">
                                <button type="button"
                                    class="btn btn-primary btn-soft-primary waves-effect waves-light float-end mb-3">
                                    <i class="fas fa-solid fa-print" style="font-size: 18px !important;"></i>
                                </button>
                            </a>
                        </div>
                    </div> --}}
                    <div class="media-body">
                        <div class="p-4">

                            <?php
                                $carType = \App\Models\DataSetting::where('group_type', 'car_num')->where('is_active','1')->get();

                                    if($carType){
                                        foreach ($carType as $car);      
                                    }
                             ?>
                                <h4 class="font-16 mb-3 text-center">บันทึกการใช้รถยนต์ ประจำเดือน....</h4>
                                <h2 class="font-16 mb-3 text-center">ยี่ห้อ Nissan หมายเลขทะเบียน {{$car->name}}</h2>

                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color custom-table">ลำดับ</th>
                                            <th class="text-color-td table-border-color custom-table " colspan = "2">ออกเดินทาง</th>
                                            <th class="text-color-td table-border-color custom-table">ผู้ขอใช้รถ</th>
                                            <th class="text-color-td table-border-color custom-table">สถานที่ไป</th>
                                            <th class="text-color-td table-border-color custom-table">ระยะ กม./ไมล์ จาก สนง.</th>
                                            <th class="text-color-td table-border-color custom-table" colspan = "2">กลับถึงสำนักงาน</th>
                                            <th class="text-color-td table-border-color custom-table">ระยะ กม./ไมล์ ถึง สนง.</th>
                                            <th class="text-color-td table-border-color custom-table">รวมระยะ กม./ไมล์</th>
                                            <th class="text-color-td table-border-color custom-table">พนักงานขับรถ</th>
                                            <th class="text-color-td table-border-color custom-table">หมายเหตุ</th>
                                        </tr>

                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table">วันที่</th>
                                            <th class="text-color-td table-border-color custom-table">เวลา</th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table">วันที่</th>
                                            <th class="text-color-td table-border-color custom-table">เวลา</th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                            <th class="text-color-td table-border-color custom-table"></th>
                                           
                                        </tr>
                                    </thead>


                                    <?php $no = 0;?>
                                    @if (!empty($items))
                                    @foreach ($items as $item)
                                    <?php $no++;?>
                                    <tbody>
                                        <tbody>

                                              <tr>
                                                <td class="text-color-td table-border-color custom-table">{{$no}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{date("d-m-Y", strtotime($item->date_start))}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->time_start}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->owner_name}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->detail}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->car_start}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{date("d-m-Y", strtotime($item->date_end))}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->time_end}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->car_end}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->car_end - $item->car_start}}</td>
                                                <td class="text-color-td table-border-color custom-table">{{$item->driver}}</td>
                                                <td class="text-color-td table-border-color custom-table"></td>
                                            </tr>  

                                        </tbody>
                                    @endforeach
                                    @endif
                                </table>
                    
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
