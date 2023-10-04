@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{url('assets/default/css/jquery.stickytable.min.css')}}">

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ยุทธศาสตร์</a></li>
                            <li class="breadcrumb-item active"> สถานการณ์ LPG</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง สถานการณ์ LPG</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/strategic/oil/save')}}" method="POST" name="frm-save" id="frm-save">        

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล สถานการณ์ LPG</i> </h4>

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">
                            <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                            <input type="hidden" name="input[group_type]" id="group_type" value="{{$t}}">


                            <div class="no-padding sticky-table sticky-rtl-cells">
                                <table id="datatable" class="table table-bordered" style="width: 300%">

                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th rowspan="3" style="width: 1%">Date</th>
                                            @if (!empty($oilGroup))
                                            @foreach ($oilGroup as $oilGroups)
                                            <?php 
                                                $oilTypes = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilGroups['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                $num = 0;
                                                foreach ($oilTypes as $oilType){

                                                    $oilTypeCount = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilType['id'])->where('is_deleted', '0')->where('is_active','1')->count();

                                                    if($oilTypeCount > 0){

                                                        $num += $oilTypeCount;

                                                    }else{

                                                        $num += 1;
                                                    }

                                                }
                                            ?>
                                                <th colspan="{{$num}}" style="width: 2%">{{ $oilGroups['name'] }}</th>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            @if (!empty($oilGroup))
                                            @foreach ($oilGroup as $oilGroups1)
                                            <?php 
                                                $oilTypes1 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilGroups1['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                if(count($oilTypes1) > 0){
                                            ?>
                                                @foreach ($oilTypes1 as $oilType1)
                                                <?php
                                                     $oilTypeCount1 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilType1['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                                                ?>
                                                    <th colspan="{{$oilTypeCount1}}" style="width: 1%">{{ $oilType1['name'] }}</th>
                                                @endforeach
                                            <?php
                                                }else{
                                            ?>
                                                    <th rowspan="2" style="width: 1%"></th>
                                            <?php
                                                }
                                            ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            @if (!empty($oilGroup))
                                            @foreach ($oilGroup as $oilGroups2)
                                            <?php 
                                                $oilTypes2 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilGroups2['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                            ?>
                                                @foreach ($oilTypes2 as $oilType2)
                                                <?php
                                                     $oilTypesDs2 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilType2['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                     if(count($oilTypesDs2) > 0){
                                                     foreach ($oilTypesDs2 as $oilTypesD2){
                                                ?>
                                                    <th style="width: 1%">{{ $oilTypesD2['name'] }}</th>
                                                <?php } }else { ?>
                                                    <th style="width: 1%"></th>
                                                <?php } ?>
                                                @endforeach
                                            @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if (!empty($infos))
                                        @foreach ($infos as $item)
                                        <tr>
                                            <td class="align-middle">{{getDateShow($item->oil_price_date)}}</td>
                                            @if (!empty($oilGroup))
                                            @foreach ($oilGroup as $oilGroups3)
                                            <?php 
                                                $oilTypes3 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilGroups3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                if(count($oilTypes3) > 0){
                                            ?>
                                                @foreach ($oilTypes3 as $oilType3)
                                                <?php
                                                     $oilTypesDs3 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilType3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                     if(count($oilTypesDs3) > 0){
                                                     foreach ($oilTypesDs3 as $oilTypesD3){

                                                        $oilSum3 = \App\Models\OilPriceDetail::where('oil_price_id', $item->id)->where('oil_type', $oilTypesD3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                        foreach ($oilSum3 as $itemSum3);
                                                ?>
                                                    <th style="width: 1%">{{ $itemSum3['oil_min'] }}</th>
                                                <?php } }else { 
                                                        $oilSum3 = \App\Models\OilPriceDetail::where('oil_price_id', $item->id)->where('oil_type', $oilType3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                        foreach ($oilSum3 as $itemSum3);
                                                ?>
                                                    <th style="width: 1%">{{ $itemSum3['oil_min'] }}</th>
                                                <?php } ?>
                                                @endforeach
                                                <?php
                                                    }else{

                                                        $oilSum3 = \App\Models\OilPriceDetail::where('oil_price_id', $item->id)->where('oil_type', $oilGroups3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                        foreach ($oilSum3 as $itemSum3);
                                                ?>
                                                        <th style="width: 1%">{{ $itemSum3['oil_min'] }}</th>
                                                <?php
                                                    }
                                                ?>
                                            @endforeach
                                            @endif   
                                        </tr> 
                                        @endforeach
                                    @endif   
                                    <tr>
                                        <td class="align-middle">

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[oil_price_date]">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->

                                        </td>
                                        @if (!empty($oilGroup))
                                        @foreach ($oilGroup as $oilGroups4)
                                        <?php 
                                            $oilTypes4 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilGroups4['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                            if(count($oilTypes4) > 0){
                                        ?>

                                            <input type="hidden" name="oil_min[{{$oilGroups4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                            <input type="hidden" name="oil_max[{{$oilGroups4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">

                                            @foreach ($oilTypes4 as $oilType4)
                                            <?php
                                                    $oilTypesDs4 = \App\Models\DataSetting::where('group_type', "situation")->where('parent_id', $oilType4['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                    if(count($oilTypesDs4) > 0){
                                                    foreach ($oilTypesDs4 as $oilTypesD4){
                                            ?>
                                                <input type="hidden" name="oil_min[{{$oilTypesD4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                <input type="hidden" name="oil_max[{{$oilTypesD4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                <th style="width: 1%">
                                                        <input type="text" name="oil_min[{{$oilTypesD4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                        <input type="hidden" name="oil_max[{{$oilTypesD4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                </th>
                                            <?php } }else { ?>
                                                <th style="width: 1%">
                                                    <input type="text" name="oil_min[{{$oilType4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    <input type="hidden" name="oil_max[{{$oilType4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                </th>
                                            <?php } ?>
                                            @endforeach
                                            <?php
                                                }else{
                                            ?>
                                                    <th style="width: 1%">
                                                        <input type="text" name="oil_min[{{$oilGroups4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                        <input type="hidden" name="oil_max[{{$oilGroups4['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    </th>
                                            <?php
                                                }
                                            ?>
                                        @endforeach
                                        @endif
                                    </tr>       
                                    </tbody>
                                </table>
                            </div>
                    </div>

                    
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-database-plus"> บันทึก</i>
                    </button>
                    <a href="{{URL('office/strategic/oil/lists')}}/?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                        "> ยกเลิก</i></a>
                </div>
                <!-- end col -->
            </div>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/strategic/oil/add')}}/?t={{$t}}&pr={{$pr}}"></div>
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
                    required: "กรุณากรอกประเภทค่าใช้จ่าย"
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
