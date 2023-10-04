@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">เข้าสู่ระบบ</a></li>
                            <li class="breadcrumb-item active">ลงเวลาเข้าออก - งาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ลงเวลาเข้าออก - งาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <!-- <div class="card-box" style="height: 850px;"> -->
    
                    <!-- <div class="row">   
                        <div class="col-lg-12">
                            <div class="text-center"> -->

                                <div style="width: 65%; height: 90%; background-color: #fff; border-radius: 1em; box-shadow: 0 0 2em rgba(0, 0, 0, .2); padding: 2em 1em; display: flex; align-items: center; flex-direction: column; margin: 0 2em;">

                                    <div style="width: 10em; height: 10em; border-radius: 50%; border: 5px solid #9176FF; padding: 3px; margin-bottom: 2em;">
                                        <!-- <img src="{{$defaultAvatar}}" alt="" class="avatar-custom rounded-circle mb-2 mt-2"> -->
                                        <img src="{{$defaultAvatar}}" alt="" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;"/>
                                    </div>

                                    <!-- <div style="display: flex; align-items: center; flex-direction: column;">
                                        <span style="font-size: 1.5rem; font-weight: 500; position: relative; top: .2em;">Web Designer</span>
                                        <span style="color: #9176FF;">Vanessa Martinez</span>
                                        <p style="text-align: center; font-size: 1.1rem; margin: 1em 0;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit veritatis labore provident non tempora odio est sunt, ipsum</p>
                                        <button style="background-color: #9176FF; color: #fff; font-size: 1rem; text-transform: uppercase; font-weight: 600; border: none; padding: .5em; border-radius: .5em; margin-top: .5em; cursor: pointer;">View More</button>
                                    </div> -->
                                    <div class="media-body">
                                        <h4 class="mt-1 mb-1 font-18 ellipsis">คุณ {{ $authInfo['user_name'] }}</h4>
                                            {{-- <p class="font-16"> พนักงานทั่วไป</p> --}}
                                        <div class="row mt-3">
                                            <div class="col-3"></div>
                                            <div class="col-6">
                                                <hr class="hr-custom">
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="mt-1 mb-4 font-16 ellipsis">{{ $today }}</h4>
                                            <div class="mb-4">
                                                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="mb-4 font-16 ellipsis time-status">สถานะ : <span id="status_check_type">{!! $checkType !!}</span></h4>
                                        </div>   
                                    </div>
                                    
                                    <div class="col-lg-12">
                                    <div class="row mt-5">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="mt-5">
        
                                                @if ($btnCheckInStatus)
                                                <form action="{{ URL('office/time-attendance/check-in-time') }}" id="frm-save" method="post">
                                                    <input type="hidden" name="check_in_type" id="check_in_type" value="{{ $statusCheckType }}">
                                                    <input type="hidden" name="latitude" id="latitude" value="{{ $lat }}">
                                                    <input type="hidden" name="longitude" id="longitude" value="{{ $lng }}">
                                                    <input type="hidden" name="distance_number" value="{{ $distance_number }}">
                                                    <input type="hidden" name="check_time_type" value="{{ $check_time_type }}">
                
                                                    <div class="form-group">
                                                        <textarea name="note" id="note" class="form-control" cols="30" rows="5" placeholder="หมายเหตุเพิ่มเติม"></textarea>
                                                    </div>
        
                                                    <button type="submit" class="btn btn-stamp waves-effect width-md waves-light btn-submit" style="margin-top: 65px;">บันทึกเวลา</button>
                                                </form>    
                                                @endif     
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-12" style="flex-direction: row;">
                                        <input type="checkbox" id="change_check_in_out" @if($statusCheckType=='in') checked @endif value="check_in" data-toggle="toggle" data-on="Check In" data-off="Check Out" data-onstyle="dark" data-offstyle="warning">
                                        {{-- <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="change_check_in_out">
                                        <label class="form-check-label" for="change_check_in_out">เปลี่ยนสถานะการลงเวลางาน <span id="label_change_check_type">(Check in)</span></label>
                                    </div> --}}
                                    {{-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="{{$statusCheckType}}" name="change_check_in_out" id="change_check_in_out">
                                        <label class="form-check-label" for="change_check_in_out">
                                            เปลี่ยนสถานะการลงเวลางาน <span id="label_change_check_type">(Check in)</span>
                                        </label>
                                    </div> --}}
                                            @if (!$btnCheckInStatus)
                                                <button type="button" class="btn btn-stamp waves-effect width-md waves-light" disabled>บันทึกเวลา</button>
                                            @endif
                                    </div>

                                </div>

                            <!-- </div>
                        </div>
                    </div> -->

                <!-- </div> -->
            </div>
        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<div id="url-redirect-back" data-url="{{ URL('office/time-attendance/worktime') }}"></div>
@endsection


@section('js')
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeWzE8MAUvcONoA1lR0X6HiSrbkCudRbY&callback=initMap&libraries=&v=weekly&channel=2" async></script> --}}
<script src="{{URL('assets/js/location.js')}}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>//change_check_in_out
    $(function () {
        getLocation();

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
            rules: {},
            messages: {},
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

        $("#change_check_in_out").change(function (e) { 
            e.preventDefault();
            if( $(this).is(':checked') ){
                $("#check_in_type").html('in');
                $("#check_in_type").val('in');
                $("#status_check_type").html('<span class="check-in">Check In</span>');
                console.log("Checkbox Is checked");
            }
            else {
                $("#check_in_type").html('out');
                $("#check_in_type").val('out');
                $("#status_check_type").html('<span class="check-out">Check Out</span>');
                console.log("Checkbox Is not checked");
            }
        });
    });


    function showTime() {
        var date = new Date();
        var h = date.getHours(); // ชั่วโมง 0 - 23
        var m = date.getMinutes(); // นาที 0 - 59
        var s = date.getSeconds(); // วินาที 0 - 59

        h = (h < 10) ? "0" + h : h; //น้อยกว่า 10 ใส่ 0
        m = (m < 10) ? "0" + m : m; //น้อยกว่า 10 ใส่ 0
        s = (s < 10) ? "0" + s : s; //น้อยกว่า 10 ใส่ 0
        var time = h + ":" + m + ":" + s + " " + "น.";
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;
        setTimeout(showTime, 1000);
    }
    showTime();
</script>
@endsection





