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
        <form action="{{url('office/budget/expenses/project/update')}}" method="POST" name="frm-save" id="frm-save">

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล โครงการ</i> </h4>

                   
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="project_name">ชื่อโครงการ <code>*</code></label>
                                    <input type="text" name="input[project_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->project_name}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่เริ่มต้น โครงการ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_start]" value="{{getDateFormatToInputThai($info->date_start)}}">
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
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_end]" value="{{getDateFormatToInputThai($info->date_end)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($year))
                                        @foreach ($year as $valyear)
                                        <option value="{{$valyear['id']}}" @if($valyear['id'] == $info->in_year) selected @endif>{{$valyear['year_name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <?php $budgetCategroys = \App\Models\BudgetYearDetail::selectRaw('count(*) AS cnt, statementtype_id')->where('budget_year_id',$info->in_year)->groupBy('statementtype_id')->get(); ?>
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                    <select name="input[budget_categroy]" id="budget_categroy" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($budgetCategroys))
                                        @foreach ($budgetCategroys as $budgetCategroy)
                                        <?php $dataCategroys = \App\Models\DataSetting::getNameDataByValueAndType($budgetCategroy['statementtype_id'],'statementtype'); ?>
                                            <option value="{{$budgetCategroy['statementtype_id']}}"  @if($budgetCategroy['statementtype_id'] == $info->budget_categroy) selected @endif>{{$dataCategroys}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <?php $budgetTypes = \App\Models\BudgetYearDetail::selectRaw('count(*) AS cnt, budget_id')->where('budget_year_id',$info->in_year)->where('statementtype_id',$info->budget_categroy)->groupBy('budget_id')->get(); ?>
                                <div class="form-group">
                                    <label for="budget_type">ประเภทค่าใช้จ่าย <code>*</code></label>
                                    <select name="input[budget_type]" id="budget_type" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($budgetTypes))
                                        @foreach ($budgetTypes as $budgetType)
                                        <?php $dataTypes = \App\Models\DataSetting::getNameDataByValueAndType($budgetType['budget_id'],'budget'); ?>
                                            <option value="{{$budgetType['budget_id']}}"  @if($budgetType['budget_id'] == $info->budget_type) selected @endif>{{$dataTypes}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label>
                                    <input type="text" name="input[budget_amount]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->budget_amount}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">ลักษณะโครงการ <code>*</code></label>
                                    <textarea name="input[description]" class="form-control">{{$info->description}}</textarea>
                                    <small id="description" class="form-text text-muted"></small>
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

    $(document).on("change", "#year_id", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/getNew/info/?t=statementtype&id=" + _itemValue + '&parentId=0';

        $("#budget_type").html('<option value="">--เลือก--</option>');

        $("#budget_categroy").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_categroy").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#budget_categroy", function(){
        var _itemValue = $(this).val();
        var _id = $("#year_id").val();
        var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/getNew/info/?t=budget&id=" + _itemValue + '&parentId=' + _id;

        $("#budget_type").html('<option value="">--เลือก--</option>');
        $.get(_url, function(data){
            $("#budget_type").html(data.elem_html);
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
