@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">สรุปผลคะแนนการประเมินผู้เข้ารับการสัมภาษณ์
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">สรุปผลคะแนนการประเมินผู้เข้ารับการสัมภาษณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="media-body">
                        <div class="p-4">
                            <h4 class="font-16 mb-3 text-center">สรุปผลคะแนนการประเมินผู้เข้ารับการสัมภาษณ์
                            </h4>
                            <h4 class="font-16 mb-3 text-center">ตำแหน่ง
                                {{$info->name}}</h4>

                            <div class="table-responsive mt-4 mb-2">

                            <div class="row mb-3">
                                <div class="col-12 text-right">
                                    <a href="{{URL('office/hr/candidate/print')}}/{{$id}}">
                                        <button type="button"
                                        class="btn btn-primary">
                                        <i class="mdi mdi-file-document-box-plus-outline"> 
                                            ปริ๊นเอกสาร</i></button>
                                    </a>
                                </div>
                            </div>

                                <table class="table table-bordered mb-0">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th style="width: 5%;"
                                                class="text-white table-border-color custom-table"
                                                rowspan="2">
                                                ลำดับที่</th>
                                            <th style="width: 20%;"
                                                class="text-white table-border-color custom-table"
                                                rowspan="2">
                                                รายชื่อผู้สมัคร</th>
                                            <th class="text-white table-border-color custom-table"
                                                colspan="<?php if (!empty($directors)){ echo count($directors);}?>">ผลคะแนนการประเมินผู้เข้ารับการสัมภาษณ์
                                                โดยคณะกรรมการสรรหาและคัดเลือกฯ</th>
                                            <th class="text-white table-border-color custom-table"
                                                rowspan="2" style="width: 10%;">คะแนนเฉลี่ย</th>
                                            <th class="text-white table-border-color custom-table"
                                                rowspan="2" style="width: 10%;">หมายเหตุ</th>
                                        </tr>
                                        <tr class="text-center">
                                            @if (!empty($directors))
                                                @foreach ($directors as $director)
                                                    <th class="text-white table-border-color custom-table">
                                                    <?php if($director['position_id'] == 1){ echo 'ประธานกรรมการ'; }else{ echo 'กรรมการ'; }?>
                                                    </th>
                                                @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 0;?>
                                    @if (!empty($items))
                                    @foreach ($items as $item)
                                    <?php $no++;?>
                                        <tr>
                                            <td class="border-rl">{{$no}}</td>
                                            <th class="border-rl">{{$item['firstname']}} {{$item['lastname']}}</th>
                                            @if (!empty($directors))
                                                @foreach ($directors as $directorsum)
                                                <?php $checknums = \App\Models\UserToEstimate::where('director_id',$directorsum['id'])->where('users_id',$item['id'])->where('job_id',$id)->get();?>
                                                <td class="border-rl">
                                                <?php 
                                                $sum = 0;
                                                if(count($checknums) > 0){ 
                                                    foreach ($checknums as $checknum);  
                                                    echo $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];  

                                                    $sum += $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'] + $checknum['score_5'] + $checknum['score_6'] + $checknum['score_7'] + $checknum['score_8'];
                                                }else{ echo '0';}?>
                                                </td>
                                                @endforeach
                                            @endif
                                            <td class="border-rl">{{$sum}}</td>
                                            <td class="border-rl"></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

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
