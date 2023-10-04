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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > โครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">โครงการ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{url('office/budget/expenses/project/save')}}" method="POST" name="frm-save" id="frm-save">

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล โครงการ</i> </h4>

                   
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="project_name">ชื่อโครงการ <code>*</code></label>
                                    <input type="text" name="input[project_name]" class="form-control" placeholder="" style="height: 45px;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่เริ่มต้น โครงการ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่สิ้นสุด โครงการ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_end]" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label>
                                    <input type="text" name="input[budget_amount]" class="form-control" placeholder="" style="height: 45px;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($year) > 0)
                                        @foreach($year as $valyear)
                                        <option value="{{$valyear['year_id']}}">{{$valyear['year_name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year_id">หน่วยงาน <code>*</code></label>
                                    <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                    <select name="input[budget_categroy]" id="budget_categroy" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="budget_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                    <select name="input[budget_type]" id="budget_type" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                    </select>
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">ลักษณะโครงการ</label>
                                    <textarea name="input[description]" class="form-control"></textarea>
                                    <small id="description" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="objective">วัตถุประสงค์ของโครงการ </label>
                                    <textarea name="input[objective]" class="form-control"></textarea>
                                    <small id="objective" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="target">เป้าหมายโครงการ </label>
                                    <textarea name="input[target]" class="form-control"></textarea>
                                    <small id="target" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="split">การแบ่งงวดงาน </label>
                                    <textarea name="input[split]" class="form-control"></textarea>
                                    <small id="split" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="project_file">แนบ เอกสาร </label>
                                    <input type="file" name="project_file" class="filestyle" placeholder="" style="height: 45px;">
                                    <small id="project_file" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-database-plus"> บันทึก</i>
                            </button>
                            <a href="{{URL('office/budget/expenses/project')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                "> ยกเลิก</i></a>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        </form>
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/project')}}"></div>

        <div data-url="{{URL('/')}}" id="base-url-api"></div>
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

    $(document).on("change", "#institution_id", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/get/info/?t=statementtypeNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_categroy", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/get/info/?t=budgetNew&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');
        $("#projects_id").html('<option value="">--เลือก--</option><option value="0">สำนักงาน</option>');
        $.get(_url, function(data){
            $("#budget_type").html(data.elem_html);
        }, "json");
    });

    $(document).on('change', '#year_id', function(params) {
        let values = $(this).val();

        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/get/info/?t=yearNew&id=" + values + '&parentId=0';

        $("#institution_id").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#institution_id").html(data.elem_html);
        }, "json");
        
        
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
                    required: "กรุณากรอกปีงบประมาณ"
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
