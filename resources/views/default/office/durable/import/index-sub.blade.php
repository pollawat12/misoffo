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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > รายได้</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายได้</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูลใบแจ้งหนี้</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            <!--a href="{{url('office/budget/debtors/add')}}" class="btn btn-secondary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a -->
                            <a href="{{url('office/budget/debtors/import-form/new')}}" class="btn btn-dark"><i class="mdi mdi-file-document-box-plus-outline"> สร้างรายงานประจำเดือน</i></a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-striped table-bordered  dt-responsive"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="15%">เลขที่ใบแจ้งหนี้</th>
                                <th width="12%">งวดที่</th>
                                <th width="15%">หมายเลขใบอนุญาต</th>
                                <th width="22%">ชื่อผู้ได้รับใบอนุญาต</th>
                                <th width="12%">สถานะ</th>
                                <th style="width: 15%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>

                            <tr>
                                <td class="align-middle">01-2020-3-0002</td>
                                <td class="align-middle">3/2563</td>
                                <td class="align-middle">01-50955-0001</td>
                                <td class="align-middle">บริษัท สินธุ โปรดักส์ จำกัด</td>
                                <td class="align-middle"><span class="badge badge-warning badge-pill" style="padding:8px; font-size:14px !important;">รอชำระเงิน</span></td>

                                <td>
                                    <select name="" class="form-control" id="">
                                        <option value="">เลือก</option>
                                        <option value="">ดูรายละเอียด</option>
                                        <option value="">แก้ไข</option>
                                        <option value="">ลบ</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle">01-2020-3-0003</td>
                                <td class="align-middle">3/2563</td>
                                <td class="align-middle">01-51155-0003</td>
                                <td class="align-middle">นางสาวเอมอร จินดาสมบัติเจริญ</td>
                                <td class="align-middle"><span class="badge badge-warning badge-pill" style="padding:8px; font-size:14px !important;">รอชำระเงิน</span></td>

                                <td>
                                    <select name="" class="form-control" id="">
                                        <option value="">เลือก</option>
                                        <option value="">ดูรายละเอียด</option>
                                        <option value="">แก้ไข</option>
                                        <option value="">ลบ</option>
                                    </select>
                                </td>
                            </tr>
                            
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
    $(function(){
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
    })
</script>
@endsection
