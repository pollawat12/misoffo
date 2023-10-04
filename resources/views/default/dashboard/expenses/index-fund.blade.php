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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายได้ของเงินกองทุน</a>
                            </li>
                            <li class="breadcrumb-item active">รายได้ของเงินกองทุน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายได้ของเงินกองทุน</h4>
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
                                        src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">รายงานรายได้ของเงินกองทุน</h4>
                                <div class="header-title ml-2r mb-2 font-size-14"></div>

                                <div class="table-responsive">

                                    <table class="table mb-0 table-colored-bordered table-border-color">
                                        <thead>
                                            <tr class="table-bgcolor">
                                                <th class="text-center" style="width: 35%;">รายงาน</th>
                                                @if ($info)
                                                    @foreach ($info as $infos)
                                                        <th class="text-center" style="width: 15%;">{{getDateMonthTH($infos->asset_date)}}</th>
                                                    @endforeach
                                                 @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $no = 0;
                                        ?>
                                        @if ($institution)
                                        @foreach ($institution as $item)
                                        <?php $no++;?>
                                        <tr>
                                            <td>{{$item['name']}}</td>
                                            @if ($info)
                                                @foreach ($info as $infos1)
                                                    <td class="text-center"></td>
                                                @endforeach
                                            @endif
                                        </tr>
                                            <?php             
                                                $valdetails = \App\Models\DataSetting::where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                if (!empty($valdetails)){
                                                    foreach ($valdetails as $valdetail){

                                                        // $FundDetail1 = \App\Models\AssetFundDetail::where('asset_id', $id)->where('type_id', $valdetail['id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                            ?>
                                                    <tr>
                                                        <td>{{$valdetail['name']}}</td>
                                                        @if ($info)
                                                            @foreach ($info as $infos2)
                                                                <td class="text-center"></td>
                                                            @endforeach
                                                        @endif
                                                    </tr>

                                                        <?php             
                                                            // $valassets = \App\Models\AssetMonthDetail::where('asset_id', $id)->where('parent_id', $valdetail['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            // if (!empty($valdetails)){
                                                            //     foreach ($valassets as $valasset){

                                                                    // $FundDetail2 = \App\Models\AssetFundDetail::where('asset_id', $id)->where('type_id', $valasset['id'])->where('is_deleted', '0')->where('is_active','1')->first();

                                                                    // $Setting = \App\Models\DataSetting::find((int) $valasset['type_id']);
                                                        ?>


                                                <?php 
                                                    //     }
                                                    // }        
                                                ?>
                                            <?php 
                                                    }
                                                }        
                                            ?>
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