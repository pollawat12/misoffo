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
                            <li class="breadcrumb-item active"> ปิโตรเลียม OFFO Crude</li>
                        </ol>
                    </div>
                    <h4 class="page-title"> ปิโตรเลียม OFFO Crude</h4>
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
                    

                                <div class="no-padding sticky-table sticky-rtl-cells">
                                    <table id="datatable" class="table table-bordered" style="width: 100%;">

                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th style="width: 2%" rowspan="2" class="align-middle text-center">ลำดับ</th>
                                            <th style="width: 5%" rowspan="2" class="align-middle text-center">วันที่</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">TAPIS</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">OMAN</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">DUBAI</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">BRENT</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">FORCADOS</th>
                                            <th style="width: 10%" colspan="2" class="align-middle text-center">WTI</th>
                                            <th style="width: 6%" rowspan="2" class="align-middle text-center">งบประมาณที่ได้รับ </th>
                                            <th style="width: 6%" rowspan="2" class="align-middle text-center">งบประมาณที่ได้รับ </th>
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                            <th style="width: 5%">MIN</th>
                                            <th style="width: 5%">MAX</th>
                                        </tr>
                                    </thead>
                                        <tbody>   
                                        <?php $noN = 0;?>
                                        @if (!empty($groupoil))
                                        @foreach ($groupoil as $details)
                                        <?php $noN++;?>
                                        <?php $obj = json_decode($details['date_json']); ?>
                                        <tr>
                                            <td style="width: 5%" class="align-middle text-center">{{$noN}}</td>
                                            <td style="width: 5%" class="align-middle text-center">{{getDateShow($details['date_report'])}}</td>
                                            <td style="width: 5%"><?php echo $obj->{'TAPIS_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'TAPIS_MAX'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'OMAN_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'OMAN_MAX'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'DUBAI_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'DUBAI_MAX'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'BRENT_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'BRENT_MAX'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'FORCADOS_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'FORCADOS_MAX'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'WTI_MiN'};?></td>
                                            <td style="width: 5%"><?php echo $obj->{'WTI_MAX'};?></td>
                                            <td style="width: 5%" class="align-middle text-center"><?php echo $obj->{'BUYING'};?></td>
                                            <td style="width: 5%" class="align-middle text-center"><?php echo $obj->{'SELLING'};?></td>
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
