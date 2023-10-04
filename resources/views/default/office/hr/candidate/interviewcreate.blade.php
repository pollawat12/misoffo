@extends('default.layouts.load')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
@endsection

@section('content')
<form action="{{url('office/hr/candidate/interviewsave')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
<input type="hidden" name="action" value="add">
<input type="hidden" name="edit_id" value="0">
<input type="hidden" name="sort_order" value="0">
<input type="hidden" name="input[job_id]" value="{{$jobid}}">
<input type="hidden" name="input[users_id]" value="{{$id}}">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">รายละเอียดการนัดสัมภาษณ์</h4>
    </div>
    <div class="modal-body">
        <h6 class="header-title mb-1 font-size-16">ตำแหน่ง</h6>
        <hr class="hr-form-all">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">ชื่อผู้สมัคร
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputEmail4" name="input[job_name]" placeholder="" value="{{$items->firstname}} {{$items->lastname}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">วันที่นัดสัมภาษณ์ </label>
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="input[checkin_date]" style="height: 45px;">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div><!-- input-group -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">สถานะ
                        <span class="text-danger">*</span></label>
                        <select name="input[is_checkin]" class="form-control" style="height: 45px;">
                            <option value="1">นัดสัมภาษณ์</option>
                            <option value="2">ยกเลิกสัมภาษณ์</option>
                        </select>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect"
            data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">บันทึก</button>
    </div>
</form>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

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


    $(function() {

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
                'input[job_name]': {
                    required: true
                }
            },
            messages: {
                'input[job_name]': {
                    required: "กรุณากรอก"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>

@endsection