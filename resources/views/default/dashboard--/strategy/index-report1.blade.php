@extends('default.layouts.main')


@section('css')
<!-- Plugin css -->

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
                            <li class="breadcrumb-item active">สภาพคล่อง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายงานประมาณการสภาพคล่อง</h4>
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
                        <div class="row">

                            <div class="col-md-6">
                                <h4 class="header-title mb-1 font-size-18"><img class="icon-img mr-1"
                                        src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">รายงานราคาเช้า</h4>
                                <div class="header-title ml-2r mb-2 font-size-14">{{getDateFormatToInputThai($chackDay)}}</div>

                                <div class="table-responsive">

                                    <table class="table mb-0 table-colored-bordered table-border-color">
                                        <thead>
                                            <tr class="table-bgcolor">
                                                <th class="text-right" style="width: 35%;"></th>
                                                <th class="text-right" style="width: 15%;">ราคาเมื่อวาน</th>
                                                <th class="text-right" style="width: 15%;">ราคาวันนี้</th>
                                                <th class="text-right" style="width: 15%;">เปลี่ยนแปลง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($price)
                                        @foreach ($price as $arr)
                                        <tr>
                                            <td>{{ $arr['label'] }}</td>
                                            <td class="text-right">{{ $arr['s_price'] }}</td>
                                            <td class="text-right">{{ $arr['e_price'] }}</td>
                                            <td class="text-right {{ $arr['checktext'] }}">{{ $arr['diff_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h4 class="header-title mb-1 font-size-18"><img class="icon-img mr-1"
                                            src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">รายงานราคา ณ สิ้นวัน
                                    </h4>
                                    <div class="header-title ml-2r mb-2 font-size-14">{{getDateFormatToInputThai($chackDay)}}</div>
                                    <table class="table m-0 table-colored-bordered table-border-color">
                                        <thead>
                                            <tr class="table-bgcolor">
                                                <th class="text-right" style="width: 35%;"></th>
                                                <th class="text-right" style="width: 15%;">ราคาเมื่อวาน</th>
                                                <th class="text-right" style="width: 15%;">ราคาวันนี้</th>
                                                <th class="text-right" style="width: 15%;">เปลี่ยนแปลง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($price_end)
                                            @foreach ($price_end as $arr_end)
                                            <tr>
                                                <td>{{ $arr_end['label'] }}</td>
                                                <td class="text-right">{{ $arr_end['s_price'] }}</td>
                                                <td class="text-right">{{ $arr_end['e_price'] }}</td>
                                                <td class="text-right {{ $arr_end['checktext'] }}">{{ $arr_end['diff_price'] }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->

                        </div>  <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">

                            </div> <!-- end col -->
                        </div>  <!-- end row -->
                    </div>

                    <div class="col-lg-12">
                            <div class="card-box">
                                <h4 class="header-title mb-1 font-size-18 text-center"><img class="icon-img mr-1"
                                        src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">รายงานราคาครึ่งวัน
                                </h4>
                                <div class="header-title ml-2r mb-2 font-size-14 text-center">วันที่ 31 มกราคม 2565
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="header-title ml-2r mb-2 font-size-14 text-center">เวลา 11.00 น.
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-border-color">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-color-td">ดูไบ</th>
                                                        <td class="text-right text-color-td">86.74</td>
                                                        <td class="text-right text-danger">(- 1.03)</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">เบรนท์</th>
                                                        <td class="text-right text-color-td">89.74</td>
                                                        <td class="text-right text-danger">(- 0.33)</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">WTI</th>
                                                        <td class="text-right text-color-td">88.14</td>
                                                        <td class="text-right text-success">+ 1.53</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">HSD</th>
                                                        <td class="text-right text-color-td">105.03</td>
                                                        <td class="text-right text-success">+ 1.65</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="header-title ml-2r mb-2 font-size-14 text-center">เวลา 15.00 น.
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-border-color">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-color-td">ดูไบ</th>
                                                        <td class="text-right text-color-td">86.74</td>
                                                        <td class="text-right text-danger">(- 1.03)</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">เบรนท์</th>
                                                        <td class="text-right text-color-td">89.74</td>
                                                        <td class="text-right text-danger">(- 0.33)</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">WTI</th>
                                                        <td class="text-right text-color-td">88.14</td>
                                                        <td class="text-right text-success">+ 1.53</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-color-td">HSD</th>
                                                        <td class="text-right text-color-td">105.03</td>
                                                        <td class="text-right text-success">+ 1.65</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                </div>
                <!-- end col-12 -->
            </div> <!-- end row -->
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




<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });


    $(document).on("change", ".chackDay", function(){

        var urlRedirect = $("#url-redirect-back").attr("data-url");

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