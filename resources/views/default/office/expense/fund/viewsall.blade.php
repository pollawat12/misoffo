@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{url('assets/default/css/jquery.stickytable.min.css')}}">
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
                            <li class="breadcrumb-item active">งบประมาณ > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตั้งงบประมาณ</i> </h4>

                        
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">
                            <?php 
                            foreach($yearsDetail as $keydetail => $valyear);
                            ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                        <select name="year_id_n" id="year_id_n" class="form-control" disabled style="height: 40px; width: 90%;">
                                            <option value="">--เลือก--</option>
                                            @if (count($year) > 0)
                                            @foreach($year as $valyears)
                                            <option value="{{$valyears['id']}}" @if($valyears['id'] == $id) selected @endif>{{$valyears['year_name']}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
                                        
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year_id">หน่วยงาน <code>*</code></label>
                                        <select name="input[institution_id]" id="institution_id" class="form-control" disabled style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($institution) > 0)
                                            @foreach($institution as $keyinstitution => $valinstitution)
                                            <option value="{{$valinstitution->id}}" @if($valinstitution->id == $institutionId) selected @endif>{{$valinstitution->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label >
                                        <input type="text" disabled name="input[budget_money]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->budget_money}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">ลักษณะโครงการ <code>*</code></label>
                                        <textarea name="input[description]" disabled class="form-control">{{$info->description}}</textarea>
                                        <small id="description" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i> <a href="{{url('office/budget/expenses/year/repost/export/')}}/{{$id}}/{{$institutionId}}" class="btn btn-primary"><i class="mdi mdi-table-large"> นำออกข้อมูล</i></a></h4>
                        
                             <?php $no = 0;?>
                                <div class="input_fields_wrap">
                                @if (!empty($detail))
                                @foreach ($detail as $item)
                                <?php $no++;?>


                                @endforeach
                                @endif

                                
                            
                                </div>

                                <div class="no-padding sticky-table sticky-rtl-cells">
                                    <table id="datatable" class="table table-bordered">

                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th style="width: 3%" rowspan="2">ลำดับ</th>
                                                <th style="width: 15%" rowspan="2">รายงาน</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 1 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 2 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 3 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 4 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 15%" rowspan="2">รวมรายจ่าย ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <!-- <th style="width: 15%" rowspan="2">งบประมาณที่ได้รับ </th> -->
                                            </tr>
                                            <tr>
                                                <th style="width: 5%">ต.ค. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">พ.ย. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">ธ.ค. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ม.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ก.พ. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">มี.ค {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">เม.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">พ.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">มิ.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ก.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ส.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ก.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                            </tr>
                                        </thead>

                                        <?php $no = 0;?>
                                        @if (!empty($detail))
                                        @foreach ($detail as $item)
                                            <?php 
                                                        
                                                $valdetails = \App\Models\BudgetsrDetailYear::where('budgets_detail_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                            ?>
                                        <?php $no++;?>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle" align="right">{{$item['sort_order']}}</td>
                                                <td class="align-middle">{{$item['name']}}</td>
                                                @if (!empty($valdetails))
                                                @foreach ($valdetails as $valdetail)
                                                    <td style="width: 5%">{{$valdetail['month_10']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_11']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_12']}}</td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_10'] + $valdetail['month_11'] + $valdetail['month_12']?></td>
                                                    <td style="width: 5%">{{$valdetail['month_1']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_2']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_3']}}</td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_1'] + $valdetail['month_2'] + $valdetail['month_3']?></td>
                                                    <td style="width: 5%">{{$valdetail['month_4']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_5']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_6']}}</td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_4'] + $valdetail['month_5'] + $valdetail['month_6']?></td>
                                                    <td style="width: 5%">{{$valdetail['month_7']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_8']}}</td>
                                                    <td style="width: 5%">{{$valdetail['month_9']}}</td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_7'] + $valdetail['month_8'] + $valdetail['month_9']?></td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_10'] + $valdetail['month_11'] + $valdetail['month_12'] + $valdetail['month_1'] + $valdetail['month_2'] + $valdetail['month_3'] + $valdetail['month_4'] + $valdetail['month_5'] + $valdetail['month_6'] + $valdetail['month_7'] + $valdetail['month_8'] + $valdetail['month_9']?></td>
                                                @endforeach
                                                @endif
                                            </tr> 
                                        </tbody>
                                        <tbody id="loaddate{{$item['id']}}">
                                                    
                                        </tbody>
                                        @endforeach
                                        @endif


                                    </table>
                                </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>
        <!-- end row -->
        <div id="div-data-url" data-url="{{url('office/budget/expenses/year/edit')}}/{{$id}}"></div>
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/year/lists')}}/{{$id}}"></div>
    </div>
</div>
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 70%;">
        <form action="{{url('office/budget/expenses/year/subsave')}}" method="POST" name="frm-save-new" id="frm-save-new" enctype="multipart/form-data">

        <input type="hidden" name="budget_year_id" id="input-budget_year_id"  value="{{$id}}">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyear">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(document).ready(function () {
        // $("#datatable").DataTable({
        //     "ordering": true,
        //     "pageLength": 25,
        //     "oLanguage": {
        //         "sZeroRecords": "-ไม่พบรายการข้อมูล-",
        //         "sLengthMenu": "แสดง  _MENU_  รายการ",
        //         "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
        //         "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
        //         "oPaginate": {
        //             "sFirst": "หน้าแรก",
        //             "sPrevious": "ก่อนหน้า",
        //             "sNext": "ถัดไป",
        //             "sLast": "หน้าสุดท้าย"
        //         },
        //         "sSearch": "ค้นหา"
        //     }
        // });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });
    });

    $(function () {
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
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

        $('#frm-save').validate({
            rules: {
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกปีงบประมาณ"
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

        $('#frm-save-new').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
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

                ajaxSubmitFormImage("frm-save-new", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });
</script>

<script type="text/javascript">

    $('#button_add_new').click(function(){

        $('#con-close-modal').modal('show'); 

        $('#loadbudgetyear').load('{{URL('office/budget/expenses/year/get/loadbudget')}}');
        
    });

    function loaddate(id , yearid , num){
        $('#loaddate'+id).load('{{URL('office/budget/expenses/year/get/loaddate')}}' + '/' + id + '/' + yearid + '/' + num);
    }

    $(document).on('change', '#year_id_n', function(params) {
        let values = $(this).val();

        let institutionId = $('#institution_id').val();

        window.location='{{URL('office/budget/expenses/year/repost/get')}}'+ '/' +values + '/' +institutionId;
        
    });

    $(document).on('change', '#institution_id', function(params) {
        let values = $('#year_id_n').val();

        let institutionId = $(this).val();

        window.location='{{URL('office/budget/expenses/year/repost/get')}}'+ '/' +values + '/' +institutionId;
        
    });
</script>
@endsection
