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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบจัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item active">ข้อมูจัดซื้อ - จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข จัดซื้อ - จัดจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                        <h6 class="header-title mb-1 font-size-16 mt-1">รายงานผลการพิจารณา/สั่งซื้อสั่งจ้าง</h6>
                        <hr class="hr-form-all">

                        <form action="{{url('office/purchase/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <input type="hidden" name="input[purchases_status]" value="3">

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ชื่อเรื่อง
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_name]" value="{{$info->purchases_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">บันทึกเลขที่
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_order_number_no3]" value="{{$info->purchases_order_number}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">วันที่ <span
                                                class="text-danger">*</span></label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป" style="height: 45px;" name="input[purchases_invoice_date_3]" value="@if ($info->purchases_invoice_date_3 != NULL){{getDateFormatToInputThai($info->purchases_invoice_date_3)}} @endif">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4"
                                            class="col-form-label label-step">ผู้ชนะการเสนอราคา <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_offer_name]" value="{{$info->purchases_offer_name}}">
                                    </div>
                                </div> -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="title-aad-name">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">ผู้ชนะการเสนอราคา <span
                                                    class="text-danger">*</span></label>
                                                    {{-- <div class="pad-cus">
                                                        <button type="button" class="btn btn-info pt-1 pb-1" data-toggle="modal" data-target="#con-close-modal"><i
                                                            class="mdi mdi-plus font-8">
                                                            เพิ่มบริษัท/ผู้ค้า</i></button>
                                                    </div> --}}
                                            
                                        </div>

                                        <select name="input[purchases_offer_name]" id="input[purchases_offer_name]" class="form-control" style="height: 45px;" >
                                            <option value="">เลือก</option>
                                            @if (count($company) > 0)
                                            @foreach($company as $keycompany => $valcompany)
                                            <option value="{{$valcompany->id}}" @if($valcompany->id == $info->purchases_offer_name) selected @endif>{{$valcompany->company_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">ราคาที่ตกลงซื้อจ้าง <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="" style="height: 45px;" name="input[purchases_offer_price]" value="{{$info->purchases_offer_price}}">
                                    </div>
                                </div>
                                

                                <div class="col-lg-12">
                                    <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                            class="text-danger">*</span></div>
                                    <div class="form-group">
                                        <input type="file" class="filestyle" name="purchases_file4" id="filestyleicon">    
                                                                          
                                    </div>
                                    <div class="comment-file">
                                        แนบได้มากกว่า 1 ไฟล์ เช่น รายงานผลการพิจารณาคัดเลือก, ประกาศผู้ชนะการเสนอราคา ฯลฯ
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            บันทึก
                                        </button>
                                        <a href="{{URL('office/purchase/detail')}}/{{$id}}?t=1&pr=0"><button type="button" class="btn btn-secondary waves-effect waves-light">
                                            ยกเลิก
                                        </button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div> <!-- end col -->

            <div id="con-close-modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">เพิ่มข้อมูล บริษัท/ผู้ค้า</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">ชื่อบริษัท/ผู้ค้า <span
                                            class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">เลขที่จดทะเบียน <span
                                            class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">วันที่จดทะเบียน <span
                                            class="text-danger">*</span></label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                                        id="datepicker-autoclose">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">บัญชีเลขที่</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">ธนาคาร</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">ชื่อบัญชี</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">สาขา</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">ชื่อผู้ติดต่อ</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">เบอร์โทรติดต่อ</label>
                                        <input type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">แนบเอกสาร</label>
                                        <div class="form-group">
                                            <input type="file" class="filestyle" id="filestyleicon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->


        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{URL('office/purchase/detail')}}/{{$id}}?t=1&pr=0"></div>

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
                'input[purchases_name]': {
                    required: true
                },
                'input[purchases_order_number_no3]': {
                    required: true
                },
                'input[purchases_invoice_date_3]': {
                    required: true
                },
                'input[purchases_offer_name]': {
                    required: true
                },
                'input[purchases_offer_price]': {
                    required: true
                },
                'purchases_file4': {
                    required: true
                },

                // 'input[durable_serial]': {
                //     required: true
                // },
                // 'input[category_id]': {
                //     required: true
                // },
                // 'input[typedata_id]': {
                //     required: true
                // },
                // 'input[unitcount_id]': {
                //     required: true
                // },
                // 'input[durable_received_date]': {
                //     required: true
                // },
                // 'input[durable_purchase]': {
                //     required: true
                // }
            },
            messages: {
                'input[purchases_name]': {
                    required: "กรุณากรอกเรื่อง"
                },
                'input[purchases_order_number_no3]': {
                    required: "กรุณากรอกบันทึกเลขที่"
                },
                'input[purchases_invoice_date_3]': {
                    required: "กรุณากรอกวันที่"
                },
                'input[purchases_offer_name]': {
                    required: "กรุณาเลือก"
                },
                'input[purchases_offer_price]': {
                    required: "กรุณากรอกราคาที่ตกลงซื้อจ้าง"
                },
                'purchases_file4': {
                    required: "กรุณาแนบไฟล์"
                },

                // 'input[durable_serial]': {
                //     required: "กรุณากรอก Serial Number"
                // },
                // 'input[category_id]': {
                //     required: "กรุณาเลือก หมวดหมู่"
                // },
                // 'input[typedata_id]': {
                //     required: "กรุณาเลือก ประเภท"
                // },
                // 'input[unitcount_id]': {
                //     required: "กรุณาเลือก หน่วยนับ"
                // },
                // 'input[durable_received_date]': {
                //     required: "กรุณากรอก วันที่ได้รับ"
                // },
                // 'input[durable_purchase]': {
                //     required: "กรุณากรอก ใบจัดซื้อ-จัดจ้าง"
                // }
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
</script>
<script type="text/javascript">

$(document).ready(function() {
    
    var x = 1;
    var add_button      = $(".add_field_button"); 
    $(add_button).click(function(e){ 

        var id = $(this).attr('data-id');

        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"+id); 
        
        var fname_lname_new = '<div class="row"><div class="col-md-6" ><div class="form-group"><select name="purchases_inspector['+id+'][]" id="purchases_inspector" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><?php if(count($employees) > 0){ foreach($employees as $valemployees){ ?><option value="<?php echo $valemployees['id']; ?>"><?php echo $valemployees['name'] ?></option><?php } }?></select></div></div><div class="col-md-5" ><div class="form-group"><select name="position_id['+id+'][]" id="position_id" class="form-control" style="height: 40px;"><option value="">--เลือก--</option><option value="1">ประธานกรรมการ</option><option value="2">กรรมการ</option></select></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 40px;margin-block:0px;"> ลบ </button></div>';
    
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
@endsection
