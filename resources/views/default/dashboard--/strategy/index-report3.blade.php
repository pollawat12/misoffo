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
                                src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">แผนวิกฤตการณ์ด้านน้ำมัน ตามสถานการ์ที่ 1 และ 2</h4>
                        <div class="header-title text-center ml-2r mb-2 font-size-14">วันที่ 24 มกราคม 2565</div>

                        <div class="table-responsive">
                            <table class="table m-0 table-colored-bordered table-border-color">
                                <thead>
                                    <tr>
                                        <th class="text-center font-size-13 text-color-td"></th>
                                        <th class="text-center font-size-13 text-color-td border-right" colspan="2">เหรียญสหรัฐฯ / บาร์เรล</th>
                                        <th class="text-center font-size-13 text-color-td border-right" colspan="4">ตลาดสิงคโปร์</th>
                                        <th class="text-center font-size-13 text-color-td border-right" colspan="2">บาท / ลิตร</th>
                                    </tr>
                                    <tr class="table-bgcolor">
                                        <th class="text-center font-size-17 table-border-color">วันที่</th>
                                        <th class="text-center font-size-17 table-border-color">ราคา Dubai</th>
                                        <th class="text-center font-size-17 table-border-color">ส่วนต่างราคาในสัปดาห์</th>
                                        <th class="text-center font-size-17 table-border-color">ราคาน้ำมันดีเซล 0.05 %s</th>
                                        <th class="text-center font-size-17 table-border-color">ส่วนต่างราคาในสัปดาห์</th>
                                        <th class="text-center font-size-17 table-border-color">ราคาน้ำมันดีเซล 0.001 %s</th>
                                        <th class="text-center font-size-17 table-border-color">ส่วนต่างราคาในสัปดาห์</th>
                                        <th class="text-center font-size-17 table-border-color">ราคาขายปลีกดีเซล</th>
                                        <th class="text-center font-size-17 table-border-color">ส่วนต่างราคาในสัปดาห์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center table-bordered border-top text-color-td">17 ม.ค. 65</td>
                                        <td class="text-center text-color-td font-weight-600 table-bordered border-top">84.900</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                        <td class="text-center text-color-td border-top">99.870</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                        <td class="text-center text-color-td table-bordered border-top">101.430</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                        <td class="text-center text-color-td font-weight-600 table-bordered border-top">29.84</td>
                                        <td class="text-center text-danger table-bordered border-top">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">18 ม.ค. 65</td>
                                        <td class="text-center text-color-td font-weight-600 table-bordered">86.550</td>
                                        <td class="text-center text-success font-weight-600 table-bgcolor-body table-bordered">+ 1.65</td>
                                        <td class="text-center text-color-td table-bordered">101.680</td>
                                        <td class="text-center text-success table-bordered">+ 1.81</td>
                                        <td class="text-center text-color-td table-bordered">103.180</td>
                                        <td class="text-center text-success table-bordered">+ 1.75</td>
                                        <td class="text-center text-color-td table-bordered">29.84</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">19 ม.ค. 65</td>
                                        <td class="text-center text-color-td table-bordered">86.340</td>
                                        <td class="text-center text-success table-bordered">+ 1.65</td>
                                        <td class="text-center text-color-td table-bordered">100.510</td>
                                        <td class="text-center text-success table-bordered">+ 0.64</td>
                                        <td class="text-center text-color-td table-bordered">102.010</td>
                                        <td class="text-center text-success table-bordered">+ 0.58</td>
                                        <td class="text-center text-color-td table-bordered">29.84</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">20 ม.ค. 65</td>
                                        <td class="text-center text-color-td table-bordered">86.295</td>
                                        <td class="text-center text-success table-bordered">+ 1.395</td>
                                        <td class="text-center text-color-td table-bordered">100.510</td>
                                        <td class="text-center text-success table-bordered">+ 0.77</td>
                                        <td class="text-center text-color-td table-bordered">101.820</td>
                                        <td class="text-center text-success table-bordered">+ 0.39</td>
                                        <td class="text-center text-color-td table-bordered">29.94</td>
                                        <td class="text-center text-success font-weight-600 table-bgcolor-body table-bordered">+ 0.10</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-weight-600 table-bordered text-color-td">21 ม.ค. 65</td>
                                        <td class="text-center text-color-td table-bordered">85.100</td>
                                        <td class="text-center text-success table-bordered">+ 0.200</td>
                                        <td class="text-center text-color-td table-bordered">99.210</td>
                                        <td class="text-center text-danger table-bordered">- 0.66</td>
                                        <td class="text-center text-color-td table-bordered">100.530</td>
                                        <td class="text-center text-danger table-bordered">- 0.90</td>
                                        <td class="text-center text-color-td table-bordered">29.94</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">22 ม.ค. 65</td>
                                        <td class="text-center text-color-td table-bordered" colspan="6">วันเสาร์</td>
                                        <td class="text-center text-color-td table-bordered">29.94</td>
                                        <td class="text-center text-danger table-bordered">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center table-bordered text-color-td">23 ม.ค. 65</td>
                                        <td class="text-center text-color-td table-bordered" colspan="6">วันอาทิตย์</td>
                                        <td class="text-center text-color-td table-bordered">29.94</td>
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