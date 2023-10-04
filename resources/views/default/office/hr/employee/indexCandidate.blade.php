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
                            <li class="breadcrumb-item"><a href="{{url('/')}}">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">ทะเบียนประวัติ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ทะเบียนประวัติ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ทะเบียนประวัติ</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <!-- <a href="{{URL('office/hr/employees/sub/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a> -->
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 8%"># ลำดับ</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th style="width: 25%">ตำแหน่งงาน</th>
                                <th style="width: 12%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($employees))
                            @foreach ($employees as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle">{{$item['position']}}</td>
                                <td class="align-middle">
                                    {{-- <a href="{{URL('office/hr/employees/print')}}/{{$item['id']}}/?t=profile" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">ปริ๊นประวัติ</i> </a>
                                    <a href="{{URL('office/hr/employees/print')}}/{{$item['id']}}/?t=money" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">ปริ๊นเงินเดือน</i> </a>
                                    <a href="{{URL('office/hr/employees/add')}}/{{$item['id']}}/?t=general" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">แก้ไข</i> </a>
                                    <a href="{{URL('office/hr/employees/delete')}}/{{$item['id']}}" class="btn btn-outline-danger waves-effect width-md waves-light btn-sm" ><i class="mdi mdi-trash-can-outline">ลบ</i></a> --}}
                                
                                    <select name="input_action" class="form-control select-action" data-id="{{$item['id']}}">
                                        <option value="">เลือก</option>
                                        {{-- <option value="report" data-id="{{$item['id']}}">ปริ๊นประวัติ</option> --}}
                                        {{-- <option value="reportMoney">พิมพ์เงินเดือน</option> --}}
                                        <option value="edit">แก้ไข</option>
                                        <option value="deleted">ลบ</option>
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

    $(document).on('change', '.select-action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'report'){

            window.open('{{URL('office/hr/employees/print')}}' + '/' + id + '/?t=profile' , '_blank');

        }else if(values == 'reportMoney'){

            window.open('{{URL('office/hr/employees/print')}}' + '/' + id + '/?t=money' , '_blank');

        }else if(values == 'edit'){

            window.location='{{URL('office/hr/employees/add')}}' + '/' + id + '/?t=general';

        }else if(values == 'deleted'){

            window.location='{{URL('office/hr/employees')}}'+ '/' + values + '/' + id + '/0/employees/';

        }else{

        }  
    
    });

</script>
@endsection
