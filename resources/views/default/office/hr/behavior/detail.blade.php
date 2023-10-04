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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ใบสมัครออนไลน์</a>
                            </li>
                            <li class="breadcrumb-item active">ประกาศรับสมัครงาน
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">ประกาศรับสมัครงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box pb-2">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="header-title mb-2">
                                <i class="mdi mdi-file-document" style="font-size: 16px !important;">
                                    รายละเอียดประกาศ :: {{$info->name}}</i>
                            </h4>

                            <div class="row">
                                <div class="col-lg-4">
                                    <h4 class="font-16 ml-3">ผู้สมัคร :: <span
                                            class="ml-1">{{$users->firstname}} {{$users->lastname}}</span></h4>
                                </div>

                                <div class="col-lg-4">
                                    <h4 class="font-16 ml-3">ตำแหน่งงาน :: <span
                                            class="ml-1">{{$jobs->job_name}}</span></h4>
                                </div>

                                
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div class="row mb-3">
                        <div class="col-10">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus"
                                    style="font-size: 16px !important; "> ผู้ประเมิน</i>
                            </h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{URL('office/hr/estimate/views')}}/{{$id}}/{{$jobid}}/{{$workid}}" target="_blank">
                                <button type="button"
                                class="btn btn-primary" >
                                <i class="mdi mdi-file-document-box-plus-outline"> 
                                    สรุปคะแนนทั้งหมด</i></button>
                            </a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="10%" class="text-center align-middle">ลำดับ</th>
                                <th class="align-middle">ชื่อ</th>
                                <th width="20%" class="text-center align-middle">ตำแหน่ง</th>
                                <th width="10%" class="text-center align-middle">คะแนน (บุคลิกภาพ)</th>
                                <th width="10%" class="text-center align-middle">คะแนน (อื่นๆ)</th>
                                <th class="text-center align-middle" style="width: 15%;">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle text-center">{{$no}}</td>
                                <td class="align-middle">

                                <?php

                                    $UserDsN = \App\Models\UserInformation::where('users_id',$item['user_id'])->get();
                                    foreach ($UserDsN as $UserDN);

                                    echo $UserDN['firstname'].' '. $UserDN['lastname'];
                                
                                ?>
                                </td>
                                <td class="align-middle text-center">

                                <?php if($item['position_id'] == 1){ echo 'ประธานกรรมการ'; }else{ echo 'กรรมการ'; }?>
                                </td>
                                
                                <?php $checknums = \App\Models\UserToEstimate::where('director_id',$item['id'])->get();?>
                                <td class="align-middle text-center">
                                <?php if(count($checknums) > 0){ foreach ($checknums as $checknum);  echo $checknum['score_1'] + $checknum['score_2'] + $checknum['score_3'] + $checknum['score_4'];  }else{ echo 'รอการประเมิน';}?>
                                
                                </td>
                                <td class="align-middle text-center">

                                <?php if(count($checknums) > 0){ foreach ($checknums as $checknum2);  echo $checknum2['score_5'] + $checknum2['score_6'] + $checknum2['score_7'] + $checknum2['score_8'];  }else{ echo 'รอการประเมิน';}?>
                                
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{URL('office/hr/estimate/add')}}/{{$item['id']}}/{{$id}}/{{$jobid}}/{{$workid}}">
                                        <button type="button"
                                            class="btn btn-warning waves-effect width-md waves-light"
                                            data-toggle="modal" data-target="#edit01">
                                            <i class="mdi mdi-pencil-outline"></i> ประเมิน
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal add-job -->
        <div id="add-job" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="loadJob">
                    
                </div>
            </div>
        </div><!-- /.modal -->
        
        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/jobs')}}/{{$id}}"></div>


    </div>
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

    function loadJob(id){

        $('#add-job').modal('show');

        $('#loadJob').load('{{URL('office/hr/jobs/add')}}' + '/' + id);
    }


</script>
@endsection
