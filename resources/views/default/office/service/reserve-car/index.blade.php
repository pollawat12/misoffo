@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">งานบริการ</a></li>
                            <li class="breadcrumb-item active">จองรถยนต์ส่วนกลาง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง จองรถยนต์ส่วนกลาง9999</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="media-body">
                        
                        
                        <div class="title-aad-name">
                            <h6 class="header-title font-size-16">
                                รายการรถยนต์ส่วนกลางสำนักงานกองทุนน้ำมันเชื้อเพลิง</h6>
                                <a href="insert-car.html"
                                class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline">
                                    เพิ่มรายการ</i></a>
                        </div>

                        <hr class="hr-form-car">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center text-white custom-table" style="width: 5%;">ลำดับ
                                                </th>
                                                <th class="text-white custom-table">รุ่นรถ</th>
                                                <th class="text-center text-white custom-table">ยี่ห้อรถ</th>
                                                <th class="text-center text-white custom-table">หมายเลขทะเบียน</th>
                                                <th class="text-center text-white custom-table" style="width: 30%;">จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center custom-table">1</td>
                                                <td class="custom-table">คอมมิวเตอร์หลังคาสูง MT</td>
                                                <td class="text-center custom-table">Toyota</td>
                                                <td class="text-center custom-table">8 กฬ 6509</td>
                                                <td class="text-center custom-table">
                                                    <a href="view-car.html">
                                                        <button type="button" class="btn btn-info waves-effect width-md waves-light">
                                                            <i class="mdi mdi-eye"></i> ดูรายละเอียด
                                                        </button>
                                                    </a>
                                                    
                                                    <button type="button" class="btn btn-warning waves-effect width-md waves-light">
                                                        <i class="mdi mdi-pencil-outline"></i> แก้ไข
                                                    </button>
                                                    <button type="button" class="btn btn-danger waves-effect width-md waves-light">
                                                        <i class="mdi mdi-trash-can-outline"></i> ลบ
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->


        </div>
        <!-- end row -->

    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/switchery/switchery.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="{{url('assets/default')}}/libs/autocomplete/jquery.autocomplete.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{url('assets/default')}}/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Init js-->
<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>
<script src="{{url('assets/default')}}/js/pages/form-pickers.init.js"></script>

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
            "autoWidth": false,
            "columnDefs": [
                { "width": "8%", "targets": 0 },
                { "width": "30%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { "width": "12%", "targets": 5 },
                { "width": "18%", "targets": 6 }
            ],
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
    });

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var __action = $(this).find(':selected').attr('value');
        var __url = "{{ url('office/services/reserve-meeting') }}";

        if (__action == "edit") {
            window.location = __url+ '/' + __action + '/' + id;
        } else {
            var __url = __url+"/delete";
            ajaxConfirmDel(id, __url, true);
        }
    });
</script>
@endsection
