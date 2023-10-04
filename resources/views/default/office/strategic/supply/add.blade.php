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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ยุทธศาสตร์</a></li>
                            <li class="breadcrumb-item active"> LPG จัดหา</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง LPG จัดหา</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/strategic/oil/save')}}" method="POST" name="frm-save" id="frm-save">         
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> เพิ่มข้อมูล LPG จัดหา</i> </h4>

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">
                            <input type="hidden" name="input[parent_id]" id="parent_id" value="{{$pr}}">
                            <input type="hidden" name="input[group_type]" id="group_type" value="{{$t}}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob">วันที่ </label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose"  placeholder="วว/ดด/ปปปป"  name="input[oil_price_date]">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail">หมายเหตุ</label>
                                    <textarea  name="input[detail]" class="form-control"></textarea>
                                    <small id="detail" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> การจัดหาภายในประเทศ</i> 
                        </h4>
                        <?php $no = 0;?>
                        @if (!empty($domestic))
                        @foreach ($domestic as $domestics)
                        <?php 
                            $oilTypeCount = \App\Models\DataSetting::where('group_type', "domestic")->where('parent_id', $domestics['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                            $oilType = \App\Models\DataSetting::where('group_type', "domestic")->where('parent_id', $domestics['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                        ?>
                        <?php $no++;?>
                        
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">
                                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียด : {{$domestics['name']}}</i> 
                                        </h4>
                                            <?php $no = 0;?>
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>
                                                    <tr class="bg-dark text-white">
                                                        <th width="5%">ลำดับ</th>
                                                        <th>ประเภท</th>
                                                        <th style="width: 25%">จำนวน</th>
                                                    </tr>
                                                </thead>


                                                

                                                    <?php $no1 = 0;?>
                                                    @if ($oilTypeCount > 0)

                                                    <input type="hidden" name="oil_min[{{$domestics['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    <input type="hidden" name="oil_max[{{$domestics['id']}}][]" class="form-control" placeholder="" style="height: 45px;">

                                                    @foreach ($oilType as $item)
                                                    <?php
                                                        $oilTypeCount2 = \App\Models\DataSetting::where('group_type', "domestic")->where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                                                        $oilType2 = \App\Models\DataSetting::where('group_type', "domestic")->where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                    ?>
                                                    <?php $no1++;?>
                                                        @if ($oilTypeCount2 > 0)
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $no1 }}</td>
                                                                    <td class="align-middle">{{ $item['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="hidden" name="oil_min[{{$item['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$item['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                                <?php $no2 = 0;?>
                                                                @foreach ($oilType2 as $item2)
                                                                <?php $no2++;?>
                                                                    <tr>
                                                                        <td class="align-middle" align="right">{{ $no1 }}.{{ $no2 }}</td>
                                                                        <td class="align-middle">{{ $item2['name'] }}</td>
                                                                        <td class="align-middle" align="right">
                                                                            <input type="text" name="oil_min[{{$item2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                            <input type="hidden" name="oil_max[{{$item2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        </td>
                                                                    </tr> 
                                                                @endforeach
                                                            </tbody>

                                                        @else
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $no1 }}</td>
                                                                    <td class="align-middle">{{ $item['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="text" name="oil_min[{{$item['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$item['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                            </tbody>
                                                        @endif

                                                    @endforeach     

                                                    @else

                                                    <tbody>
                                                        <tr>
                                                            <td class="align-middle" align="right">1</td>
                                                            <td class="align-middle">{{ $domestics['name'] }}</td>
                                                            <td class="align-middle" align="right">
                                                                <input type="text" name="oil_min[{{$domestics['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                <input type="hidden" name="oil_max[{{$domestics['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                            </td>
                                                        </tr> 
                                                    </tbody>

                                                    @endif
                                                    
                                            </table>
                                    </div>

                                    
                                    
                                </div>
                                <!-- end col -->
                            </div>
                                
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> การนำเข้า/ส่งออก</i> 
                        </h4>
                        <?php $noP = 0;?>
                        @if (!empty($portage))
                        @foreach ($portage as $portages)
                        <?php 
                            $oilTypeCountP = \App\Models\DataSetting::where('group_type', "portage")->where('parent_id', $portages['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                            $oilTypeP = \App\Models\DataSetting::where('group_type', "portage")->where('parent_id', $portages['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                        ?>
                        <?php $noP++;?>
                        
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">
                                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียด : {{$portages['name']}}</i> 
                                        </h4>
                                            <?php $noP = 0;?>
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>
                                                    <tr class="bg-dark text-white">
                                                        <th width="5%">ลำดับ</th>
                                                        <th>ประเภท</th>
                                                        <th style="width: 25%">จำนวน</th>
                                                    </tr>
                                                </thead>


                                                

                                                    <?php $noP1 = 0;?>
                                                    @if ($oilTypeCountP > 0)

                                                    <input type="hidden" name="oil_min[{{$portages['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    <input type="hidden" name="oil_max[{{$portages['id']}}][]" class="form-control" placeholder="" style="height: 45px;">

                                                    @foreach ($oilTypeP as $itemP)
                                                    <?php
                                                        $oilTypeCountP2 = \App\Models\DataSetting::where('group_type', "portage")->where('parent_id', $itemP['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                                                        $oilTypeP2 = \App\Models\DataSetting::where('group_type', "portage")->where('parent_id', $itemP['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                    ?>
                                                    <?php $noP1++;?>
                                                        @if ($oilTypeCountP2 > 0)
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $noP1 }}</td>
                                                                    <td class="align-middle">{{ $itemP['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="hidden" name="oil_min[{{$itemP['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$itemP['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                                <?php $noP2 = 0;?>
                                                                @foreach ($oilTypeP2 as $itemP2)
                                                                <?php $noP2++;?>
                                                                    <tr>
                                                                        <td class="align-middle" align="right">{{ $noP1 }}.{{ $noP2 }}</td>
                                                                        <td class="align-middle">{{ $itemP2['name'] }}</td>
                                                                        <td class="align-middle" align="right">
                                                                            <input type="text" name="oil_min[{{$itemP2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                            <input type="hidden" name="oil_max[{{$itemP2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        </td>
                                                                    </tr> 
                                                                @endforeach
                                                            </tbody>

                                                        @else
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $noP1 }}</td>
                                                                    <td class="align-middle">{{ $itemP['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="text" name="oil_min[{{$itemP['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$itemP['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                            </tbody>
                                                        @endif

                                                    @endforeach     

                                                    @else

                                                    <tbody>
                                                        <tr>
                                                            <td class="align-middle" align="right">1</td>
                                                            <td class="align-middle">{{ $portages['name'] }}</td>
                                                            <td class="align-middle" align="right">
                                                                <input type="text" name="oil_min[{{$portages['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                <input type="hidden" name="oil_max[{{$portages['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                            </td>
                                                        </tr> 
                                                    </tbody>

                                                    @endif
                                                    
                                            </table>
                                    </div>

                                    
                                    
                                </div>
                                <!-- end col -->
                            </div>
                                
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>


            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ประเภทธุรกิจ</i> 
                        </h4>
                        <?php $no = 0;?>
                        @if (!empty($business))
                        @foreach ($business as $businesss)
                        <?php 
                            $oilTypeCountB = \App\Models\DataSetting::where('group_type', "business")->where('parent_id', $businesss['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                            $oilTypeB = \App\Models\DataSetting::where('group_type', "business")->where('parent_id', $businesss['id'])->where('is_deleted', '0')->where('is_active','1')->get(); 
                        ?>
                        <?php $no++;?>
                        
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">
                                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียด : {{$businesss['name']}}</i> 
                                        </h4>
                                            <?php $noB = 0;?>
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>
                                                    <tr class="bg-dark text-white">
                                                        <th width="5%">ลำดับ</th>
                                                        <th>ประเภท</th>
                                                        <th style="width: 25%">จำนวน</th>
                                                    </tr>
                                                </thead>


                                                

                                                    <?php $noB1 = 0;?>
                                                    @if ($oilTypeCountB > 0)

                                                    <input type="hidden" name="oil_min[{{$businesss['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                    <input type="hidden" name="oil_max[{{$businesss['id']}}][]" class="form-control" placeholder="" style="height: 45px;">

                                                    @foreach ($oilTypeB as $itemB)
                                                    <?php
                                                        $oilTypeCountB2 = \App\Models\DataSetting::where('group_type', "business")->where('parent_id', $itemB['id'])->where('is_deleted', '0')->where('is_active','1')->count();
                                                        $oilTypeB2 = \App\Models\DataSetting::where('group_type', "business")->where('parent_id', $itemB['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                    ?>
                                                    <?php $noB1++;?>
                                                        @if ($oilTypeCountB2 > 0)
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $noB1 }}</td>
                                                                    <td class="align-middle">{{ $itemB['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="hidden" name="oil_min[{{$itemB['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$itemB['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                                <?php $no2 = 0;?>
                                                                @foreach ($oilTypeB2 as $itemB2)
                                                                <?php $no2++;?>
                                                                    <tr>
                                                                        <td class="align-middle" align="right">{{ $noB1 }}.{{ $noB2 }}</td>
                                                                        <td class="align-middle">{{ $itemB2['name'] }}</td>
                                                                        <td class="align-middle" align="right">
                                                                            <input type="text" name="oil_min[{{$itemB2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                            <input type="hidden" name="oil_max[{{$itemB2['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        </td>
                                                                    </tr> 
                                                                @endforeach
                                                            </tbody>

                                                        @else
                                                            <tbody>
                                                                <tr class="bg-light">
                                                                    <td class="align-middle" align="right">{{ $noB1 }}</td>
                                                                    <td class="align-middle">{{ $itemB['name'] }}</td>
                                                                    <td class="align-middle" align="right">
                                                                        <input type="text" name="oil_min[{{$itemB['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                        <input type="hidden" name="oil_max[{{$itemB['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                    </td>
                                                                </tr> 
                                                            </tbody>
                                                        @endif

                                                    @endforeach     

                                                    @else

                                                    <tbody>
                                                        <tr>
                                                            <td class="align-middle" align="right">1</td>
                                                            <td class="align-middle">{{ $businesss['name'] }}</td>
                                                            <td class="align-middle" align="right">
                                                                <input type="text" name="oil_min[{{$businesss['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                                <input type="hidden" name="oil_max[{{$businesss['id']}}][]" class="form-control" placeholder="" style="height: 45px;">
                                                            </td>
                                                        </tr> 
                                                    </tbody>

                                                    @endif
                                                    
                                            </table>
                                    </div>

                                    
                                    
                                </div>
                                <!-- end col -->
                            </div>
                                
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="mdi mdi-database-plus"> บันทึก</i>
            </button>
            <a href="{{URL('office/strategic/oil/lists')}}/?t={{$t}}&pr={{$pr}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                "> ยกเลิก</i></a>

        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/strategic/oil/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
