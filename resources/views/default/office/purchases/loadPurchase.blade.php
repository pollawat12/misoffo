@extends('default.layouts.load')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลจัดซื้อ - จัดจ้าง</i> </h4>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#update-name" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                        <span class="d-none d-sm-block">จัดซื้อ - จัดจ้าง</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#update-company" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                        <span class="d-none d-sm-block">คู่สัญญา</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#update-inspector" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                        <span class="d-none d-sm-block">เจ้าหน้าที่ตรวจสอบ</span>
                    </a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="update-name">
                    <p>
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เรื่อง</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_name}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขที่ใบสั่งซื้อ</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_order_number}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_invoice_date != NULL) {{getDateFormatToInputThai($info->purchases_invoice_date)}} @endif</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_fiscal_year}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">งบประมาณที่ได้รับจัดสรรร</h4>
                                    <label for="exampleInputEmail1">{{number_format($info->purchases_allocated_budget,2,'.',',')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ราคากลาง</h4>
                                    <label for="exampleInputEmail1">{{number_format($info->purchases_middle_price,2,'.',',')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วิธีการจัดซื้อ จัดจ้าง</h4>
                                    @if (count($purchasesmethod) > 0)
                                        @foreach($purchasesmethod as $keypurchasesmethod => $valpurchasesmethod)
                                            <label for="exampleInputEmail1">@if($valpurchasesmethod->id == $info->purchases_method) {{$valpurchasesmethod->name}} @endif</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </p>
                </div>
                <div class="tab-pane" id="update-company">
                    <p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ชื่อบริษัท/ห้าง/ร้าน</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_company}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขที่สัญญา</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_contract_number}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่ทำสัญญา</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_contract_date != NULL) {{getDateFormatToInputThai($info->purchases_contract_date)}} @endif</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่ครบกำหนดสัญญา</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_contract_expiration_date != NULL) {{getDateFormatToInputThai($info->purchases_contract_expiration_date)}} @endif</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">จำนวนเงินตามสัญญา</h4>
                                    <label for="exampleInputEmail1">{{number_format($info->purchases_contract_amount,2,'.',',')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ประเภทหลักประกัน</h4>
                                    @if (count($purchasesmargin) > 0)
                                        @foreach($purchasesmargin as $keypurchasesmargin => $valpurchasesmargin)
                                            <label for="exampleInputEmail1">@if($valpurchasesmargin->id == $info->purchases_margin_type) {{$valpurchasesmargin->name}} @endif</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ธนาคาร</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_bank}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">เลขที่บัญชี</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_account_number}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ลงวันที่</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_contrac_dated != NULL) {{getDateFormatToInputThai($info->purchases_contrac_dated)}} @endif</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">จำนวนเงินวางประกัน</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_insurance_amount}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ระยะเวลาการรับประกัน (เริ่มต้น)</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_warranty_start != NULL) {{getDateFormatToInputThai($info->purchases_warranty_start)}} @endif</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ระยะเวลาการรับประกัน (สิ้นสุด)</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_warranty_end != NULL) {{getDateFormatToInputThai($info->purchases_warranty_end)}} @endif</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่กรรมการตรวจรับ</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_date_committee != NULL) {{getDateFormatToInputThai($info->purchases_date_committee)}} @endif</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่ครบกำหนดคืน</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_date_return_due != NULL) {{getDateFormatToInputThai($info->purchases_date_return_due)}} @endif</label>
                                </div>
                            </div>
                        </div>
                    </p>
                </div>
                <div class="tab-pane" id="update-inspector">
                    <p>
                        <?php $no = 0;?>
                        @if (!empty($detail))
                            @foreach ($detail as $item)
                            <?php $no++;?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4 class="header-title" style="font-size:16px !important;">ชื่อเจ้าหน้าที่ ตรวจสอบ</h4>
                                            @if (count($employees) > 0)
                                                @foreach($employees as $valemployees)
                                                    <label for="exampleInputEmail1">@if($valemployees['id'] == $item['purchases_inspector']) {{$valemployees['name']}} @endif</label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4 class="header-title" style="font-size:16px !important;">ตำแหน่ง</h4>
                                                <label for="exampleInputEmail1">@if($item['position_id'] == 1) ประธานกรรมการ @elseif($item['position_id'] == 2) กรรมการ @endif</label>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">สถานะจัดซื้อ - จัดจ้าง</h4>
                                    @if (count($purchasesstatus) > 0)
                                        @foreach($purchasesstatus as $keypurchasesstatus => $valpurchasesstatus)
                                            <label for="exampleInputEmail1">@if($valpurchasesstatus->id == $info->purchases_purchasing_status) {{$valpurchasesstatus->name}} @endif</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">วันที่ ตรวจสอบ</h4>
                                    <label for="exampleInputEmail1">@if ($info->purchases_check_date != NULL) {{getDateFormatToInputThai($info->purchases_check_date)}} @endif</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">หมายเหตุ</h4>
                                    <label for="exampleInputEmail1">{{$info->purchases_note}}</label>
                                </div>
                            </div>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
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



<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>
@endsection
