@extends('default.template')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">คอร์สฝึกอบรม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง คอร์สฝึกอบรม</h4>
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
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียดคอร์สฝึกอบรม</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            
                            
                        </div>
                    </div>
                    @foreach ($courses as $course)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">คอร์สฝึกอบรม</h4>
                                <label for="exampleInputEmail1"> {{$course['name']}}</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">วันที่เริ่มต้น - วันที่สิ้นสุด</h4>
                                <label for="exampleInputEmail1"> {{getDateShow($course['date_start'])}} - {{getDateShow($course['date_end'])}}</label>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">เวลาที่เริ่มต้น - เวลาที่สิ้นสุด</h4>
                                <label for="exampleInputEmail1"> {{$course['time_start']}} - {{$course['time_end']}} </label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">สถานที่</h4>
                                <label for="exampleInputPassword1"> {{$course['place']}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">ผู้บรรยาย</h4>
                                <label for="exampleInputEmail1"> {{$course['lecturer_name']}}</label>
                                
                            </div>
                        </div>
                        
                    </div>
                    

                    @endforeach
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: คอร์สฝึกอบรม</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/hr/course')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline"> กลับ</i></a>
                            <button class="btn btn-primary btn-action-add" type="button" data-id="{{$id}}"><i class="mdi mdi-file-plus-outline"></i> เพิ่มข้อมูล</button>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">ผู้เข้าฝึกอบรม</th>
                                <th style="width: 10%">วันลงทะเบียน</th>
                                <th style="width: 20%">ประเภทหน่วยงาน</th>
                                <th style="width: 20%">สถานะการเข้า</th>
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($user))
                            @foreach ($user as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle">{{getDateShow($item['checkin_date'])}}</td>
                                <td class="align-middle">{{$item['role']}}</td>
                                <td class="align-middle">@if ($item['is_checkin'] == 0) เข้าฝึกอบรม @elseif($item['is_checkin'] == 1) ไม่ได้เข้าฝึกอบรม @else  @endif</td>
                                <td class="align-middle">
                                    <select name="input_action" class="form-control input_action" data-id="{{$item['id']}}">
                                        <option value="">เลือก</option>
                                        <option value="deleted" >ลบ</option>
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

<div id="url-redirect-back" data-url="{{url('office/hr/course/sub/')}}/{{$id}}"></div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/course/sub/save')}}" method="POST" name="frm-courses-save" id="frm-courses-save" enctype="multipart/form-data">
            <input type="hidden" id="input-action" name="action" value="add">
            <input type="hidden" id="input-edit_id" name="edit_id" value="0">

            <input type="hidden" name="input[courses_id]" value="{{$id}}">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ข้อมูลผู้เข้ารวมโครงการ</h4>
                </div>
                <div class="modal-body">
                    <?php 
                        $UserInformation = \App\Models\UserInformation::orderBy('firstname', 'asc')->get();
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="users_id">ผู้เข้ารวมโครงการ <code>*</code></label>
                                <select name="input[users_id]" class="form-control" style="height: 45px;" id="input-cost_type">
                                    <option value="">--เลือก--</option>
                                    @if (!empty($UserInformation))
                                        @foreach ($UserInformation as $UserInformations)
                                            <option value="{{$UserInformations['users_id']}}">{{$UserInformations['prename']}} {{$UserInformations['firstname']}} {{$UserInformations['lastname']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">วันลงทะเบียน</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[checked_at]" >
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_checkin">สถานะการเข้าอบรม <code>*</code></label>
                                <select name="input1[is_checkin]" class="form-control" style="height: 45px;" id="input-budget-is_checkin">
                                    <option value="">--เลือก--</option>
                                    <option value="0">เข้าฝึกอบรม</option>
                                    <option value="1">ไม่ได้เข้าฝึกอบรม</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                    <button type="submit" id="button_courses" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
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

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

<script>
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

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
</script>

<script>

    $(document).on('change', '.input_action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        window.location='{{URL('office/hr/course/sub')}}'+ '/' + values + '/' + id;  
    });

    $('.btn-action-add').click(function(){

       $('#con-close-modal').modal('show'); 

    });

    $('#button_courses').click(function(){ 

        function callBackFuncInsertCudget(data) {
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

        $('#frm-courses-save').validate({
            rules: {
                'input[users_id]': {
                    required: true
                }
            },
            messages: {
                'input[users_id]': {
                    required: "กรุณาเลือกผู้เข้าร่วม"
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

                ajaxSubmitForm("frm-courses-save", "json", callBackFuncInsertCudget);
                return false;
            }
        });
    });

    
</script>
@endsection



