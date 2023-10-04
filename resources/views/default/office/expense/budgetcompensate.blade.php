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
                            <li class="breadcrumb-item active">งบประมาณ > เงินชดเชย</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เงินชดเชย</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
         
        <?php foreach ($infos as $info);?>
        <span id="loadBudget">
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">

                        <!-- <div class="row mb-3">
                            <div class="col-10">
                                
                            </div>
                            <div class="col-2 text-right">
                                <select name="year_id_n" id="year_id_n" class="form-control" style="height: 40px; ">
                                    <option value="">--เลือก--</option>
                                    @if (count($year) > 0)
                                    @foreach($year as $valyear)
                                    <option value="{{$valyear['year_id']}}" @if($valyear['year_id'] == $info['year_id']) selected @endif>{{$valyear['year_name']}}</option>
                                    @endforeach
                                    @endif
                                </select>  
                            </div>
                        </div> -->


                        <div class="row mb-3">
                            <div class="col-10">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล เงินชดเชยจากกองทุนน้ำมันเชื้อเพลิง</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{url('office/expenses/compensate/add')}}/{{$id}}/?t={{$t}}&pr={{$pr}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr class="bg-dark text-white">
                                    <th width="5%" class="text-center align-middle" rowspan="2">ลำดับ</th>
                                    <th width="20%" rowspan="2" class="align-middle">เลขที่หนังสือกรมสรรพสามิต
                                    </th>
                                    <th class="text-center align-middle" rowspan="2" width="15%">บริษัท/หน่วยงาน
                                    </th>
                                    <th width="10%" class="text-center align-middle" rowspan="2">ลงวันที่</th>
                                    <th class="text-center align-middle" colspan="2">จำนวนรวม</th>
                                    <th class="text-center align-middle" rowspan="2">สถานะ</th>
                                    <th class="text-center align-middle" rowspan="2" width="15%">จัดการ</th>
                                </tr>

                                <tr class="bg-dark text-white">
                                    <th class="text-center align-middle">ปริมาณ
                                        (ลิตร)/(กิโลกรัม)</th>
                                    <th class="text-center align-middle">จำนวนเงินขอรับชดเชย
                                        (บาท)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @if (!empty($items))
                                @foreach ($items as $item)
                                <?php $no++;?>
                                    <tr>
                                        <td class="align-middle text-center">{{$no}}</td>
                                        <td class="align-middle">{{$item['compensate_num']}}</td>
                                        <td class="align-middle text-center">{{$item['compensate_payfor']}}</td>
                                        <td class="align-middle text-center">{{getDateShow($item['compensate_date'])}}</td>
                                        <td class="align-middle text-center">
                                        {{number_format($item['price'],2,'.',',')}}</td>
                                        <td class="align-middle text-center">
                                        {{number_format($item['liter'],2,'.',',')}}</td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-success p-1 font-size-14">
                                                ดำเนินการเสร็จสิ้น
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{url('office/expenses/compensate/edit')}}/{{$item['id']}}/?t={{$t}}&pr={{$pr}}"><button type="button"
                                                class="btn btn-warning waves-effect width-md waves-light">
                                                <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                            </button></a>
                                            <a href="{{url('office/expenses/compensate/deleted')}}/{{$item['id']}}/?t={{$t}}&pr={{$pr}}"><button type="button"
                                                class="btn btn-danger waves-effect width-md waves-light">
                                                <i class="mdi mdi-trash-can-outline"></i> ลบ
                                            </button></a>
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
        
        <div id="div-data-url" data-url="{{url('office/expenses/charges')}}/{{$id}}"></div>   
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


    $(document).on('change', '.btn-action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/expenses')}}'+ '/' + values + '/' + id + '/{{$id}}/?t={{$t}}&pr={{$pr}}';
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


    $(document).on('change', '#year_id_n', function(params) {
        let values = $(this).val();

        window.location='{{URL('office/expenses/charges')}}'+ '/' +values+'?t={{$t}}&pr={{$pr}}';
        
    });
</script>
@endsection


