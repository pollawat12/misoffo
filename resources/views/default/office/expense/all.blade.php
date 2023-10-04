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
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่ายโครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่ายโครงการ</h4>
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
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ค่าใช้จ่ายโครงการ</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{url('office/expenses/project/add')}}" class="btn btn-secondary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="10%">ลำดับ</th>
                                <th width="12%">ปี เริ่มดำเนินการ</th>
                                <th>โครงการ</th>
                                <th width="20%">วันที่เริ่ม - สิ้นสุดโครงการ</th>
                                <th width="15%">งบประมาณ</th>
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>

                            <?php $no = 0;?>
                            @if (!empty($projects))
                            @foreach ($projects as $row)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{ $no }}</td>
                                <td class="align-middle">
                                    <?php 
                                    
                                        $budgetCategroys = \App\Models\YearBudget::where('id', $row->in_year)->where('is_deleted', '0')->where('is_active','1')->get(); 
                                        foreach ($budgetCategroys as $rowBudgetCategroys)

                                        echo $rowBudgetCategroys['in_year']
                                    ?>
                                </td>
                                <td class="align-middle">{{$row->project_name}}</td>
                                <td class="align-middle">{{getDateShow($row->date_start)}} - {{getDateShow($row->date_end)}}</td>
                                <td class="align-middle">{{number_format($row->budget_amount,2,'.',',')}}</td>
                                <td>
                                    {{-- <a href="{{URL('office/budget/expenses/show')}}/{{$row->id}}" class="btn btn-outline-warning waves-effect waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">รายงานค่าใช้จ่าย</i> </a>
                                    <a href="{{URL('office/budget/expenses/print')}}/{{$row->id}}" class="btn btn-outline-success waves-effect waves-light btn-sm"><i class="mdi mdi-printer-settings">พิมพ์รายงาน</i> </a> --}}
                                    <select name="input_action" class="form-control " data-id="{{$row->id}}">
                                        <option value="">เลือก</option>
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

        if(values != ''){
            window.location='{{URL('office/budget/expenses/project')}}'+ '/' + values + '/' + id;
        }else{

        }  
    });
</script>
@endsection
