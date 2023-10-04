@extends('default.layouts.mainPrint')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection


@section('content')
<div class="content">
    <?php $Interviews = \App\Models\UserToInterview::where('job_id', $jobid)->where('users_id', $id)->where('is_deleted', '0')->where('is_active','1')->get(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="media-body">
                <div class="p-4">
                    <h4 class="font-16 mb-3 text-center">ตารางการให้คะแนนสัมภาษณ์</h4>
                    <h4 class="font-16 mb-3 text-center">ตำแหน่ง
                    {{$jobs->job_name}}</h4>
                    <h4 class="font-16 mb-3 text-center">วัน
                        <?php 
                                    
                            if(count($Interviews) > 0){ 
                                foreach ($Interviews as $Interview2);

                                echo getDateShow($Interview2['checkin_date']);
                            }
                        ?>

                        <div class="table-responsive mt-4 mb-2">

                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 5%;" class="text-color-td table-border-color custom-table"
                                            rowspan="3">
                                            ลำดับที่</th>
                                        <th style="width: 20%;"
                                            class="text-color-td table-border-color custom-table" rowspan="3">
                                            รายชื่อผู้เข้าสัมภาษณ์</th>
                                        <th class="text-color-td table-border-color custom-table" colspan="9">
                                            คะแนนเต็ม 50</th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="3">
                                            ความคิดเห็นเพิ่มเติม</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th class="text-color-td table-border-color custom-table" colspan="4">
                                            บุคลิกภาพ (คะแนนเต็ม 20)</th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="2">
                                            ทัศนคติ <div class="pt-2"> (5) </div>
                                        </th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="2">
                                            การตอบคำถาม <div class="pt-2"> (5) </div>
                                        </th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="2">
                                            ความรู้เกี่ยวกับองค์กร <div class="pt-2"> (10) </div>
                                        </th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="2">
                                            ความรู้ด้านวิชาชีพ <div class="pt-2"> (10) </div>
                                        </th>
                                        <th class="text-color-td table-border-color custom-table" rowspan="2">คะแนนรวม
                                        </th>
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
                                                    <td class="border-rl"><?php echo $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];    $s9 += $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];?></td>
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
                                            <td class="border-rl""><?php echo $s9;?></td>
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
                                <h6 class="font-14 mb-2">โปรดส่งคืนกลุ่มงานบริหารกลาง
                                    สำนักบริหารการเงินและบริหารองค์กร เพื่อสรุปผลคะแนน
                                </h6>
                            </div>
                        </div>

                        <h6 class="font-14 mb-3 text-right color-text">ลงชื่อ
                            ......................................................................................... ผู้สัมภาษณ์</h6>
                </div>
            </div>

        </div>

    </div>
    <!-- end row -->
</div>

@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>


<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "oLanguage": {
                "sZeroRecords": "-ไม่พบรายการข้อมูล-",
                "sLengthMenu": "แสดง  _MENU_  รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
                "sSearch": "ค้นหา"
            }
        });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });


        // var a = $("#datatable-buttons").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // });
        // $("#key-table").DataTable({
        //     keys: !0
        // }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
        //     select: {
        //         style: "multi"
        //     }
        // }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });

    $(document).on('change', '.select-new', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');
        
        if(values == 'report'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id + '/?t=durable&pr=0';

        }else if(values == 'downloads'){

            window.open('{{URL('')}}' + '/' + title, '_blank');

        }else if(values == 'edit'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id + '/?t=durable&pr=0';

        }else if(values == 'delete'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id;

        }else{

        }  
    });

    function loadJob(id , projectid){

        $('#add-job').modal('show');

        $('#loadJob').load('{{URL('office/hr/candidate/interviewcreate')}}' + '/' + id + '/' + projectid);
    }


</script>
@endsection
