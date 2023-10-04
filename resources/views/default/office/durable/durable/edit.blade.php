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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ครุภัณฑ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไข ครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                <span class="d-none d-sm-block">ข้อมูลครุภัณฑ์</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#update-detail" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                <span class="d-none d-sm-block">รายละเอียดการสั่งซื้อ</span>
                            </a>
                        </li> -->

                    </ul>
                    <form action="{{url('office/durable/update')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[unitcount_id]" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">
                        <div class="tab-content">

                            <div class="tab-pane show active" id="general">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="durable_name">ครุภัณฑ์ <code>*</code></label>
                                            <input type="text" name="input[durable_name]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_name}}">
                                            <small id="durable_name" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                            <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                                <option value="0">--เลือก--</option>
                                                @if (!empty($year))
                                                @foreach($year as $keyinfo => $valinfo)
                                                <option value="{{$valinfo->id}}" @if($valinfo->id == $info->year_id) selected @endif>{{$valinfo->in_year}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <!-- <small id="year_id" class="form-text text-muted"></small> -->
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="institution_id">หน่วยงาน <code>*</code></label>
                                            <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($institution) > 0)
                                                @foreach($institution as $keyinstitution => $valinstitution)
                                                <option value="{{$valinstitution->id}}" @if($valinstitution->id == $info->institution_id) selected @endif>{{$valinstitution->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small id="institution_id" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="durable_purchase">ใบจัดซื้อ-จัดจ้าง </label>
                                            <select name="input[durable_purchase]" id="durable_purchase" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($purchases) > 0)
                                                @foreach($purchases as $keypurchases => $valpurchases)
                                                <option value="{{$valpurchases->id}}" @if($valpurchases->id == $info->durable_purchase) selected @endif>{{$valpurchases->purchases_order_number}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small id="durable_purchase_id" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="durable_company">ชื่อผู้ขาย</label>
                                            <input type="text" name="input[durable_company]" id="durable_company" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_company}}">
                                            <small id="durable_company_id" class="form-text text-muted"></small>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="means_id">วิธีจัดซื้อ </label>
                                            <select name="input[means_id]" id="means_id" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($means) > 0)
                                                @foreach($means as $keyMeans => $valMeans)
                                                <option value="{{$valMeans->id}}" @if($valMeans->id == $info->means_id) selected @endif>{{$valMeans->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">หมวดหมู่ <code>*</code></label>
                                            <select name="input[category_id_new]" id="category_id" class="form-control" style="height: 45px;" disabled>
                                                <option value="">--เลือก--</option>
                                                @if (count($category) > 0)
                                                @foreach($category as $key => $val)
                                                <option value="{{$val->id}}" @if($val->id == $info->category_id) selected @endif>{{$val->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <input type="hidden" name="input[category_id]" value="{{$info->category_id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="typedata_id">ประเภท <code>*</code></label>
                                            <select name="input[typedata_id]" id="typedata_id" class="form-control" style="height: 45px;">
                                                <option value="1">--เลือก--</option>
                                                @if (count($typedata) > 0)
                                                @foreach($typedata as $key1 => $val1)
                                                <option value="{{$val1->id}}" @if($val1->id == $info->typedata_id) selected @endif>{{$val1->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_number">หมายเลขครุภัณฑ์ <code>*</code></label>
                                            <span id="durable_number">
                                                <input type="text" name="input[durable_number_new]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_number}}" disabled>
                                                <input type="hidden" name="input[durable_number]" value="{{$info->durable_number}}">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_serial">รหัสครุภัณฑ์ </label>
                                            <input type="text" name="input[durable_serial]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_serial}}">
                                            <small id="durable_serial" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="durable_brand">ยี่ห้อ <code>*</code></label>
                                            <select name="input[durable_brand]" id="durable_brand" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($brand) > 0)
                                                @foreach($brand as $keyBrand => $valBrand)
                                                <option value="{{$valBrand->id}}" @if($valBrand->id == $info->durable_brand) selected @endif>{{$valBrand->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="durable_generation">รุ่น </label>
                                            <input type="text" name="input[durable_generation]" id="durable_generation" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_generation}}">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                            <select name="input[unitcount_id]" class="form-control" style="height: 45px;">
                                                <option value="1">--เลือก--</option>
                                                @if (count($unitcount) > 0)
                                                @foreach($unitcount as $key => $val)
                                                <option value="{{$val->id}}" @if($val->id == $info->unitcount_id) selected @endif>{{$val->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dob">วันที่ตรวจรับ </label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="input[durable_received_date]" style="height: 45px;" value="@if ($info->durable_received_date != NULL){{getDateFormatToInputThai($info->durable_received_date)}} @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="durable_num">จำนวน <code>*</code></label>
                                            <input type="text" name="input[durable_num]" class="form-control" id="durable_num" placeholder="" style="height: 45px;" value="{{$info->durable_num}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="durable_price">ราคา/หน่วย/ชุด/กลุ่ม <code>*</code></label>
                                            <input type="text" name="input[durable_price]" class="form-control" id="durable_price" placeholder="" style="height: 45px;" value="{{$info->durable_price}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_vat">VAT 7% <code>*</code></label>
                                            <input type="text" name="input[durable_vat]" class="form-control" id="durable_vat" placeholder="" style="height: 45px;" value="{{$info->durable_vat}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_sum">ราคาสุทธิ <code>*</code></label>
                                            <input type="text" name="input[durable_sum]" class="form-control" id="durable_sum" placeholder="" style="height: 45px;" value="{{$info->durable_sum}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_year">อายุการใช้งาน(ปี) <code>*</code></label>
                                            <input type="text" name="input[durable_year]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_year}}">
                                            <small id="durable_year" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durable_depreciation_rate">%อัตราค่าเสื่อม <code>*</code></label>
                                            <input type="text" name="input[durable_depreciation_rate]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->durable_depreciation_rate}}">
                                            <small id="durable_depreciation_rate" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="durable_detail">รายละเอียดเพิ่มเติม</label>
                                            <textarea name="input[durable_detail]" class="form-control">{{$info->durable_detail}}</textarea>
                                            <small id="durable_detail" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="durable_storage_location">สถานที่จัดเก็บ <code>*</code></label>
                                            <textarea  name="input[durable_storage_location]" class="form-control">{{$info->durable_storage_location}}</textarea>
                                            <small id="durable_storage_location" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="durable_image">แนบรูปภาพพัสดุ </label>
                                            <input type="file" name="durable_image" class="filestyle" placeholder="" style="height: 45px;">
                                            <small id="durable_image" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-database-plus"> บันทึก</i>
                                </button>
                                {{-- <a href="#update-detail" data-toggle="tab" aria-expanded="false"><button type="button" class="btn btn-primary">
                                        <i class="mdi mdi-database-plus"> รายละเอียดการสั่งซื้อ</i>
                                    </button></a> --}}
                                <a href="{{URL('office/durable/lists')}}?t=durable&pr=0" class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                        "> ยกเลิก</i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>

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
                'input[durable_name]': {
                    required: true
                },
                'input[durable_serial]': {
                    required: true
                },
                'input[category_id]': {
                    required: true
                },
                'input[typedata_id]': {
                    required: true
                },
                'input[unitcount_id]': {
                    required: true
                },
                'input[durable_received_date]': {
                    required: true
                },
                'input[durable_purchase]': {
                    required: true
                }
            },
            messages: {
                'input[durable_name]': {
                    required: "กรุณากรอกครุภัณฑ์"
                },
                'input[durable_serial]': {
                    required: "กรุณากรอก Serial Number"
                },
                'input[category_id]': {
                    required: "กรุณาเลือก หมวดหมู่"
                },
                'input[typedata_id]': {
                    required: "กรุณาเลือก ประเภท"
                },
                'input[unitcount_id]': {
                    required: "กรุณาเลือก หน่วยนับ"
                },
                'input[durable_received_date]': {
                    required: "กรุณากรอก วันที่ได้รับ"
                },
                'input[durable_purchase]': {
                    required: "กรุณากรอก ใบจัดซื้อ-จัดจ้าง"
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
</script>

<script>
    $(function(){
        
        $(document).on("change", "#institution_id", function() {
            var _itemValue = $(this).val();
            var _id = $("#year_id").val();

            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=institution&id=" + _itemValue + '&parentId=' + _id;

            $.get(_url, function(data) {
                $("#durable_purchase").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#budget_categroy", function() {
            var _itemValue = $(this).val();
            var _id = $("#year_id").val();
            var _url = $("#base-url-api").attr("data-url") + "/office/budget/expenses/project/get/info/?t=budget&id=" + _itemValue + '&parentId=' + _id;

            $("#budget_type").html('<option value="">--เลือก--</option>');
            $("#projects_id").html('<option value="">--เลือก--</option><option value="0">สำนักงาน</option>');
            $.get(_url, function(data) {
                $("#budget_type").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#durable_purchase", function() {
            var _itemValue = $(this).val();

            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=purchase&id=" + _itemValue + '&parentId=0';

            $.get(_url, function(data) {
                $("#durable_company").val(data.elem_html);
            }, "json");
        });


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

            var _yearid = $("#year_id").val();

            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=typedata&id=" + _itemValue + '&institutionid=' + _institutionid + '&yearid=' + _yearid;

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
