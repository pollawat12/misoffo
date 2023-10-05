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
                            <li class="breadcrumb-item active">{{$budgets->name}} > ปีงบประมาณ {{$Years->in_year}} > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ปีงบประมาณ {{$Years->in_year}} ({{$budgets->name}}) ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{url('office/budgets/institution/save')}}" method="POST" name="frm-save" id="frm-save">

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ตั้งงบประมาณ</i> </h4>

                   
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <input type="hidden" name="input[year_id]" value="{{$yearid}}">
                        <input type="hidden" name="input[budgets_id]" value="{{$budgetsid}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                    <select name="input[year_id_num]" id="year_id" class="form-control" style="height: 45px;" disabled>
                                        <option value="">--เลือก--</option>
                                        @if (count($info) > 0)
                                        @foreach($info as $keyinfo => $valinfo)
                                        <option value="{{$valinfo->id}}" <?php if($valinfo->id == $yearid){ echo 'selected';}?>>{{$valinfo->in_year}}</option>
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
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyinstitution => $valinstitution)
                                        <option value="{{$valinstitution->id}}">{{$valinstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label for="year_id">ประเภทงบ <code>*</code></label>
                                    <select name="input[budgets_id_num]" id="budgets_id_num" class="form-control" style="height: 45px;" disabled >
                                        <option value="">--เลือก--</option>
                                        @if (count($budget) > 0)
                                        @foreach($budget as $keybudget => $vabudget)
                                        <option value="{{$vabudget->id}}" <?php if($vabudget->id == $budgetsid){ echo 'selected';}?>>{{$vabudget->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="year_id" class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label>
                                    <input type="number" name="input[budget_money]" class="form-control" placeholder="" style="height: 45px;" step="any">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">หมายเหตุ</label>
                                    <textarea name="input[description]" class="form-control"></textarea>
                                    <small id="description" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-database-plus"> บันทึก</i>
                            </button>
                            <a href="{{URL('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                "> ยกเลิก</i></a>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        </form>
        <div id="url-redirect-back" data-url="{{url('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}"></div>
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
                    window.location.href = urlRedirect + '/' + data.id;
                }, 2300);
                
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[budget_money]': {
                    required: true
                },
                'input[institution_id]': {
                    required: true
                },
                'input[budgets_id_num]': {
                    required: true
                },

            },
            messages: {
                'input[budget_money]': {
                    required: "กรุณากรอกงบประมาณ"
                },
                'input[institution_id]': {
                    required: "ระบุหน่วยงาน"
                },
                'input[budgets_id_num]': {
                    required: "ระบุประเภทงบ"
                },
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
