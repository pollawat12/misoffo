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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่ายงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่ายงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ค่าใช้จ่ายงบประมาณ</i> </h4>

                    <form action="{{url('office/budget/confirm/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}}">

                        <input type="hidden" name="input[projects_id]" value="0">
                        <input type="hidden" name="input[year_budgets_id]" value="{{$projectsId}}">
                        <input type="hidden" name="input[budget_type]" value="{{$t}}">
                        <?php foreach($detail as $keydetail => $valDetail);?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">ปีงบประมาณ : {{$valDetail->in_year}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_report">วันที่รายงาน <code>*</code></label>
                                    <input type="text" class="form-control datepicker-autoclose" placeholder="mm/dd/yyyy" name="input[date_report]" id="datepicker-autoclose22" readonly="" value="{{getDateFormatToInput($info->date_report)}}">
                                    <small id="date_report" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">จำนวน <code>*</code></label>
                                    <input type="text" name="input[amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->amount}}">
                                    <small id="amount" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ครั้งที่อนุมัติ <code>*</code></label>
                                    <textarea name="input[approved_time]" class="form-control" id="input-area_process" cols="30" rows="4">{{$info->approved_time}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ระยะเวลาโครงการ <code>*</code></label>
                                    <textarea name="input[duration]" class="form-control" id="input-area_process" cols="30" rows="4">{{$info->duration}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                    <select name="input[cost_type] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="1" @if(1 == $info->cost_type) selected @endif>เงินโอนไปส่วนภูมิภาค</option>
                                        <option value="2" @if(2 == $info->cost_type) selected @endif>เบิกจ่ายส่วนกลาง</option>
                                        <option value="3" @if(3 == $info->cost_type) selected @endif>คืนเข้า กพน.</option>
                                    </select>
                                    <small id="cost_type" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_approved">สถานะอนุมัติ <code>*</code></label>
                                    <select name="input[status_approved] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="0" @if(0 == $info->status_approved) selected @endif>อยู่ระหว่างดำเนินการ</option>
                                        <option value="1" @if(1 == $info->status_approved) selected @endif>รออนุมัติ</option>
                                        <option value="2" @if(2 == $info->status_approved) selected @endif>อนุมัติ</option>
                                    </select>
                                    <small id="status_approved" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">หมายเหตุ <code>*</code></label>
                                    <textarea name="input[comment]" class="form-control" id="input-area_process" cols="30" rows="4">{{$info->comment}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file_name">แนบไฟล์เอกสาร <code>*</code></label>
                                    <input type="file" name="input[file_name]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="file_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/budget/confirm/show')}}/{{$projectsId}}/?t=1"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/confirm/show')}}/{{$projectsId}}/?t=1"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
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
                'input[projects_id]': {
                    required: true
                }
            },
            messages: {
                'input[projects_id]': {
                    required: "กรุณาเลือกโครงการ"
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
