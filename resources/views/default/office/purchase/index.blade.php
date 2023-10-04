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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบจัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดซื้อ - จัดจ้าง</a></li>
                            <li class="breadcrumb-item active">ข้อมูลจัดซื้อ - จัดจ้าง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูลจัดซื้อ - จัดจ้าง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลจัดซื้อ - จัดจ้าง</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/purchase/add')}}?t=1&pr=0" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%" class="text-center">ลำดับ</th>
                                <th width="50%">เรื่อง</th>
                                <th width="10%" class="text-center">วันที่เพิ่มรายงาน</th>
                                <th width="10%" class="text-center">วันที่อัพเดทรายงาน</th>
                                <th width="10%" class="text-center">งบประมาณที่ได้รับ</th>
                                <th width="10%" class="text-center">สถานะ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle text-center">{{$no}}</td>
                                <td class="align-middle">{{$item['purchases_name']}}</td>
                                <td class="align-middle text-center">{{getDateShow($item['purchases_invoice_date'])}}</td>
                                <td class="align-middle text-center">{{getDateShow($item['purchases_invoice_date'])}}</td>
                                <td class="align-middle text-center">{{number_format($item['purchases_allocated_budget'],2,'.',',')}}</td>
                                <td class="align-middle text-center">
                                    <?php if($item['purchases_status'] == 6){ ?>
                                        <span class="badge badge-success p-1 font-size-14">
                                            เสร็จสิ้น
                                        </span>
                                    <?php }else{ ?>
                                        
                                        <span class="badge badge-warning p-1 font-size-14">
                                            กำลังดำเนินการ
                                        </span>
                                    <?php } ?>
                                    
                                </td>
                                <td lass="align-middle text-center">
                                    <a href="{{URL('office/purchase/detail')}}/{{$item['id']}}?t=1&pr=0">
                                        <button type="button" class="btn btn-info waves-effect width-md waves-light">
                                            <i class="mdi mdi-update"></i> อัพเดท
                                        </button>
                                    </a>
                                    <!-- <a href="{{URL('office/purchase/edit')}}/{{$item['id']}}?t={{$item['purchases_status'] + 1}}&pr=0">
                                        <button type="button" class="btn btn-warning waves-effect width-md waves-light">
                                            <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                        </button>
                                    </a> -->
                                    <a href="{{URL('office/purchase/delete')}}/{{$item['id']}}?t=1&pr=0">
                                        <button type="button" class="btn btn-danger waves-effect width-md waves-light">
                                            <i class="mdi mdi-trash-can-outline"></i> ลบ
                                        </button>
                                    </a>
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

    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');
        
        if(values == 'report'){

            window.location='{{URL('office/purchase/')}}'+ '/' + values + '/' + id;

        }else if(values == 'downloads'){

            window.open('{{URL('')}}' + '/' + title, '_blank');

        }else if(values == 'edit'){

            window.location='{{URL('office/purchase/')}}'+ '/' + values + '/' + id + '?t=' + title + '&pr=0';

        }else if(values == 'delete'){

            window.location='{{URL('office/purchase/')}}'+ '/' + values + '/' + id;

        }else if(values == 'detail'){

            window.location='{{URL('office/purchase/')}}'+ '/' + values + '/' + id;

        }else{

        }  
    });
</script>
@endsection
