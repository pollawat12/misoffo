@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แบบประเมิน</a></li>
                            <li class="breadcrumb-item active">ปีการประเมินพนักงาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ปีการประเมินพนักงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <?php
        
        $empName = (!empty($info->prename) && is_numeric($info->prename)) ? $prename = \App\Models\DataSetting::getNameDataByValueAndType($info->prename,'prename').' ' : '';
        $empName .= (!empty($info->firstname)) ?  trim($info->firstname) . ' ' . trim($info->lastname).' ' : '';

        ?>
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ปีการประเมินพนักงาน ({{$empName}})</h4>
                            <p class="sub-header"></p>
                        </div>

                        <!-- <div class="col-6 text-right">
                            <a href="{{URL('office/settings/budget-year/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div> -->
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <?php $num = 4; ?>
                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 8%" rowspan="2"># ลำดับ</th>
                                <th style="width: 10%" rowspan="2">ปีงบประมาณ</th>
                                <th style="width: 20%" rowspan="2">วันที่เริ่มต้น - วันที่สิ้นสุด</th>
                                <th colspan="{{$num}}">ครั้งที่ประเมิน</th>
                                <th style="width: 8%" rowspan="2">จัดการ</th>
                            </tr>
                            <tr class="bg-dark text-white">
                            <?php for ($a=1; $a <= $num; $a++) {  ?>
                                <th>ครั้งที่ {{$a}}</th>
                            <?php } ?>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($years))
                            @foreach ($years as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item->in_year}}</td>
                                <td class="align-middle">
                                    {{getDateTimeTH($item->date_start, false)}} - {{getDateTimeTH($item->date_end, false)}}
                                </td>
                                <?php for ($i=1; $i <= $num; $i++) {  ?>
                                    <td class="align-middle">
                                    <?php
                                        $ep1 = \App\Models\BehaviorSum::where('user_id' , $id )->where('years_id' , $item->id )->where('ep_value' , $i )->first();
                                        if(!empty($ep1)){
                                            echo $ep1->value_sum;
                                        }
                                    ?>
                                    </td>
                                <?php } ?>
                                </td>
                                <td class="align-middle" style="width: 10%">
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <?php for ($z=1; $z <= $num; $z++) {  ?>
                                            <option value="{{$z}}" data-id="{{$item->id}}">ครั้งที่ {{$z}}</option>
                                        <?php } ?>
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

    </div>
</div>

<div id="div-data-url" data-url="{{url('office/budgets/set')}}"></div>
<div id="url-back" data-url="{{url('office/hr/employees/estimate/years')}}/{{$id}}/{{$typeid}}"></div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 30%;">
        <form action="{{url('office/hr/employees/estimate/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
            
        <input type="hidden" name="edit_id" id="input-edit_id"  value="add">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">คะแนน ครั้งที่ <span id="ep"></span> ({{$empName}})</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="value_sum">คะแนน </label>
                            <input type="text" class="form-control" name="input[value_sum]" id="input-name" placeholder="">
                        </div>
                    </div>
                </div>
                

                <input type="hidden" name="input[user_id]" value="{{$id}}">
                <input type="hidden" name="input[years_id]" id="input-years_id" value="">
                <input type="hidden" name="input[ep_value]" id="input-ep_value" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_year" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
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
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

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

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        $('#con-close-modal').modal('show'); 

        // var _url = $("#div-data-url").attr("data-url")+"/get/info/?yearid="+id+"&budgetsid={{$id}}&type=budgets";

        // $.get(_url, function(res){
        //     $("#frm-save #input-name").val(res.info.name);
        //     $("#frm-save #input-money").val(res.info.money);
        //     $("#frm-save #input-year").val(res.info.year);
        //     $("#frm-save #input-edit_id").val(res.info.edit_id);
        // }, "json");

        $("#frm-save #ep").text(values);
        $("#frm-save #input-ep_value").val(values);
        $("#frm-save #input-years_id").val(id);

    });


    $('#button_year').click(function(){ 

        function callBackFuncInsert(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-back").attr("data-url");

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
                'input[budgets_money]': {
                    required: true
                }
            },
            messages: {
                'input[budgets_money]': {
                    required: "กรุณากรอกข้อมูล"
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

                ajaxSubmitFormImage("frm-save", "json", callBackFuncInsert);
                return false;
            }
        });
    });
</script>
@endsection
