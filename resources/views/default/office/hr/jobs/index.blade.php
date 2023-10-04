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
                                    <h4 class="font-16 ml-3">วันที่เริ่มประกาศ :: <span
                                            class="ml-1">{{getDateShow($info->day_start)}}</span></h4>
                                </div>

                                <div class="col-lg-4">
                                    <h4 class="font-16 ml-3">วันที่สิ้นสุดประกาศ :: <span
                                            class="ml-1">{{getDateShow($info->day_end)}}</span></h4>
                                </div>

                                <?php
                                    $institution = \App\Models\YearBudget::find((int) $info->year_id);
                                ?>

                                <div class="col-lg-4">
                                    <h4 class="font-16 ml-3">ปีงบประมาณ :: <span class="ml-1"><?php if(isset($institution)):
                                        echo $institution->in_year;
                                    endif; ?></span>
                                    </h4>
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="font-16 ml-3">คำอธิบายโครงการโดยย่อ :: <span class="ml-1">
                                            โครงก{{$info->note}}</span></h4>
                                </div>

                                <div class="col-lg-12">
                                    <div class="label-cus">
                                        <h4 class="font-16 ml-3 mb-2">ไฟล์แนบ</label>
                                    </div>

                                    <div class="main-file ml-3">
                                        <a href="{{ URL($info->file_work) }}">
                                            <div class="box-file">
                                                <i class="mdi mdi-file file-cus"
                                                    style="font-size:30px !important;"></i>
                                                <div class="file-cus title-file">ไฟล์เอกสาร</div>
                                            </div>
                                        </a>
                                    </div>
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
                                    style="font-size: 16px !important; "> ตำแหน่งงานว่าง</i>
                            </h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-2 text-right">
                            <button type="button" class="btn btn-primary" onclick="loadJob('<?php echo $id;?>');">
                                <i class="mdi mdi-file-document-box-plus-outline">
                                    เพิ่มตำแหน่ง</i>
                            </button>


                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%" class="text-center align-middle">ลำดับ</th>
                                <th width="20%" class="text-center align-middle">ชื่อตำแหน่ง</th>
                                <th class="text-center align-middle">สำนักที่รับ</th>
                                <th class="text-center align-middle">กลุ่มงาน</th>
                                <th width="8%" class="text-center align-middle">จำนวน</th>
                                <th width="25%" class="text-center align-middle">คณะกรรมการ</th>
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
                                <td class="align-middle text-center">{{$item['job_name']}}</td>
                                <td class="align-middle text-center">
                                <?php
                                    $department = \App\Models\DataSetting::find((int) $item['department_id']);
                                    if(isset($department)):
                                        echo $department->name;
                                    endif;
                                ?>
                                </td>
                                <td class="align-middle text-center">
                                <?php
                                    $group = \App\Models\DataSetting::find((int) $item['group_work_id']);
                                    if(isset($group)):
                                        echo $group->name;
                                    endif;
                                ?>
                                </td>
                                <td class="align-middle text-center">{{$item['job_num']}}</td>
                                <td class="align-middle">
                                <?php
                                    $directors = \App\Models\ProjectsDirector::where('job_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                    if(isset($directors)):
                                        foreach ($directors as $director){

                                                $UserDsN = \App\Models\UserInformation::where('users_id',$director['user_id'])->get();
                                                foreach ($UserDsN as $UserDN);

                                                echo $UserDN['firstname'].' '. $UserDN['lastname'].'<br />';
                                        }
                                    endif;
                                ?>

                                </td>
                                <td class="align-middle text-center">
                                    <button type="button"
                                        class="btn btn-warning waves-effect width-md waves-light"
                                        data-toggle="modal" data-target="#edit01">
                                        <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                    </button>
                                    <button type="button"
                                        class="btn btn-danger waves-effect width-md waves-light">
                                        <i class="mdi mdi-trash-can-outline"></i> ลบ
                                    </button>
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
