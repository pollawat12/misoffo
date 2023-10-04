@extends('default.template')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > ค่าใช้จ่ายโครงการ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ค่าใช้จ่ายโครงการ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียดข้อมูล ค่าใช้จ่ายโครงการ</i> </h4>

                    <form action="" method="POST" name="frm-save" id="frm-save">
                        
                        @foreach ($items as $item)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">แผนงาน/โครงการ</h4>
                                    <label for="projects_id">{{$item['project_name']}}</label>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">วันที่รายงาน</h4>
                                    <label for="date_report">{{getDateShow($item['date_report'])}}</label>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">ปีงบประมาณ</h4>
                                    <label for="year_budgets_id ">ปีงบประมาณ {{$item['yearbudgets_year']}} ระหว่าง เดือน {{getDateMonthTH($item['yearbudgets_start'])}} - {{getDateMonthTH($item['yearbudgets_end'])}}</label>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">จำนวน</h4>
                                    <label for="amount"> {{number_format($item['amount'],2,'.',',')}} บาท</label>
                                   
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">ประเภทค่าใช้จ่าย</h4>
                                    <label for="cost_type"> @if ($item['cost_type'] == 1) จำนวนเงินโอน @else เบิกจ่ายส่วนกลาง @endif</label>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">สถานะอนุมัติ</h4>
                                    <label for="status_approved"> @if ($item['status_approved'] == 0) ยังไม่ยันยืน @else ยันยืน @endif</label>
                                   
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:18px !important;">แนบไฟล์เอกสาร</h4>
                                    <label for="file_name"> </label>
                                    
                                </div>
                            </div>
                        </div> --}}
                        @endforeach

                        <a href="{{URL('office/budget/confirm/show')}}/{{$projectsId}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> ยกเลิก</i></a>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/confirm/show')}}/{{$projectsId}}"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

@endsection
