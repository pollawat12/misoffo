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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบ</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ราคา</a></li>
                            <li class="breadcrumb-item active">รายงานราคา ปิโตรเลียม OFFO</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายงานราคา ปิโตรเลียม OFFO</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายงานราคา</i> </h4>

                    <form action="{{url('office/durable/update')}}" method="POST" name="frm-save" id="frm-save">
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ลำดับ</th>  
                                        <th>วันที่</th> 
                                        <th>97 UNL (min)</th>
                                        <th>97 UNL (max)</th>
                                        <th>92 UNL (min)</th>
                                        <th>92 UNL (max)</th>
                                        <th>95 UNL (min)</th>
                                        <th>95 UNL (max)</th>
                                        <th>91 UNL (Non-Oxy) (min)</th>
                                        <th>91 UNL (Non-Oxy) (max)</th>
                                        <th>NAPHTHA (min)</th>
                                        <th>NAPHTHA (max)</th>
                                        <th>JET KERO (min)</th>
                                        <th>JET KERO (max)</th>
                                        <th>GO 1.0%S (min)</th>
                                        <th>GO 1.0%S (max)</th>
                                        <th>GO 0.5%S (Gasoil) (min)</th>
                                        <th>GO 0.5%S (Gasoil)  (max)</th>
                                        <th>GO 0.25%S (min)</th>
                                        <th>GO 0.25%S (max)</th>
                                        <th>GO 0.05%S (min)</th>
                                        <th>GO 0.05%S (max)</th>
                                        <th>GO 0.005%S (min)</th>
                                        <th>GO 0.005%S (max)</th>
                                        <th>GO 0.001%S (min)</th>
                                        <th>GO 0.001%S (max)</th>
                                        <th>FO 180 2% (min)</th>
                                        <th>FO 180 2% (max)</th>
                                        <th>FO 180 3.5% (min)</th>
                                        <th>FO 180 3.5% (max)</th>
                                        <th>FO 380 3.5% (min)</th>
                                        <th>FO 380 3.5% (max)</th>
                                        <th>MTBE (min)</th>
                                        <th>MTBE (max)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;?>
                                        @if (!empty($report))
                                        @foreach ($report as $item)
                                        <?php $no++;?>
                                        <tr>
                                            <td class="align-middle">{{$no}}</td>
                                            <td class="align-middle">{{getDateShow($item['reportdate'])}}</td>
                                            <td class="align-middle">{{number_format($item['min_97_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_97_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_92_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_92_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_95_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_95_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_91_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_91_UNL'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_naphtha'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_naphtha'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_jet_kero'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_jet_kero'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_10'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_10'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_05'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_05'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_025'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_025'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_005'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_005'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_0005'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_0005'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_go_0001'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_go_0001'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_fo_180_2'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_fo_180_2'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_fo_180_35'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_fo_180_35'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_fo_180_380'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_fo_180_380'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['min_mtbe'],2,'.',',')}}</td>
                                            <td class="align-middle">{{number_format($item['max_mtbe'],2,'.',',')}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>    
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}"></div>
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
