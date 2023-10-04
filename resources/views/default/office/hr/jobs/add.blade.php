@extends('default.layouts.load')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
@endsection

@section('content')
<form action="{{url('office/hr/jobs/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
<input type="hidden" name="action" value="add">
<input type="hidden" name="edit_id" value="0">
<input type="hidden" name="sort_order" value="0">
<input type="hidden" name="input[work_id]" value="{{$id}}">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">รายละเอียดตำแหน่งงาน</h4>
    </div>
    <div class="modal-body">
        <h6 class="header-title mb-1 font-size-16">ตำแหน่ง</h6>
        <hr class="hr-form-all">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">ชื่อตำแหน่ง
                        <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputEmail4" name="input[job_name]" placeholder="">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">จำนวน
                        <span class="text-danger">*</span></label>
                    <input type="text" name="input[job_num]" class="form-control" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">สำนักที่รับ
                        <span class="text-danger">*</span></label>
                        <select name="input[department_id]" class="form-control" style="height: 45px;">
                            <option value="">--เลือก--</option>
                            @if (count($departments) > 0)
                            @foreach($departments as $key => $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">กลุ่มงาน
                        <span class="text-danger">*</span></label>
                        <select name="input[group_work_id]" class="form-control" style="height: 45px;">
                            <option value="">--เลือก--</option>
                            @if (count($groups) > 0)
                            @foreach($groups as $key1 => $val1)
                            <option value="{{$val1->id}}">{{$val1->name}}</option>
                            @endforeach
                            @endif
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">วุฒิการศึกษา</label>
                    <input type="text" name="input[educational_name]" class="form-control" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">ประสบการณ์</label>
                    <input type="text" name="input[experience_num]" class="form-control" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">เงินเดือน</label>
                    <input type="text" name="input[salary]" class="form-control" id="inputEmail4" placeholder="">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputEmail4" class="col-form-label label-step">คุณสมบัติ</label>
                    <textarea name="input[note]" id="" rows="5" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="title-aad-name mt-4 mb-2">
                    <h6 class="header-title mb-1 font-size-16">ระบุ คณะกรรมการ</h6>
                    <button type="button" class="btn btn-info waves-effect waves-light clicker" value="1">
                        <i class="mdi mdi-plus"></i> เพิ่มคณะกรรมการ
                    </button>
                </div>

                <hr class="hr-form-all" style="margin-top: -25px !important;">

                <div class="table-responsive">
                    <table class="table table-bordered mb-3 input_fields_wrap">
                        <thead class="thead-dark">
                            <tr>
                                <!-- <th class="text-center text-white align-middle" style="width: 5%;">
                                    ลำดับ</th> -->
                                <th class="text-white align-middle" style="width: 60%">
                                    ชื่อ-นามสกุล</th>
                                <th class="text-white align-middle" style="width: 30%">
                                    ตำแหน่ง</th>
                                <th class="text-center text-white align-middle">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td class="text-center align-middle">1</td> -->
                                <td class="align-middle">
                                    <select name="purchases_inspector[1][]" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        @if (count($employees) > 0)
                                        @foreach($employees as $valemployees)
                                        <option value="{{$valemployees['id']}}">{{$valemployees['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class="align-middle">
                                    <select name="position_id[1][]" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        <option value="1">ประธานกรรมการ</option>
                                        <option value="2">กรรมการ</option>
                                    </select>
                                </td>
                                <td class="text-center align-middle">

                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
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

<script type="text/javascript">

$(document).ready(function() {
    
    var max_fields      = 20; //maximum input boxes allowed   
    var x = 2;
    $(".clicker").click(function (e) {

        let values = $(this).val();

        var wrapper = $(".input_fields_wrap"); 
        var fname_lname_new_2 = ' <tr><td><select name="purchases_inspector['+values+'][]" id="purchases_inspector" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){?><option value="<?php echo $valemployees['id'];?>"><?php echo $valemployees['name'];?></option><?php } }?></select></td><td><select name="position_id['+values+'][]" id="position_id" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></td><td class="text-center  align-middle"><button type="button" class="btn btn-danger waves-effect width-md waves-light remove" value="'+values+'"><i class="mdi mdi mdi-trash-can-outline"></i> ลบ</button></td></tr>';
        e.preventDefault();
        if(x < max_fields){ 
            x++; //text box increment
            $(wrapper).append(fname_lname_new_2); 
        }

    });
});

$(document).on('click', '.remove', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});
</script>
@endsection