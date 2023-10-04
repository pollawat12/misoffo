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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">บุคลากร</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่ม ประวัติพนักงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ประวัติพนักงาน</i> </h4>

                    <form action="{{url('office/hr/employees/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php $prenames = \App\Models\DataSetting::where('group_type','prename')->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                                    <label for="prename">คำนำหน้า <code>*</code></label>
                                    <select name="input[prename]" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (!empty($prenames))
                                        @foreach ($prenames as $prename)
                                            <option value="{{$prename['id']}}">{{$prename['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อ <code>*</code></label>
                                    <input type="text" name="input[firstname]" class="form-control" id="input-firstname" placeholder="ชื่อ">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">นามสกุล <code>*</code></label>
                                    <input type="text" name="input[lastname]" class="form-control" id="input-lastname" placeholder="นามสกุล">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ประเภทพนักงาน <code>*</code></label>
                                    <select name="input[contract_type]" class="form-control" id="input-contract_type">
                                        <?php 
                                        $empTypes = getEmployeeType();
                                        ?>
                                        @foreach ($empTypes as $k => $v)
                                        <option value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ฝ่ายงาน <code>*</code></label>
                                    <select name="input[department_no]" class="form-control" id="">
                                        <option value="">เลือก</option>
                                        @foreach ($departments as $item)
                                        <option value="{{$item->data_value}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">กลุ่มงาน <code>*</code></label>
                                    <select name="input[group_no]" class="form-control" id="input_group_no">
                                        <option value="0">เลือก</option>
                                        @foreach ($groups as $item)
                                        <option value="{{$item->data_value}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ตำแหน่งงาน <code>*</code></label>
                                    <select name="input[positions_no]" class="form-control" id="input-position_no">
                                        <option value="0">เลือก</option>
                                        @foreach ($positions as $item)
                                        <option value="{{$item->data_value}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">อีเมล </label>
                                    <input type="text" name="input[email]" class="form-control" id="input-budget-year" placeholder="อีเมล">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">มือถือ </label>
                                    <input type="text" name="input[mobile]" class="form-control" id="input-budget-year" placeholder="มือถือ">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/hr/employees')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/employees/add')}}"></div>

    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

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
            

            $(".btn-submit").attr("disabled", false);

            var urlRedirect = $("#url-redirect-back").attr("data-url");

            if (data.status) {
                
                setTimeout(() => {
                    window.location.href = urlRedirect + '/' + data.id + '?t=general';
                }, 2300);

                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[email]': {
                    required: true
                },
                'input[mobile]': {
                    required: true
                },
                'input[date_end]': {
                    required: true
                }
            },
            messages: {
                'input[email]': {
                    required: "กรุณากรอกปี พ.ศ."
                },
                'input[mobile]': {
                    required: "กรุณากรอก วันที่เริ่มต้น"
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
