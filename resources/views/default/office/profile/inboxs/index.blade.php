@extends('default.template')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ข้อมูลของฉัน</a></li>
                            <li class="breadcrumb-item active">กล่องข้อความ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">กล่องข้อความ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <!-- Right Sidebar -->
            <div class="col-lg-12">
                <div class="card-box">
                    <!-- Left sidebar -->
                    <div class="inbox-leftbar">
                        <!-- Left sidebar
                        <a href="email-compose.html" class="btn btn-danger btn-block waves-effect waves-light">เขียนข้อความ</a>
                         -->

                        <div class="mail-list mt-3">
                            <a href="{{ URL('office/my/inbox') }}" class="list-group-item border-0 text-danger"><i class="mdi mdi-inbox font-18 align-middle mr-2"></i>กล่องข้อความ<span class="badge badge-danger float-right ml-2 mt-1">8</span></a>
                            <a href="#" class="list-group-item border-0"><i class="mdi mdi-delete font-18 align-middle mr-2"></i>ลบข้อความ</a>
                        </div>

                    </div>
                    <!-- End Left sidebar -->

                    <div class="inbox-rightbar">
                        <div class="">
                            <div class="mt-3">


                                <div class="">
                                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th style="width: 10%">ลำดับ</th>
                                                <th>เรื่อง</th>
                                                <th style="width: 20%"></th>
                                                <th style="width: 15%">จัดการ</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr class="unread">
                                                <td>
                                                    <input type="checkbox" id="chk1">
                                                    <label for="chk1" class="toggle"></label>
                                                </td>
                                                <td>
                                                    เจ้าหน้าที่แจ้งการลา
                                                </td>
                                                <td>
                                                    หหห
                                                </td>
                                                <td>
                                                    <select name="input_action" class="form-control" >
                                                        <option value="">เลือก</option>
                                                        <option value="delete">ลบ</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- card body -->
                        </div> <!-- card -->

                    </div>

                    <div class="clearfix"></div>
                </div>

            </div> <!-- end Col -->

        </div>
    </div>
    <!-- end .container-fluid -->
</div>
<!-- end .content -->

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

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

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
    });

</script>
@endsection