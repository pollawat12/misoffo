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
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; ">อัพโหลดเอกสาร</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            
                            
                        </div>
                    </div>
                    @foreach ($db_courses as $course)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">คอร์สฝึกอบรม</h4>
                                <label for="exampleInputEmail1"> {{$course->name}}</label>
                                
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
                    <form action="{{url('office/hr/course/fileSave')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="edit_id" value="0">

                        <div class="row">
                            <div class="col-md-6">
                                <div for="inputEmail4" class="col-form-label label-step">แนบไฟล์ <span
                                        class="text-danger">*</span></div>
                                <div class="form-group">
                                    <input type="file" name="file_work" class="filestyle" id="filestyleicon">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-database-plus">อัพโหลด</i></button>
                    </form>
                </div>
            </div>
        </div> <!-- end row -->
        {{-- <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                        <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th style="width: 5%">ลำดับ</th>
                                        <th style="width: 20%">หน่วยงาน</th>
                                        <th style="width: 20%">หลักสูตรการฝึกอบรม</th>
                                        <th style="width: 10%">ไฟล์</th>
                                        <th style="width: 10%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;?>
                                    @if (!empty($db_courses))
                                    @foreach ($db_courses as $item)
                                    <?php $no++;?>
                                    <tr>
                                        <td class="align-middle">{{$no}}</td>
                                        <td class="align-middle">{{$item->place}}</td>
                                        <td class="align-middle">{{$item->name}}</td>
                                        <td class="align-middle">{{$item->lecturer_name}}</td>
                                        <td class="align-middle">
                                            <select name="input_action" class="form-control input_action" data-id="{{$item->id}}">
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
        </div> --}}

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

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

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



