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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">เบิก / ยืม / คืน พัสดุ</a></li>
                            <li class="breadcrumb-item active">ยืมพัสดุ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง เบิก / ยืม / คืน พัสดุ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลการเบิก / ยืม / คืน พัสดุ</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <!-- <a href="{{URL('office/durable/activity/search/list')}}/?t=borrow&pr=0" target="_blank"><button type="button" class="btn btn-sm btn-dark"><i class="mdi mdi-database-plus"> นำข้อมูลออก</i></button></a> -->
                            <a href="{{URL('office/durable/borrow/add')}}/?t=borrow&pr=0" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%;"># ลำดับ</th>
                                <th style="width: 10%;">วันที่</th>
                                <th style="width: 20%;">หมายเลขพัสดุ</th>
                                <th style="width: 10%;">ผู้เบิก</th>
                                <th style="width: 8%;">สถานะ</th>
                                <th style="width: 8%;">
                                    จัดการ
                                </th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['borrow_date']}}</td>
                                <td class="align-middle">{{$item['borrow_number']}}</td>
                                <td class="align-middle">@if ($item['borrow_status'] == 1) เบิก @elseif($item['borrow_status'] == 2) โอน @else ยืม @endif</td>
                                <td class="align-middle">{{$item['borrow_user_name']}}</td>
                                <td class="align-middle">
                                    {{-- <a href="{{URL('office/durable/borrow/edit')}}/{{$item['id']}}/?t=borrow&pr=0" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">แก้ไข</i> </a>
                                    <a href="{{URL('office/durable/borrow/delete')}}/{{$item['id']}}" class="btn btn-outline-danger waves-effect width-md waves-light btn-sm" ><i class="mdi mdi-trash-can-outline">ลบ</i></a> --}}

                                    <select name="input_action" class="form-control select-new" data-id="{{$item['id']}}">
                                        <option value="">เลือก</option>
                                        <option value="print" >พิมพ์เอกสาร</option> 
                                        <option value="edit" >แก้ไข</option>
                                        <option value="receive" >รับ</option>
                                        <option value="returns" >คืน</option>
                                        <option value="delete" >ลบ</option>
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

        <div id="div-data-url-new" data-url="{{url('office/purchases')}}"></div>

        <div id="url-redirect-back" data-url="{{url('office/durable/borrow/lists')}}/?t={{$t}}&pr={{$pr}}"></div>

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

    $(document).on('change', '.select-new', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'report'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id + '/?t=borrow&pr=0';

        }else if(values == 'edit'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id + '/?t=borrow&pr=0';

        }else if(values == 'receive'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id + '/?t=borrow&pr=0';

        }else if(values == 'returns'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id + '/?t=borrow&pr=0';

        }else if(values == 'delete'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id;

        }else if(values == 'print'){

            window.location='{{URL('office/durable/borrow')}}'+ '/' + values + '/' + id + '/?t=borrow&pr=0';

        }else{

        }  
    });

    $(document).on('change', '.btn-action-new', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        if(title == 'add'){
            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val('');
                $("#frm-save #input-purchases_status_file").val('');
                $("#frm-save #input-purchases_status_to").val('0');
                $("#frm-save #input-purchases_status_update").val('0');
                $("#frm-save #input-purchases_status_date").val('');
                $("#frm-save #input-edit_id").val('0');
            }, "json");

        }else if(title == 'edit'){

            $('#con-close-modal').modal('show'); 

            var _url = $("#div-data-url-new").attr("data-url")+"/get/info/?id="+id+"&type="+title;

            $.get(_url, function(res){
                $("#frm-save #input-purchases_status_message").val(res.info.purchases_status_message);
                $("#frm-save #input-purchases_status_file").val(res.info.purchases_status_file);
                $("#frm-save #input-purchases_status_to").val(res.info.purchases_status_to);
                $("#frm-save #input-purchases_status_update").val(res.info.purchases_status_update);
                $("#frm-save #input-purchases_status_date").val(res.info.purchases_status_date);
                $("#frm-save #input-is_status").val(res.info.is_status);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(title == 'show'){
            window.open('{{URL('office/purchases/show')}}'+ '/' + values, '_blank');
        }else{
            
        }
        
    });

    $('#button_add').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.href = urlRedirect;
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[purchases_status_message]': {
                    required: true
                }
            },
            messages: {
                'input[purchases_status_message]': {
                    required: "กรุณากรอก"
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
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitFormImage("frm-save", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });
</script>
@endsection
