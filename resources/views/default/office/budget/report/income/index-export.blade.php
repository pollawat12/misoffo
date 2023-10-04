@extends('default.template-blank')

@section('css')
    
@endsection


@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- third party css -->
    <link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid">
        <!-- Content here -->
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
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <!-- Required datatable js -->
    <script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

    <script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>
    <!-- Responsive examples -->
    <script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script>
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
</body>
</html>
@endsection

@section('js')

@endsection