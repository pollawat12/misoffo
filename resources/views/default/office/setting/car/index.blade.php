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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">รถยนต์ส่วนกลาง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง รถยนต์ส่วนกลาง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="media-body">
                        
                        
                        <div class="title-aad-name">
                            <h6 class="header-title font-size-16">
                                รายการรถยนต์ส่วนกลางสำนักงานกองทุนน้ำมันเชื้อเพลิง</h6>
                                <a href="{{ URL('office/settings/cars/add') }}"
                                class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline">
                                    เพิ่มรายการ</i></a>
                        </div>

                        <hr class="hr-form-car">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive mb-3">
                                    <table  id="datatable" class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center text-white custom-table" style="width: 5%;">ลำดับ
                                                </th>
                                                <th class="text-center text-white custom-table" style="width: 15%;">หมายเลขทะเบียน</th>
                                                <th class="text-white custom-table">ข้อมูลรถ</th>
                                                <th class="text-center text-white custom-table" style="width: 15%;">สัญญาซื้อขาย</th>
                                                <th class="text-center text-white custom-table" style="width: 28%;">จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center custom-table">1</td>
                                                <td class="text-center custom-table">8 กฬ 6509</td>
                                                <td class="custom-table">Toyota/CH-R CL0091</td>
                                                
                                                <td class="text-center custom-table">เช่าซื้อ</td>
                                                <td class="text-center custom-table">
                                                    <a href="view-car.html">
                                                        <a href="{{ URL('/') }}" class="btn btn-info waves-effect width-md waves-light">
                                                            <i class="mdi mdi-eye"></i> ดูรายละเอียด
                                                        </a>
                                                    </a>
                                                    <a type="button" class="btn btn-warning waves-effect width-md waves-light">
                                                        <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                                    </a>
                                                    <a type="button" class="btn btn-danger waves-effect width-md waves-light">
                                                        <i class="mdi mdi-trash-can-outline"></i> ลบ
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->


        </div>
        

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
</script>
@endsection
