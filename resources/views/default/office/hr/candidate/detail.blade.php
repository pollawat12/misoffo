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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">สัมภาษณ์</a>
                            </li>
                            <li class="breadcrumb-item active">รายชื่อผู้ผ่านการคัดเลือก
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายชื่อผู้ผ่านการคัดเลือก</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div class="row mb-3">
                        <div class="col-10">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus"
                                    style="font-size: 16px !important; "> ตำแหน่งงาน</i>
                            </h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-2 text-right">
                            <a href="{{URL('office/hr/candidate/scores')}}/{{$id}}" target="_blank">
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
                                <th width="5%" class="text-center">ลำดับ</th>
                                <th width="35%">ชื่อ</th>
                                <th width="20%" class="text-center">ตำแหน่งที่สนใจ</th>
                                <th width="10%" class="text-center">เบอร์โทร</th>
                                <th width="10%" class="text-center">วันที่สัมภาษณ์</th>
                                <th width="10%" class="text-center">สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>

                            <?php $Interviews = \App\Models\UserToInterview::where('job_id', $id)->where('users_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get(); ?>
                            <tr>
                                <td class="align-middle text-center">{{$no}}</td>
                                <td class="align-middle">{{$item['firstname']}} {{$item['lastname']}}</td>
                                <td class="align-middle text-center">
                                    <?php echo $info->job_name;?>
                                </td>
                                <td class="align-middle text-center">{{$item['mobile']}}</td>
                                <td class="align-middle text-center">
                                    <?php 
                                    
                                        if(count($Interviews) > 0){ 
                                            foreach ($Interviews as $Interview2);

                                            echo getDateShow($Interview2['checkin_date']);
                                        }
                                    ?>
                                </td>
                                <td class="align-middle text-center"> 

                                    <?php 
                                    
                                        
                                        if(count($Interviews) > 0){ 
                                            foreach ($Interviews as $Interview);

                                            if($Interview['is_checkin'] == 1){
                                    ?>
                                                <span class="badge badge-status-2 p-1 font-size-15">
                                                    นัดสัมภาษณ์เรียบร้อย
                                                </span>
                                    <?php 
                                            }else{
                                    ?>
                                                <span class="badge badge-status-1 p-1 font-size-15">
                                                    ยกเลิกสัมภาษณ์
                                                </span>
                                    <?php
                                            }
                                        }else{
                                    ?>
                                            <span class="badge badge-status-3 p-1 font-size-15">
                                                รอมาสัมภาษณ์
                                            </span>     
                                    <?php
                                        }
                                    ?>

                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{URL('office/hr/estimate')}}/{{$item['id']}}/{{$id}}/{{$info->work_id}}">
                                        <button type="button"
                                            class="btn btn-info waves-effect width-md waves-light">
                                            <i class="mdi mdi-square-edit-outline"></i> ประเมิน
                                        </button>
                                    </a>
                                    <a onclick="loadJob('{{$item['id']}}' , '{{$id}}');">
                                        <?php if(count($Interviews) > 0){  ?>
                                            <button type="button"
                                                class="btn btn-primary waves-effect width-md waves-light">
                                                <i class="mdi mdi-calendar-remove"></i> กำหนดสัมภาษณ์
                                            </button>
                                        <?php }else{ ?>
                                            <button type="button"
                                                class="btn btn-warning  waves-effect width-md waves-light">
                                                <i class="mdi mdi-calendar-remove"></i> นัดสัมภาษณ์
                                            </button>
                                        <?php } ?>
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

        <div id="url-redirect-back" data-url="{{url('office/hr/candidate/detail')}}/{{$id}}"></div>


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

    function loadJob(id , projectid){

        $('#add-job').modal('show');

        $('#loadJob').load('{{URL('office/hr/candidate/interviewcreate')}}' + '/' + id + '/' + projectid);
    }


</script>
@endsection
