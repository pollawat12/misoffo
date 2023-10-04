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
                    <li class="breadcrumb-item active">รายการประกอบแบบสรุปการประเมินสมรรถนะ
                    </li>
                </ol>
            </div>
            <h4 class="page-title">รายการประกอบแบบสรุปการประเมินสมรรถนะ</h4>
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
                            style="font-size: 16px !important; ">
                            รายการประกอบแบบสรุปการประเมินสมรรถนะ</i>
                    </h4>
                    <p class="sub-header"></p>
                </div>
                <div class="col-2 text-right">
                    <a href="{{URL('office/hr/employees/behavior')}}/{{$id}}/add">
                        <button type="button" class="btn btn-primary">
                            <i class="mdi mdi-file-document-box-plus-outline">
                                เพิ่มรายการ</i>
                        </button>
                    </a>
                </div>
            </div>
            <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                <thead>
                    <tr class="bg-dark text-white">
                        <th width="5%" class="text-center align-middle">ลำดับ</th>
                        <th width="30%" class="align-middle">สมรรถนะ</th>
                        <th width="40%" class="align-middle">รายละเอียด</th>
                        <th class="text-center align-middle" style="width: 10%;">สถานะ</th>
                        <th class="text-center align-middle" style="width: 15%;">จัดการ</th>
                    </tr>
                </thead>


                <tbody>

                    <?php $no = 0;?>
                    @if (!empty($items))
                    @foreach ($items as $item)
                    <?php $no++;?>
                    <tr>
                        <td class="align-middle text-center color-text">{{$no}}</td>
                        <td class="align-middle color-text">{{$item['name']}}</td>
                        <td class="align-middle color-text">


                        </td>
                        <td class="align-middle text-center">
                            <span class="badge badge-success p-1 font-size-14">
                                เปิดใช้งาน
                            </span>
                        </td>
                        <td class="align-middle">
                            <a href="{{URL('office/hr/employees/behavior/detail')}}/{{$item['id']}}"><button type="button"
                                class="btn btn-warning waves-effect width-md waves-light">
                                <i class="mdi mdi-pencil-plus-outline"></i> เพิ่มรายการ
                            </button></a>
                            <a href="{{URL('office/hr/employees/behavior/edit')}}/{{$item['id']}}"><button type="button"
                                class="btn btn-warning waves-effect width-md waves-light">
                                <i class="mdi mdi-pencil-outline"></i> แก้ไข
                            </button></a>
                            <a href="{{URL('office/hr/employees/behavior/delete')}}/{{$item['id']}}"><button type="button"
                                class="btn btn-danger waves-effect width-md waves-light">
                                <i class="mdi mdi-trash-can-outline"></i> ลบ
                            </button></a>
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
    });

</script>
@endsection
