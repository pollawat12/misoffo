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
                    <h4 class="page-title">แก้ไข รายงานครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ครุภัณฑ์</i> </h4>

                    <form action="{{url('office/durable/update')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}}">
                        <input type="hidden" name="sort_order" value="0">
                        <input type="hidden" name="input[unitcount_id]" value="0">
                        <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                        <input type="hidden" name="input[durable_type]" id="group_type" value="{{$t}}">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>รายการ</th>
                                        <th>Serial Number</th>
                                        <th>หมายเลขครุภัณฑ์</th>
                                        <th>วันที่ได้รับ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{$info->durable_name}}</td>
                                        <td>{{$info->durable_serial}}</td>
                                        <td>{{$info->durable_number}}</td>
                                        <td>{{getDateShow($info->durable_received_date)}}</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ลำดับ</th>  
                                        <th>วันที่คำนวณ</th> 
                                        <th>ราคา</th>
                                        <th>อายุการใช้งาน(ปี)</th>
                                        <th>%อัตราค่าเสื่อม</th>
                                        <th>จำนวนวัน</th>
                                        <th>ค่าเสื่อมราคาสะสมยกมา</th>
                                        <th>ค่าเสื่อมราคาประจำปี</th>
                                        <th>ค่าเสื่อมราคาสะสมยกไป </th>
                                        <th>มูลค่าสุทธิ(บาท)</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>30/10/2559</td>
                                        <td>23,540.00</td>
                                        <td>12</td>
                                        <td>8.50</td>
                                        <td>366</td>
                                        <td>9,061.29</td>
                                        <td>1,961.67</td>
                                        <td>11,022.96</td>
                                        <td>4,670.36</td>
                                        <td>กพน.</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>30/10/2560</td>
                                        <td>23,540.00</td>
                                        <td>12</td>
                                        <td>8.50</td>
                                        <td>366</td>
                                        <td>11,022.96</td>
                                        <td>1,961.67</td>
                                        <td>12,984.63</td>
                                        <td>4,670.36</td>
                                        <td>กพน.</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>30/10/2561</td>
                                        <td>23,540.00</td>
                                        <td>12</td>
                                        <td>8.50</td>
                                        <td>366</td>
                                        <td>12,984.63</td>
                                        <td>1,961.67</td>
                                        <td>14,946.30</td>
                                        <td>4,670.36</td>
                                        <td>กพน.</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>30/10/2562</td>
                                        <td>23,540.00</td>
                                        <td>12</td>
                                        <td>8.50</td>
                                        <td>366</td>
                                        <td>14,946.30</td>
                                        <td>1,961.67</td>
                                        <td>16,907.97</td>
                                        <td>4,670.36</td>
                                        <td>กพน.</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>30/10/2563</td>
                                        <td>23,540.00</td>
                                        <td>12</td>
                                        <td>8.50</td>
                                        <td>366</td>
                                        <td>16,907.97</td>
                                        <td>1,961.67</td>
                                        <td>18,869.64</td>
                                        <td>4,670.36</td>
                                        <td>กพน.</td>
                                    </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div>

                        <a href="{{URL('office/durable/lists')}}?t=durable&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
            }
        });
    });
</script>
@endsection
