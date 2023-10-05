<?php $id = Auth::id(); ?>

<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title menu-title-label"># สรุปภาพรวม</li>

                <li class="mm-active">
                    <a href="javascript: void(0);">
                        <i class="fe-airplay" style="font-size: 18px !important;"></i>
                        <span> ภาพรวมข้อมูล </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        {{-- <li><a href="{{url('/')}}"><i class="fas fa-angle-right"></i> รายได้</a></li> --}}


                        <li><a href="{{url('dashboard')}}"><i class="fe-sidebar"></i> ปฏิทินกิจกรรม</a></li>
                        <li><a href="{{url('dashboard/budget')}}"><i class="fe-sidebar"></i> งบประมาณ</a></li>
                        {{-- <li><a href="{{url('dashboard/account')}}"><i class="fe-sidebar"></i> รายรับ-รายจ่าย</a></li> --}}
                        <li><a href="{{url('dashboard/durable')}}"><i class="fe-sidebar"></i> พัสดุ/ครุภัณฑ์</a></li>
                        <li><a href="{{url('dashboard/purchases')}}"><i class="fe-sidebar"></i> จัดซื้อ-จัดจ้าง</a></li>
                        {{-- <li><a href="{{url('dashboard/strategy')}}"><i class="fe-sidebar"></i> บริหารงานยุทธศาสตร์</a></li> --}}
                        {{-- <li><a href="{{url('dashboard/hr')}}"><i class="fe-sidebar"></i></i> งบประมาณ</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fe-sidebar"></i> บัญชี</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fe-sidebar"></i> การเงิน</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fe-sidebar"></i> บุคลากร</a></li>
                        <li><a href="{{url('dashboard/hr')}}"><i class="fe-sidebar"></i> พัสดุ-ครุภัณฑ์</a></li>--}}
                        <!--<li>
                             <a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> บริหารงานยุทธศาสตร์</a> 

                            <a href="javascript: void(0);">
                                <i class="fas fa-angle-right"></i>
                                <span> ยุทธศาสตร์ </span>
                                <span class="menu-arrow"></span>
                            </a>

                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{URL('dashboard/strategy')}}/?t=reports&pr=1"><i class="fas fa-angle-right"></i> รายงานราคาน้ำมัน</a></li> 
                                <li><a href="{{URL('dashboard/strategy')}}/?t=reports&pr=2"><i class="fas fa-angle-right"></i> ประมาณการสภาพคล่อง</a></li> 
                            </ul>
                    
                        </li>-->
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fe-sidebar"></i>
                                <span> การเงิน </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{URL('dashboard/expenses/estimate')}}/?t=0&pr=0"><i
                                            class="fas fa-angle-right mr-1"></i>ประเมินผลความคุ้มค่าฯ</a></li>
                                <li> <a href="{{URL('dashboard/expenses/institution')}}/?t=0&pr=0"><i
                                            class="fas fa-angle-right mr-1"></i>ฐานะการเงิน</a></li>
                                <!-- <li><a href="{{URL('dashboard/expenses/fund')}}/?t=0&pr=0"><i
                                            class="fas fa-angle-right mr-1"></i>รายได้ของเงินกองทุน</a></li> -->
                                <!-- <li><a href="{{URL('dashboard/expenses/incomes')}}/?t=0&pr=0"><i
                                            class="fas fa-angle-right mr-1"></i>รายรับ - รายจ่าย</a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="http://103.80.48.33:8000">
                                <i class="fe-sidebar"></i>
                                <span> ยุทธศาสตร์ </span>
                            </a>
                        </li>
                        {{-- <li><a href="{{url('dashboard/hr')}}"><i class="fas fa-angle-right"></i> จัดซื้อ - จัดจ้าง</a></li> --}}


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
                $nav_role_id = $nav_login_info['role_id'];
                ?>
                <li class="">
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-tie" style="font-size: 18px !important;"></i>
                        <span> ข้อมูลของฉัน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{url('office/time-attendance/worktime')}}"><i class="fas fa-angle-right"></i> ลงเวลาปฏิบัติงาน</a></li>
                        <li><a href="{{url('office/hr/employees/add')}}/{{$nav_login_info['user_id']}}/?t=general"><i class="fas fa-angle-right"></i> โปรไฟล์</a></li>
                        <li> <a href="{{url('office/hr/leave/sub')}}/{{$nav_login_info['user_id']}}"><i class="fas fa-angle-right"></i> ประวัติการลา</a></li>
                        <li> <a href="{{url('office/hr/leave-work')}}/{{$nav_login_info['user_id']}}/?t=user"><i class="fas fa-angle-right"></i> สิทธิการลา</a></li>
                        <li> <a href="{{url('office/hr/reserve-car/sub')}}/{{$nav_login_info['user_id']}}"><i class="fas fa-angle-right"></i> จองรถยนต์ส่วนกลาง</a></li>


                        <!-- <li> <a href="{{url('office/hr/employees/estimate')}}/{{$nav_login_info['user_id']}}"><i class="fas fa-angle-right"></i> ตั้งค่าการประเมิน</a></li> -->
                        <?php
                            if($nav_login_info['user_id'] != 1):
                                $leaves = \App\Models\UserDiagram::where('level_id', '1')->where('user_id', $nav_login_info['user_id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                if($leaves):
                        ?> 
                                    
                                    <li> <a href="{{url('office/hr/leave/departments')}}/{{$nav_login_info['user_id']}}/{{$leaves->department_id}}"><i class="fas fa-angle-right"></i> อนุมัติการลา</a></li>
                                    <li> <a href="{{url('office/hr/reserve-car/departments')}}/{{$nav_login_info['user_id']}}/{{$leaves->department_id}}"><i class="fas fa-angle-right"></i> อนุมัติการจองรถ</a></li>
                        <?php 
                                endif;
                            
                            endif;
                            
                        ?>
                        <?php
                            if($nav_login_info['user_id'] != 1):
                                $diagrams = \App\Models\UserDiagram::where('level_id', '1')->where('user_id', $nav_login_info['user_id'])->where('is_deleted', '0')->where('is_active','1')->first();
                                if($diagrams):
                        ?> 
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fas fa-clipboard-list"></i>
                                            <span> ประเมินผลการปฏิบัติงาน </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level nav" aria-expanded="false">
                                            <li>
                                                <a href="{{url('office/hr/employees/estimate')}}/{{$nav_login_info['user_id']}}/{{$diagrams->department_id}}">
                                                    <i class="fas fa-angle-right mr-1"></i>ประเมินพนังงาน
                                                </a>
                                            </li>
                                            <!-- <li>
                                                <a href="{{url('office/hr/employees/behavior')}}/{{$nav_login_info['user_id']}}">
                                                    <i class="fas fa-angle-right mr-1"></i>รายการประเมินสมรรถนะ
                                                </a>
                                            </li> -->
                                        </ul>
                                    </li>
                        <?php 
                                endif; 
                            else:
                        ?>
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fas fa-clipboard-list"></i>
                                        <span> ประเมินผลการปฏิบัติงาน </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level nav" aria-expanded="false">
                                        <li>
                                            <a href="{{url('office/hr/employees/estimate')}}/{{$nav_login_info['user_id']}}/0">
                                                <i class="fas fa-angle-right mr-1"></i>ประเมินพนังงาน ผู้ดูแลระบบ
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                        <?php endif;?>

                       
                        {{-- <li> <a href="{{url('office/hr/course/detail')}}/{{$id}}"><i class="fas fa-angle-right"></i> การฝึกอบรม</a></li>
                        <li><a href="{{url('office/my/inbox')}}"><i class="fas fa-angle-right"></i> กล่องข้อความ</a></li>  --}}
                        <li> <a href="{{url('office/my/changepass')}}"><i class="fas fa-angle-right"></i> เปลี่ยนรหัสผ่าน</a></li>
                    </ul>
                </li>
                
                <?php //if($nav_role_id != 3): ?>

                <?php
                    $Roles = \App\Models\ModulePermission::where('main_functions_id', '2')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($Roles) > 0):
                ?> 
                <li class="menu-title menu-title-label"># นำเข้ารายการข้อมูล</li>
                <?php endif; ?>
                {{-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-money-check-alt" style="font-size: 18px !important;"></i>
                        <span> งบประมาณ</span>
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
                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 11 || $nav_role_id == 16):?> 
                <?php
                    $RoleBudget = \App\Models\ModulePermission::where('module_functions_id', '7')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleBudget) > 0):
                ?>      
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
                        <!-- <li><a href="{{url('office/budgets')}}"><i class="fas fa-angle-right"></i> งบประมาณ</a></li> -->

                        <?php
                            $RoleBudget1 = \App\Models\ModulePermission::where('module_functions_id', '8')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget1) > 0):
                        ?>
                        <li><a href="{{url('office/budgets/set/488')}}"><i class="fas fa-angle-right"></i> งบบริหาร</a></li>
                        <?php endif; ?>

                        <?php
                            $RoleBudget2 = \App\Models\ModulePermission::where('module_functions_id', '9')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget2) > 0):
                        ?>
                        <li><a href="{{url('office/budgets/set/489')}}"><i class="fas fa-angle-right"></i> งบโครงการ</a></li>
                        <?php endif; ?>


                        {{--
                        <?php
                            $RoleBudget3 = \App\Models\ModulePermission::where('module_functions_id', '10')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget3) > 0):
                        ?>
                        <li><a href="{{url('office/budgets/set/490')}}"><i class="fas fa-angle-right"></i> งบชดเชย</a></li>
                        <?php endif; ?>
                        --}}

                        <?php
                            $RoleBudget4 = \App\Models\ModulePermission::where('module_functions_id', '11')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget4) > 0):
                        ?>
                        <li><a href="{{url('office/expenses/project')}}"><i class="fas fa-angle-right"></i> โครงการ</a></li>
                        <?php endif; ?>
                        <li><a href="{{url('office/budgets/set/9999')}}"><i class="fas fa-angle-right"></i> สำรองค่าใช้จ่าย</a></li>

                        <!-- <li><a href="{{ url('office/expenses/all') }}/?t=0&pr=0"><i class="fas fa-angle-right"></i> รายการค่าใช้จ่าย</a></li> -->
                        <!-- <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> รายการค่าใช้จ่าย
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/expenses/all') }}/?t=0&pr=0">ค่าใช้จ่าย</a></li>
                                <li><a href="{{ url('office/expenses/all') }}/?t=1&pr=0">โครงการ</a></li>
                                <li><a href="{{ url('office/expenses/compensate/all') }}/?t=2&pr=0">ชดเชข</a></li>
                            </ul>
                        </li> -->

                        <?php
                            $RoleBudget5 = \App\Models\ModulePermission::where('module_functions_id', '33')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget5) > 0):
                        ?>
                        <li><a href="{{url('office/expenses/years/reposts/lists')}}"><i class="fas fa-angle-right"></i> รายงานงบประมาณ</a></li>
                        <?php endif; ?>
                        
                        <?php
                            $RoleBudget6 = \App\Models\ModulePermission::where('module_functions_id', '34')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBudget6) > 0):
                        ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> ตั้งค่า
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=budget&pr=0">ประเภทค่าใช้จ่าย</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=categorybudget&pr=0">ประเภท</a></li>
                                <!-- <li><a href="{{URL('office/settings/data/lists')}}/?t=statementtype&pr=0">ประเภทงบ</a></li> -->
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=budgets&pr=0">ประเภทงบประมาณ</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php endif; ?>
                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 12 || $nav_role_id == 16):?>   
                <?php
                    $RoleB = \App\Models\ModulePermission::where('module_functions_id', '12')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleB) > 0):
                ?>            
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-calculator" style="font-size: 18px !important;"></i>
                        <span> บัญชี </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <?php
                            $RoleB1 = \App\Models\ModulePermission::where('module_functions_id', '13')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleB1) > 0):
                        ?> 
                        <li><a href="{{URL('office/incomes/lists')}}"><i class="fas fa-angle-right"></i> รายได้</a></li>
                        <?php endif;?>

                        <?php
                            $RoleB2 = \App\Models\ModulePermission::where('module_functions_id', '14')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleB2) > 0):
                        ?> 
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
                        <?php endif;?>

                    </ul>
                </li>
                <?php endif;?>
                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 13 || $nav_role_id == 16):?>  
                <?php
                    $RoleMoney = \App\Models\ModulePermission::where('module_functions_id', '18')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleMoney) > 0):
                ?>             
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-cash-register" style="font-size: 18px !important;"></i>
                        <span> การเงิน </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <!-- <li><a href="{{ url('office/expenses/all') }}/?t=3&pr=0"><i class="fas fa-angle-right"></i> บันทึกค่าใช้จ่าย</a></li> -->
                        <li><a href="{{ url('office/expenses/estimate/lists') }}/?t=0&pr=0"><i class="fas fa-angle-right"></i> ประเมินผลความคุ้มค่าฯ</a></li>

                        <?php
                            $RoleMoney1 = \App\Models\ModulePermission::where('module_functions_id', '19')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleMoney1) > 0):
                        ?>  
                        <li><a href="{{ url('office/expenses/certificate/all') }}/?t=1&pr=0"><i class="fas fa-angle-right"></i> ใบสำคัญจ่าย (สีฟ้า)</a></li>
                        <?php endif; ?>

                        <?php
                            $RoleMoney2 = \App\Models\ModulePermission::where('module_functions_id', '20')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleMoney2) > 0):
                        ?> 
                        <li><a href="{{ url('office/expenses/certificate/all') }}/?t=2&pr=0"><i class="fas fa-angle-right"></i> ใบสำคัญจ่าย (สีเหลือง)</a></li>
                        <?php endif; ?>

                        <?php
                            $RoleMoney3 = \App\Models\ModulePermission::where('module_functions_id', '21')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleMoney3) > 0):
                        ?> 
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> รายการค่าใช้จ่าย
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/expenses/all') }}/?t=0&pr=0">ค่าใช้จ่าย</a></li>
                                <li><a href="{{ url('office/expenses/all') }}/?t=1&pr=0">โครงการ</a></li>
                                <li><a href="{{ url('office/expenses/compensate/all') }}/?t=2&pr=0">ชดเชย</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false"><i class="fas fa-angle-right"></i> รายรับ-รายจ่าย
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{ url('office/expenses/income/lists') }}/?t=1&pr=0">รายรับ</a></li>
                                <li><a href="{{ url('office/expenses/income/lists') }}/?t=2&pr=0">รายจ่าย</a></li>
                                <li><a href="{{ url('office/expenses/income/lists') }}/?t=3&pr=0">ค้างจ่าย</a></li>
                                <li><a href="{{ url('office/expenses/institution/lists') }}/?t=0&pr=0">งบแสดงฐานะการเงิน</a></li>
                                <li><a href="{{ url('office/expenses/fund/lists') }}/?t=0&pr=0">รายได้ของเงินกองทุน</a></li>
                                <li><a href="{{ url('office/expenses/incomes/lists') }}/?t=0&pr=0">รายรับ - รายจ่าย</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <!-- <li><a href="{{url('office/expenses/')}}"><i class="fas fa-angle-right"></i>  รายงานโครงการ</a></li> -->

                        <!-- <li><a href="{{url('office/expenses/reposts')}}"><i class="fas fa-angle-right"></i> สรุปค่าใช้จ่าย</a></li> -->

                        <?php
                            $RoleMoney4 = \App\Models\ModulePermission::where('module_functions_id', '22')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleMoney4) > 0):
                        ?> 
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/expenses/certificate/company')}}"><i class="fas fa-angle-right"></i> บริษัท/ผู้ค้า </a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=asset&pr=0"><i class="fas fa-angle-right"></i> ประเภทสินทรัพย์</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=fund&pr=0"><i class="fas fa-angle-right"></i> ประเภทเงินกองทุน</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=income&pr=0"><i class="fas fa-angle-right"></i> ประเภทรายรับ - รายจ่าย</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=estimate&pr=0"><i class="fas fa-angle-right"></i> ประเภทประเมินผลความคุ้มค่าฯ</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php endif; ?>
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
                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 9 || $nav_role_id == 17):?> 
                    
                <?php
                    $RoleHr = \App\Models\ModulePermission::where('module_functions_id', '23')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleHr) > 0):
                ?> 
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-user-edit " style="font-size: 18px !important;"></i>
                        <span> บุคลากร </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                     

                        <?php
                            $RoleHr2 = \App\Models\ModulePermission::where('module_functions_id', '24')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr2) > 0):
                        ?>

                         <li>
                            <a href="javascript: void(0);" aria-expanded="false">ระบบลาออนไลน์ 
                                <span class="menu-arrow"></span>
                            </a>
                            
                        <?php
                            $RoleHr3 = \App\Models\ModulePermission::where('module_functions_id', '25')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr3) > 0):
                        ?>

                        <?php
                            $RoleHr4 = \App\Models\ModulePermission::where('module_functions_id', '35')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr4) > 0):
                        ?>

                        <?php endif; ?>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/hr/leave-work/all')}}"><i class="fas fa-angle-right"></i> สิทธิการลา</a></li>
                                <li><a href="{{URL('office/hr/leave/all')}}"><i class="fas fa-angle-right"></i> รายการลา</a></li>
                                <li><a href="{{URL('office/hr/leave/report')}}"><i class="fas fa-angle-right"></i> รายงานสถิติการลา</a></li>
                            </ul>
                        </li>
                        
                        <?php endif; ?>


                        <?php
                            $RoleHr1 = \App\Models\ModulePermission::where('module_functions_id', '23')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr1) > 0):
                        ?>
                        <li><a href="{{URL('office/hr/employees')}}"><i class="fas fa-angle-right"></i> ทะเบียนประวัติ</a></li>
                        <?php endif; ?>
                        <li><a href="{{URL('office/hr/course')}}"><i class="fas fa-angle-right"></i> การฝึกอบรม</a></li>
                        <?php endif; ?>

                        <?php
                            $RoleHr5 = \App\Models\ModulePermission::where('module_functions_id', '36')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr5) > 0):
                        ?>
                        <li><a href="{{URL('office/hr/time_attendances')}}"><i class="fas fa-angle-right"></i> บันทึกเวลาทำงาน</a></li>
                        <li><a href="{{URL('office/hr/time_attendances/month')}}"><i class="fas fa-angle-right"></i> บันทึกเวลาทำงานบุคคล (รายเดือน)</a></li>
                        <li><a href="{{URL('office/hr/time_attendances/paymonth')}}"><i class="fas fa-angle-right"></i> ค่าตอบแทน</a></li>
                        <?php endif; ?>

                        <?php
                            $RoleHr6 = \App\Models\ModulePermission::where('module_functions_id', '37')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr6) > 0):
                        ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ผู้สมัครงาน 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('appform/projects')}}" target="_blank"><i class="fas fa-angle-right"></i> ฟอร์มสมัครงานออนไลน์</a></li>
                                <li><a href="{{URL('office/hr/candidate')}}"><i class="fas fa-angle-right"></i> ใบสมัครงาน</a></li>
                                <li><a href="{{URL('office/hr/announce')}}"><i class="fas fa-angle-right"></i> ตั้งโครงการสมัครงาน</a></li>
                                {{-- <li><a href="{{URL('office/settings/data/lists')}}/?t=leave&pr=0"><i class="fas fa-angle-right"></i> ประเภทการลา</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=holiday&pr=0"><i class="fas fa-angle-right"></i> กำหนดวันหยุดประจำปี</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=government&pr=0"><i class="fas fa-angle-right"></i> ระดับสำหรับข้าราชการ</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=prename&pr=0"><i class="fas fa-angle-right"></i> คำนำหน้า</a></li>
                                <li><a href="{{URL('office/hr/diagram/all')}}"><i class="fas fa-angle-right"></i> ผังเจ้าหน้าที่กองทุน</a></li> --}}
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php
                            $RoleHr7 = \App\Models\ModulePermission::where('module_functions_id', '39')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleHr7) > 0):
                        ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=course&pr=0"><i class="fas fa-angle-right"></i> ประเภทการฝึกอบรม</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=leave&pr=0"><i class="fas fa-angle-right"></i> ประเภทการลา</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=holiday&pr=0"><i class="fas fa-angle-right"></i> กำหนดวันหยุดประจำปี</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=government&pr=0"><i class="fas fa-angle-right"></i> ระดับสำหรับเจ้าหน้าที่</a></li>
                                <li><a href="{{URL('office/settings/data/lists')}}/?t=prename&pr=0"><i class="fas fa-angle-right"></i> คำนำหน้า</a></li>
                                <li><a href="{{URL('office/hr/diagram/all')}}"><i class="fas fa-angle-right"></i> ผังเจ้าหน้าที่กองทุน</a></li>
                                <li><a href="{{URL('office/hr/setting/time-attendance')}}"><i class="fas fa-angle-right"></i> ลงเวลาปฏิบัติงาน</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fas fa-user-injured"></i>
                                <span> สิทธิประโยชน์พนักงาน </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level nav" aria-expanded="false">
                                <li>
                                    <a href="{{URL('office/settings/data/lists')}}/?t=pay&pr0">
                                        <i class="fas fa-angle-right mr-1"></i>ค่าตอบแทน
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL('office/settings/data/lists')}}/?t=welfare&pr0">
                                        <i class="fas fa-angle-right mr-1"></i>ข้อมูลสวัสดิการ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL('office/settings/data/lists')}}/?t=credentials&pr0">
                                        <i class="fas fa-angle-right mr-1"></i>ขอหนังสือรับรอง
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php endif; ?>

                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 10 || $nav_role_id == 17):?> 
                <?php
                    $RoleDurable = \App\Models\ModulePermission::where('module_functions_id', '40')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleDurable) > 0):
                ?> 
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-shapes" style="font-size: 18px !important;"></i>
                        <span> พัสดุ(ครุภัณฑ์และวัสดุ)  </span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <?php
                            $RoleDurable1 = \App\Models\ModulePermission::where('module_functions_id', '41')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleDurable1) > 0):
                        ?> 
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ครุภัณฑ์ 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/lists')}}/?t=durable&pr=0">ข้อมูลครุภัณฑ์</a></li>
                                <li><a href="{{URL('office/durable/borrow/lists')}}/?t=borrow&pr=0">เบิก / ยืม / คืน ครุภัณฑ์</a></li>
                                {{-- <li><a href="{{URL('office/durable/activity')}}/?t=returns&pr=0">คืนครุภัณฑ์</a></li> --}}
                                <li><a href="{{URL('office/durable/activity')}}/?t=distribution&pr=0">จำหน่ายครุภัณฑ์</a></li>
                                <li><a href="{{URL('office/durable/repair')}}/?t=repair&pr=0">ซ่อมแซมครุภัณฑ์</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>


                        <?php
                            $RoleDurable2 = \App\Models\ModulePermission::where('module_functions_id', '42')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleDurable2) > 0):
                        ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">วัสดุสำนักงาน
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/lists')}}/?t=supplies&pr=0">ข้อมูลวัสดุสำนักงาน</a></li>
                                {{-- <li><a href="javascript: void(0);">รับวัสดุสำนักงาน</a></li> --}}
                                <li><a href="{{URL('office/durable/disbursement')}}/?t=supplies&pr=0">เบิกวัสดุสำนักงาน</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>


                        <?php
                            $RoleDurable3 = \App\Models\ModulePermission::where('module_functions_id', '43')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleDurable3) > 0):
                        ?>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">รายงาน 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="false">พัสดุ 
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-third-level nav" aria-expanded="false">
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=durable&pr=0"><i class="fas fa-angle-right"></i> พัสดุ</a></li>
                                        <!-- <li><a href="{{URL('office/durable/reports/lists')}}/?t=project&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์โครงการ</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=office&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์สำนักงาน</a></li> -->
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=borrow&pr=0"><i class="fas fa-angle-right"></i> ยืมพัสดุ</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=distribution&pr=0"><i class="fas fa-angle-right"></i> จำหน่ายพัสดุ</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=repair&pr=0"><i class="fas fa-angle-right"></i> ซ่อมแซมพัสดุ</a></li>
                                    </ul>
                                </li> 
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="false">วัสดุสำนักงาน 
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-third-level nav" aria-expanded="false">
                                        <li><a href="{{URL('office/durable/reports/supplies/lists')}}/?t=supplies&pr=0"><i class="fas fa-angle-right"></i> ข้อมูลวัสดุสำนักงาน</a></li>
                                        <li><a href="{{URL('office/durable/reports/supplies/lists')}}/?t=disbursement&pr=0"><i class="fas fa-angle-right"></i> เบิกวัสดุสำนักงาน</a></li>
                                    </ul>
                                </li> 
                            </ul>
                        </li>
                        <?php endif; ?>
                        
                        <?php
                            $RoleDurable4 = \App\Models\ModulePermission::where('module_functions_id', '44')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleDurable4) > 0):
                        ?>
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
                            </ul>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php endif; ?>

                {{-- <li>
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
                                <li><a href="{{URL('office/durable/activity')}}/?t=distribution&pr=0">จำหน่ายครุภัณฑ์</a></li>
                                <li><a href="{{URL('office/durable/repair')}}/?t=repair&pr=0">ซ่อมแซม</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">วัสดุ/อุปกรณ์ 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/durable/lists')}}/?t=supplies&pr=0">ข้อมูลวัสดุ/อุปกรณ์</a></li>
                                <li><a href="{{URL('office/durable/disbursement')}}/?t=supplies&pr=0">เบิกวัสดุ/อุปกรณ์</a></li>
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
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=project&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์โครงการ</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=office&pr=0"><i class="fas fa-angle-right"></i> ครุภัณฑ์สำนักงาน</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=borrow&pr=0"><i class="fas fa-angle-right"></i> ยืมครุภัณฑ์</a></li>
                                        <li><a href="{{URL('office/durable/reports/lists')}}/?t=distribution&pr=0"><i class="fas fa-angle-right"></i> จำหน่ายครุภัณฑ์</a></li>
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
                            </ul>
                        </li>
                    </ul>
                </li> --}}

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
                
                <?php //f($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 10 || $nav_role_id == 17):?>
                <?php
                    $RoleBuy = \App\Models\ModulePermission::where('module_functions_id', '45')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    if(count($RoleBuy) > 0):
                ?> 
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-calculator" style="font-size: 18px !important;"></i>
                        <span> จัดซื้อ - จัดจ้าง </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php
                            $RoleBuy1 = \App\Models\ModulePermission::where('module_functions_id', '46')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBuy1) > 0):
                        ?>
                        <li><a href="{{URL('office/purchase/lists')}}"><i class="fas fa-angle-right"></i> จัดซื้อ - จัดจ้าง</a></li>
                        <?php endif; ?>


                        <?php
                            $RoleBuy2 = \App\Models\ModulePermission::where('module_functions_id', '47')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBuy2) > 0):
                        ?>
                        <li><a href="{{URL('office/purchase/report')}}"><i class="fas fa-angle-right"></i> รายงาน การจัดซื้อ - จัดจ้าง</a></li>
                        <?php endif; ?>


                        <?php
                            $RoleBuy3 = \App\Models\ModulePermission::where('module_functions_id', '48')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleBuy3) > 0):
                        ?>
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
                        <?php endif; ?>

                    </ul>
                </li>
                <?php endif; ?>    
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


                <!-- <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-balance-scale" style="font-size: 18px !important;"></i>
                        <span> ประเมินผลความคุ้มค่า </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{URL('office/evaluations/indicator')}}"><i class="fas fa-angle-right"></i> ตัวชี้วัด</a></li>

                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">ตั้งค่า 
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="{{URL('office/evaluations/settings/unit')}}"><i class="fas fa-angle-right"></i> หน่วยนับ</a></li>
                                <li><a href="{{URL('office/evaluations/settings/category')}}"><i class="fas fa-angle-right"></i> หมวดหมู่</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>  -->
                <?php //if($nav_role_id == 1 || $nav_role_id == 2 || $nav_role_id == 14 || $nav_role_id == 15):?>  
                

                <li class="menu-title menu-title-label"># งานบริการ</li>
                <li>
                    <a href="{{ url('office/services/reserve-meeting') }}">
                        <i class="fas fa-calendar-alt" style="font-size: 18px !important;"></i>
                        <span> จองห้องประชุม </span>
                    </a>
            
                </li>
                
                <li>
                    <a href="{{ url('office/services/reserve-car') }}">
                        <i class="fas fa-calendar-alt" style="font-size: 18px !important;"></i>
                        <span> จองรถยนต์ส่วนกลาง </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('office/hr/course/all') }}">
                        <i class="fas fa-calendar-alt" style="font-size: 18px !important;"></i>
                        <span>การฝึกอบรม</span>
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


                

                <?php //if($nav_role_id == 1):?>   
                    
                <?php
                        $RoleSetting = \App\Models\ModulePermission::where('main_functions_id', '3')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                        if(count($RoleSetting) > 0):
                ?>
                    <li class="menu-title menu-title-label"># ตั้งค่าระบบ</li>

                    <?php
                            $RoleSetting1 = \App\Models\ModulePermission::where('module_functions_id', '26')->where('roles_id', $nav_role_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            if(count($RoleSetting1) > 0):
                    ?>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-settings" style="font-size: 18px !important;"></i>
                            <span> ตั้งค่า </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{URL('office/settings/budget-year')}}"><i class="fas fa-angle-right"></i> ปีงบประมาณ</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=department&pr=0"><i class="fas fa-angle-right"></i> สำนักงาน</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=group_work&pr=0"><i class="fas fa-angle-right"></i> กลุ่มงาน</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=position&pr=0"><i class="fas fa-angle-right"></i> ตำแหน่งงาน</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=institution&pr=0"><i class="fas fa-angle-right"></i> หน่วยงาน</a></li>
                            <li><a href="{{URL('office/settings/roles/lists')}}"><i class="fas fa-angle-right"></i> กลุ่มผู้ใช้งานระบบ</a></li>
                            <!-- <li><a href="{{URL('office/settings/exports/lists')}}"><i class="fas fa-angle-right"></i> นำออก ฐานข้อมูล</a></li> -->

                            <!-- Meeting Book -->
                            <!-- <li><a href="{{ URL('office/settings/cars') }}"><i class="fas fa-angle-right"></i> รถยนต์ส่วนกลาง</a></li>  -->
                            <li><a href="{{ URL('office/settings/meeting_room') }}"><i class="fas fa-angle-right"></i> ห้องประชุม</a></li>
                            <li><a href="{{ URL('office/settings/meeting_type') }}"><i class="fas fa-angle-right"></i> ประเภทการประชุม</a></li>
                            <li><a href="{{ URL('office/settings/meeting_item') }}"><i class="fas fa-angle-right"></i> อุปกรณ์ห้องประชุม</a></li>
                            <li><a href="{{URL('office/durable/data/import/lists')}}/?t=oil&pr=0"><i class="fas fa-angle-right"></i> นำเข้าข้อมูล</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=groupoil&pr=0"><i class="fas fa-angle-right"></i> กลุ่มน้ำมันราคา</a></li>
                            <li><a href="{{URL('office/management/reports')}}/?t=332&pr=0"><i class="fas fa-angle-right"></i> ปิโตรเลียม OFFO Crude</a></li>
                            <li><a href="{{URL('office/management/reports')}}/?t=334&pr=0"><i class="fas fa-angle-right"></i> ปริมาณการใช้น้ำมันเชื้อเพลิง</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=leave&pr=0"><i class="fas fa-angle-right"></i> ประเภทการลา</a></li>
                            <li><a href="{{ URL('office/settings/data/lists') }}/?t=car_tpye&pr=0""><i class="fas fa-angle-right"></i> ประเภทการจองรถ</a></li>
                            <li><a href="{{ URL('office/settings/data/lists') }}/?t=car_num&pr=0""><i class="fas fa-angle-right"></i> ทะเบียนรถ</a></li>
                            <!--
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=token&pr=0"><i class="fas fa-angle-right"></i> Token line Notify</a></li>
                            <li><a href="{{URL('office/settings/data/lists')}}/?t=institution&pr=0"><i class="fas fa-angle-right"></i> ข้อความ Line Notify</a></li>
                            -->
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fas fa-users-cog" style="font-size: 18px !important;"></i>
                            <span> สิทธิ์การใช้งาน </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{{URL('office/settings/users/lists')}}"><i class="fas fa-angle-right"></i> กลุ่มผู้ใช้งานระบบ</a></li>
                        </ul>
                    </li>
                    <?php endif;?>
                <?php endif;?>

            </ul>
            <p class="pt-4"></p>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
