@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<style>
    .form-control {
        height: 39px !important;
        font-size: 15px !important;
    }
</style>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">งานบริหาร</a>
                            </li>
                            <li class="breadcrumb-item active">เพิ่มจองรถยนต์ส่วนกลาง</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่ม จองรถยนต์ส่วนกลาง</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="media-body">
                        <h6 class="header-title mb-1 font-size-16 mt-3">
                            เพิ่ม รถยนต์ส่วนกลาง</h6>
                        <hr class="hr-form-all">

                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">รุ่นรถ
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ยี่ห้อรถ
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4"
                                        class="col-form-label label-step">หมายเลขทะเบียน
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ชื่อผู้ขับรถ
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">วันที่ซื้อ
                                        <span class="text-danger">*</span></label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                                id="datepicker-autoclose">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i
                                                        class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ประเภของรถ
                                        <span class="text-danger">*</span></label>
                                    <select name="" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        <option value="">รถยนต์</option>
                                        <option value="">รถกระบะ</option>
                                        <option value="">รถตู้</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ประเภทสัญญา
                                        <span class="text-danger">*</span></label>
                                    <select name="" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        <option value="">เช่าซื้อ</option>
                                        <option value="">ซื้อขาด</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">แนบไฟล์
                                        <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="file" class="filestyle" id="filestyleicon">
                                    </div>
                                </div>
                            </div>

                            <!-- กรณีเช่าซื้อ -->
                            <!-- <div style="display:none;"> -->
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">ชื่อบริษัท
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">เบอร์โทรติดต่อ
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputEmail4"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">วันเริ่มทำสัญญา
                                                <span class="text-danger">*</span></label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEmail4"
                                                class="col-form-label label-step">วันสิ้นสุดสัญญา
                                                <span class="text-danger">*</span></label>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="inputEmail4" class="col-form-label label-step">ที่อยู่บริษัท
                                        <span class="text-danger">*</span></label>
                                    <textarea name="" id="" rows="5" class="form-control"></textarea>
                                </div>
                            </div>



                            <!-- </div> -->

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light mr-1">
                                        บันทึก
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                        ยกเลิก
                                    </button>
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

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>

</script>
@endsection
