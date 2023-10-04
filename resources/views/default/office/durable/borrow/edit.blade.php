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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบครุภัณฑ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">เบิก / ยืม พัสดุ</a></li>
                            <li class="breadcrumb-item active">เบิก / ยืม พัสดุ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เบิก / ยืม พัสดุ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล เบิก / ยืม พัสดุ</i> </h4>

                    <form action="{{url('office/durable/borrow/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[unitcount_id]" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">
                        <input type="hidden" name="input[durable_status]" id="durable_status" value="1">
                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="borrow_number">เลขที่ใบเบิก <code>*</code></label>
                                    <input type="text" name="input[borrow_number]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->borrow_number}}">
                                    <small id="borrow_number" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่เบิก </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[borrow_date]" style="height: 45px;" value="@if ($info->borrow_date != NULL){{getDateFormatToInputThai($info->borrow_date)}} @endif">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="borrow_user_name">ชื่อผู้เบิก <code>*</code></label>
                                    <input type="text" name="input[borrow_user_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->borrow_user_name}}">
                                    <small id="borrow_user_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_affiliate">เรียน กลุ่มงาน <code>*</code></label>
                                    <select class="form-control" name="input[borrow_affiliate]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        @if (count($groups) > 0)
                                        @foreach($groups as $keygroups => $valgroups)
                                        <option value="{{$valgroups->id}}" @if($info->borrow_affiliate == $valgroups->id) selected @endif>{{$valgroups->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="borrow_institution">หน่วยงาน <code>*</code></label>
                                    <select class="form-control" name="input[borrow_institution]" data-toggle="select2">
                                        <option value="">--เลือก--</option>
                                        @if (count($institution) > 0)
                                        @foreach($institution as $keyInstitution => $valInstitution)
                                        <option value="{{$valInstitution->id}}" @if($info->borrow_institution == $valInstitution->id) selected @endif>{{$valInstitution->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- คณะกรรมการ -->
                        <div class="col-lg-12">
                            <div class="label-step mt-3 mb-2">เป็นการ <span class="text-danger">*</span></div>

                            <div class="form-inline">
                                <div class="form-group ml-2">
                                    <div class="radio checkbox-primary">
                                        <input id="Check1" type="radio" name="input[borrow_status]" value="1" @if($info->borrow_status == 1) checked @endif>
                                        <label for="Check1">
                                            เบิก
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group ml-2">
                                    <div class="radio checkbox-primary">
                                        <input id="Check2" type="radio" name="input[borrow_status]" value="2" @if($info->borrow_status == 2) checked @endif>
                                        <label for="Check2">
                                            โอน
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline mb-2">
                                <div class="form-group ml-2">
                                    <div class="radio checkbox-primary">
                                        <input id="Check3" type="radio" name="input[borrow_status]" value="3" @if($info->borrow_status == 3) checked @endif>
                                        <label for="Check3">
                                            ยืม กำหนดวันส่งคืน
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ml-2">
                                    <label class="sr-only" for="exampleInputEmail21"></label>
                                    <!-- <div>
                                        <div class="input-group"> -->
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[borrow_night_date]" value="@if ($info->durable_invoice_date != NULL){{getDateFormatToInputThai($info->borrow_night_date)}} @endif">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                    <!-- </div> -->
                                    <!-- input-group -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="borrow_night_detail">ยืมเพื่อนำไปใช้งานราชการเกี่ยวกับ</label>
                                    <textarea  name="input[borrow_night_detail]" class="form-control">{{$info->borrow_night_detail}}</textarea>
                                    <small id="borrow_night_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <!-- พัสดุ -->
                        <div class="col-lg-12">
                            <div class="title-aad-name mt-2 mb-2">
                                <div class="label-step mt-2 mb-2">ระบุ พัสดุ</div>
                                <button type="button" class="btn btn-info waves-effect waves-light clicker" value="1">
                                    <i class="mdi mdi-plus"></i> เพิ่มพัสดุ
                                </button>
                            </div>
                            

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 input_fields_wrap">
                                    <thead class="thead-dark">
                                        <tr>
                                            <!-- <th class="text-center text-white" style="width: 5%;">ลำดับ</th> -->
                                            <th class="text-white" style="width: 45%">ชื่อพัสดุ</th>
                                            <th class="text-white" style="width: 10%;">จำนวน</th>
                                            <th class="text-white" style="width: 30%;">สถานที่ตั้งพัสดุ</th>
                                            <th class="text-white" style="width: 20%;">ผู้รับผิดชอบ</th>
                                            <th class="text-center text-white">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(count($details) > 0){
                                                foreach($details as $detail){
                                        ?>
                                                    <tr>
                                                        <!-- <td class="text-center">1</td> -->
                                                        <td>
                                                            <select name="value_id[1][]" id="purchases_inspector" class="form-control" style="height: 45px;">
                                                                <option value="">--เลือก--</option>
                                                                @if (count($item) > 0)
                                                                @foreach($item as $key => $val)
                                                                <option value="{{$val->id}}" @if($detail['durable_id'] == $val->id) selected @endif>{{$val->durable_number}} || {{$val->durable_name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="num[1][]" class="form-control" placeholder="" style="height: 45px;" value="{{$detail['durable_num']}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="add[1][]" class="form-control" placeholder="" style="height: 45px;" value="{{$detail['durable_location']}}">
                                                        </td>
                                                        <td>
                                                            <select name="person[1][]" id="purchases_inspector" class="form-control" style="height: 45px;">
                                                                <option value="">--เลือก--</option>
                                                                @if (!empty($employees))
                                                                @foreach ($employees as $itememployees)
                                                                <option value="{{$itememployees['id']}}" @if($itememployees['id'] == $detail['durable_user']) selected @endif>{{$itememployees['name']}}</option>
                                                                @endforeach
                                                                @endif 
                                                            </select>
                                                        </td>
                                                        <td class="text-center">

                                                        </td>
                                                    </tr>

                                        <?php 
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                <a href="{{URL('office/durable/borrow/lists')}}?t=borrow&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                    "> ยกเลิก</i></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/borrow/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกฝ่ายงาน"
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
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });

    $(document).ready(function() {
    
        var max_fields      = 20; //maximum input boxes allowed   
        var x = 2;
        $(".clicker").click(function (e) {

            let values = $(this).val();

            var wrapper = $(".input_fields_wrap"); 
            var fname_lname_new_2 = '<tr><td><select name="value_id['+values+'][]" id="purchases_inspector" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if (count($item) > 0){ foreach($item as $val){?><option value="<?php echo $val->id;?>"><?php echo $val->durable_number.' || '.$val->durable_name;?></option><?php }}?></select></td><td><input type="text" name="num['+values+'][]" class="form-control" placeholder="" style="height: 45px;"></td><td><input type="text" name="add['+values+'][]" class="form-control" placeholder="" style="height: 45px;"></td><td><select name="person['+values+'][]" id="purchases_inspector" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if (!empty($employees)){ foreach ($employees as $itememployees){?><option value="<?php echo $itememployees['id'];?>"><?php echo $itememployees['name'];?></option><?php }}?></select></td><td class="text-center"><button type="button" class="btn btn-danger waves-effect width-md waves-light remove" value="'+values+'"><i class="mdi mdi mdi-trash-can-outline"></i> ลบ</button></td></tr>';
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
