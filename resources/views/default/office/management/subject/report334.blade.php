@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{url('assets/default/css/jquery.stickytable.min.css')}}">
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
                            <li class="breadcrumb-item active">ปริมาณการใช้น้ำมันเชื้อเพลิง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ปริมาณการใช้น้ำมันเชื้อเพลิง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i> </h4>
                    

                                <div class="no-padding sticky-table sticky-rtl-cells table-responsive sroll-box">
                                    <table id="datatable" class="table table-bordered" style="width: 100%;">

                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th style="width: 2%" class="align-middle text-center text-nowrap">ลำดับ</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">วันที่</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">ออกเทน 91</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">ออกเทน 95</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">อี 20</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">อี 85</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">เบนซิน</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">รวมเบนซิน</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">บี 7 </th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">บี 7 ชนิดพิเศษ</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">บี 7 ชนิดพิเศษ ยูโร 5</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">ธรรมดา</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">ธรรมดา ชนิดพิเศษ</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">บี 20</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">รวม</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">10 PPM</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">50 PPM</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">กำมะถันสูง</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">เขตต่อเนื่อง</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">รวม</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">รวมกลุ่มดีเซล</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">JET A-1</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">LPG (ล้าน กก./วัน)</th>
                                            <th style="width: 8%" class="align-middle text-center text-nowrap">น้ำมันเตา</th>
                                        </tr>
                                    </thead>
                                        <tbody>   
                                        <?php $noN = 0;?>
                                        @if (!empty($groupoil))
                                        @foreach ($groupoil as $details)
                                        <?php $noN++;?>
                                        <?php $obj = json_decode($details['date_json']); ?>
                                        <tr>
                                            <td class="align-middle text-center">{{$noN}}</td>
                                            <td class="align-middle text-center"><?php echo $obj->{'Month'}.' '.$obj->{'Year'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'Octane91'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'Octane95'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'E20'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'E85'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'petrol'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'Octane91'} + $obj->{'Octane95'} + $obj->{'E20'} + $obj->{'E85'} + $obj->{'petrol'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B7'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B72'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B73'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B74'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B75'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B20'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'B7'} + $obj->{'B72'} + $obj->{'B73'} + $obj->{'B74'} + $obj->{'B75'} + $obj->{'B20'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'10PPM'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'50PPM'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'brimstone'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'county'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'10PPM'} + $obj->{'50PPM'} + $obj->{'brimstone'} + $obj->{'county'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'10PPM'} + $obj->{'50PPM'} + $obj->{'brimstone'} + $obj->{'county'} + $obj->{'B7'} + $obj->{'B72'} + $obj->{'B73'} + $obj->{'B74'} + $obj->{'B75'} + $obj->{'B20'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'JETA1'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'LPG'};?></td>
                                            <td class="align-middle text-center"><?php echo $obj->{'stove'};?>
                                        </tr>


                                        @endforeach
                                        @endif
                                        </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>
        <!-- end row -->
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

@endsection
