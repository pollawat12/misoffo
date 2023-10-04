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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">สัมภาษณ์</a>
                            </li>
                            <li class="breadcrumb-item active">การให้คะแนนสัมภาษณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">การให้คะแนนสัมภาษณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box pb-2">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="header-title mb-2">
                                <i class="mdi mdi-file-document" style="font-size: 16px !important;">
                                    ข้อมูลผู้สมัคร</i>
                            </h4>
                            <hr class="hr-form-all" style="margin-top: -5px !important;">

                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">ชื่อผู้สมัคร :: <span
                                            class="ml-1">{{$users->firstname}} {{$users->lastname}}</span></h4>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">ตำแหน่งที่สมัคร :: <span
                                            class="ml-1">{{$jobs->job_name}}</span></h4>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">เบอร์โทร :: <span class="ml-1">{{$users->tel}}</span>
                                    </h4>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">จบจากสาขา :: <span class="ml-1">-</span>
                                    </h4>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">ประสบการณ์ทำงาน :: <span class="ml-1">สกนช.</span>
                                    </h4>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <h4 class="font-16 ml-3">เงินเดือน :: <span class="ml-1">-</span>
                                    </h4>
                                </div>

                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <?php
                        $UserDsN = \App\Models\UserInformation::where('users_id',$items['user_id'])->get();
                        foreach ($UserDsN as $UserDN);
                    ?>
                    <form action="{{url('office/hr/estimate/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="input[job_id]" value="{{$jobid}}">
                        <input type="hidden" name="input[users_id]" value="{{$userid}}">
                        <input type="hidden" name="input[work_id]" value="{{$workid}}">
                        <input type="hidden" name="input[director_id]" value="{{$id}}">

                        <div class="media-body">
                            <h6 class="header-title mb-1 font-size-16 mt-3">
                             การให้คะแนนสัมภาษณ์</h6>
                            <hr class="hr-form-all">

                            <div class="row">

                            
                                <div class="col-lg-5 mb-2">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ชื่อกรรมการผู้สัมภาษณ์
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" value="<?php echo $UserDN['firstname'].' '. $UserDN['lastname'];?>">
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ตำแหน่ง
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" value="<?php if($items->position_id == 1){ echo 'ประธานกรรมการ'; }else{ echo 'กรรมการ'; }?>">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">วัน <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="input[estimate_date]" style="height: 45px;" value="{{getDateFormatToInputThai(date('Y-m-d'))}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            บุคลิกภาพ (คะแนนเต็ม 20)
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">การแต่งกาย (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_1]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">การพูด/น้ำเสียง (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_2]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">กริยา ท่าทาง (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_3]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">อารมณ์ (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_4]">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-12">
                                    <fieldset class="fieldset-custom mb-3">
                                        <legend class="label-step">
                                            อื่นๆ (คะแนนเต็ม 30)
                                        </legend>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">ทัศนคติ (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_5]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">การตอบคำถาม (5) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_6]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">ความรู้เกี่ยวกับองค์กร (10) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_7]">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="inputEmail4"
                                                        class="col-form-label label-step">ความรู้ด้านวิชาชีพ (10) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="inputEmail4"
                                                        placeholder="" name="input[score_8]">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ความคิดเห็นเพิ่มเติม</label>
                                        <textarea name="input[comments_name]" id="" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- </div> -->

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <a href="job-list.html">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            บันทึก
                                        </button>
                                    </a>
                                    
                                    <a href="{{URL('office/hr/estimate')}}/{{$userid}}/{{$jobid}}/{{$workid}}"><button type="button" class="btn btn-secondary waves-effect waves-light">
                                        ยกเลิก
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->

        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/estimate')}}/{{$userid}}/{{$jobid}}/{{$workid}}"></div>

    </div>
</div>
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
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
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

<script>
    $(function() {

        $(document).on("change", "#category_id", function() {
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=category&id=" + _itemValue;

            $("#durable_number").html('<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;">');
            $.get(_url, function(data) {
                $("#typedata_id").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#typedata_id", function() {
            var _itemValue = $(this).val();

            var _institutionid = $("#institution_id").val();

            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=typedata&id=" + _itemValue + '&institutionid=' + _institutionid;

            $.get(_url, function(data) {
                $("#durable_number").html(data.elem_html);
            }, "json");
        });

        $(document).on("keyup", "#durable_price", function() {
            let _itemValue = $(this).val();

            let vat = ((_itemValue * 7) / 100).toFixed(2);

            let sum = (Number(_itemValue) + Number(vat)).toFixed(2);

            $("#durable_vat").val(vat);

            $("#durable_sum").val(sum);
        });




    });
</script>
@endsection