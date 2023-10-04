@extends('default.template')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item active">งบประมาณ/การเงิน > รายงาน > รายได้</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายงาน รายได้</h4>
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
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> สรุปข้อมูลตามรายละเอียดใบแจ้งหนี้ จากระบบ GCL ของ สนง.ทสจ.และกรุงเทพมหานคร </i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                        </div>
                    </div>

                    <table id="datatable" class="table table-striped table-bordered nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th rowspan="2">งวดที่</th>
                                <th colspan="3">รายงานตามใบแจ้งหนี้</th>
                                <th colspan="3">เงินเพิ่ม</th>
                                <th colspan="3">รายงานการรับชำระเงิน</th>
                                <th colspan="3">ลูกหนี้ค้างชำระ (เงินต้น)</th>
                                <th colspan="3">ลูกหนี้ค้างชำระ (เงินเพิ่ม)</th>
                                <th rowspan="2">รวมลูกหนี้ค้างชำระ</th>
                            </tr>
                            <tr class="bg-dark text-white">
                                <th>ค่าอนุรักษ์ใช้ฯ</th>
                                <th>ค่าใช้น้ำฯ 50% (กพน.)</th>
                                <th>รวมรายได้ กพน. </th>

                                <th>ค่าอนุรักษ์ใช้ฯ</th>
                                <th>ค่าใช้น้ำฯ 50% (กพน.)</th>
                                <th>รวมรายได้ กพน. </th>

                                <th>ค่าอนุรักษ์ใช้ฯ</th>
                                <th>ค่าใช้น้ำฯ 50% (กพน.)</th>
                                <th>รวมรายได้ กพน. </th>

                                <th>ค่าอนุรักษ์ใช้ฯ</th>
                                <th>ค่าใช้น้ำฯ 50% (กพน.)</th>
                                <th>รวมรายได้ กพน. </th>

                                <th>ค่าอนุรักษ์ใช้ฯ</th>
                                <th>ค่าใช้น้ำฯ 50% (กพน.)</th>
                                <th>รวมรายได้ กพน. </th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (count($arrayReports) > 0)
                                @foreach ($arrayReports as $arr)
                                <tr>
                                    <td>{{ $arr['subject'] }}</td>
                                    
                                    <td class="text-right">{{ $arr['g_conv_total'] }}</td>
                                    <td class="text-right">{{ $arr['g_water_cost_total'] }}</td>
                                    <td class="text-right">{{ $arr['g_receive_total'] }}</td>

                                    <td class="text-right">{{ $arr['g_rateup_conv_total'] }}</td>
                                    <td class="text-right">{{ $arr['g_rateup_water_cost_total'] }}</td>
                                    <td class="text-right">{{ $arr['g_rateup_receive_total'] }}</td>

                                    <td class="text-right">{{ $arr['receive_conv_total'] }}</td>
                                    <td class="text-right">{{ $arr['receive_water_cost_total'] }}</td>
                                    <td class="text-right">{{ $arr['receive_receive_total'] }}</td>

                                    <td class="text-right">{{ $arr['wait_conv_total'] }}</td>
                                    <td class="text-right">{{ $arr['wait_water_cost_total'] }}</td>
                                    <td class="text-right">{{ $arr['wait_receive_total'] }}</td>

                                    <td class="text-right">{{ $arr['wait_rateup_conv_total'] }}</td>
                                    <td class="text-right">{{ $arr['wait_rateup_water_cost_total'] }}</td>
                                    <td class="text-right">{{ $arr['wait_rateup_receive_total'] }}</td>

                                    
                                    <td class="text-right">{{ $arr['wait_payment_total'] }}</td>
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

<div id="url-action-update" data-url="{{ URL('office/budget/debtors/import-form/update') }}"></div>
<div id="url-action-view" data-url="{{ URL('office/budget/debtors/view') }}"></div>
<div id="url-action-delete" data-url="{{ URL('office/budget/debtors/delete') }}"></div>
@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>


<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>


<script>
    $(document).on('change', '.select-action', function(params) {
        let itemId = $(this).attr('data-id');
        let actionType = $(this).val();

        var actionUrl = $("#url-action-update").attr('data-url') + "/" + itemId;

        if (actionType != "") {
            if (actionType == 'view') { actionUrl = $("#url-action-view").attr('data-url') + "/?rpid=" + itemId; }
            if (actionType == 'delete') { actionUrl = $("#url-action-delete").attr('data-url') + "/" + itemId; }


            window.location = actionUrl;
        } else {
            ajaxSweetAlert("errro", "กรุณาระบุประเภทจัดการ", "แจ้งเตือน");
        }
    });


    $(function(){
        $("#datatable").DataTable({
            "ordering": false,
            "scrollX": true,
            "dom": 'Bfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    header: true
                }
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
    });
</script>
@endsection
