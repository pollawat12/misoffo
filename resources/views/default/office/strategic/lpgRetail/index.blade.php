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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ยุทธศาสตร์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ราคาขายปลีก</a></li>
                            <li class="breadcrumb-item active">ก๊าซ LPG  </li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ก๊าซ LPG  </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ก๊าซ LPG   </h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/strategic/oil/add')}}/?t={{$t}}&pr={{$pr}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    
                    <div class="no-padding sticky-table sticky-rtl-cells">
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th style="width: 8%"># ลำดับ</th>
                                    <th style="width: 10%">วันที่มี</th>
                                    <th style="width: 15%">นำเข้า <br /> (บาท/กก.)</th>
                                    <th style="width: 15%">โรงแยก <br /> (บาท/กก.)</th>
                                    <th style="width: 15%">ปตท.สผ. <br /> (บาท/กก.)</th>
                                    <th style="width: 15%">UAC</th>
                                    <th style="width: 15%">ราคาขายปลีกจริง  <br /> (บาท/กก.)</th>
                                    <th style="width: 15%">นำเข้า-โรงแยก</th>
                                    <th style="width: 15%">นำเข้าเทียบ โรงแยก (สผ.)</th>
                                    <th style="width: 15%">นำเข้าเทียบ โรงแยก (UAC)</th>
                                    <th style="width: 15%">เทียบ 363-ราคาขายปลีก</th>
                                    <th style="width: 15%">สถานะใช้งาน</th>
                                    <th style="width: 15%">จัดการ</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $no = 0;?>
                                @if (!empty($infos))
                                @foreach ($infos as $item)
                                <?php $no++;?>
                                <tr>
                                    <td class="align-middle">{{$no}}</td>
                                    <td class="align-middle">{{getDateShow($item->oil_price_date)}}</td>
                                    <?php 
                                        $i = 0;
                                        $j = 0;
                                        $k = 0;
                                        $g = 0;
                                        $OilPriceDetails = \App\Models\OilPriceDetail::where('oil_price_id', $item->id)->where('is_deleted', '0')->where('is_active','1')->get(); 
                                        foreach ($OilPriceDetails as $OilPriceDetail){
                                            if($OilPriceDetail['oil_type'] == '484'){
                                                $i = $OilPriceDetail['oil_min'];
                                            }

                                            if($OilPriceDetail['oil_type'] == '485'){
                                                $j = $OilPriceDetail['oil_min'];
                                            }

                                            if($OilPriceDetail['oil_type'] == '482'){
                                                $g = $OilPriceDetail['oil_min'];
                                            }

                                            if($OilPriceDetail['oil_type'] == '486'){
                                                $k = $OilPriceDetail['oil_min'] - 363;
                                            }
                                    ?>
                                            <td class="align-middle">{{$OilPriceDetail['oil_min']}}</td>
                                    <?php
                                        }
                                    ?>
                                    <td class="align-middle"><?php echo $i - $g; ?></td>
                                    <td class="align-middle"><?php echo $j - $g; ?></td>
                                    <td class="align-middle"><?php echo $k; ?></td>
                                    <td class="align-middle">
                                        {!! getLabelStatusOnOff($item->is_deleted) !!}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL('office/strategic/oil/edit')}}/{{$item->id}}/?t={{$t}}&pr={{$pr}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">แก้ไข</i> </a>
                                        <a href="{{URL('office/strategic/oil/delete')}}/{{$item->id}}/?t={{$t}}&pr={{$pr}}" class="btn btn-outline-danger waves-effect width-md waves-light btn-sm" ><i class="mdi mdi-trash-can-outline">ลบ</i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                

                            </tbody>
                        </table>
                    </div>
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
</script>
@endsection
