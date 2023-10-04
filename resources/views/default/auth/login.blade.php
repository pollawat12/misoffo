@extends('default.layouts.auth')


@section('css')
<link href="{{ url('assets/js/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">

                    <div class="card-body p-4">

                        <div class="account-box">
                            <div class="account-logo-box">
                                <div class="text-center">
                                    <a href="javascript:void(0);">
                                        <img src="{{ url('assets') }}/img/offo-new-logo_0.png" alt="" style="width: 100%">
                                    </a>
                                </div>
                                <h5 class="text-uppercase mb-1 mt-4">เข้าใช้งานระบบ</h5>
                                <p class="mb-0">ระบบสารสนเทศที่สนับสนุนการบริหารจัดการสำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)</p>
                            </div>

                            <div class="account-content mt-4">
                                <form class="form-horizontal" action="{{ url('auth/verify_login') }}" method="POST" id="frm-login" name="frm-login">
                                    

                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="emailaddress">ชื่อผู้ใช้งาน / Username</label>
                                            <input class="form-control" name="username" type="text" id="username" 
                                                placeholder="ชื่อผู้ใช้งาน / Username">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <a href="{{ url('/auth/forget-pw') }}" class="text-muted float-right"><small>ลืมรหัสผ่าน ?</small></a>
                                            <label for="password">รหัสผ่าน / Password</label>
                                            <input class="form-control" type="password"  id="password" name="password"
                                                placeholder="รหัสผ่าน / Password">
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wordin">สถานปฏิบัติงาน <code>*</code></label>
                                                <select name="wordin" id="wordin" class="form-control" style="height: 45px;">
                                                    <option value="1">สำนักงาน</option>
                                                    <option value="2">Work For Home</option>
                                                    <option value="3">นอกสถานที่</option>
                                                </select>
                                                <small id="year_id_n" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row text-center mt-2">
                                        <div class="col-12">
                                            <button class="btn btn-md btn-block btn-secondary waves-effect width-lg btn-submit" type="submit"><i class="fas fa-key"></i> เข้าใช้งานระบบ</button>
                                        </div>
                                    </div>

                                </form>
                                


                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<div id="url-redirect-back" data-url="{{ url('dashboard') }}"></div>

@endsection

@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- App js -->
<script src="{{url('assets/default')}}/js/app.min.js"></script>

<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>


<script src="{{URL('assets/js/script.js')}}"></script>

<script>

    $(function () {

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

        $('#frm-login').validate({
            rules: {
                'username': {
                    required: true
                },
                'password': {
                    required: true
                }
            },
            messages: {
                'username': {
                    required: "กรุณากรอกชื่อผู้ใช้งาน (username)"
                },
                'password': {
                    required: "กรุณากรอกรหัสผ่าน (password)"
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
                ajaxSubmitForm("frm-login", "json", callBackFunc);
                return false;
            }
        });
    });
</script>
@endsection
