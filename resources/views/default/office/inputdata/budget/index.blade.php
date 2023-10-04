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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">นำเข้ารายการข้อมูล</a></li>
                            <li class="breadcrumb-item active">จัดการไฟล์รูปภาพ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">จัดการไฟล์รูปภาพ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="header-title">รายการข้อมูล :: ติดตามงบประมาณ</h4>
                    <p class="sub-header"></p>

                    <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>รายงาน</th>
                                <th>ปีงบประมาณ</th>
                                <th>วันที่อัพเดท</th>
                                <th>ผู้จัดทำ</th>
                                <th style="width: 20%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>รายงานฐานะการเงินของกองทุนพัฒนาน้ําบาดาล</td>
                                <td>2563</td>
                                <td>1 ก.ย. 2563 10:00</td>
                                <td>นางสาวสุรีรัตน์  เชียรจันทึก</td>
                                <td>
                                    <button class="btn btn-info" type="button">เพิ่มรายงาน</button>
                                    <button class="btn btn-warning" type="button">แก้ไข</button>
                                    <button class="btn btn-danger" type="button">ลบ</button>
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

<!-- Datatables init -->
<script src="{{url('assets/default')}}/js/pages/datatables.init.js"></script>
@endsection
