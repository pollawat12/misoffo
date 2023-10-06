@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />


<link href="{{ url('assets/js/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">{{$budgets->name}} > ปีงบประมาณ {{$Years->in_year}} > ตั้งงบประมาณ </li>
                        </ol>
                    </div>
                    <h4 class="page-title">ปีงบประมาณ {{$Years->in_year}} ({{$budgets->name}})</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ตั้งงบประมาณหน่วยงาน</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{url('office/budgets/institution/add')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}" class="btn btn-secondary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="10%">ลำดับ</th>
                                <th width="15%">ปีงบประมาณ</th>
                                <th>หน่วยงาน</th>
                                <th width="30%">งบปนะมาณที่ได้รับ</th>
                                <th style="width: 12%">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($infos))
                            @foreach ($infos as $info)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{ $no }}</td>
                                <td class="align-middle">{{$Years->in_year}}</td>
                                <td class="align-middle">
                                    <?php
                                        $institution = \App\Models\DataSetting::find((int) $info->institution_id);
                                        if(isset($institution)):
                                            echo $institution->name;
                                        endif;
                                    ?>
                                </td>
                                <td class="align-middle">{{number_format($info->budget_money,2,'.',',')}}</td>
                                <td>
                                    <select name="input_action" class="form-control " data-id="{{$info->id}}">
                                        <option value="">เลือก</option>
                                        {{--<option value="imports">อัปโหลดไฟล์เอกสาร</option>--}}
                                        <option value="edit" >แก้ไข</option>
                                        <option value="deleted" >ลบ</option>
                                    </select>
                                </td>
                            </tr> 
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->
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

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "pageLength": 25,
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

    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'edit'){
            window.location='{{URL('office/budgets/institution')}}'+ '/' + values + '/' + id + '/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}';
        }else if(values == 'imports'){
            window.location='{{URL('office/budgets/institution/imports/lists/')}}'+ '/' + id + '/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}';
        }else if(values == 'deleted'){
            swal({
                title: "แจ้งเตือน",
                text: "คุณแน่ใจต้องการลบรายการนี้?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false
            },
            function(isConfirm){
                console.log(isConfirm)
                if (isConfirm){
                    //swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
                    window.location='{{URL('office/budgets/institution')}}'+ '/' + values + '/' + id + '/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}';
                } else {
                    // <a href="{{URL('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}"
                    window.location='{{URL('office/budgets/institution')}}/?yearid={{$yearid}}&budgetsid={{$budgetsid}}&id={{$id}}';
                }
            });
        }else{}
    });
</script>
@endsection
