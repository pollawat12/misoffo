@extends('default.layouts.main')

@section('css')
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">บริษัท/ผู้ค้า</li>
                        </ol>
                    </div>
                    <h4 class="page-title">บริษัท/ผู้ค้า</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        
        <span id="loadBudget">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">

                        <div class="row mb-3">
                            <div class="col-10">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล บริษัท/ผู้ค้า</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{url('office/budget/certificate/company/add')}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">ชื่อบริษัท/ผู้ค้า</th>
                                    <th width="10%">เลขที่</th>
                                    <th width="10%">ผู้ติดต่อ</th>
                                    <th width="10%">เบอร์โทรศัพท์</th>
                                    <th style="width: 8%">จัดการ</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $no = 0;?>
                                @if (!empty($items))
                                @foreach ($items as $item)
                                <?php $no++;?>
                                <tr>
                                    <td class="align-middle">{{$no}}</td>
                                    <td class="align-middle">{{$item['company_name']}}</td>
                                    <td class="align-middle">{{$item['company_num']}}</td>
                                    <td class="align-middle">{{$item['company_contact']}}</td>
                                    <td class="align-middle">{{$item['company_tel']}}</td>
                                    <td>
                                        <select name="input_action" class="form-control btn-action"  data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            <option value="certificate/company/edit" >แก้ไข</option>
                                            <option value="certificate/company/deleted" >ลบ</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </span>
        <div id="div-data-url-new" data-url="{{url('office/budget')}}"></div>     
        
        <div id="div-data-url" data-url="{{url('office/budget/certificate/all')}}"></div>   
    </div>
</div>

<!-- /.modal -->
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

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(document).ready(function () {
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


    $(document).on('change', '.btn-action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/budget/')}}'+ '/' + values + '/' + id;
        } 
    });


</script>
@endsection


