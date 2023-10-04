@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">ข้อมูลสิทธิการลา</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูลสิทธิการลา</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลสิทธิการลา</h4>
                            <p class="sub-header"></p>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%"># ลำดับ</th>
                                <th style="width: 20%">ประเภทการลา</th>
                                <th style="width: 20%">จำนวนวันสามารถลาได้</th>
                                <th style="width: 20%">จำนวนวันที่ลา</th> 
                                <th style="width: 20%">คงเหลือ</th> 
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;
                            
                                 $LeaveNum = \App\Models\Userleave::where('users_id', $id)->where('leave_type', $item['id'])->whereIn('is_approved', ['4','5'])->where('is_deleted', '0')->where('is_active','1')->get();
                                 $LeaveNumCount = $LeaveNum->count();

                                  $LeaveNumCount2 = 0;

                                        for ($x = 0; $x < $LeaveNumCount; $x++) {
                                            $LeaveNumCount2  =  $LeaveNumCount2 + $LeaveNum[$x]['total_date'];
                                        }
                                                        
                            ?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <?php 

                                    $Leaves = \App\Models\LeaveSetting::where('user_id', $id)->where('leave_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();

                                    $LeavesCount = $Leaves->count();

                                    if($LeavesCount > 0){
                                        foreach ($Leaves as $Leave);
                                       
                                ?>
                                        <td class="align-middle">{{$Leave['number_date'] + $item['data_value']}}</td>
                                        <td class="align-middle">{{$LeaveNumCount}}</td>
                                <?php 
                                
                                }
                                
                                
                                    else{ 
                                        
                                        ?>
                                        <td class="align-middle">{{$item['data_value']}}</td>
                                        <td class="align-middle">{{$LeaveNumCount2}}</td>
                                        <?php 
                                    } 
                                ?>
                                <td>{{$item['data_value'] - $LeaveNumCount2}}</td>
                  
                                <td class="align-middle" style="width: 10%">
                                    @if($t == 'admin')
                                        <select name="input_action" class="form-control" >
                                            <option value="">เลือก</option>
                                            {{-- <option value="add" data-id="{{$item['id']}}">ยื่นใบลา</option> --}}
                                            <option value="edit" data-id="{{$item['id']}}">แก้ไข</option>
                                            {{-- <option value="delete" data-id="{{$item['id']}}">ลบ</option> --}}
                                        </select>
                                    @else
                                        <a href="{{URL('office/hr/leave/add')}}/{{$id}}/{{$item['id']}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus">ยื่นใบลา</i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div> <!-- end row -->

        @if($t == 'admin')
            <div id="url-redirect-back" data-url="{{url('office/hr/leave-work')}}/{{$id}}/?t=admin"></div>
        @else
            <div id="url-redirect-back" data-url="{{url('office/hr/leave-work')}}/{{$id}}/?t=user"></div>
        @endif

        

        <div id="div-data-url" data-url="{{url('office/hr/leave-work')}}"></div>

    </div>
</div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/leave-work/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
        <input type="hidden" name="input[action]" id="input-action" value="add">
        <input type="hidden" name="input[edit_id]" id="input-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูล ประเภทการลา</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number_date">ประเภทการลา </label>
                            <input type="text" class="form-control" name="input[name]" id="input-name" placeholder="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number_date">จำนวนวันเพิ่มเติม </label>
                            <input type="text" class="form-control" name="input[number_date]" id="input-number_date" placeholder="" >
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="input[sum_not_over]" id="input-sum_not_over" placeholder="" value="0">
                <input type="hidden" name="input[user_id]" id="input-user_id" value="{{$id}}">
                <input type="hidden" name="input[leave_id]" id="input-leave_id">
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

<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
</script>

<script>
    
    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'edit'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+'&uid={{$id}}';

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                    $("#frm-save #input-leave_id").val(res.info.leave_id);
                    $("#frm-save #input-number_date").val(res.info.number_date);
                    $("#frm-save #input-sum_not_over").val(res.info.sum_not_over);
                    $("#frm-save #input-name").val(res.info.name);
                    $("#frm-save #input-action").val(res.info.action);
                    $("#frm-save #input-edit_id").val(res.info.id);
                }, "json");

        }else if(values == 'add'){

            window.location='{{URL('office/hr/leave/add')}}'+ '/{{$id}}/' + id;

        }else if(values == 'deleted'){
            window.location='{{URL('office/hr/leave-work')}}'+ '/' + values + '/' + id;
        }
    });

    $('#button_action').click(function(){ 

        function callBackFuncInsert(data) {
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
                'input[number_date]': {
                    required: true
                }
            },
            messages: {
                'input[number_date]': {
                    required: "กรุณากรอกจำนวนวัน"
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

                ajaxSubmitForm("frm-save", "json", callBackFuncInsert);
                return false;
            }
        });
    });
</script>
@endsection
