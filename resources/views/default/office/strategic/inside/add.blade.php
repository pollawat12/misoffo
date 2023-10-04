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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ราคาปิโตรเลียม</a></li>
                            <li class="breadcrumb-item active"> PLATT'S CRUDE OIL PRICES</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง PLATT'S CRUDE OIL PRICES</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/strategic/oil/save')}}" method="POST" name="frm-save" id="frm-save">        

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล PLATT'S CRUDE OIL PRICES</i> </h4>

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">
                            <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                            <input type="hidden" name="input[group_type]" id="group_type" value="{{$t}}">
                            <div class="col-12 text-right">
                                <label for="dob" class="text-right">UNIT:บาท/BBL</label>
                            </div>

                            <div class="no-padding sticky-table sticky-rtl-cells table-responsive sroll-box">
                                <table id="datatable" class="table table-bordered" style="width: 400%">

                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th rowspan="3" style="width: 1%!important;" class="align-middle">Date</th>
                                            @if (!empty($oilCategory))
                                            @foreach ($oilCategory as $Category)
                                            <?php 
                                                $oilType = \App\Models\DataSetting::where('group_type', "oilType")->where('data_value', $Category['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                                $numOilType = count($oilType);
                                            ?>
                                                <th colspan="{{$numOilType * 2}}" style="width: 2%" class="align-middle text-center">{{ $Category['name'] }}</th>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            @if (!empty($oilCategory))
                                            @foreach ($oilCategory as $Category1)
                                            <?php 
                                                $oilType1 = \App\Models\DataSetting::where('group_type', "oilType")->where('data_value', $Category1['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                            ?>
                                                @if (!empty($oilType1))
                                                @foreach ($oilType1 as $item1)
                                                    <th colspan="2" style="width: 2%" class="align-middle text-center">{{ $item1['name'] }}</th>
                                                @endforeach
                                                @endif  
                                            @endforeach
                                            @endif    
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            @if (!empty($oilCategory))
                                            @foreach ($oilCategory as $Category2)
                                            <?php 
                                                $oilType2 = \App\Models\DataSetting::where('group_type', "oilType")->where('data_value', $Category2['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                            ?>
                                                @if (!empty($oilType2))
                                                @foreach ($oilType2 as $item2)
                                                    <th style="width: 1%" class="align-middle">MIN</th>
                                                    <th style="width: 1%" class="align-middle">MAX</th>
                                                @endforeach
                                                @endif  
                                            @endforeach
                                            @endif    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($infos))
                                            @foreach ($infos as $item)
                                            <tr>
                                                <td class="align-middle">{{getDateShow($item->oil_price_date)}}</td>
                                                <?php
                                                
                                                    $oilPriceDetail = \App\Models\OilPriceDetail::where('oil_price_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();
                                                    if (!empty($oilPriceDetail)){
                                                        foreach ($oilPriceDetail as $oilPriceDetails){
                                                    ?>
                                                            <td class="align-middle">{{$oilPriceDetails['oil_min']}}</td>
                                                            <td class="align-middle">{{$oilPriceDetails['oil_max']}}</td>
                                                    <?php
                                                        }

                                                    }
                                                ?>
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
                                            @if (!empty($oilCategory))
                                            @foreach ($oilCategory as $Category3)
                                            <?php 
                                                $oilType3 = \App\Models\DataSetting::where('group_type', "oilType")->where('data_value', $Category3['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                                            ?>
                                                @if (!empty($oilType3))
                                                @foreach ($oilType3 as $item3)
                                                    <td class="align-middle" align="right">
                                                        <input type="text" name="oil_min[{{$item3['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="oil_max[{{$item3['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    </td>
                                                @endforeach
                                                @endif  
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
