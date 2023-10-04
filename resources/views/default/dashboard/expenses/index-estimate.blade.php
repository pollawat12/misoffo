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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายงานการเงิน</a>
                            </li>
                            <li class="breadcrumb-item active">ประเมินผลความคุ้มค่าฯ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ประเมินผลความคุ้มค่าฯ</h4>
                </div>
            </div>
        </div>   
        <!-- end page title --> 
        <form method="POST" id="frm-save" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="pr" value="{{$pr}}">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card-box">
                        <div class="row">

                            <div class="col-md-12">
                                <h4 class="header-title mb-1 font-size-18"><img class="icon-img mr-1"
                                        src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">รายงานประเมินผลความคุ้มค่าฯ</h4>
                                <div class="header-title ml-2r mb-2 font-size-14">{{getDateFormatToInputThai($info->asset_date)}}</div>

                                <div class="table-responsive">

                                    <table class="table mb-0 table-colored-bordered table-border-color">
                                        <thead>
                                            <tr class="table-bgcolor">
                                                <th class="text-center" style="width: 35%;">เกณฑ์วัดผลการดำเนินงาน</th>
                                                <th class="text-center" style="width: 15%;">น้ำหนัก (ร้อยละ)</th>
                                                <th class="text-center" style="width: 15%;">คะแนนที่ได้</th>
                                                <th class="text-center" style="width: 15%;">คะแนนถ่วงน้ำหนัก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        $no = 0;
                                        $sum1 = 0;
                                        $sum2 = 0;
                                        ?>
                                        @if ($institution)
                                        @foreach ($institution as $item)
                                        <?php $no++;?>
                                        <?php $FundDetail = \App\Models\AssetEstimateDetail::where('asset_id', $info->id)->where('type_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->first();?>
                                        <tr style="background-color: #c0ecff;">
                                            <td>{{$item['name']}}</td>
                                            <td class="text-center"><?php if(isset($FundDetail)){ $sum1 += $FundDetail->value_weight; echo $FundDetail->value_weight; }?></td>
                                            <td class="text-center"><?php if(isset($FundDetail)){ echo $FundDetail->value_num; }?></td>
                                            <td class="text-center"><?php if(isset($FundDetail)){ echo $FundDetail->sum_total; }?></td>
                                        </tr>
                                        <?php   
                                        $no1 = 1;          
                                        $valdetails = \App\Models\DataSetting::where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                        if (!empty($valdetails)){
                                            foreach ($valdetails as $valdetail){

                                                $FundDetail1 = \App\Models\AssetEstimateDetail::where('asset_id', $info->id)->where('type_id', $valdetail['id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                        ?>
                                                    <tr>
                                                        <td>{{$no}}.{{$no1}} {{$valdetail['name']}}</td>
                                                        <td class="text-center"><?php if(isset($FundDetail1)){ echo $FundDetail1->value_weight; }?></td>
                                                        <td class="text-center"><?php if(isset($FundDetail1)){ echo $FundDetail1->value_num; }?></td>
                                                        <td class="text-center"><?php if(isset($FundDetail1)){ $sum2 += $FundDetail1->sum_total; echo $FundDetail1->sum_total; }?></td>
                                                    </tr>

                                        <?php 
                                            $no1++;}
                                        }        
                                        ?>

                                        @endforeach
                                        @endif
                                            <tr class="table-bgcolor">
                                                <th class="text-center" style="width: 35%;"></th>
                                                <th class="text-center" style="width: 15%;">{{$sum1}}</th>
                                                <th class="text-center" style="width: 15%;">คะแนนรวม</th>
                                                <th class="text-center" style="width: 15%;">{{$sum2}}</th>
                                            </tr>
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