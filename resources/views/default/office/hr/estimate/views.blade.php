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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">สัมภาษณ์</a></li>
                            <li class="breadcrumb-item active">ตารางการให้คะแนนสัมภาษณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตารางการให้คะแนนสัมภาษณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php $Interviews = \App\Models\UserToInterview::where('job_id', $jobid)->where('users_id', $id)->where('is_deleted', '0')->where('is_active','1')->get(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">
                            <h4 class="font-16 mb-3 text-center">ตารางการให้คะแนนสัมภาษณ์</h4>
                            <h4 class="font-16 mb-3 text-center">ชื่อ  {{$users->firstname}} {{$users->lastname}}</h4>
                            <h4 class="font-16 mb-3 text-center">ตำแหน่ง  {{$jobs->job_name}}</h4>
                            <h4 class="font-16 mb-3 text-center">วัน  <?php 
                                    
                                    if(count($Interviews) > 0){ 
                                        foreach ($Interviews as $Interview2);

                                        echo getDateShow($Interview2['checkin_date']);
                                    }
                                ?>

                            <div class="row mb-3">
                                <div class="col-12 text-right">
                                    <a href="{{URL('office/hr/estimate/print')}}/{{$id}}/{{$jobid}}/{{$workid}}">
                                        <button type="button"
                                        class="btn btn-primary">
                                        <i class="mdi mdi-file-document-box-plus-outline"> 
                                            ปริ๊นเอกสาร</i></button>
                                    </a>
                                </div>
                            </div>

                                <div class="table-responsive mt-4 mb-2">

                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width: 5%;"
                                                    class="text-color-td table-border-color custom-table"
                                                    rowspan="3">
                                                    ลำดับที่</th>
                                                <th style="width: 20%;"
                                                    class="text-color-td table-border-color custom-table"
                                                    rowspan="3">
                                                    รายชื่อผู้เข้าสัมภาษณ์</th>
                                                <th class="table-border-color custom-table hl-color-tb"
                                                    colspan="9">คะแนนเต็ม 50</th>
                                                <th class="text-color-td table-border-color custom-table"
                                                    rowspan="3">ความคิดเห็นเพิ่มเติม</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th class="text-color-td table-border-color custom-table"
                                                    colspan="4">บุคลิกภาพ (คะแนนเต็ม 20)</th>
                                                <th class="text-color-td table-border-color custom-table"
                                                    rowspan="2">ทัศนคติ <div class="pt-2"> (5) </div></th>
                                                <th class="text-color-td table-border-color custom-table"
                                                    rowspan="2">การตอบคำถาม <div class="pt-2"> (5) </div></th>
                                                <th class="text-color-td table-border-color custom-table"
                                                    rowspan="2">ความรู้เกี่ยวกับองค์กร <div class="pt-2"> (10) </div></th>
                                                <th class="text-color-td table-border-color custom-table"
                                                    rowspan="2">ความรู้ด้านวิชาชีพ <div class="pt-2"> (10) </div></th>
                                                <th class="table-border-color custom-table hl-color-tb"
                                                    rowspan="2">คะแนนรวม</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th class="text-color-td table-border-color custom-table">
                                                    การแต่งกาย <div class="pt-2"> (5) </div>
                                                </th>
                                                <th class="text-color-td table-border-color custom-table">
                                                    การพูด/น้ำเสียง <div class="pt-2"> (5) </div>
                                                </th>
                                                <th class="text-color-td table-border-color custom-table">
                                                    กริยา ท่าทาง <div class="pt-2"> (5) </div>
                                                </th>
                                                <th class="text-color-td table-border-color custom-table">
                                                    อารมณ์ <div class="pt-2"> (5) </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;?>
                                            @if (!empty($items))
                                            @foreach ($items as $item)
                                            <?php $no++;?>
                                                <tr>
                                                    <td class="border-rl">{{$no}}</td>
                                                    <th class="border-rl">
                                                        <?php

                                                            $UserDsN = \App\Models\UserInformation::where('users_id',$item['user_id'])->get();
                                                            foreach ($UserDsN as $UserDN);

                                                            echo $UserDN['firstname'].' '. $UserDN['lastname'];

                                                        ?>
                                                    </th>
                                                    <?php 
                                                    
                                                        $checknums = \App\Models\UserToEstimate::where('director_id',$item['id'])->get();
                                                        $s1 = 0;
                                                        $s2 = 0;
                                                        $s3 = 0;
                                                        $s4 = 0;
                                                        $s5 = 0;
                                                        $s6 = 0;
                                                        $s7 = 0;
                                                        $s8 = 0;
                                                        $s9 = 0;
                                                        if(count($checknums) > 0){
                                                            foreach ($checknums as $checknum);
                                                    ?>
                                                            <td class="border-rl"><?php echo $checknum['score_1'];   $s1 += $checknum['score_1'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_2'];   $s2 += $checknum['score_2'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_3'];   $s3 += $checknum['score_3'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_4'];   $s4 += $checknum['score_4'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_5'];   $s5 += $checknum['score_5'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_6'];   $s6 += $checknum['score_6'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_7'];   $s7 += $checknum['score_7'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['score_8'];   $s8 += $checknum['score_8'];?></td>
                                                            <td class="border-rl hl-color-tb" style="color: #fff !important;"><?php echo $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];    $s9 += $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];?></td>
                                                            <td class="border-rl"><?php echo $checknum['comments_name'];?></td>
                                                    <?php 
                                                        }else{
                                                    ?>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl">-</td>
                                                            <td class="border-rl hl-color-tb">-</td>
                                                            <td class="border-rl"></td>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td class="border-rl" colspan="2">รวม</td>
                                                    <td class="border-rl"><?php echo $s1;?></td>
                                                    <td class="border-rl"><?php echo $s2;?></td>
                                                    <td class="border-rl"><?php echo $s3;?></td>
                                                    <td class="border-rl"><?php echo $s4;?></td>
                                                    <td class="border-rl"><?php echo $s5;?></td>
                                                    <td class="border-rl"><?php echo $s6;?></td>
                                                    <td class="border-rl"><?php echo $s7;?></td>
                                                    <td class="border-rl"><?php echo $s8;?></td>
                                                    <td class="border-rl hl-color-tb" style="color: #fff !important;"><?php echo $s9;?></td>
                                                    <td class="border-rl"></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-row">
                                    <div class="col-auto">
                                        <h6 class="font-14 mb-2 mr-2 text-danger">*หมายเหตุ :
                                        </h6>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="font-14 mb-2">โปรดส่งคืนกลุ่มงานบริหารกลาง สำนักบริหารการเงินและบริหารองค์กร เพื่อสรุปผลคะแนน 
                                        </h6>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>

                
            </div>

        </div>
        <!-- end col -->

        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/estimate')}}/{{$id}}/{{$jobid}}/{{$workid}}"></div>

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


    $(function() {

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
                    required: "กรุณากรอก"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });
    });
</script>

<script>
    $(function() {

        $(document).on("change", "#category_id", function() {
            var _itemValue = $(this).val();
            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=category&id=" + _itemValue;

            $("#durable_number").html('<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;">');
            $.get(_url, function(data) {
                $("#typedata_id").html(data.elem_html);
            }, "json");
        });

        $(document).on("change", "#typedata_id", function() {
            var _itemValue = $(this).val();

            var _institutionid = $("#institution_id").val();

            var _url = $("#base-url-api").attr("data-url") + "/office/durable/get/category/?t=typedata&id=" + _itemValue + '&institutionid=' + _institutionid;

            $.get(_url, function(data) {
                $("#durable_number").html(data.elem_html);
            }, "json");
        });

        $(document).on("keyup", "#durable_price", function() {
            let _itemValue = $(this).val();

            let vat = ((_itemValue * 7) / 100).toFixed(2);

            let sum = (Number(_itemValue) + Number(vat)).toFixed(2);

            $("#durable_vat").val(vat);

            $("#durable_sum").val(sum);
        });




    });
</script>
@endsection