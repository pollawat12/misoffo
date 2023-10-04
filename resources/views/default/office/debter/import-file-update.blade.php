@extends('default.template')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item active">งบประมาณ > รายได้</li>
                        </ol>
                    </div>
                    <h4 class="page-title">อัพเดท รายได้</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/document.svg" title="document.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">ใบแจ้งหนี้ (ทั้งหมด)</p>
                            <h2 class="mb-2"><span data-plugin="counterup">{{ $summary['invoice_total'] }}</span></h2>
                            <span class="text-right">รายการ</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/news.svg" title="news.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right text-danger">
                            <p class="mt-1 text-uppercase font-weight-medium">ใบแจ้งหนี้ (รอชำระเงิน)</p>
                            <h2 class="mb-2"><span data-plugin="counterup" class="text-danger">{{ $summary['invoice_wait'] }}</span></h2>
                            <span class="text-right">รายการ</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/cancel.svg" title="cancel.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right text-danger">
                            <p class="mt-1 text-uppercase font-weight-medium">จำนวนเงิน (รอชำระเงิน)</p>
                            <h2 class="mb-2"><span data-plugin="counterup" class="text-danger">{{ $summary['invoice_wait_total'] }}</span></h2>
                            <span class="text-right">บาท</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="media">
                        <div class="avatar-lg bg-icon rounded-circle align-self-center">
                            <img class="avatar-sm" src="{{url('assets/default')}}/images/icons/ok.svg" title="ok.svg">
                        </div>
                        <div class="wigdet-two-content media-body text-right">
                            <p class="mt-1 text-uppercase font-weight-medium">จำนวนเงิน (ชำระเงินแล้ว)</p>
                            <h2 class="mb-2"><span data-plugin="counterup">{{ $summary['invoice_grand_total'] }}</span></h2>
                            <span class="text-right">บาท</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="row">

            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> อัพเดท ใบแจ้งหนี้</i> </h4>

                    <form action="{{url('office/budget/import/invoice/update/data')}}" enctype="multipart/form-data" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="subject_id" value="{{ $id }}">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <p>เรื่อง <code>*</code></p>
                                    <input type="text" name="subject[name]" class="form-control" id="subject_name" value="{{ $subjectInfo->subject }}" readonly>
                                    <span class="font-14 text-muted">ตัวอย่าง ประจำงวดที่ </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <p>งวดที่ <code>*</code></p>
                                    <input type="text" name="subject[time_no]" class="form-control" id="subject_time_no" value="{{ $subjectInfo->time_no }}" placeholder="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <p>ปีงบ <code>*</code></p>
                                    <input type="text" name="subject[budget_year]" class="form-control" id="subject_budget_year" value="{{ $subjectInfo->budget_year }}" placeholder="62">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p>วันที่เริ่ม <code>*</code></p>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="subject[start_date]" id="datepicker-autoclose22-start_date" readonly value="{{ getDateFormatToInputThai($subjectInfo->start_date) }}" data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p>วันที่สิ้นสุด <code>*</code></p>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="subject[end_date]" id="datepicker-autoclose22-end_date" readonly value="{{ getDateFormatToInputThai($subjectInfo->end_date) }}" data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <p>ครบกำหนดชำระเงิน <code>*</code></p>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป" name="subject[paid_expire_date]" id="datepicker-autoclose22-paid_expire_date" readonly value="{{ getDateFormatToInputThai($subjectInfo->paid_expire_date) }}" data-provide="datepicker" data-date-language="th-th">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>ไฟล์เอกสาร <code>*</code></p>
                                    <input type="file" class="filestyle" name="file_upload" id="file_upload">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>หมายเหตุ </p>
                                    <textarea name="subject[note]" class="form-control" id="subject_note" cols="30" rows="4">{{ $subjectInfo->note }}</textarea >
                                </div>
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-database-plus"> บันทึก</i>
                        </button>
                        <a href="{{URL('office/budget/debtors/all')}}"  class="btn btn-secondary"><i class="mdi mdi-keyboard-backspace"> ย้อนกลับ</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แสดงรายการ ใบแจ้งหนี้</i> </h4>

                    <table id="datatable" class="table table-striped table-bordered  dt-responsive"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="6%">ลำดับที่</th>
                                <th width="8%">จังหวัด</th>
                                <th width="12%">เลขที่ใบแจ้งหนี้</th>
                                <th width="12%">หมายเลขบ่อหลัก</th>
                                <th width="22%">ชื่อผู้ได้รับใบอนุญาต</th>
                                <th width="12%">เลขที่ใบเสร็จ</th>
                                <th width="10%">รวมเป็นเงิน</th>
                                <th width="10%">สถานะใบแจ้งนี้</th>
                                <th width="20%" style="text-align: center;">จัดการ</th>
                            </tr>
                        </thead>
                        

                        <tbody>
                            <?php $no = 0;?>
                            @if (count($invoices) > 0)
                            @foreach ($invoices as $item)
                            <?php $no++;?>
                                <tr id="item-{{ $item['invoice_id'] }}">
                                    <td>{{ $no }}</td>
                                    <td>{{ $item['province'] }}</td>
                                    <td>{{ $item['invoice_code'] }}</td>
                                    <td>{{ $item['pond_master_no'] }}</td>
                                    <td>{{ $item['company'] }}</td>
                                    <td>{{ getImportCommaWithArray($item['receipt_code']) }}</td>
                                    <td>{{ getNumberCurrency($item['total_cost']) }}</td>
                                    
                                    <td>{!! $item['invoice_status'] !!}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ URL('office/budget/debtors/import-form/update/item/edit') }}/{{ $item['invoice_id'] }}" class="btn btn-outline-warning btn-rounded waves-effect"><i class="mdi mdi-pencil-plus-outline"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-rounded waves-effect btn-del" data-url="{{url('office/budget/debtors/import-form/update/item/delete')}}" data-id="{{ $item['invoice_id'] }}"><i class="mdi mdi mdi-trash-can"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

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


<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language:'th-th',
        thaiyear: true,
        autoclose: !0,
        todayHighlight: !0
    });

    $(document).ready(function () {
        // $("#datatable").DataTable({
        //     "pageLength": 50
        // });
        $("#datatable").DataTable({
            "ordering": true,
            "pageLength": 25,
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

    $(function () {
        
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.reload();
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {//time_no  budget_year
                'subject[time_no]': {
                    required: true
                },
                'subject[budget_year]': {
                    required: true
                }
            },
            messages: {
                'subject[time_no]': {
                    required: "กรุณากรอกเลขที่งวด"
                },
                'subject[budget_year]': {
                    required: "กรุณากรอกปี พ.ศ."
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
