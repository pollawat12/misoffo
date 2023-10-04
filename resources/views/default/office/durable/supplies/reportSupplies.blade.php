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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">การรับพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูล พัสดุ/อุปกรณ์</i> </h4>

                        @foreach ($info as $infos)

                        <div class="row">
                            <div class="col-md-12">
                                <table style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th colspan="4" align="center" style="height: 55px;">บัญชีวัสดุ </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="height: 55px;"><b>ประเภท : </b>  {{$infos['category']}}</td>
                                        <td colspan="2" ><b>ชื่อหรือชนิดวัสดุ : </b>  {{$infos['durable_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 55px;"><b>ขนาดลักษณะ : </b>  </td>
                                        <td style="height: 55px;"></td>
                                        <td style="height: 55px;"><b>จำนวนอย่างสูง : </b>  {{$infos['durable_mix']}}</td>
                                        <td style="height: 55px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="height: 55px;"><b>หน่วยนับ : </b>  {{$infos['borrow_institution']}}</td>
                                        <td style="height: 55px;"><b>ที่เก็บ : </b>  {{$infos['durable_storage_location']}}</td>
                                        <td style="height: 55px;"><b>จำนวนอย่างต่ำ : </b>  {{$infos['durable_mix']}}</td>
                                        <td style="height: 55px;"><b>รหัส : </b></td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        @endforeach

                        <div class="row">
                            <div class="col-md-12">
                                <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th rowspan="2">วัน/เดือน/ปี</th> 
                                            <th rowspan="2">รับจาก/จ่ายให้</th>
                                            <th rowspan="2">เลขที่ใบสำคัญ</th>
                                            <th rowspan="2">ราคาต่อหน่วย (บาท)</th>
                                            <th colspan="2">รับ</th>
                                            <th colspan="2">จ่าย</th>
                                            <th colspan="2">คงเหลือ</th>
                                            <th rowspan="2">หมายเหตุ</th>
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            <th>จำนวน</th>  
                                            <th>ราคา</th> 
                                            <th>จำนวน</th>  
                                            <th>ราคา</th> 
                                            <th>จำนวน</th>  
                                            <th>ราคา</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 0;?>
                                    @if (!empty($item))
                                    @foreach ($item as $items)
                                    <?php $no++;?>
                                        <tr>
                                            <td>{{getDateShow($items['amount_date'])}}</td>
                                            <td>{{$items['amount_name']}}</td>
                                            <td></td>
                                            <td>{{number_format($items['amount_price'],2,'.',',')}}</td>
                                            <td>{{number_format($items['amount_num'],2,'.',',')}}</td>
                                            <td>{{number_format($items['amount_sum'],2,'.',',')}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{number_format($items['amount_num'],2,'.',',')}}</td>
                                            <td>{{number_format($items['amount_sum'],2,'.',',')}}</td>
                                            <td></td>
                                        <tr>
                                        <?php
                                            $Checkitems = \App\Models\DurableDisbursement::where('lot_id', $items['id'])->where('is_deleted', '0')->where('is_active','1')->get();

                                            if($items['project_id'] == 0){
                                                $name = 'สำนักงาน';
                                            }else{
                                                $info = \App\Models\Project::find((int) $items['project_id']);

                                                $names = $info->project_name;
                                            } 

                                            foreach ($Checkitems as $value) {
                                        ?>
                                        <tr>
                                            <td>{{getDateShow($value->amount_date)}}</td>
                                            <td>{{$value->affiliate}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{$value->amount_num}}</td>
                                            <td>{{number_format($items->amount_price * $value->amount_num,2,'.',',')}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <tr>
                                        <?php
                                            }
                                        ?>
                                    @endforeach
                                    @endif    
                                    </tbody>
                                </table>    
                            </div>
                        </div>

                        
                        <a href="{{URL('office/durable/lists')}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> กลับหน้าแรก</i></a>
                    
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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
</script>
@endsection
