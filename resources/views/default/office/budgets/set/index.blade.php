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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">งนประมาณ ({{$info->name}})</li>
                            <li class="breadcrumb-item active">ปีงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ปีงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ปีงบประมาณ ({{$info->name}})</h4>
                            <p class="sub-header"></p>
                        </div>

                        <!-- <div class="col-6 text-right">
                            <a href="{{URL('office/settings/budget-year/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div> -->
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 8%"># ลำดับ</th>
                                <th style="width: 10%">ปีงบประมาณ</th>
                                <th style="width: 20%">วันที่เริ่มต้น - วันที่สิ้นสุด</th>
                                <th >วงเงินงบประมาณ</th>
                                <th style="width: 15%">จัดการ</th>
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
                                <td class="align-middle">
                                    <?php
                                    if($id != 488){
                                        $BudgetsYearSets = \App\Models\BudgetsYearSet::where('budgets_id', $id)->where('year_id', $item->id)->where('is_deleted', '0')->where('is_active','1')->first();
                                        if(isset($BudgetsYearSets)):
                                            echo number_format($BudgetsYearSets->budgets_money,2,'.',',').' บาท';
                                        endif;
                                    }else{
                                        $BudgetYear = \App\Models\BudgetYear::where('budgets_id', $id)->where('year_id', $item->id)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'DESC')->get();
                                        if(count($BudgetYear) > 0){

                                            $sum = 0;
                                            foreach ($BudgetYear as $value) {
                                                $sum += $value->budget_money;
                                            }

                                            echo number_format($sum,2,'.',',').' บาท';
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        @if($id != 488)
                                            @if(isset($BudgetsYearSets))
                                                <option value="{{$BudgetsYearSets->id}}" data-id="{{$item->id}}">จัดสรรงบประมาณ</option>
                                            @endif
                                            <option value="edit" data-id="{{$item->id}}">วงเงินงบประมาณ</option>
                                        @else
                                            @if(isset($BudgetsYearSets))
                                                <option value="{{$BudgetsYearSets->id}}" data-id="{{$item->id}}">จัดสรรงบประมาณ</option>
                                            @else
                                                <option value="{{$item->id}}" data-id="{{$item->id}}">จัดสรรงบประมาณ</option>
                                            @endif
                                        @endif
                                        <!-- <option value="delete" data-id="{{$item['id']}}">ลบ</option> -->
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
<div id="url-back" data-url="{{url('office/budgets/set')}}/{{$id}}"></div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/budgets/set/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
            
        <input type="hidden" name="edit_id" id="input-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ตั้งงบประมาณ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">ปีงบประมาณ </label>
                            <input type="text" class="form-control" name="input[name]" id="input-name" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="money">วงเงินงบประมาณ </label>
                            <input type="text" class="form-control" name="input[budgets_money]" id="input-money" placeholder="">
                        </div>
                    </div>
                </div>
                

                <input type="hidden" name="input[budgets_id]" value="{{$id}}">
                <input type="hidden" name="input[year_id]" id="input-year" value="">
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

        if(values == ''){

            

        }else if(values == 'edit'){

            $('#con-close-modal').modal('show'); 

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?yearid="+id+"&budgetsid={{$id}}&type=budgets";

            $.get(_url, function(res){
                    $("#frm-save #input-name").val(res.info.name);
                    $("#frm-save #input-money").val(res.info.money);
                    $("#frm-save #input-year").val(res.info.year);
                    $("#frm-save #input-edit_id").val(res.info.edit_id);
                }, "json");

        }else if(values == 'delete'){
            window.location='{{URL('office/budgets/budget-year')}}'+ '/' + values + '/' + id;
        }else{

            window.location='{{URL('office/budgets/institution')}}'+ '/?yearid='+id+'&budgetsid={{$id}}&id='+values;

        }

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
