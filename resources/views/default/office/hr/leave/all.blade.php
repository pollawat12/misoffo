@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">รายการลา</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง รายการลา</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: รายการลา</h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            <form action="{{url('office/hr/leave/search/list')}}" target="_blank" method="POST" name="frm-search" id="frm-search">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                       
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dob">วันที่เริ่ม</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[day]" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dob">วันที่เสร็จสิ้น</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[day]" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dob">พนักงาน</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <select class="form-control" name="input[user_id]" data-toggle="select">
                                                                    <option value="">--เลือก--</option>
                                                                    @if (count($staff) > 0)
                                                                    @foreach($staff as $item)
                                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- <button type="submit" class="btn btn-sm btn-dark"><i class="mdi mdi-database-plus"> นำออกข้อมูล</i></button> --}}
                                          <a href="{{URL('office/hr/leave/add/0/0')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> ยื่นใบลา</i></a>
                                    </div>
                                </div>
                            </form>   
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%"># ลำดับ</th>
                                <th style="width: 10%">ชื่อ-นามสกุล</th>
                                <th style="width: 15%">วันที่ยื่นใบลา</th>
                                <th style="width: 10%">ประเภทการลา</th>
                                <th style="width: 10%">จำนวนวันลา</th>
                                <th style="width: 10%">วันที่เริ่มลา</th>
                                <th style="width: 10%">วันที่สิ้นสุด</th>
                                <th style="width: 10%">สถานะการอนุมัติ</th>
                                <th >จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($Leave))
                            @foreach ($Leave as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle" style="width: 5%">{{$no}}</td>
                                <td class="align-middle" style="width: 20%">{{$item['name']}}</td>
                                <td class="align-middle" style="width: 12%">{{getDateTimeTH($item['date_resign'] , false)}}</td>
                                <td class="align-middle">{{$item['leave_type']}}</td>
                                <td class="align-middle">{{$item['total_date']}} </td>
                                <td class="align-middle" style="width: 12%">{{getDateTimeTH($item['date_start'] , false)}}</td>
                                <td class="align-middle" style="width: 12%">{{getDateTimeTH($item['date_end'] , false)}}</td>
                                <td class="align-middle">
                                    @if($item['is_approved'] == '0')  

                                        <span class="badge bg-info badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">รออนุญาต</span>

                                    @elseif($item['is_approved'] == '1') 

                                        <span class="badge bg-warning badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">เห็นควรอนุญาต</span>

                                    @elseif($item['is_approved'] == '2') 

                                        <span class="badge bg-warning badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">อนุญาต</span>

                                     @elseif($item['is_approved'] == '3') 

                                        <span class="badge bg-success badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">อนุญาต</span>

                                    @elseif($item['is_approved'] == '4') 

                                        <span class="badge bg-success badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">อนุญาต</span>

                                    @elseif($item['is_approved'] == '5') 

                                        <span class="badge bg-primary badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">รอยกเลิก</span>

                                    @elseif($item['is_approved'] == '6') 

                                        <span class="badge bg-secondary badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">ยกเลิกเรียบร้อย</span>

                                    @elseif($item['is_approved'] == '9') 

                                        <span class="badge bg-danger badge-pill" style="font-size: 14px; padding:8px 16px 8px 16px">ไม่อนุญาต</span>

                                    @else  
                                    
                                        <span class="badge bg-info badge-pill" style="font-size: 14px; padding:8px">รออนุญาต</span>

                                    @endif
                                </td>
                                <td class="align-middle" style="width: 15%">

                                    @if($item['is_approved'] == '0')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >หัวหน้ากลุ่มงานพิจารณา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>
                                    @elseif($item['is_approved'] == '1')    
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >ผ.อ.สำนักพิจารณา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>
                                    @elseif($item['is_approved'] == '2')    
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >ผ.อ.สกนช พิจารณา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>
                                    @elseif($item['is_approved'] == '3')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >อัพเดทสถานะการลา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>
                                    @elseif($item['is_approved'] == '4')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >อัพเดทสถานะการลา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>

                                    @elseif($item['is_approved'] == '5')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >อัพเดทสถานะการลา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>

                                    @elseif($item['is_approved'] == '6')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >อัพเดทสถานะการลา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>

                                     @elseif($item['is_approved'] == '9')
                                        <select name="input_action" class="form-control" data-id="{{$item['id']}}">
                                            <option value="">เลือก</option>
                                            {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                                            <option value="edit" >อัพเดทสถานะการลา</option>
                                            <option value="deleted" >ลบ</option>
                                        </select>
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

    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

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

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

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

    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'report'){

            window.location='{{URL('office/hr/leave/')}}'+ '/' + values + '/' + id;

        }else if(values == 'edit'){

            window.location='{{URL('office/hr/leave/')}}'+ '/' + values + '/' + id + '/?t=admin&pr=0&de=0';

        }else if(values == 'deleted'){

            window.location='{{URL('office/hr/leave/')}}'+ '/' + values + '/' + id;

        }else{

        }    
    });
</script>
@endsection
