@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">ตำแหน่งงาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ตำแหน่งงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ตำแหน่งงาน</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/settings/data/add')}}/?t={{$t}}&pr={{$pr}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 8%"># ลำดับ</th>
                                <th>ตำแหน่งงาน</th>
                                <th style="width: 15%">สถานะใช้งาน</th>
                                <th style="width: 15%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item->name}}</td>
                                <td class="align-middle">
                                    {!! getLabelStatusOnOff($item->is_deleted) !!}
                                </td>
                                <td class="align-middle">
                                    {{-- <a href="{{URL('office/settings/data/edit')}}/{{$item->id}}/?t={{$t}}&pr={{$pr}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm"><i class="mdi mdi-pencil-plus-outline">แก้ไข</i> </a>
                                    <a href="{{URL('office/settings/data/delete')}}/{{$item->id}}" class="btn btn-outline-danger waves-effect width-md waves-light btn-sm" ><i class="mdi mdi-trash-can-outline">ลบ</i></a>
                                 --}}
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <option value="position" data-id="{{$item['id']}}">กำหนดตำแหน่ง</option>
                                        <option value="edit" data-id="{{$item['id']}}">แก้ไข</option>
                                        <option value="delete" data-id="{{$item['id']}}">ลบ</option>
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

        <div id="div-data-url" data-url="{{url('office/settings/data')}}"></div>
        <div id="url-redirect-back" data-url="{{url('office/settings/data/lists')}}?t=position&pr=0"></div>

    </div>
</div>

<div id="con-close-modal-position" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/settings/data/info/save')}}?typeid=position" method="POST" name="frm-position-save" id="frm-position-save" enctype="multipart/form-data">
        <input type="hidden" name="input[action]" id="input-action" value="add">
        <input type="hidden" name="input[edit_id]" id="input-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">กำหนดจำนวนตำแหน่ง</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position_min">จำนวนน้อยสุด </label>
                            <input type="text" class="form-control" name="input[position_min]" id="input-position_min" placeholder="" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position_max">จำนวนมากสุด </label>
                            <input type="text" class="form-control" name="input[position_max]" id="input-position_max" placeholder="" >
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="input[position_id]" id="input-position_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_action" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

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

<script src="{{url('public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('public/js/plugins/validate/validate.js')}}"></script>

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

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'position'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&typeid=position";

            $('#con-close-modal-position').modal('show');

            $.get(_url, function(res){
                    $("#frm-"+values+"-save #input-position_min").val(res.info.position_min);
                    $("#frm-"+values+"-save #input-position_max").val(res.info.position_max);
                    $("#frm-"+values+"-save #input-action").val(res.info.action);
                    $("#frm-"+values+"-save #input-position_id").val(res.info.position_id);
                    $("#frm-"+values+"-save #input-edit_id").val(res.info.id);
                }, "json");

        }else if(values != ''){

            window.location='{{URL('office/settings/data')}}'+ '/' + values + '/' + id + '/?t=position&pr=0';

        }

    });

    $('#button_action').click(function(){ 

        function callBackFuncInsertEmployee(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-redirect-back").attr("data-url");

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

        $('#frm-position-save').validate({
            rules: {
                'input[position_min]': {
                    required: true
                }
            },
            messages: {
                'input[position_min]': {
                    required: "กรุณากรอกจำนวนตำแหน่ง"
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
                // $("#button_action").attr("disabled", "disabled");

                ajaxSubmitForm("frm-position-save", "json", callBackFuncInsertEmployee);
                return false;
            }
        });
    });

</script>
@endsection
