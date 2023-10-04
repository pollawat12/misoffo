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
                            <li class="breadcrumb-item active">การเงิน > ใบสำคัญจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ใบสำคัญจ่าย</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/certificate/update')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล ใบสำคัญจ่าย</i> </h4>

                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <input type="hidden" name="input[type_id]" value="{{$t}}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_id">ID <code>*</code></label>
                                        <input type="text" name="input[certificate_id]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_id}}">
                                        <small id="certificate_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_num">เลขที่ <code>*</code></label>
                                        <input type="text" name="input[certificate_num]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_num}}">
                                        <small id="certificate_num" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">วันที่ <code>*</code></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป"  name="input[certificate_date]" value="@if ($info->certificate_date != NULL){{getDateFormatToInputThai($info->certificate_date)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <fieldset class="mb-4 fieldset-custom">
                                <legend>
                                    หน่วยงาน/บริษัท
                                </legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_payfor">จ่ายให้ (หน่วยงาน/บริษัท) <code>*</code></label>
                                            <select name="input[certificate_payfor]" id="certificate_payfor" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($company) > 0)
                                                @foreach($company as $keycompany => $valcompany)
                                                <option value="{{$valcompany->id}}" @if($valcompany['id'] == $info->certificate_payfor) selected @endif>{{$valcompany->company_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small id="year_id" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_type">ประเภทการจ่าย <code>*</code></label>
                                            <select name="input[certificate_type] " class="form-control"] style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                <option value="1" @if(1 == $info->certificate_type) selected @endif>โอนเงินผ่านระบบผ่านอิเล็กทรอนิกส์</option>
                                                <option value="2" @if(2 == $info->certificate_type) selected @endif>เงินสด</option>
                                                <option value="3" @if(3 == $info->certificate_type) selected @endif>เช็ค</option>
                                            </select>
                                            <small id="certificate_type" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_num">บัญชีเลขที่</label>
                                            <input type="text" name="input[certificate_bank_num]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_bank_num}}">
                                            <small id="certificate_bank_num" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_name">ธนาคาร </label>
                                            <input type="text" name="input[certificate_bank_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_bank_name}}">
                                            <small id="certificate_bank_name" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_account">ชื่อบัญชี </label>
                                            <input type="text" name="input[certificate_bank_account]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_bank_account}}">
                                            <small id="certificate_bank_account" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certificate_bank_branch">สาขา </label>
                                            <input type="text" name="input[certificate_bank_branch]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_bank_branch}}"> 
                                            <small id="certificate_bank_branch" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_check_num">เช็คเลขที่ </label>
                                        <input type="text" name="input[certificate_check_num]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_check_num}}"> 
                                        <small id="certificate_check_num" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">ลงวันที่ </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="height: 45px;" placeholder="วว/ดด/ปปปป"  name="input[certificate_check_date]"value="@if ($info->certificate_check_date != NULL){{getDateFormatToInputThai($info->certificate_check_date)}} @endif">
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
                                        <label for="certificate_organizer">ผู้จัดทำ </label>
                                        <input type="text" name="input[certificate_organizer]" class="form-control" placeholder="" style="height: 45px;"  value="{{$info->certificate_organizer}}"> 
                                        <small id="certificate_organizer" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_inspector">ผู้ตรวจ </label>
                                        <input type="text" name="input[certificate_inspector]" class="form-control" placeholder="" style="height: 45px;"  value="{{$info->certificate_inspector}}"> 
                                        <small id="certificate_inspector" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="certificate_approver">ผู้อนุมัติ </label>
                                        <input type="text" name="input[certificate_approver]" class="form-control" placeholder="" style="height: 45px;"  value="{{$info->certificate_approver}}"> 
                                        <small id="certificate_approver" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_payer">ผู้จ่ายเงิน </label>
                                        <input type="text" name="input[certificate_payer]" class="form-control" placeholder="" style="height: 45px;"  value="{{$info->certificate_recipient}}"> 
                                        <small id="certificate_payer" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="certificate_recipient">ผู้รับเอกสาร </label>
                                        <input type="text" name="input[certificate_recipient]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->certificate_recipient}}"> 
                                        <small id="certificate_recipient" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_note">รายละเอียด</label>
                                        <textarea  name="input[certificate_note]" class="form-control">{{$info->certificate_note}}</textarea>
                                        <small id="certificate_note" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="certificate_file">แนบ เอกสาร </label>
                                        <input type="file" name="certificate_file" class="filestyle" placeholder="" style="height: 45px;">
                                        <small id="certificate_file" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end col -->

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลรายละเอียด</i> </h4>

                                <span id="loadDetail">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success btn-sm add_field_button" data-id="{{$id}}">เพิ่มรายการ</button></h4>
                                            </div>
                                        </div>
                                    </div>

                                    @if (count($items) > 0)
                                        @foreach($items as $valitems)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="certificate_detail_name">รายการ <code>*</code> </label>

                                                        <?php if($t == 1):?>
                                                            <select name="certificate_detail_nameNew[]" id="certificate_detail_nameNew" class="form-control" style="height: 45px;">
                                                                <option value="">--เลือก--</option>
                                                                @if (count($details) > 0)
                                                                @foreach($details as $valdetails)
                                                                <option value="{{$valdetails['id']}}" @if($valdetails['id'] == $valitems->budget_costs_id) selected @endif>{{$valdetails['expense_item']}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        <?php else: ?>
                                                            <select name="certificate_detail_nameNew[]" id="certificate_detail_nameNew" class="form-control" style="height: 45px;">
                                                                <option value="">--เลือก--</option>
                                                                @if (count($details) > 0)
                                                                @foreach($details as $valdetails)
                                                                <option value="{{$valdetails['id']}}" @if($valdetails['id'] == $valitems->budget_costs_id) selected @endif>{{$valdetails['compensate_num']}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="certificate_detail_noteNew"> หมายเหตุ </label>
                                                        <input type="text" name="certificate_detail_noteNew[]" class="form-control" placeholder="" style="height: 45px;" value="{{$valitems->certificate_detail_note}}"> 
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @else:
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="certificate_detail_name">รายการ <code>*</code> </label>

                                                    <?php if($t == 1):?>
                                                        <select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            @if (count($details) > 0)
                                                            @foreach($details as $valdetails)
                                                            <option value="{{$valdetails['id']}}">{{$valdetails['expense_item']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    <?php else: ?>
                                                        <select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;">
                                                            <option value="">--เลือก--</option>
                                                            @if (count($details) > 0)
                                                            @foreach($details as $valdetails)
                                                            <option value="{{$valdetails['id']}}">{{$valdetails['compensate_num']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="certificate_detail_note"> หมายเหตุ </label>
                                                    <input type="text" name="certificate_detail_note[]" class="form-control" placeholder="" style="height: 45px;"> 
                                                </div>
                                            </div>
                                        </div>
                                    @endif                        
                                    <div class="input_fields_wrap">

                                    </div>


                                    <script type="text/javascript">

                                        $(document).ready(function() {
                                            
                                            var x = 1;
                                            var add_button      = $(".add_field_button"); 
                                            $(add_button).click(function(e){ 

                                                var id = $(this).attr('data-id');

                                                var max_fields      = 20; //maximum input boxes allowed
                                                var wrapper         = $(".input_fields_wrap"); 

                                                <?php if($t == 1):?>
                                                    var fname_lname_new = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="certificate_detail_name">รายการ <code>*</code> </label><select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($details) > 0){ foreach($details as $valdetails){ ?><option value="<?php echo $valdetails['id']; ?>"><?php echo $valdetails['expense_item'] ?></option><?php } }?></select></div></div><div class="col-md-5"><div class="form-group"><label for="certificate_detail_note"> หมายเหตุ </label><input type="text" name="certificate_detail_note[]" class="form-control" placeholder="" style="height: 45px;"></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 45px;margin-block:30px;"> ลบ </button></div>';
                                                <?php else: ?>
                                                    var fname_lname_new = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="certificate_detail_name">รายการ <code>*</code> </label><select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($details) > 0){ foreach($details as $valdetails){ ?><option value="<?php echo $valdetails['id']; ?>"><?php echo $valdetails['compensate_num'] ?></option><?php } }?></select></div></div><div class="col-md-5"><div class="form-group"><label for="certificate_detail_note"> หมายเหตุ </label><input type="text" name="certificate_detail_note[]" class="form-control" placeholder="" style="height: 45px;"></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 45px;margin-block:30px;"> ลบ </button></div>';
                                                <?php endif; ?>
                                                

                                                e.preventDefault();
                                                if(x < max_fields){ 
                                                    x++; //text box increment
                                                    $(wrapper).append(fname_lname_new); 
                                                }
                                            });

                                            $(wrapper).on("click",".remove_field", function(e){             e.preventDefault(); $(this).parent().remove(); x--;
                                            })
                                        });
                                    </script>
                                </span>

                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/budget/certificate/all')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>
                        
                    </div>
                </div>
                <!-- end col -->

            </div>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/certificate/all')}}"></div>

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
                'input[certificate_id]': {
                    required: true
                }
            },
            messages: {
                'input[certificate_id]': {
                    required: "กรุณากรอกข้อมูล"
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

<script type="text/javascript">

$(document).on("change", "#certificate_payfor", function(){
    var _itemValue = $(this).val();

    $('#loadDetail').load('{{URL('office/budget/certificate/get/loadDetail')}}' + '/' + _itemValue);
});


</script>
@endsection
