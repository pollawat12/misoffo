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
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: บันทึกเวลาทำงาน</h4>
                            <p class="sub-header"></p>
                        </div>

                        {{-- <div class="col-6 text-right">
                            <a href="{{URL('office/hr/time_attendances/import_form/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div> --}}

                        <div class="col-6 text-right">
                            <form action="{{url('office/hr/time_attendances/month/search')}}" method="GET" name="frm-search" id="frm-search">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dob"> เดือน </label>
                                                <div>
                                                    <div class="input-group">
                                                        <select class="form-control" name="input[month]" data-toggle="select2">
                                                            <option value="">--เลือก--</option>
                                                            <option value="01" @if(1 == $moth) selected @endif>1</option>
                                                            <option value="02" @if(2 == $moth) selected @endif>2</option>
                                                            <option value="03" @if(3 == $moth) selected @endif>3</option>
                                                            <option value="04" @if(4 == $moth) selected @endif>4</option>
                                                            <option value="05" @if(5 == $moth) selected @endif>5</option>
                                                            <option value="06" @if(6 == $moth) selected @endif>6</option>
                                                            <option value="07" @if(7 == $moth) selected @endif>7</option>
                                                            <option value="08" @if(8 == $moth) selected @endif>8</option>
                                                            <option value="09" @if(9 == $moth) selected @endif>9</option>
                                                            <option value="10" @if(10 == $moth) selected @endif>10</option>
                                                            <option value="11" @if(11 == $moth) selected @endif>11</option>
                                                            <option value="12" @if(12 == $moth) selected @endif>12</option>
                                                        </select>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dob"> ปี </label>
                                                <div>
                                                    <div class="input-group">
                                                        <select class="form-control" name="input[year]" data-toggle="select2">
                                                            <?php echo $mo = date('Y');?>
                                                            <option value="">--เลือก--</option>
                                                            @for($m=2021; $m <= (int) $mo; $m++)
                                                            <option value="{{$m}}" @if($m == $year) selected @endif>{{$m + 543}}</option>
                                                            @endfor
                                                        </select>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dob"> พนักงาน </label>
                                                <div>
                                                    <div class="input-group">
                                                        <select class="form-control" name="input[user_id]" data-toggle="select2">
                                                            <option value="">--เลือก--</option>
                                                            @if (count($employees) > 0)
                                                            @foreach($employees as $item)
                                                            <option value="{{$item['id']}}" @if($item['id'] == $user_id) selected @endif>{{$item['name']}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div><!-- input-group -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
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
                                <th style="width: 15%">วันที่ / เวลา </th>
                                <th style="width: 25%">ชื่อ-นามสกุล</th>
                                <th style="width: 15%">เข้างาน</th>
                                <th style="width: 15%">สถานปฏิบัติงาน</th>
                                <th style="width: 15%">เลิกงาน</th>
                                <th style="width: 15%">สถานปฏิบัติงาน</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php 
                            // date_default_timezone_set("Asia/Bangkok");
                            $date = date('Y-m-d');
                            ?>
                            <?php $no = 0;?>
                            @if (!empty($day))
                            @for($no=1; $no <= $day; $no++)
                                @if ($user_id == 0)
                                    <tr>
                                        <td class="align-middle">{{$no}}</td>
                                        <td class="align-middle">
                                            <?php 
                                                $year = date('Y') + 543;
                                                echo $no.'/'.date('m').'/'.$year;
                                            ?>
                                        </td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle">
                                            
                                        </td>
                                        <td class="align-middle">
                                           
                                        </td>
                                        <td class="align-middle">
                                        </td>
                                        <td class="align-middle">
                                        </td>
                                    </tr>

                                @else
                                <?php 
                                    $conditions = [];
                                    $user = \App\Models\User::getEmployeesName($conditions, $user_id);
                                    foreach($user as $users);
                                ?>
                                    <tr>
                                        <td class="align-middle">{{$no}}</td>
                                        <?php 

                                        $Checkday = $year.'-'.$moth.'-'.$no;

                                        $timeInfo = \App\Models\TimeAttendance::getDataTimeLabel($user_id, $Checkday, 'in');
                                        
                                        $strDateTime = '-';
                                        $place = '-';
                                        if ($timeInfo) {
                                            $strDate = getShowDateMonthTH($timeInfo->check_in_date, false);
                                            list($hh, $mm, $ii) = explode(':', trim($timeInfo->check_in_time));
                                            $strDateTime = implode(':', [$hh, $mm]) . ' น.';
                                            $place = getCheckInPlaceType($timeInfo->check_time_type);
                                        }
                                        ?>
                                        <td class="align-middle">
                                            <?php 
                                                // $years = $year + 543;
                                                echo getShowDateMonthTH($Checkday);
                                            ?>
                                        </td>
                                        
                                        <td class="align-middle">{{$users['name']}}</td>
                                        <td class="align-middle">
                                            {{ @$strDateTime }}
                                        </td>
                                        <td class="align-middle">
                                            {{ @$place }}
                                        </td>
                                        <?php 
                                        $timeInfos = \App\Models\TimeAttendance::getDataTimeLabel($user_id, $Checkday, 'out');

                                        $strDateTime = '-';
                                        $place = '-';
                                        if ($timeInfos) {
                                            $strDate = getShowDateMonthTH($timeInfos->check_in_date, false);
                                            list($hh, $mm, $ii) = explode(':', trim($timeInfos->check_in_time));
                                            $strDateTime = implode(':', [$hh, $mm]) . ' น.';

                                            $place = getCheckInPlaceType($timeInfos->check_time_type);
                                        }
                                        ?>

                                        <td class="align-middle">
                                            {{ @$strDateTime }}
                                        </td>
                                        <td class="align-middle">
                                            {{ @$place }}
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                            @endif
                            

                        </tbody>
                    </table>
                </div>
                <p>{{$moth}}</p>
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
            "pageLength": 31,
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

</script>
@endsection
