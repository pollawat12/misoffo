<?php 
// $navNotiMessages = \App\Libraries\MyLogs::getNavNotifications();
$navNotiMessages = '';

?>

<?php 
// $authInfo = \Auth::user();
$roles_id  = 0;
?>

<div class="navbar-custom dgr-bg-color-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

    

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                
                <span class="pro-user-name ml-1">
                    Username<i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">ยินดีต้อนรับ !</h6>
                </div>

                <!-- item
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>โปรไฟล์</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>ข้อมูลสิทธิ์การลา</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>กล่องข้อความ</span>
                </a>
                -->
                <!-- item-->
                <a href="{{url('office/my/changepass')}}" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>เปลี่ยนรหัสผ่าน</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ URL('auth/logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>ออกจากระบบ</span>
                </a>

            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.html" class="logo text-center">
            <span class="logo-lg">
                <img src="{{url('assets')}}/img/logo-nav-bar.jpg" alt="" style="width: 100%; height: auto;">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="{{url('assets')}}/default/images/logo-sm.png" alt="" height="45">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li class="d-none d-sm-block">
            
        </li>

    </ul>
</div>
