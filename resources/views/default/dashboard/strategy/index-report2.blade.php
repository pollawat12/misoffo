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
                                            <div class="input-group-append">
                                                <select name="chackDay" id="chackDay" class="form-control chackDay">
                                                    <?php 

                                                        $strDate = explode("-", $chackDay);

                                                        $CheckM = $strDate[1];

                                                        $CheckY = $strDate[0];
                                                    ?>

                                                    <option value="01" <?php if('01' == $CheckM){ echo 'selected'; } ?>>มกราคม</option>
                                                    <option value="02" <?php if('02' == $CheckM){ echo 'selected'; } ?>>กุมภาพันธ์</option>
                                                    <option value="03" <?php if('03' == $CheckM){ echo 'selected'; } ?>>มีนาคม</option>
                                                    <option value="04" <?php if('04' == $CheckM){ echo 'selected'; } ?>>เมษายน</option>
                                                    <option value="05" <?php if('05' == $CheckM){ echo 'selected'; } ?>>พฤษภาคม</option>
                                                    <option value="06" <?php if('06' == $CheckM){ echo 'selected'; } ?>>มิถุนายน</option>
                                                    <option value="07" <?php if('07' == $CheckM){ echo 'selected'; } ?>>กรกฎาคม</option>
                                                    <option value="08" <?php if('08' == $CheckM){ echo 'selected'; } ?>>สิงหาคม</option>
                                                    <option value="09" <?php if('09' == $CheckM){ echo 'selected'; } ?>>กันยายน</option>
                                                    <option value="10" <?php if('10' == $CheckM){ echo 'selected'; } ?>>ตุลาคม</option>
                                                    <option value="11" <?php if('11' == $CheckM){ echo 'selected'; } ?>>พฤศจิกายน</option>
                                                    <option value="12" <?php if('12' == $CheckM){ echo 'selected'; } ?>>ธันวาคม</option>
                                                </select>
                                            </div>
                                            <div class="input-group-append">

                                                <select name="chackDayNum" id="chackDayNum" class="form-control chackMon chackDay">

                                                    <?php 
                                                        $Sumdate = $CheckY + 5;
                                                        for ($z=2012; $z <= $Sumdate; $z++) { 
                                                    ?>
                                                        <option value="<?php echo $z;?>" <?php if($z == $CheckY){ echo 'selected'; } ?>><?php echo $z + 543;?></option>
                                                    <?php 

                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text table-bgcolor"><i
                                                        class="mdi mdi-calendar text-white"></i></span>
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
                            <div class="col-md-12">

                            <h4 class="header-title mb-2 font-size-18 text-center"><img class="icon-img mr-1"
                                src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">ประมาณการสภาพคล่อง กลองทุนน้ำมันเชื้อเพลิง : กุมภาพันธ์ 2565</h4>
                            <div class="table-responsive mb-2">
                                    <table class="table m-0 table-colored-bordered table-border-color">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="header-title ml-2r mb-2 font-size-14 text-center text-color-td">
                                                </th>
                                                <th
                                                    class="header-title ml-2r mb-2 font-size-14 text-center text-color-td">
                                                    <div>
                                                        ปริมาณ
                                                    </div>
                                                    <div>
                                                        น้ำมัน : ล้านลิตร / วัน
                                                    </div>
                                                    <div>
                                                        LPG : พันตัน / วัน
                                                    </div>
                                                </th>
                                                <th
                                                    class="header-title ml-2r mb-2 font-size-14 text-center text-color-td">
                                                    <div>
                                                        อัตราเงินส่งเข้า
                                                    </div>
                                                    <div>
                                                        กองทุนน้ำมันฯ
                                                    </div>
                                                    <div>
                                                        ( บาท / ลิตร&กก.)
                                                    </div>
                                                </th>
                                                <th
                                                    class="header-title ml-2r mb-2 font-size-14 text-center text-color-td">
                                                    <div>
                                                        รายรับ / รายจ่าย
                                                    </div>
                                                    <div>
                                                        กองทุนน้ำมันฯ
                                                    </div>
                                                    <div>
                                                        ( ล้านบาท / วัน )
                                                    </div>
                                                </th>
                                                <th
                                                    class="header-title ml-2r mb-2 font-size-14 text-center text-color-td">
                                                    <div>
                                                        รายรับ / รายจ่าย
                                                    </div>
                                                    <div>
                                                        กองทุนน้ำมันฯ
                                                    </div>
                                                    <div>
                                                        ( ล้านบาท / เดือน )
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr class="table-bgcolor">
                                                <th class="text-center font-size-17" colspan="5">กองทุนน้ำมันฯ</th>
                                            </tr>
                                        @if ($price_oil)
                                        @foreach ($price_oil as $arr)
                                        <tr>
                                            <td>{{ $arr['label'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr['s_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr['e_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr['d_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr['f_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมเบนซิน</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">0.33</th>
                                            <th class="text-center text-color-td">10</th>
                                        </tr>
                                        @if ($price_oil2)
                                        @foreach ($price_oil2 as $arr2)
                                        <tr>
                                            <td>{{ $arr2['label'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr2['s_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr2['e_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr2['d_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr2['f_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมดีเซล</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">-26.08</th>
                                            <th class="text-center text-color-td">-782</th>
                                        </tr>
                                        @if ($price_oil3)
                                        @foreach ($price_oil3 as $arr3)
                                        <tr>
                                            <td>{{ $arr3['label'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr3['s_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr3['e_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr3['d_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr3['f_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมรายรับ</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">44.13</th>
                                            <th class="text-center text-color-td">1,324</th>
                                        </tr>
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมรายจ่าย</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">-69.58</th>
                                            <th class="text-center text-color-td">-2,087</th>
                                        </tr>
                                        <tr class="table-bgcolor-sum">
                                            <th class="text-center text-color-td font-size-17">สุทธิ
                                                กลุ่มน้ำมันฯ</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">-25.45</th>
                                            <th class="text-center text-color-td">-764</th>
                                        </tr>
                                        <tr class="table-bgcolor border-top-1 border-bottom">
                                            <th colspan="5" class="text-center font-size-17 text-white font-weight-600">
                                            กลุ่ม ก๊าซ LPG
                                            </th>
                                        </tr>
                                        @if ($price_oil4)
                                        @foreach ($price_oil4 as $arr4)
                                        <tr>
                                            <td>{{ $arr4['label'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr4['s_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr4['e_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr4['d_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr4['f_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมการจัดหา LPG Pool</th>
                                            <th colspan="2"></th>
                                            <td class="text-right">57.94</td>
                                            <td class="text-right">1,738</td>
                                        </tr>
                                        @if ($price_oil5)
                                        @foreach ($price_oil5 as $arr5)
                                        <tr>
                                            <td>{{ $arr5['label'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr5['s_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr5['e_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr5['d_price'] }}</td>
                                            <td class="text-center text-color-td">{{ $arr5['f_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr class="table-bgcolor-body border-top border-bottom">
                                            <td class="text-center text-color-td">รวมการจำหน่าย LPG </td>
                                            <th colspan="2"></th>
                                            <td class="text-center text-color-td">-103.27</td>
                                            <td class="text-center text-color-td">-3,098</td>
                                        </tr>
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมรายรับ</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-color-td">57.96</th>
                                            <th class="text-center text-color-td">1,739</th>
                                        </tr>
                                        <tr class="table-bgcolor-body">
                                            <th class="text-center text-color-td">รวมรายจ่าย</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-danger">-103.29</th>
                                            <th class="text-center text-danger">-3,099</th>
                                        </tr>
                                        <tr class="table-bgcolor-sum">
                                            <th colspan="3" class="text-center text-color-td font-size-17">
                                            สุทธิ กลุ่ม ก๊าซ LPG
                                            </th>
                                            <th class="text-center text-danger font-size-17">0.30</th>
                                            <th class="text-center text-danger font-size-17">101.25</th>
                                        </tr>
                                        <tr class="table-bgcolor border-top-1 border-bottom">
                                                <th class="text-center font-size-17 text-white font-weight-600" colspan="5">
                                                กองทุนน้ำมัน
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-color-td">รวมรายรับ</td>
                                            <td class="text-center text-color-td">102.09</td>
                                            <td class="text-center text-color-td">3,063</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-color-td">รวมรายจ่าย</td>
                                            <td class="text-center text-danger">-172.87</td>
                                            <td class="text-center text-danger">-5,186</td>
                                        </tr>
                                        <tr class="table-bgcolor-sum">
                                            <th class="text-center text-color-td font-size-17">
                                                สภาพคล่องสุทธิของกองทุนฯ</th>
                                            <th colspan="2"></th>
                                            <th class="text-center text-danger font-size-17">-70.78</th>
                                            <th class="text-center text-danger font-size-17">-2,123</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-12" style="height: 30px;">

                            </div> <!-- end col -->

                        </div>  <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">

                            </div> <!-- end col -->
                        </div>  <!-- end row -->
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