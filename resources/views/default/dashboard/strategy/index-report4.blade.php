@extends('default.layouts.main')


@section('css')
<!-- Plugin css -->
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
<style>
    
</style>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายงานยุทธศาสตร์</a>
                            </li>
                            <li class="breadcrumb-item active">สถานะการด้านน้ำมัน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายงานสถานะการด้านน้ำมัน</h4>
                </div>
            </div>
        </div> 
        <!-- end page title --> 
        <form method="POST" id="frm-save" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="pr" value="{{$pr}}">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box display-calendar">
                        <div class="text-center">
                            <div class="form-row">
                                <div class="col-auto">
                                    <label class="header-title font-size-16 mt-2 mr-1">ค้นหาจากวันที่</label>
                                </div>
                                <div class="col-auto">
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" id="chackDay" name="chackDay" value="{{getDateFormatToInputThai($chackDay)}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text table-bgcolor"><i class="mdi mdi-calendar text-white"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title mb-2 font-size-18 text-center"><img class="icon-img mr-1"
                                src="assets/images/icons/document.svg"
                                title="document.svg">แผนวิกฤตการณ์ ด้านก๊ซ LPG ตามสถานการ์ที่ 1 และ 2</h4>
                        <div class="header-title text-center ml-2r mb-2 font-size-14">วันที่ 24 มกราคม 2565
                        </div>
                        <div class="header-title text-center ml-2r mb-3 font-size-14">ก๊าซ LPG (บาท / กก.) <span class="mr-2"></span> LPG Cargo ($ / ton)
                        </div>

                        <div class="table-responsive">
                            <table class="table m-0 table-colored-bordered table-border-color">
                                <thead>
                                    <tr>
                                        <th class="text-center font-size-17 vertical-center table-border-color table-bgcolor" rowspan="3">วันที่</th>
                                        <th class="text-center font-size-17 text-color-td table-border-color" colspan="2">ราคาโรงแยก < ราคานำเข้า</th>
                                        <th class="text-center font-size-17 text-color-td vertical-center table-border-color" rowspan="2">ราคาขายปลีกมากกว่า 363</th>
                                        <th class="text-center font-size-17 text-color-td vertical-center table-border-color" rowspan="2">เฉลี่ย 2 สัปดาห์ > 35 เหรียญ</th>
                                        <th class="text-center font-size-17 text-color-td vertical-center table-border-color" rowspan="2">ส่วนต่างราคาในสัปดาห์</th>
                                        <th class="text-center font-size-17 text-color-td vertical-center table-border-color" rowspan="2">เฉลี่ย 2 สัปดาห์ > 1 บาท</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center font-size-14 text-color-td table-border-color">นำเข้า / โรงแยก</th>
                                        <th class="text-center font-size-14 text-color-td table-border-color">นำเข้า / ปตท.สผ. และ UAC</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center font-size-16 table-border-color table-bgcolor" colspan="2">ก.</th>
                                        <th class="text-center font-size-16 table-border-color table-bgcolor">ข.</th>
                                        <th class="text-center font-size-16 table-border-color table-bgcolor" colspan="2">ก.</th>
                                        <th class="text-center font-size-16 table-border-color table-bgcolor">ข.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center table-bordered border-top text-color-td">10 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered border-top">
                                            - 12.777</td>
                                        <td class="text-center text-danger table-bordered border-top">- 11.980</td>
                                        <td class="text-center text-color-td table-bordered border-top">561.20</td>
                                        <td class="text-center text-color-td table-bordered border-top">738.00</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">11 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.878</td>
                                        <td class="text-center text-danger table-bordered">- 12.082</td>
                                        <td class="text-center text-color-td table-bordered">562.83</td>
                                        <td class="text-center text-color-td table-bordered">747.000</td>
                                        <td class="text-center text-success table-bordered">+ 9.00</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">12 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.988</td>
                                        <td class="text-center text-danger table-bordered">- 12.191</td>
                                        <td class="text-center text-color-td table-bordered">564.59</td>
                                        <td class="text-center text-color-td font-weight-600 table-bordered">757.000</td>
                                        <td class="text-center text-success table-bordered">+ 19.50</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">13 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.982</td>
                                        <td class="text-center text-danger table-bordered">- 12.186</td>
                                        <td class="text-center text-color-td table-bordered">564.49</td>
                                        <td class="text-center text-color-td table-bordered">752.000</td>
                                        <td class="text-center text-success table-bordered">+ 14.00</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">14 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.896</td>
                                        <td class="text-center text-danger table-bordered">- 12.100</td>
                                        <td class="text-center text-color-td table-bordered">563.12</td>
                                        <td class="text-center text-color-td table-bordered">740.500</td>
                                        <td class="text-center text-success table-bordered">+ 2.50</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">17 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.821</td>
                                        <td class="text-center text-danger table-bordered">- 12.025</td>
                                        <td class="text-center text-color-td table-bordered">561.92</td>
                                        <td class="text-center text-color-td table-bordered">731.000</td>
                                        <td class="text-center text-danger table-bordered">- 26.50</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">18 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.703</td>
                                        <td class="text-center text-danger table-bordered">- 11.907</td>
                                        <td class="text-center text-color-td table-bordered">560.03</td>
                                        <td class="text-center text-color-td table-bordered">732.000</td>
                                        <td class="text-center text-danger table-bordered">- 25.50</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">19 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.606</td>
                                        <td class="text-center text-danger table-bordered">- 11.810</td>
                                        <td class="text-center text-color-td table-bordered">558.47</td>
                                        <td class="text-center text-color-td font-weight-600 table-bordered">726.500</td>
                                        <td class="text-center text-danger table-bgcolor-body table-bordered">- 31.00</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">20 ม.ค. 65</td>
                                        <td class="text-center text-danger table-bordered">
                                            - 12.541</td>
                                        <td class="text-center text-danger table-bordered">- 11.745</td>
                                        <td class="text-center text-color-td table-bordered">557.42</td>
                                        <td class="text-center text-color-td table-bordered">735.500</td>
                                        <td class="text-center text-danger table-bordered">- 22.00</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-weight-600 table-bordered text-color-td">21 ม.ค. 65</td>
                                        <td class="text-center text-danger font-weight-600 table-bgcolor-body table-bordered">
                                            - 12.503</td>
                                        <td class="text-center text-danger font-weight-600 table-bgcolor-body table-bordered">- 11.706</td>
                                        <td class="text-center text-color-td font-weight-600 table-bgcolor-sum table-bordered">556.80</td>
                                        <td class="text-center text-color-td table-bordered">737.500</td>
                                        <td class="text-center text-danger table-bordered">- 20.00</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </form>
        
    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<div id="url-redirect-back" data-url="{{url('dashboard/strategy')}}?t={{$t}}&pr={{$pr}}"></div>

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/main.js') }}"></script>
<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/locales-all.js') }}"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });


    $(document).on("change", "#chackDay", function(){

        var urlRedirect = $("#url-redirect-back").attr("data-url");

        // alert('testtest');
        $.ajax({
            type: "POST",
            url: '{{url('dashboard/strategy/load')}}',
            data: $('#frm-save').serialize(),
            dataType: "json",
            success: function(msg){

                window.location.href = urlRedirect + '&chackdate=' + msg.chackDay;
            }
        });
    });
</script>
@endsection