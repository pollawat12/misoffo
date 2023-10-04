<div class="row">
    <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#works-detail" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'works-detail' || $t == 'leave' || $t == 'money' || $t == 'courses' || $t == 'access' || $t == 'general' || $t == 'addresses' || $t == 'family' || $t == 'educations' || $t == 'experience') active @endif">
                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                        <span class="d-none d-sm-block">ข้อมูลการทำงาน</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#works-contract" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'works-contract') active @endif">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                        <span class="d-none d-sm-block">ข้อมูลการต่อสัญญา</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#update-transfer" data-toggle="tab" aria-expanded="false" class="nav-link @if($t == 'transfer') active @endif">
                        <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                        <span class="d-none d-sm-block">ประวัติการช่วยปฏิบัติราชการ </span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if($t == 'works-detail' || $t == 'leave' || $t == 'money' || $t == 'courses' || $t == 'access' || $t == 'general' || $t == 'addresses' || $t == 'family' || $t == 'educations' || $t == 'experience') show active @endif" id="works-detail">
                    <p>@include('default.office.hr.employee.include.table-works-detail')</p>
                </div>

                <div class="tab-pane @if($t == 'works-contract') show active @endif" id="works-contract">
                    <p>@include('default.office.hr.employee.include.table-works-contract')</p>
                </div>

                
                <div class="tab-pane @if($t == 'transfer') show active @endif" id="update-transfer">
                    <p>@include('default.office.hr.employee.include.table-transfer')</p>
                </div>
            </div>
    </div> <!-- end col -->

</div>



