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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ</a></li>
                            <li class="breadcrumb-item active">ทะเบียนคุมทรัพย์สิน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ทะเบียนคุมทรัพย์สิน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php foreach ($items as $item); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL('office/durable/print')}}/{{$id}}/?t=durable&pr=0" target="_blank">
                                <button type="button"
                                    class="btn btn-primary btn-soft-primary waves-effect waves-light float-end mb-3">
                                    <i class="fas fa-solid fa-print" style="font-size: 18px !important;"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="p-4">
                            <h4 class="font-16 mb-3 text-center">บันทึกทะเบียนคุมทรัพย์สิน999</h4>
                            <h6 class="font-14 mb-3 text-right color-text">ส่วนราชการ
                                <span class="ml-2 position-relative">
                                    ............................................
                                    <p class="text-float">{{$item['projects']}}</p>
                                </span>
                            </h6>
                            <h6 class="font-14 mb-3 text-right color-text">หน่วยงาน
                                <span class="ml-2 position-relative">
                                    ............................................
                                    <p class="text-float">{{$item['borrow_institution']}}</p>
                                </span>
                            </h6>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2 mr-2">ประเภท
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float">{{$item['category']}}</p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2">รหัส 
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float">{{$item['durable_number']}}</p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2">ลักษณะ/คุณสมบัติ 
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2">รุ่น/แบบ 
                                        <span class="ml-2 position-relative">
                                            ..................................................................................
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2 mr-2">สถานที่ตั้ง/หน่วยงานที่รับผิดชอบ 
                                        <span class="text-ml-25 position-relative">
                                            .......................................................................................................................................................
                                            <p class="text-float">{{$item['borrow_institution']}}</p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2 mr-2">ชื่อผู้ขาย/ผู้รับจ้าง/ผู้บริจาค 
                                        <span class="text-ml-25 position-relative">
                                            .....................................................................................................................................................
                                            <p class="text-float">{{$item['durable_company']}}</p>
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2 mr-2">ที่อยู่ 
                                        <span class="text-ml-25 position-relative">
                                            .................................................................................................................................................................................................................................................................................
                                            <p class="text-float">{{$item['borrow_location']}}</p>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <h6 class="font-14 mb-2 mr-2">โทรศัพท์ 
                                        <span class="text-ml-25 position-relative">
                                            .........................................................................................................
                                            <p class="text-float"></p>
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-auto mt-2 mr-3">
                                    <label class="label-check">
                                        ประเภทเงิน
                                    </label>
                                </div>
                                @if (count($money) > 0)
                                    @foreach($money as $keyMoney => $valMoney)
                                        <div class="col-auto mr-3">
                                            <div class="form-group mt-2">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox{{$valMoney->id}}" type="checkbox" @if($valMoney->id == $item['borrow_institution']) checked @endif> 
                                                    <label for="checkbox{{$valMoney->id}}" class="label-check">
                                                        {{$valMoney->name}}
                                                        @if($valMoney->id == 376)
                                                            <span class="text-ml-25 position-relative">
                                                                ............................................................................................................................................................................................
                                                                <p class="text-float"></p>
                                                            </span>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="col-auto mr-3">
                                    <label class="label-check">
                                        วิธัการได้มา
                                    </label>
                                </div>

                                @if (count($means) > 0)
                                    @foreach($means as $keyMeans => $valMeans)
                                        <div class="col-auto mr-3">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox{{$valMeans->id}}" type="checkbox" @if($valMeans->id == $item['borrow_institution']) checked @endif>
                                                    <label for="checkbox{{$valMeans->id}}" class="label-check">
                                                        {{$valMeans->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                            </div>
                           
                            <div class="table-responsive mt-2">

                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-color-td table-border-color custom-table">วัน
                                                เดือน ปี</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                ที่เอกสาร</th>
                                            <th class="text-color-td table-border-color custom-table">รานการ
                                            </th>
                                            <th class="text-color-td table-border-color custom-table">
                                                จำนวนหน่วย</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                ราคาต่อหน่วย/ชุด/กลุ่ม</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                มูลค่ารวม</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                อายุใช้งาน</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                อัตราค่าเสื่อมราคา</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                ค่าเสื่อมราคาประจำปี</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                ค่าเสื่อมราคาสะสม</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                มูลค่าสุมธิ</th>
                                            <th class="text-color-td table-border-color custom-table">
                                                หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            list($yyyy, $mm, $dd) = explode('-', $info->durable_received_date);

                                            $yearall = $yyyy + $info->durable_year;

                                            
                                            for ($i=$yyyy; $i <= $yearall; $i++) { 
                                                $z = $i + 0 - $yyyy;     
                                                $numz = $z;

                                                $numz++;
                                        ?>
                                                <!-- <tr>
                                                    <td><?php echo $z.'.';?></td>
                                                    <td>{{$dd}}/{{$mm}}/<?php echo $i + 543;?></td>
                                                    <td>{{number_format($info->durable_price,2,'.',',')}}</td>
                                                    <td>{{$info->durable_year}}</td>
                                                    <td>{{$info->durable_depreciation_rate}}</td>
                                                    <td>366</td>
                                                    <td><?php if($z == 1){ echo 0.00; }else{ echo number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * ($z-1))),2,'.',','); }?></td>
                                                    <td><?php if($z == 1){ echo number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * $z)),2,'.',','); }else{ echo number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * ($numz-$z))),2,'.',','); }?></td>
                                                    <td>{{number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * $z)),2,'.',',')}}</td>
                                                    <td><?php $sum = $info->durable_price - $info->durable_price * (($info->durable_depreciation_rate /100) * $z);  echo number_format($sum,2,'.',','); ?></td>
                                                    <td>กพน.</td>
                                                </tr> -->

                                                <tr>
                                                    <td class="border-rl border-bottom">{{$dd}}/{{$mm}}/<?php echo $i + 543;?></td>
                                                    <td class="border-rl border-bottom">{{$item['purchase']}}</td>
                                                    <td class="border-rl border-bottom">{{$item['durable_name']}}</td>
                                                    <td class="border-rl border-bottom">{{$info->durable_num}}</td>
                                                    <td class="border-rl border-bottom">{{number_format($info->durable_price,2,'.',',')}}</td>
                                                    <td class="border-rl border-bottom">{{number_format($info->durable_price * $info->durable_num,2,'.',',')}}</td>
                                                    <td class="border-rl border-bottom">{{$info->durable_year}}</td>
                                                    <td class="border-rl border-bottom">{{$info->durable_depreciation_rate}}</td>
                                                    <td class="border-rl border-bottom"><?php if($z == 0){ echo '0.00';}elseif($z == 1){ echo number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * $z)),2,'.',','); }else{ echo number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * ($numz-$z))),2,'.',','); }?> <??></td>
                                                    <td class="border-rl border-bottom">
                                                        {{number_format(($info->durable_price * (($info->durable_depreciation_rate /100) * $z)),2,'.',',')}}
                                                    </td>
                                                    <td class="border-rl border-bottom"><?php $sum = $info->durable_price - $info->durable_price * (($info->durable_depreciation_rate /100) * $z);  echo number_format($sum,2,'.',','); ?></td>
                                                    <td class="border-rl border-bottom"></td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a href="{{URL('office/durable/lists')}}?t=durable&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                </div>
            </div>
                
        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
