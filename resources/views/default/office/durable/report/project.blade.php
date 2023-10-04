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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบครุภัณฑ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">รายงาน</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ครุภัณฑ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลครุภัณฑ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูลครุภัณฑ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลครุภัณฑ์</h4>
                            <p class="sub-header"></p>
                        </div>
                    </div>
                    
                    <div class="widget-main no-padding sticky-table sticky-headers sticky-rtl-cells">
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th style="vertical-align : middle;text-align:center;">ลำดับ</th>
                                    <th style="width: 14%; vertical-align : middle;text-align:center;">รายการ</th>
                                    <th style="width: 14%; vertical-align : middle;text-align:center;">หมายเลขครุภัณฑ์</th>
                                    <th style="vertical-align : middle;text-align:center;">ว/ด/ป ที่ได้มา</th>
                                    <th style="vertical-align : middle;text-align:center;">ราคา/หน่วย/ชุด/กลุ่ม</th>
                                    <th style="vertical-align : middle;text-align:center;">อายุการใช้งาน(ปี)</th>
                                    <th style="vertical-align : middle;text-align:center;">%อัตราค่าเสื่อม</th>
                                    <th style="vertical-align : middle;text-align:center;">จำนวนวัน</th>
                                    <th style="vertical-align : middle;text-align:center;">ค่าเสื่อมราคาสะสมยกมา</th>
                                    <th style="vertical-align : middle;text-align:center;">ค่าเสื่อมประจำปี</th>
                                    <th style="vertical-align : middle;text-align:center;">ค่าเสื่อมราคาสะสมยกไป</th>
                                    <th style="vertical-align : middle;text-align:center;">มูลค่าสุทธิ (บาท)</th>
                                    <th style="vertical-align : middle;text-align:center;">หมายเหตุ</th>
                                </tr>
                            </thead>


                            <tbody>
                                @if (!empty($project))
                                @foreach($project as $projects)

                                <?php 
                                    $Durable = \App\Models\Durable::where('durable_type', 'durable')->where('borrow_project',$projects['id'])->where('is_deleted','0')->where('is_active','1')->get(); 
                                    $DurableCount = $Durable->count();
                                ?>
                                <?php 
                                    if($DurableCount > 0){
                                ?>
                                    <tr>
                                        <td class="align-middle" colspan="14">{{$projects['project_name']}}</td>
                                    </tr>
                                    <?php $no = 0;?>
                                    @if (!empty($Durable))
                                    @foreach ($Durable as $item)
                                    <?php $no++;?>
                                    <?php
                                        $yearall = date('Y');

                                        $timestamp = strtotime($item['durable_received_date']);

                                        $yyyy = date('Y', $timestamp);

                                        $mm = date('n', $timestamp);

                                        $dd = date('d', $timestamp);
                                        
                                        for ($i=$yyyy; $i <= $yearall; $i++) { 
                                            $z = $i + 1 - $yyyy;     
                                            $numz = $z;

                                            $numz++;

                                            if($z == 1){ $sum1 = 0.00; }else{ $sum1 = ($item['durable_price'] * (($item['durable_depreciation_rate'] /100) * ($z-1))); }

                                            if($z == 1){ $sum2 = ($item['durable_price'] * (($item['durable_depreciation_rate'] /100) * $z)); }else{ $sum2 = ($item['durable_price'] * (($item['durable_depreciation_rate'] /100) * ($numz-$z))); }

                                            $sum3 = ($item['durable_price'] * (($item['durable_depreciation_rate'] /100) * $z));

                                            $sum = $item['durable_price'] - $item['durable_price'] * (($item['durable_depreciation_rate'] /100) * $z);
                                        }
                                    ?>
                                    <tr>
                                        <td class="align-middle">{{$no}}</td>
                                        <td class="align-middle">{{$item['durable_name']}}</td>
                                        <td class="align-middle">{{$item['durable_number']}}</td>
                                        <td class="align-middle">{{getDateShow($item['durable_received_date'])}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:right;">{{number_format($item['durable_price'],2,'.',',')}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$item['durable_year']}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$item['durable_depreciation_rate']}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:center;">366</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:right;">{{number_format($sum1,2,'.',',')}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:right;">{{number_format($sum2,2,'.',',')}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:right;">{{number_format($sum3,2,'.',',')}}</td>
                                        <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($sum > 0) {{number_format($sum,2,'.',',')}} @else 0.00 @endif</td>
                                        <td class="align-middle">{{$item['borrow_institution']}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                <?php
                                    }
                                ?>
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

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'report'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id + '/?t=durable&pr=0';

        }else if(values == 'edit'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id + '/?t=durable&pr=0';

        }else if(values == 'delete'){

            window.location='{{URL('office/durable/')}}'+ '/' + values + '/' + id;

        }else{

        }  
    });
</script>
@endsection
