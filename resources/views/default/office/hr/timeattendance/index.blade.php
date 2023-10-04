@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">บันทึกเวลาทำงาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง บันทึกเวลาทำงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-8">
                            <h4 class="header-title">รายการข้อมูล :: บันทึกเวลาทำงาน</h4>
                            <p class="sub-header"></p>
                        </div>

                        {{-- <div class="col-6 text-right">
                            <a href="{{URL('office/hr/time_attendances/import_form/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div> --}}

                        <div class="col-4 text-right">
                            <form action="{{url('office/hr/time_attendances/search')}}" method="GET" name="frm-search" id="frm-search">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="dob"> </label>
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker-autoclose" placeholder="วว/ดด/ปปปป"  name="input[day]" value="@if ($day != 0){{$day}} @endif">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob"> </label>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="mdi mdi-database-plus"> ค้นหา</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
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
                                <th style="width: 20%">ชื่อ-นามสกุล</th>
                                <th style="width: 15%">วันที่ / เวลา </th>
                                <th style="width: 10%">เข้างาน</th>
                                <th style="width: 10%">สถานปฏิบัติงาน</th>
                                <th style="width: 10%">Remark</th>
                                <th style="width: 10%">เลิกงาน</th>
                                <th style="width: 10%">สถานปฏิบัติงาน</th>
                                <th style="width: 10%">Remark</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php 
                            // date_default_timezone_set("Asia/Bangkok");
                            $date = date('Y-m-d');
                            ?>
                            <?php $no = 0;?>
                            @if (!empty($employees))
                            @foreach ($employees as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <?php 
                                if($day == 0){

                                    $timeInfo = \App\Models\TimeAttendance::getDataTimeLabel($item['id'], date('Y-m-d'), 'in');

                                }else{
                                    
                                    $timeInfo = \App\Models\TimeAttendance::getDataTimeLabel($item['id'], getInputDateToDB($day), 'in');
                                }
                                
                                $strDateTime = '-';
                                $place = '-';
                                $note1 = '-';
                                $strDate = '-';

                                if ($timeInfo) {
                                    $strDate = getShowDateMonthTH($timeInfo->check_in_date, false);
                                    list($hh, $mm, $ii) = explode(':', trim($timeInfo->check_in_time));
                                    $strDateTime = implode(':', [$hh, $mm]) . ' น.';

                                    $place = getCheckInPlaceType($timeInfo->check_time_type);

                                    $note1 = $timeInfo->note;

                                }
                                ?>
                                <td class="align-middle">
                                    {{@$strDate}}
                                </td>
                                <td class="align-middle">
                                    {{ @$strDateTime }}
                                </td>
                                <td class="align-middle">
                                    {{ @$place }}
                                </td>
                                <td class="align-middle">
                                    {{ @$note1 }}
                                </td>

                                <?php 
                                if($day == 0){
                                    $timeInfos = \App\Models\TimeAttendance::getDataTimeLabel($item['id'], date('Y-m-d'), 'out');
                                }else{
                                    $timeInfos = \App\Models\TimeAttendance::getDataTimeLabel($item['id'], getInputDateToDB($day), 'out');
                                }

                                $strDateTime = '-';
                                $place = '-';
                                $note2 = '-';
                                if ($timeInfos) {
                                    $strDate = getShowDateMonthTH($timeInfos->check_in_date, false);
                                    list($hh, $mm, $ii) = explode(':', trim($timeInfos->check_in_time));
                                    $strDateTime = implode(':', [$hh, $mm]) . ' น.';

                                    $place = getCheckInPlaceType($timeInfos->check_time_type);

                                    $note2 = $timeInfos->note;

                                }
                                ?>

                                <td class="align-middle">
                                    {{ @$strDateTime }}
                                </td>
                                <td class="align-middle">
                                    {{ @$place }}
                                </td>
                                <td class="align-middle">
                                    {{ @$note2 }}
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
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
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

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
    
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": false,
            "pageLength": 25,
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
        var __url = "{{ url('office/settings/meeting_room') }}";

        if (__action == "edit") {
            window.location = __url+ '/' + __action + '/' + id;
        } else {
            var __url = __url+"/delete";
            ajaxConfirmDel(id, __url, true);
        }
    });
</script>
@endsection
