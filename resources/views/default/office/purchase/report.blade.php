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
                           
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th ># ลำดับ</th>
                                <th>บันทึกเลขที่</th>
                                <th >เรื่อง</th>
                                <th >บริษัทคู่สัญญา</th>
                                <th >วิธีการจัดซื้อจัดจ้าง</th>
                                <th >ราคาที่เสนอ</th>
                                <th >สถานะ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle" style="width: 6%;">{{$no}}</td>
                                <td class="align-middle" style="width: 15%;">{{$item['purchases_order_number']}}</td>
                                <td class="align-middle" style="width: 12%;">{{$item['purchases_name']}}</td>
                                <td class="align-middle" style="width: 12%;">
                                <?php

                                    if($item['purchases_offer_name'] != ''){
                                        $valcompany = \App\Models\BudgetCertificateCompany::find((int) $item['purchases_offer_name']);

                                        echo $valcompany->company_name;
                                    }
                                    
                                ?>
                                </td>
                                <td class="align-middle" style="width: 12%;">{{$item['purchases_method']}}</td>
                                <td class="align-middle" style="width: 10%;">{{number_format($item['purchases_offer_price'],2,'.',',')}}</td>
                                <td class="align-middle" style="width: 10%;"><?php if($item['purchases_status'] == 1){ echo 'ขออนุมัติหลักการ'; }elseif($item['purchases_status'] == 2){ echo 'รายงานขอซื้อขอจ้าง'; }elseif($item['purchases_status'] == 3){ echo 'รายงานผลการพิจารณา/สั่งซื้อสั่งจ้าง'; }elseif($item['purchases_status'] == 4){ echo 'สัญญา/ใบสั่งซื้อจ้าง'; }else{ echo 'ตรวจรับงาน/เบิกจ่าย'; }?></td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
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
            "dom": 'Bfrtip',
            "buttons": [
                'excel' , 'print'
            ],
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

            window.location='{{URL('office/purchases/')}}'+ '/' + values + '/' + id;

        }else if(values == 'downloads'){

            window.open('{{URL('')}}' + '/' + title, '_blank');

        }else if(values == 'edit'){

            window.location='{{URL('office/purchases/')}}'+ '/' + values + '/' + id;

        }else if(values == 'delete'){

            window.location='{{URL('office/purchases/')}}'+ '/' + values + '/' + id;

        }else if(values == 'detail'){

            window.location='{{URL('office/purchases/')}}'+ '/' + values + '/' + id;

        }else{

        }  
    });
</script>
@endsection
