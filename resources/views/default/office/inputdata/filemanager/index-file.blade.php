@extends('default.template')

@section('css')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin UI</a></li>
                            <li class="breadcrumb-item active">File Manager</li>
                        </ol>
                    </div>
                    <h4 class="page-title">File Manager</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <button type="button" onclick="window.location.href='{{url('office/input-data/file-manager/form/upload')}}'"
                        class="btn btn-sm btn-primary btn-rounded width-md waves-effect waves-light float-right">เพิ่มไฟล์</button>
                    <h4 class="header-title mb-0 pb-2">รายการไฟล์อัพโหลด</h4>

                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/pdf.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/bmp.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/psd.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/avi.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/cad.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/txt.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/eps.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/dll.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/sql.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/zip.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/ps.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-sm-6">
                            <div class="file-man-box rounded mt-3">
                                <a href="" class="file-close"><i class="mdi mdi-close-circle"></i></a>
                                <div class="file-img-box">
                                    <img src="{{url('assets/default')}}/images/file_icons/png.svg" alt="icon">
                                </div>
                                <a href="#" class="file-download"><i class="mdi mdi-download"></i> </a>
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                    <p class="mb-0"><small>568.8 kb</small></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->
@endsection

@section('js')

@endsection
