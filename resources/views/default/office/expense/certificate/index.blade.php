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
                            <li class="breadcrumb-item active">การเงิน > ใบสำคัญจ่าย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ใบสำคัญจ่าย</h4>
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
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ใบสำคัญจ่าย</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{url('office/expenses/certificate/add')}}/?t={{$t}}&pr={{$pr}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%">ลำดับ</th>
                                    <th width="8%">เลขที่</th>
                                    <th width="10%">วันที่</th>
                                    <th width="10%">ประเภทการจ่าย</th>
                                    <th width="10%">จ่ายให้</th>
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
                                    <td class="align-middle">{{$item['certificate_num']}}</td>
                                    <td class="align-middle">{{getDateShow($item['certificate_date'])}}</td>
                                    <td class="align-middle">@if($item['certificate_type'] == 1) โอนเงินผ่านระบบผ่านอิเล็กทรอนิกส์ @elseif($item['certificate_type'] == 2) เงินสด @else เช็ค @endif</td>
                                    <td class="align-middle">
                                        <?php
                                            $company = \App\Models\BudgetCertificateCompany::where('id', $item['certificate_payfor'])->get();
                                            foreach($company as $val)
                                        ?>
                                        {{$val['company_name']}}
                                    </td>
                                    <td>
                                        <select name="input_action" class="form-control btn-action"  data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            <option value="certificate/view" >ดูรายละเอียด</option> 
                                            <option value="certificate/edit" >แก้ไข</option>
                                            <option value="certificate/deleted" >ลบ</option>
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
        
        <div id="div-data-url" data-url="{{url('office/expenses/certificate/all')}}"></div>   
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
            window.location='{{URL('office/expenses/')}}'+ '/' + values + '/' + id + '/?t={{$t}}&pr={{$pr}}';
        } 
    });


</script>
@endsection


