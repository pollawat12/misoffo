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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">งบประมาณ > ค่าใช้จ่ายโครงการ</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">นำเข้าข้อมูลค่าใช้จ่ายโครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">นำเข้าข้อมูลค่าใช้จ่ายโครงการ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการนำเข้าข้อมูลค่าใช้จ่ายโครงการ</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right"><a href="{{url('office/budget/expenses/import/add')}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> นำเข้าข้อมูลค่าใช้จ่ายโครงการ</i></a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-striped table-bordered  dt-responsive"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="2%">ลำดับที่</th>
                                <th width="12%">ครั้งที่</th>
                                <th width="15%">อัพเดทวันที่</th>
                            </tr>
                        </thead>


                        <tbody>

                            <?php $no=0;?>
                            @if (!empty($reports))
                                @foreach ($reports as $item)
                                <?php $no++;?>
                                <tr>
                                    <td class="align-middle">{{ $no }}</td>
                                    <td class="align-middle">{{ $item['subject'] }}</td>
                                    <td class="align-middle">{{ $item['create_report_date'] }}</td>
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
            "ordering": true,
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
