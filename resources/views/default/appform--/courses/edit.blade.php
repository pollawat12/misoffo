@extends('default.template')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">การฝึกอบรม</a></li>
                            <li class="breadcrumb-item active">ข้อมูลการฝึกอบรม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง แก้ไขการฝึกอบรม</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขการฝึกอบรม</i> </h4>

                    <form action="{{url('office/hr/course/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">ชื่อหลักสูตรการฝึกอบรม <code>*</code></label>
                                        <input type="text" class="form-control" name="input[name]" placeholder="" value="{{$info->name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="place">สถานที่จัดฝึกอบรม</label>
                                        <textarea  name="input[place]" class="form-control">{{$info->place}}</textarea>
                                        <small id="place" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categroy_courses_id">ประเภทการฝึกอบรม <code>*</code></label>
                                        <select name="input[categroy_courses_id]" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($course) > 0)
                                            @foreach($course as $key => $val)
                                            <option value="{{$val->id}}" @if($val->id == $info->categroy_courses_id) selected @endif>{{$val->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="categroy_courses_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="person_amount">จำนวนผู้เข้าร่วมฝึกอบรม </label>
                                        <input type="text" class="form-control" name="input[person_amount]" placeholder="" value="{{$info->person_amount}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่เริ่มฝึกอบรม </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_start]" value="{{getDateFormatToInputThai($info->date_start)}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่สิ้นสุด </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[date_end]" value="{{getDateFormatToInputThai($info->date_end)}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time_start">เวลาที่เริ่ม</label>
                                        <input type="text" class="form-control" name="input[time_start]" placeholder="" value="{{$info->time_start}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time_end">เวลาที่สิ้นสุด</label>
                                        <input type="text" class="form-control" name="input[time_end]" placeholder="" value="{{$info->time_end}}">
                                    </div>
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="budget_year">ปีงบประมาณ</label>
                                        <input type="text" class="form-control" name="input[budget_year]" placeholder="" value="{{$info->budget_year}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">งบประมาณ</label>
                                        <input type="text" class="form-control" name="input[price]" placeholder="" value="{{$info->price}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lecturer_name">ผู้บรรยาย</label>
                                        <input type="text" class="form-control" name="input[lecturer_name]" placeholder="" value="{{$info->lecturer_name}}">
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">คะแนนรวมการประเมิน <code>*</code></label>
                                        <input type="text" class="form-control" name="input[score_sum]" placeholder="" value="{{$info->score_sum}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">ค่าเฉลี่ย (คะแนนการประเมิน) <code>*</code></label>
                                        <input type="text" class="form-control" name="input[score_grade]" placeholder="" value="{{$info->score_grade}}">
                                    </div>
                                </div>
                            </div>
                                    

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/hr/course')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/hr/course')}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

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
                },
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกชื่อคอร์ส"
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
