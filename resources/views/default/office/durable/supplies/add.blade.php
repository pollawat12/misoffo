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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เพิ่มพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล พัสดุ/อุปกรณ์</i> </h4>

                    <form action="{{url('office/durable/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="durable_type" value="{{$t}}">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_name">พัสดุอุปกรณ์ <code>*</code></label>
                                    <input type="text" name="input[durable_name]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="durable_name" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="typedata_id">ประเภท <code>*</code></label>
                                    <select name="input[typedata_id]" class="form-control" style="height: 45px;">
                                        <option value="1">--เลือก--</option>
                                        @if (count($typedata) > 0)
                                        @foreach($typedata as $key1 => $val1)
                                        <option value="{{$val1->id}}">{{$val1->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="typedata_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_brand">ยี่ห้อ <code>*</code></label>
                                    <select name="input[durable_brand]" id="durable_brand" class="form-control" style="height: 45px;">
                                        <option value="">--เลือก--</option>
                                        @if (count($brand) > 0)
                                        @foreach($brand as $keyBrand => $valBrand)
                                        <option value="{{$valBrand->id}}">{{$valBrand->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                    <select name="input[unitcount_id]" class="form-control" style="height: 45px;">
                                        <option value="1">--เลือก--</option>
                                        @if (count($unitcount) > 0)
                                        @foreach($unitcount as $key => $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <small id="unitcount_id" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_size">ขนาด <code>*</code></label>
                                    <input type="text" name="input[durable_size]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="durable_size" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_mix">จำนวนน้อยสุด <code>*</code></label>
                                    <input type="text" name="input[durable_mix]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="durable_mix" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="durable_max">จำนวนมากสุด <code>*</code></label>
                                    <input type="text" name="input[durable_max]" class="form-control" placeholder="" style="height: 45px;">
                                    <small id="durable_max" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_storage_location">สถานที่จัดเก็บ</label>
                                    <textarea  name="input[durable_storage_location]" class="form-control"></textarea>
                                    <small id="durable_storage_location" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="durable_detail">รายละเอียดเพิ่มเติม</label>
                                    <textarea  name="input[durable_detail]" class="form-control"></textarea>
                                    <small id="durable_detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/durable/lists')}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>

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
                'input[durable_name]': {
                    required: true
                },
                
            },
            messages: {
                'input[durable_name]': {
                    required: "กรุณากรอกพัสดุอุปกรณ์"
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

    $(function(){
        
        $(document).on("change", "#category_id", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=category&id=" + _itemValue;

            $("#durable_number").html('<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;">');
            $.get(_url, function(data){
                $("#typedata_id").html(data.elem_html);
            }, "json");
        });
    
        $(document).on("change", "#typedata_id", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=typedata&id=" + _itemValue;

            $.get(_url, function(data){
                $("#durable_number").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#province_no", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=province&id=" + _itemValue;

            $("#subdistrict_no").html('<option value="">ระบุ</option>');
            $("#zipcode").html('<input type="text" class="form-control" name="input[zipcode]" placeholder="">');
            $.get(_url, function(data){
                $("#district_no").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#district_no", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=district&id=" + _itemValue;

            $("#zipcode").html('<input type="text" class="form-control" name="input[zipcode]" placeholder="">');
            $.get(_url, function(data){
                $("#subdistrict_no").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#subdistrict_no", function(){
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=subdistrict&id=" + _itemValue;

            $.get(_url, function(data){
                $("#zipcode").html(data.elem_html);
            }, "json");
        });

    });
</script>
@endsection
