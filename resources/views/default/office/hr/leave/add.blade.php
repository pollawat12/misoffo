@extends('default.layouts.main')

@section('css')
    <link href="{{ url('assets/default') }}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/js/plugins/sweetalert/sweetalert.css') }}">
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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">สรุปภาพรวม</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">รายการลา</a></li>
                                <li class="breadcrumb-item active">ข้อมูลการลา</li>
                            </ol>
                        </div>
                        <h4 class="page-title">เพิ่มข้อมูลการลา</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-icon alert-info text-info alert-dismissible fade show p-3" role="alert"
                        style="color: black !important;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-information mr-2"></i>
                        <strong>ข้อมูลจำนวนวันลาคงเหลือ</strong> <span id="leave_num"
                            style="font-weight:bold;color:red;"></span>
                        <br />
                        <span id="leave_sick" style="font-weight:bold;color:red;display: none;">*กรณีเกิน 30 วันทำงาน
                            เจ้าหน้าที่มีสิทธิลาป่วยได้ตามวันที่ป่วยจริง โดยได้รับค่าตอบแทนปีละไม่เกิน 30 วันทำงาน</span>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus"
                                style="font-size: 16px !important; "> ยื่นใบลา (ระเบียบการลา)</i> </h4>

                        <form action="{{ url('office/hr/leave/sub/save') }}" method="POST" autocomplete="off"
                            name="frm-save" id="frm-save">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="edit_id" value="0">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_id">เจ้าหน้าที่<code>*</code></label>
                                        @if ($id != '0')
                                            <select name="input[user_id_new]" class="form-control" style="height: 45px;"
                                                disabled>
                                                <option value="">--เลือก--</option>
                                                @if (count($employees) > 0)
                                                    @foreach ($employees as $val1)
                                                        <option value="{{ $val1['id'] }}"
                                                            @if ($val1['id'] == $id) selected @endif>
                                                            {{ $val1['name'] }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <input type="hidden" name="input[user_id]" id="user_id"
                                                value="{{ $id }}">
                                        @else
                                            <select name="input[user_id]" id="user_id" class="form-control"
                                                style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                @if (count($employees) > 0)
                                                    @foreach ($employees as $val1)
                                                        <option value="{{ $val1['id'] }}">{{ $val1['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="leave_type">ประเภทการลา <code>*</code> </label>
                                        <select name="input[leave_type]" id="leave_type" class="form-control"
                                            style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($categoryLeave) > 0)
                                                @foreach ($categoryLeave as $key => $val)
                                                    <option value="{{ $val->id }}">
                                                        {{ $val->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่ยื่น</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose" style="pointer-events:none;background-color: #f2f2f2"
                                                    placeholder="วว/ดด/ปปปป" name="input[date_resign]"
                                                    value="{{ getDateFormatToInputThai(date('Y-m-d')) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <span id="leave_load">

                            </span>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่เริ่มลา </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                    id="startDate" placeholder="วว/ดด/ปปปป" name="input[date_start]"
                                                    onchange="SumTotalData();">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob"></label>
                                        <div class="form-inline">
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check1" type="radio" name="input[start_day_status]"
                                                        onclick="SumTotalData();" value="1" checked>
                                                    <label for="Check1">เต็มวัน</label>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check2" type="radio" name="input[start_day_status]"
                                                        onclick="SumTotalData();" value="2">
                                                    <label for="Check2">ครึ่งเช้า</label>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check3" type="radio" name="input[start_day_status]"
                                                        onclick="SumTotalData();" value="3">
                                                    <label for="Check3">ครึ่งบ่าย</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">วันที่สิ้นสุด </label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                    id="endDate" placeholder="วว/ดด/ปปปป" name="input[date_end]"
                                                    onchange="SumTotalData();">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>
                                        <span id="duplicate_day"
                                            style="font-weight:bold;color:red;display: none;">*วันลาซ้ำ กรุณาเลือกวันใหม่</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob"></label>
                                        <div class="form-inline">
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check4" type="radio" name="input[end_day_status]"
                                                        onclick="SumTotalData();" value="1" checked>
                                                    <label for="Check4">เต็มวัน</label>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check5" type="radio" name="input[end_day_status]"
                                                        onclick="SumTotalData();" value="2">
                                                    <label for="Check5">ครึ่งเช้า</label>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <div class="radio checkbox-primary">
                                                    <input id="Check6" type="radio" name="input[end_day_status]"
                                                        onclick="SumTotalData();" value="3">
                                                    <label for="Check6">ครึ่งบ่าย</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob">รวมวันลา</label>
                                        <div>
                                            <div class="input-group">
                                                <input type="text" id="total_date" class="form-control"
                                                    name="input[total_date]" value='0'
                                                    style="pointer-events:none;background-color: #f2f2f2">
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="note">รายละเอียด</label>
                                        <textarea name="input[note]" class="form-control"></textarea>
                                        <small id="note" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="faculty_name">แนบไฟล์</label>
                                        <input type="file" class="filestyle" name="upfile_leave" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="division_user_id">ผอ.กลุ่มงาน<code>*</code> </label>
                                        <select name="input[division_user_id]" id="division_user_id" class="form-control"
                                            style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($groupWork_boss) > 0)
                                                @foreach ($groupWork_boss as $key => $val)
                                                    <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                @endforeach
                                                <option value="99">อื่นๆ</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="department_user_id">ผอ.สำนัก<code>*</code> </label>
                                        <select name="input[department_user_id]" id="department_user_id"
                                            class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($department_boss) > 0)
                                                @foreach ($department_boss as $key => $val)
                                                    @if ($val->id != 1)
                                                        <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="director_user_id">ผอ.สำนักงานกองทุนน้ำมันเชื้อเพลิง
                                            <code>*</code></label>
                                        <select name="input[director_user_id]" id="director_user_id" class="form-control"
                                            style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($boss_misoffo) > 0)
                                                @foreach ($boss_misoffo as $key => $val)
                                                    <option value="{{ $val->user_id }}">{{ $val->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="input-transfer-is_present" name="input[is_present]"
                                                type="checkbox" value="1">
                                            <label for="input-transfer-is_present">
                                                ลาจากภายนอกสำนักงาน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($id == '0')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="is_approved">สถานะการอนุมัติการลา <code>*</code></label>
                                            <select name="input[is_approved]" class="form-control" style="height: 45px;">
                                                <option value="">--เลือก--</option>
                                                <option value="1">อนุมัติ</option>
                                                <option value="2">ไม่อนุมัติ</option>
                                            </select>
                                            <small id="is_approved" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="input[is_approved]" value="">
                            @endif

                            <span id="load_button">
                                <button type="submit" id="button_sub" class="btn btn-primary"> <i
                                        class="mdi mdi-database-plus"> บันทึก</i>

                                </button>
                            </span>
                            @if ($id != '0')
                                @if ($typeid != '0')
                                    <a href="{{ URL('office/hr/leave-work') }}/{{ $id }}/?t=user"
                                        class="btn btn-secondary"><i
                                            class=" mdi mdi-backspace-outline
                                    ">
                                            ยกเลิก</i></a>
                                @else
                                    <a href="{{ URL('office/hr/leave/sub') }}/{{ $id }}"
                                        class="btn btn-secondary"><i
                                            class=" mdi mdi-backspace-outline
                                    ">
                                            ยกเลิก</i></a>
                                @endif
                            @else
                                <a href="{{ URL('office/hr/leave/all') }}" class="btn btn-secondary"><i
                                        class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                            @endif


                        </form>

                    </div>
                    <!-- end col -->

                </div>




                <!-- end row -->
                @if ($id == 0)
                    <div id="url-redirect-back" data-url="{{ url('office/hr/leave/all') }}"></div>
                @else
                    <div id="url-redirect-back" data-url="{{ url('office/hr/leave/sub') }}/{{ $id }}"></div>
                @endif

                <div data-url="{{ URL('/') }}" id="base-url-api"></div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="{{ url('assets/default') }}/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>

        <script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
        <script src="{{ url('assets/default') }}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

        <script src="{{ url('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/validate/validate.js') }}"></script>

        <script>
            $(".datepicker-autoclose").datepicker({
                language: 'th',
                autoclose: !0,
                todayHighlight: !0
            });

            let leaveNumData = 0;
            let totalLeaveDate_ = 0;
            let isValidate = false;
            let isDate = false;

            const LeaveListData = <?php echo json_encode($LeaveList); ?>;
            console.log(LeaveListData);
            leaveTypeLoad();

            $(document).on('change', '#leave_type', function() {
                let values = $(this).val();

                let userid = $('#user_id').val();

                var _url = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values + '&type=0';

                var _urlCheckDay = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values +
                    '&type=' + userid;
                console.log(_urlCheckDay);

                $.get(_url, function(data) {
                    $("#leave_load").html(data.info);

                }, "json");

                $.get(_urlCheckDay, function(data) {
                    console.log(data);
                    $("#leave_num").html(data.info);
                    leaveNumData = data.leaveDate;
                    totalLeaveDate_ = data.totalLeaveDate;
                    SumTotalData();
                    if (values == "37" && totalLeaveDate_ > 30) {
                        document.getElementById("leave_sick").style.display = "block";
                    }
                    $("#load_button").html(data.checkIS);


                }, "json");

            });

            let holiday_data = <?php echo json_encode($holiday); ?>;
            console.log(holiday_data);

            // Function to check if a date is a holiday
            function isHoliday(dateToCheck) {
                const formattedDateToCheck = dateToCheck.slice(0, 10); // Extract yyyy-mm-dd part
                return holiday_data.some(holiday => holiday.is_date === formattedDateToCheck);
            }

            // Function to generate an array of dates within a date range
            function generateDatesInRange(startDate, endDate) {
                const datesInRange = [];
                const currentDate = new Date(startDate);

                while (currentDate <= new Date(endDate)) {
                    const year = currentDate.getFullYear();
                    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                    const day = currentDate.getDate().toString().padStart(2, '0');
                    datesInRange.push(`${year}-${month}-${day}`);
                    currentDate.setDate(currentDate.getDate() + 1);
                }

                return datesInRange;
            }

            function isDateInRangex(startDate1, endDate1, dateStart, dateEnd) {
                return startDate1 >= dateStart

                // 01 <= 05 && 10 >= 07
            }


            function leaveTypeLoad() {


                return false;

                console.log("leaveTypeLoad");
                let e = document.getElementById("leave_type");
                let values = e.value;
                let text = e.options[e.selectedIndex].text;
                let userid = $('#user_id').val();
                console.log(userid);
                console.log(values);
                var _url = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values + '&type=0';
                var _urlCheckDay = $("#base-url-api").attr("data-url") + "/office/hr/leave/get/info/?id=" + values +
                    '&type=' + userid;
                $.get(_url, function(data) {
                    $("#leave_load").html(data.info);

                }, "json");
                $.get(_urlCheckDay, function(data) {
                    console.log("data");
                    console.log(data);
                    $("#leave_num").html(data.info);
                    leaveNumData = data.leaveDate;
                    totalLeaveDate_ = data.totalLeaveDate;
                    //SumTotalData();
                    $("#load_button").html(data.checkIS);
                    if (values == "37" && totalLeaveDate_ > 30) {
                        document.getElementById("leave_sick").style.display = "block";
                    }


                }, "json");
            }

            async function SumTotalData() {



                const sDate = document.getElementById("startDate");
                const eDate = document.getElementById("endDate");
                console.log("sumDate");

                //startDate
                const sFulldate = sDate.value.split("/");
                let sDay = sFulldate[0];
                let sMonth = sFulldate[1];
                let sYear = sFulldate[2] - 543;
                let sFullEng = sYear + "-" + sMonth + "-" + sDay;
                //console.log(sFullEng);
                var startDate_ = new Date(sFullEng);


                //endDate
                const eFulldate = eDate.value.split("/");
                let eDay = eFulldate[0];
                let eMonth = eFulldate[1];
                let eYear = eFulldate[2] - 543;
                let eFullEng = eYear + "-" + eMonth + "-" + eDay;
                //console.log(eFullEng);
                var etartDate_ = new Date(eFullEng);

                var dateWithoutWeekEnd = dateDifference(startDate_, etartDate_) + 1;
                let holidayCount = 0;



                const datesInRange = generateDatesInRange(startDate_, etartDate_);

                for (const date of datesInRange) {
                    if (isHoliday(date)) {
                        console.log(`${date} is a holiday.`);
                        holidayCount = holidayCount + 1;

                    }
                }


                console.log("holidayCount: " + holidayCount);

                console.log("startDate_: " + startDate_);
                console.log("etartDate_: " + etartDate_);


                let totalDate = dateWithoutWeekEnd;
                console.log("total: " + dateWithoutWeekEnd);
                console.log("leave_num_data: " + leaveNumData);
                console.log("totalLeaveDate_: " + totalLeaveDate_);

                //sumtotaldate
                //console.log(startDate_.toDateString());
                //console.log(etartDate_.toDateString());)+ 1
                const oneDay = 24 * 60 * 60 * 1000; //
                const diffDays = Math.round(Math.abs((startDate_ - etartDate_) / oneDay) + 1);
                // console.log(diffDays);

                const leave_num = document.getElementById("total_date");

                const start_day_status_val = document.querySelector('input[name="input[start_day_status]"]:checked').value;
                console.log("start_day_status_val: " + start_day_status_val);

                const end_day_status_val = document.querySelector('input[name="input[end_day_status]"]:checked').value;
                console.log("end_day_status_val: " + end_day_status_val);


                if (startDate_.getTime() === etartDate_.getTime()) {

                    if (start_day_status_val != "1" || end_day_status_val != "1") {
                        dateWithoutWeekEnd = dateWithoutWeekEnd - 0.5;
                    }

                } else {

                    if (start_day_status_val != "1") {
                        dateWithoutWeekEnd = dateWithoutWeekEnd - 0.5;
                    }

                    if (end_day_status_val != "1") {
                        dateWithoutWeekEnd = dateWithoutWeekEnd - 0.5;
                    }
                }

                if (holidayCount > 0) {
                    dateWithoutWeekEnd = dateWithoutWeekEnd - holidayCount;
                }

                let totalLeaveDate_2 = totalLeaveDate_ + dateWithoutWeekEnd;
                console.log("totalLeaveDate_2:" + totalLeaveDate_2);

                isDate = await CheckDate(startDate_, etartDate_);

                if (!isDate) {
                    console.log("xxx ");
                    //alert("วันเกิน..");
                    document.getElementById("duplicate_day").style.display = "block";

                } else {
                    document.getElementById("duplicate_day").style.display = "none";
                }

                if (totalLeaveDate_2 > leaveNumData) {
                    console.log("too ");
                    let e = document.getElementById("leave_type");
                    let values = e.value;

                    if (values != "37") {
                        isValidate = false;
                    } else {
                        if (values == "37" && totalLeaveDate_2 > 30) {
                            document.getElementById("leave_sick").style.display = "block";
                        } else {
                            document.getElementById("leave_sick").style.display = "none";
                        }
                        isValidate = true;
                    }

                } else {
                    document.getElementById("leave_sick").style.display = "none";
                    isValidate = true;
                }

                // leave_num.
                document.getElementById("total_date").value = dateWithoutWeekEnd;

                // console.log(leave_num);


            }

            async function CheckDate(startDate_, etartDate_) {

                // Initialize an empty array to store the generated dates
                const generatedDates = [];

                const currentDate = new Date(startDate_);
                while (currentDate <= etartDate_) {
                    generatedDates.push(new Date(currentDate)); // Push a new date object to the array
                    currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
                }

                // Now, generatedDates contains all the dates between startDate1 and endDate1
                console.log("generatedDates");
                console.log(generatedDates);
                const generatedDatesx = [];
                generatedDates.forEach(item => {
                    console.log(item);
                    for (let i = 0; i < LeaveListData.length; i++) {
                        console.log("//////////////");
                        console.log(new Date(LeaveListData[i].date_start));
                        console.log(new Date(LeaveListData[i].date_end));
                        console.log(item);
                        console.log("//////////////");
                        if (item.setHours(0, 0, 0, 0) >= new Date(LeaveListData[i].date_start).setHours(0, 0, 0, 0) && item.setHours(0, 0, 0, 0) <= new Date(
                                LeaveListData[i].date_end).setHours(0, 0, 0, 0)) {
                            console.log("Datetime is within the range.");
                            generatedDatesx.push(item);
                        } else {
                            console.log("Datetime is outside the range.");
                        }
                    }
                });



                console.log(generatedDatesx.length);

                if (generatedDatesx.length > 0) {
                    return false;
                } else {
                    return true;
                }

                return false
            }

            function isDateInRange(startDate, endDate, dateStart, dateEnd) {
                console.log(startDate);
                console.log(endDate);
                console.log(dateStart);
                console.log(dateEnd);
                return startDate <= dateStart && endDate >= dateEnd;
            }

            // function isDateInRange(startDate, endDate, dateStart, dateEnd) {

            //     return startDate <= dateStart && endDate >= dateEnd;
            // }


            // Expects start date to be before end date
            // start and end are Date objects
            function dateDifference(start, end) {

                // Copy date objects so don't modify originals
                var s = new Date(+start);
                var e = new Date(+end);

                // Set time to midday to avoid dalight saving and browser quirks
                s.setHours(12, 0, 0, 0);
                e.setHours(12, 0, 0, 0);

                // Get the difference in whole days
                var totalDays = Math.round((e - s) / 8.64e7);

                // Get the difference in whole weeks
                var wholeWeeks = totalDays / 7 | 0;

                // Estimate business days as number of whole weeks * 5
                var days = wholeWeeks * 5;

                // If not even number of weeks, calc remaining weekend days
                if (totalDays % 7) {
                    s.setDate(s.getDate() + wholeWeeks * 7);

                    while (s < e) {
                        s.setDate(s.getDate() + 1);

                        // If day isn't a Sunday or Saturday, add to business days
                        if (s.getDay() != 0 && s.getDay() != 6) {
                            ++days;
                        }
                    }
                }
                return days;
            }


            $(function() {

                $.validator.setDefaults({
                    submitHandler: function() {
                        $(".btn-submit").attr("disabled", "disabled");
                        console.log(isValidate);

                        if (!isValidate) {
                            alert("วันลาเกินสิทธิ์ ไม่สามารถลาได้");
                            return false;
                        }


                        if (!isDate) {
                            alert("วันลาซ้ำ ไม่สามารถลาได้");
                            return false;
                        }

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
                        'input[leave_type]': {
                            required: true
                        },

                        'input[date_start]': {
                            required: true
                        },
                        'input[date_end]': {
                            required: true
                        }


                    },
                    messages: {
                        'input[leave_type]': {
                            required: "กรุณากรอกข้อมูล"
                        },

                        'input[date_start]': {
                            required: "กรุณากรอกข้อมูล"
                        },
                        'input[date_end]': {
                            required: "กรุณากรอกข้อมูล"
                        }


                    },

                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }




                });



            });
        </script>
    @endsection
