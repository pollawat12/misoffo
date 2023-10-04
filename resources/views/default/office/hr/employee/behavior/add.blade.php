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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แบบประเมิน</a>
                            </li>
                            <li class="breadcrumb-item active">
                                บันทึกเพิ่มเติมประกอบแบบสรุปการประเมินสมรรถนะ
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">บันทึกเพิ่มเติมประกอบแบบสรุปการประเมินสมรรถนะ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="media-body">
                        <h6 class="header-title mb-1 font-size-16 mt-3">
                            บันทึกเพิ่มเติมประกอบแบบสรุปการประเมินสมรรถนะ</h6>
                        <hr class="hr-form-all">

                        <form action="{{url('office/hr/employees/behavior')}}/{{$id}}/save" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">
                            <input type="hidden" name="input[id]" value="{{$id}}">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">หัวข้อสมรรถนะ
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="input[name]" class="form-control" id="inputEmail4" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputEmail4" class="col-form-label label-step">สถานะ</label>
                                        <select name="input[is_active]" id="" class="form-control">
                                            <option value="1">เปิดใช้งาน</option>
                                            <option value="0">ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail4"
                                            class="col-form-label label-step">คำอธิบาย</label>
                                        <textarea name="input[detail]" id="" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-database-plus"> บันทึก</i>
                                        </button>
                                        <a href="{{URL('office/hr/employees/behavior')}}/{{$id}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline"> ยกเลิก</i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- </div> -->

                </div>

                
            </div>
        </div>
        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/employees/behavior')}}/{{$id}}"></div>

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