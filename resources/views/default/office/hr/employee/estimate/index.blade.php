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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แบบประเมิน</a>
                            </li>
                            <li class="breadcrumb-item active">รายชื่อพนักงาน
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายชื่อพนักงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus"
                                    style="font-size: 16px !important; "> รายชื่อพนักงานในสังกัด</i>
                            </h4>
                            <p class="sub-header"></p>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%" class="text-center align-middle">ลำดับ</th>
                                <th width="40%" class="align-middle">ชื่อ-นามสกุล</th>
                                <th class="text-center align-middle">ตำแหน่ง</th>
                                <th class="text-center align-middle">สังกัด</th>
                                <th class="text-center align-middle" style="width: 15%;">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($users))
                            @foreach ($users as $item)
                            <?php $no++;?>        
                                <tr>
                                    <td class="align-middle text-center color-text">
                                    {{$no}}
                                    </td>
                                    <td class="align-middle color-text">
                                    {{$item['name']}}
                                    </td>
                                    <td class="align-middle text-center color-text">
                                    {{$item['position']}}
                                    </td>
                                    <td class="align-middle text-center color-text">
                                    {{$item['department']}}
                                    </td>
                                    <td class="align-middle text-center">
                                            <a href="{{URL('office/hr/employees/estimate/years')}}/{{$item['id']}}/{{$typeid}}" class="btn btn-primary waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">ประเมินพนักงาน</i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
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

    function loadJob(id){

        $('#add-job').modal('show');

        $('#loadJob').load('{{URL('office/hr/jobs/add')}}' + '/' + id);
    }


</script>
@endsection
