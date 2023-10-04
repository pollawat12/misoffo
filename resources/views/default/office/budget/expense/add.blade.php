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
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่ายโครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่ายโครงการ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ค่าใช้จ่ายโครงการ</i> </h4>

                    <form action="{{url('office/budget/expenses/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <input type="hidden" name="input[projects_id]" value="{{$id}}">
                        <?php foreach($detail as $keydetail => $valDetail);?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">แผนงาน/โครงการ : {{$valDetail['project_name']}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($Year))
                                        @foreach ($Year as $YearRow)
                                            <option value="{{$YearRow['id']}}">{{$YearRow['in_year']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">วันที่รายงาน </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[date_report]" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="page_number">เลขเอกสาร <code>*</code></label>
                                    <input type="text" name="input[page_number]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="page_number" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="petition_number">เลขฏีกา </label>
                                    <input type="text" name="input[petition_number]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="petition_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cut_top_number">เลขที่ตัดยอด </label>
                                    <input type="text" name="input[cut_top_number]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="cut_top_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="expense_item">รายการรายจ่าย </label>
                                    <textarea name="input[expense_item]" class="form-control"></textarea>
                                    <small id="expense_item" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php $budgetCategroys = \App\Models\DataSetting::where('group_type','statementtype')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="budget_categroy">ประเภทงบ <code>*</code></label>
                                    <select name="input[budget_categroy]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($budgetCategroys))
                                        @foreach ($budgetCategroys as $budgetCategroy)
                                            <option value="{{$budgetCategroy['id']}}">{{$budgetCategroy['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_type">ประเภทรายจ่าย <code>*</code></label>
                                    <select name="input[cost_type] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="1">ตั้งเบิก</option>
                                        <option value="2">คืนเงิน</option>
                                    </select>
                                    <small id="cost_type" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_amount">จำนวน </label>
                                    <input type="text" name="input[cost_amount]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="cost_amount" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php $institutions = \App\Models\DataSetting::where('group_type','institution')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="institution">หน่วยงานที่รับผิดชอบ </label>
                                    <select name="input[institution]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($institutions))
                                        @foreach ($institutions as $institution)
                                            <option value="{{$institution['id']}}">{{$institution['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php $costCategroys = \App\Models\DataSetting::where('group_type','categorybudget')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                <div class="form-group">
                                    <label for="cost_categroy">ประเภท </label>
                                    <select name="input[cost_categroy]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($costCategroys))
                                        @foreach ($costCategroys as $costCategroy)
                                            <option value="{{$costCategroy['id']}}">{{$costCategroy['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_approved">สถานะอนุมัติ <code>*</code></label>
                                    <select name="input[status_approved] " class="form-control"] style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        <option value="0">ยังไม่ยันยืน</option>
                                        <option value="1">ยันยืน</option>
                                    </select>
                                    <small id="status_approved" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/budget/expenses/show')}}/{{$id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/detail')}}"></div>
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
                    window.location.href = urlRedirect + '/' + data.id + '/{{$id}}';
                }, 2300);
                
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[date_report]': {
                    required: true
                },
                'input[page_number]': {
                    required: true
                },
                'input[budget_categroy]': {
                    required: true
                },
                'input[cost_type]': {
                    required: true
                }
            },
            messages: {
                'input[date_report]': {
                    required: "กรุณาเลือกวันที่รายงาน"
                },
                'input[page_number]': {
                    required: "กรุณาเลือกเลขเอกสาร"
                },
                'input[budget_categroy]': {
                    required: "กรุณาเลือกประเภทงบ"
                },
                'input[cost_type]': {
                    required: "กรุณาเลือกประเภทรายจ่าย"
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
