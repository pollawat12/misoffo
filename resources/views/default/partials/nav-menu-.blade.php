<?php $id = Auth::id(); ?>
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">สรุปภาพรวม</li>

                <li class="mm-active">
                    <a href="javascript: void(0);">
                        <i class="fe-airplay" style="font-size: 18px !important;"></i>
                        <span> ภาพรวมข้อมูล </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        {{-- <li><a href="{{url('/')}}"><i class="fas fa-angle-right"></i> รายได้</a></li> --}}


                        <li><a href="{{url('dashboard')}}"><i class="fas fa-angle-right"></i> ปฏิทินกิจกรรม</a></li>
                        <li><a href="{{url('dashboard/budget')}}"><i class="fas fa-angle-right"></i> งบประมาณ</a></li>
                        <li><a href="{{url('dashboard/account')}}"><i class="fas fa-angle-right"></i> รายรับ-รายจ่าย</a></li>
                        <li><a href="{{url('dashboard/durable')}}"><i class="fas fa-angle-right"></i> พัสดุ/ครุภัณฑ์</a></li>
                        <li><a href="{{url('dashboard/purchases')}}"><i class="fas fa-angle-right"></i> จัดซื้อ-จัดจ้าง</a></li>
                        {{-- <li><a href="{{url('dashboard/strategy')}}"><i class="fas fa-angle-right"></i> บริหารงานยุทธศาสตร์</a></li> --}}
                        {{-- <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> งบประมาณ</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> บัญชี</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> การเงิน</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> บุคลากร</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> พัสดุ-ครุภัณฑ์</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> บริหารงานยุทธศาสตร์</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> จัดซื้อ - จัดจ้าง</a></li> --}}


                        {{-- <li><a href="{{url('dashboard/expenses')}}"><i class="fas fa-angle-right"></i> ค่าใช้จ่าย</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> บุคลากร</a></li>
                        <li><a href="{{url('dashboard/record')}}"><i class="fas fa-angle-right"></i> ระเบียนครุภัณฑ์</a>
                        </li>
                        <li> <a href="{{url('dashboard/project')}}"><i class="fas fa-angle-right"></i> ติดตามผลโครงการ</a>
                        </li> --}}
                    </ul>
                </li>

                <?php 
                $nav_login_info = Session()->get('auth_info');
                $nav_login_id = $nav_login_info['user_id'];
                ?>
                <li class="">
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-tie" style="font-size: 18px !important;"></i>
                        <span> ข้อมูลของฉัน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('office/hr/employees/add')}}/{{$nav_login_info['user_id']}}/?t=general"><i class="fas fa-angle-right"></i> โปรไฟล์</a></li>
                        <li> <a href="{{url('office/hr/leave/sub')}}/{{$nav_login_info['user_id']}}"><i class="fas fa-angle-right"></i> ประวัติการลา</a></li>
                        <li> <a href="{{url('office/hr/leave-work')}}/{{$nav_login_info['user_id']}}/?t=user"><i class="fas fa-angle-right"></i> สิทธิการลา</a></li>
                        {{-- <li> <a href="{{url('office/hr/leave-work')}}/{{$nav_login_info['user_id']}}/?t=user"><i class="fas fa-angle-right"></i> จองห้องประชุม</a></li>
                        <li> <a href="{{url('office/hr/leave-work')}}/{{$nav_login_info['user_id']}}/?t=user"><i class="fas fa-angle-right"></i> จองรถ</a></li>
                        <li> <a href="{{url('office/hr/leave-work')}}/{{$nav_login_info['user_id']}}/?t=user"><i class="fas fa-angle-right"></i> เวลาทำงาน</a></li> --}}
                        {{-- <li> <a href="{{url('office/hr/course/detail')}}/{{$id}}"><i class="fas fa-angle-right"></i> การฝึกอบรม</a></li> --}}
                        {{-- <li><a href="{{url('office/my/inbox')}}"><i class="fas fa-angle-right"></i> กล่องข้อความ</a></li> --}}
                        {{-- <li> <a href="{{url('office/my/changepass')}}"><i class="fas fa-angle-right"></i> เปลี่ยนรหัสผ่าน</a></li> --}}
                    </ul>
                </li>
                







                
                <li class="menu-title">นำเข้ารายการข้อมูล</li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-money-check-alt" style="font-size: 18px !important;"></i>
                        <span> งบประมาณ xc</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('office/budget/debtors/all')}}"><i class="fas fa-angle-right"></i> รายได้</a></li>
                        
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> ค่าใช้จ่าย
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/budget/expenses/all') }}">รายการค่าใช้จ่าย</a></li>
                                <!-- <li><a href="{{URL('office/budget/expenses/import/lists')}}/?t=expenses&pr=0">นำเข้าข้อมูลค่าใช้จ่าย</a></li> -->

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> รายงาน
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/budget/report/income/all') }}">รายได้</a></li>
                                <li><a href="{{URL('office/budget/expenses/print')}}/all">ค่าใช้จ่าย</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('office/budget/expenses/year/lists')}}"><i class="fas fa-angle-right"></i> ตั้งงบประมาณ</a></li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> ตั้งค่า
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=budget&pr=0">ประเภทค่าใช้จ่าย</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=categorybudget&pr=0">ประเภท</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=statementtype&pr=0">ประเภทงบ</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-money-check-alt" style="font-size: 18px !important;"></i>
                        <span> งบประมาณ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        {{-- <li><a href="{{url('office/budget/debtors/all')}}"><i class="fas fa-angle-right"></i> รายได้</a></li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> รายงาน
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/budget/report/income/all') }}">รายได้</a></li>
                                <li><a href="{{URL('office/budget/expenses/print')}}/all">ค่าใช้จ่าย</a></li>
                                <li><a href="{{ url('office/budget/expenses/all') }}/?t=1t&pr=0">บันทึกค่าใช้จ่าย</a></li>

                            </ul>
                        </li> --}}
                        <li><a href="{{url('office/budget/expenses/year/lists')}}"><i class="fas fa-angle-right"></i> ตั้งงบประมาณ</a></li>
                        <li><a href="{{url('office/budget/expenses/project')}}"><i class="fas fa-angle-right"></i> โครงการ</a></li>
                        <li><a href="{{ url('office/budget/expenses/all') }}/?t=1&pr=0"><i class="fas fa-angle-right"></i> บันทึกงบประมาณ</a></li>
                        <li><a href="{{url('office/budget/expenses/years/reposts/lists')}}"><i class="fas fa-angle-right"></i> รายงานงบประมาณ</a></li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> ตั้งค่า
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=budget&pr=0">ประเภทค่าใช้จ่าย</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=categorybudget&pr=0">ประเภท</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=statementtype&pr=0">ประเภทงบ</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-calculator" style="font-size: 18px !important;"></i>
                        <span> บัญชี </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/incomes/lists')}}"><i class="fas fa-angle-right"></i> รายได้</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <!-- <li><a href="{{URL('office/incomes/settings/oil/lists')}}"><i class="fas fa-angle-right"></i> ราคาน้ำมัน</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=typeoil&pr=0"><i class="fas fa-angle-right"></i> ประเภทเชื้อเพลิง</a></li> -->
                                <li><a href="{{URL('office/incomes/settings/company/lists')}}"><i class="fas fa-angle-right"></i> บริษัท (ค้าน้ำมัน) </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-cash-register" style="font-size: 18px !important;"></i>
                        <span> การเงิน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ url('office/budget/expenses/all') }}/?t=3&pr=0"><i class="fas fa-angle-right"></i> บันทึกค่าใช้จ่าย</a></li>

                        <li><a href="{{ url('office/budget/certificate/all') }}/?t=1&pr=0"><i class="fas fa-angle-right"></i> ใบสำคัญจ่าย (สีฟ้า)</a></li>

                        <li><a href="{{ url('office/budget/certificate/all') }}/?t=2&pr=0"><i class="fas fa-angle-right"></i> ใบสำคัญจ่าย (สีเหลือง)</a></li>

                        <li><a href="{{url('office/budget/expenses/')}}"><i class="fas fa-angle-right"></i>  รายงานโครงการ</a></li>

                        <li><a href="{{url('office/budget/expenses/reposts')}}"><i class="fas fa-angle-right"></i> สรุปค่าใช้จ่าย</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=company&pr=0"><i class="fas fa-angle-right"></i> บริษัท/ผู้ค้า </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-cash-register" style="font-size: 18px !important;"></i>
                        <span> การเงิน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ url('office/budget/expenses/all') }}"><i class="fas fa-angle-right"></i> บันทึกค่าใช้จ่าย</a></li>

                        <li><a href="{{url('office/budget/expenses/')}}"><i class="fas fa-angle-right"></i>  รายงานโครงการ</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-edit " style="font-size: 18px !important;"></i>
                        <span> บุคลากร </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/hr/employees')}}"><i class="fas fa-angle-right"></i> ทะเบียนประวัติ</a></li>
                        <li><a href="{{URL('office/hr/leave/all')}}"><i class="fas fa-angle-right"></i> ยื่นแบบใบลา</a></li>
                        {{-- <li><a href="{{URL('office/hr/course')}}"><i class="fas fa-angle-right"></i> การฝึกอบรม</a></li> --}}
                        <li><a href="{{URL('office/hr/leave-work/all')}}"><i class="fas fa-angle-right"></i> สิทธิการลา</a></li>
                        <li><a href="{{URL('office/hr/time_attendances')}}"><i class="fas fa-angle-right"></i> บันทึกเวลาทำงาน</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ผู้สมัครงาน 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=course&pr=0"><i class="fas fa-angle-right"></i> ใบสมัครงาน</a></li>
                                {{-- <li><a href="{{URL('office/settings/data/lists')}}/?t=leave&pr=0"><i class="fas fa-angle-right"></i> ประเภทการลา</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=holiday&pr=0"><i class="fas fa-angle-right"></i> กำหนดวันหยุดประจำปี</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=government&pr=0"><i class="fas fa-angle-right"></i> ระดับสำหรับข้าราชการ</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=prename&pr=0"><i class="fas fa-angle-right"></i> คำนำหน้า</a></li>
                                <li><a href="{{URL('office/hr/diagram/all')}}"><i class="fas fa-angle-right"></i> ผังเจ้าหน้าที่กองทุน</a></li> --}}
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=course&pr=0"><i class="fas fa-angle-right"></i> ประเภทการฝึกอบรม</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=leave&pr=0"><i class="fas fa-angle-right"></i> ประเภทการลา</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=holiday&pr=0"><i class="fas fa-angle-right"></i> กำหนดวันหยุดประจำปี</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=government&pr=0"><i class="fas fa-angle-right"></i> ระดับสำหรับข้าราชการ</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=prename&pr=0"><i class="fas fa-angle-right"></i> คำนำหน้า</a></li>
                                <li><a href="{{URL('office/hr/diagram/all')}}"><i class="fas fa-angle-right"></i> ผังเจ้าหน้าที่กองทุน</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-shapes" style="font-size: 18px !important;"></i>
                        <span> ระเบียนครุภัณฑ์ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ครุภัณฑ์ 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/lists')}}/?t=durable&pr=0">ข้อมูลครุภัณฑ์</a></li>
                                <li><a href="{{URL('office/durable/activity')}}/?t=borrow&pr=0">ยืม / คืน ครุภัณฑ์</a></li>
                                {{-- <li><a href="{{URL('office/durable/activity')}}/?t=returns&pr=0">คืนครุภัณฑ์</a></li> --}}
                                <li><a href="{{URL('office/durable/activity')}}/?t=distribution&pr=0">จำหน่ายครุภัณฑ์</a></li>
                                <li><a href="{{URL('office/durable/repair')}}/?t=repair&pr=0">ซ่อมแซม</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">พัสดุ/อุปกรณ์ 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/lists')}}/?t=supplies&pr=0">ข้อมูลพัสดุ/อุปกรณ์</a></li>
                                {{-- <li><a href="javascript: void(0);">รับพัสดุ/อุปกรณ์</a></li> --}}
                                <li><a href="{{URL('office/durable/disbursement')}}/?t=supplies&pr=0">เบิกพัสดุ/อุปกรณ์</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">รายงาน 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="false">ครุภัณฑ์ 
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-third-level nav" aria-expanded="false">
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=durable&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์</a></li>
                                        <!-- <li><a href="{{URL('office/durable/reports/lists')}}/?t=project&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์โครงการ</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=office&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์สำนักงาน</a></li> -->
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=borrow&pr=0"><i class="fas fa-angle-right"></i> ยืมครุภัณฑ์</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=distribution&pr=0"><i class="fas fa-angle-right"></i> จำหน่ายครุภัณฑ์</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=repair&pr=0"><i class="fas fa-angle-right"></i> ซ่อมแซมครุภัณฑ์</a></li>
                                    </ul>
                                </li> 
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="false">พัสดุ/อุปกรณ์ 
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-third-level nav" aria-expanded="false">
                                        <li><a href="{{URL('office/durable/reports/supplies/lists')}}/?t=supplies&pr=0"><i class="fas fa-angle-right"></i> ข้อมูลพัสดุ/อุปกรณ์</a></li>
                                        <li><a href="{{URL('office/durable/reports/supplies/lists')}}/?t=disbursement&pr=0"><i class="fas fa-angle-right"></i> เบิกพัสดุ/อุปกรณ์</a></li>
                                    </ul>
                                </li> 
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=brand&pr=0">ยี่ห้อ</a></li>
                                <li><a href="{{URL('office/durable/data/lists')}}/?t=category&pr=0">หมวดหมู่</a></li>
                                <li><a href="{{URL('office/durable/data/lists')}}/?t=unitcount&pr=0">หน่วยนับ</a></li>
                                <li><a href="{{URL('office/durable/data/lists')}}/?t=means&pr=0">ประเภทวิธีที่ได้มา</a></li>
                                <li><a href="{{URL('office/durable/data/lists')}}/?t=distributor&pr=0">ประเภทจำหน่าย</a></li>
                                <li><a href="{{URL('office/durable/data/lists')}}/?t=money&pr=0">ประเภทเงิน</a></li>
                                <!-- <li><a href="{{URL('office/durable/data/import/lists')}}/?t=durable&pr=0">นำเข้าข้อมูลครุภัณฑ์</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-credit-card-marker"></i>
                        <span> ติดตามผลโครงการ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('office/progress/project/show')}}"><i class="fas fa-angle-right"></i> โครงการ</a></li>

                        <li>
                            <a href="{{url('office/progress/project/report/show')}}"><i class="fas fa-angle-right"></i> ผลการดำเนินงาน</a>
                        </li>

                        <!-- li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="javascript: void(0);">ลักษณะโครงการ</a>
                                </li>
                            </ul>
                        </li -->

                        <!-- li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="javascript: void(0);">ยี่ห้อ</a></li>
                                <li><a href="javascript: void(0);">กำหนดวันหยุดประจำปี</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('office/progress/update-progress/show')}}">ผลการดำเนินงาน  <font color="red">(5)</font></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">นำเข้าข้อมูล 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="{{url('office/progress/import-data/show')}}">Import Excel</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตัวชี้วัด 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="{{URL('office/indicators/items')}}">ตัวชี้วัด</a>
                                </li>
                            </ul>
                        </li -->
                        
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-calculator" style="font-size: 18px !important;"></i>
                        <span> จัดซื้อ - จัดจ้าง </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/purchases/lists')}}"><i class="fas fa-angle-right"></i> จัดซื้อ - จัดจ้าง</a></li>
                        <li><a href="{{URL('office/purchases/report')}}"><i class="fas fa-angle-right"></i> รายงาน การจัดซื้อ - จัดจ้าง</a></li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=purchasesstatus&pr=0"><i class="fas fa-angle-right"></i> สถานะจัดซื้อ - จัดจ้าง</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=purchasesmethod&pr=0"><i class="fas fa-angle-right"></i> วิธีการจักซื้อ - จัดจ้าง</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=purchasesmargin&pr=0"><i class="fas fa-angle-right"></i> ประเภทหลักประกัน</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=purchasesgroup&pr=0"><i class="fas fa-angle-right"></i> กลุ่มงาน</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-chess-queen" style="font-size: 18px !important;"></i>
                        <span> บริหารงานยุทธศาสตร์ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/management/subject')}}"><i class="fas fa-angle-right"></i> รายการข้อมูล</a></li>
                    </ul>
                </li> --}}


                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 18px !important;"></i>
                        <span> ประเมินความคุ้มค่า </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/incomes/reports')}}"><i class="fas fa-angle-right"></i> กำหนดแผนการ</a></li>
                        <li><a href="{{URL('office/incomes/reports')}}"><i class="fas fa-angle-right"></i> ตัวชี้วัด</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/data/import/lists')}}/?t=oil&pr=0"><i class="fas fa-angle-right"></i> หน่วยนับ</a></li>
                                <li><a href="{{URL('office/durable/data/import/lists')}}/?t=oil&pr=0"><i class="fas fa-angle-right"></i> หมวดหมู่ตัวชี้วัด</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}


                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 18px !important;"></i>
                        <span> ประเมินผล </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/purchases/lists')}}"><i class="fas fa-angle-right"></i> ตัวชี้วัด</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/evaluations/settings/indicator-category')}}"><i class="fas fa-angle-right"></i> หมวดหมู่ตัวชี้วัด</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 18px !important;"></i>
                        <span> ยุทธศาสตร์ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <!-- <li><a href="{{URL('office/incomes/reports')}}"><i class="fas fa-angle-right"></i> กำหนดแผนการ</a></li>
                        <li><a href="{{URL('office/incomes/reports')}}"><i class="fas fa-angle-right"></i> ตัวชี้วัด</a></li> -->
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ราคาปิโตรเลียม 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/strategic/oil/lists')}}/?t=crude&pr=1"><i class="fas fa-angle-right"></i> Crude</a></li>
                                <li><a href="{{URL('office/strategic/oil/lists')}}/?t=inside&pr=2"><i class="fas fa-angle-right"></i> Inside Crude</a></li>
                                <li><a href="{{URL('office/strategic/oil/lists')}}/?t=cargo&pr=3"><i class="fas fa-angle-right"></i> LPG Cargo</a></li>
                            </ul>
                        </li>  
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">เอทานอล-ไบโอดีเซล 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/strategic/oil/lists')}}/?t=exchange&pr=4"><i class="fas fa-angle-right"></i> Exchange Rate</a></li>
                            </ul>
                        </li>   
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=oilCategory&pr=0"><i class="fas fa-angle-right"></i> หมวดหมู่</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=oilType&pr=0"><i class="fas fa-angle-right"></i>  ประเภทเชื่อเพลิง</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="menu-title">งานบริการ</li>
                <li>
                    <a href="{{ url('office/services/reserve-meeting') }}">
                        <i class="fas fa-calendar-alt" style="font-size: 18px !important;"></i>
                        <span> จองห้องประชุม </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fab fa-wpforms" style="font-size: 20px !important;"></i>
                        <span> กิจกรรม </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/settings/budget-year')}}"><i class="fas fa-angle-right"></i> กิจกรรม</a></li>
                        <li><a href="{{URL('office/settings/budget-year')}}"><i class="fas fa-angle-right"></i> แบบประเมิน</a></li>
                    </ul>
                </li> --}}


                


                <li class="menu-title">ตั้งค่าระบบ</li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-settings" style="font-size: 18px !important;"></i>
                        <span> ตั้งค่า </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/settings/budget-year')}}"><i class="fas fa-angle-right"></i> ปีงบประมาณ</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=department&pr=0"><i class="fas fa-angle-right"></i> ฝ่ายงาน</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=group_work&pr=0"><i class="fas fa-angle-right"></i> สำนักงาน</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=position&pr=0"><i class="fas fa-angle-right"></i> ตำแหน่งงาน</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=institution&pr=0"><i class="fas fa-angle-right"></i> หน่วยงาน</a></li>
                        <li><a href="{{URL('office/settings/roles/lists')}}"><i class="fas fa-angle-right"></i> กลุ่มผู้ใช้งานระบบ</a></li>
                        <!-- <li><a href="{{URL('office/settings/exports/lists')}}"><i class="fas fa-angle-right"></i> นำออก ฐานข้อมูล</a></li> -->

                        <!-- Meeting Book -->
                        <li><a href="{{ URL('office/settings/meeting_room') }}"><i class="fas fa-angle-right"></i> ห้องประชุม</a></li>
                        <li><a href="{{ URL('office/settings/meeting_type') }}"><i class="fas fa-angle-right"></i> ประเภทการประชุม</a></li>
                        <li><a href="{{ URL('office/settings/meeting_item') }}"><i class="fas fa-angle-right"></i> อุปกรณ์ห้องประชุม</a></li>
                        <li><a href="{{URL('office/durable/data/import/lists')}}/?t=oil&pr=0"><i class="fas fa-angle-right"></i>นำเข้าข้อมูล</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=groupoil&pr=0"><i class="fas fa-angle-right"></i> กลุ่มน้ำมันราคา</a></li>
                        <li><a href="{{URL('office/management/reports')}}/?t=332&pr=0"><i class="fas fa-angle-right"></i> ปิโตรเลียม OFFO Crude</a></li>
                        <li><a href="{{URL('office/management/reports')}}/?t=334&pr=0"><i class="fas fa-angle-right"></i> ปริมาณการใช้น้ำมันเชื้อเพลิง</a></li>
                        <!--
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=token&pr=0"><i class="fas fa-angle-right"></i> Token line Notify</a></li>
                        <li><a href="{{URL('office/settings/data/lists')}}/?t=institution&pr=0"><i class="fas fa-angle-right"></i> ข้อความ Line Notify</a></li>
                        -->
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-users-cog" style="font-size: 18px !important;"></i>
                        <span> สิทธิ์การใช้งาน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/settings/users/lists')}}"><i class="fas fa-angle-right"></i> กลุ่มผู้ใช้งานระบบ</a></li>
                    </ul>
                </li> --}}


            </ul>
            <p class="pt-4"></p>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
