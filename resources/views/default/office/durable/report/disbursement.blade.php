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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูลการเบิกพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลการเบิกพัสดุ/อุปกรณ์</h4>
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
                                    <th style="vertical-align : middle;text-align:center;">หน่วย</th>
                                    <th style="vertical-align : middle;text-align:center;">วันที่เบิกจ่าย</th>
                                    <th style="vertical-align : middle;text-align:center;">ชื่อผู้เบิกจ่าย</th>
                                    <th style="vertical-align : middle;text-align:center;">จำนวน</th>
                                    <th style="vertical-align : middle;text-align:center;">หมายเหตุ</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $no = 0;?>
                                @if (!empty($items))
                                @foreach ($items as $item)
                                <?php $no++;?>

                                <?php
                                
                                    if($item['project_id'] == 0){
                                        $name = 'สำนักงาน';
                                    }else{
                                        $info = \App\Models\Project::find((int) $item['project_id']);

                                        $name = $info->project_name;
                                    } 
                                ?>
                                <tr>
                                    <td class="align-middle" style="width:5%">{{$no}}</td>
                                    <td class="align-middle">{{$item['durable_name']}}</td>
                                    <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$item['unitcount']}}</td>
                                    <td class="align-middle" style="vertical-align : middle;text-align:center;">{{getDateShow($item['amount_date'])}}</td>
                                    <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$item['user_name']}}</td>
                                    <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$item['amount_num']}}</td>
                                    <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$name}}</td>
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
