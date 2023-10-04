@extends('default.template')

@section('css')
<!-- Plugins css -->
<link href="{{url('assets/default')}}/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
@endsection



@section('content')


<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">สรุปภาพรวม</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">นำเข้ารายการข้อมูล</a></li>
                        <li class="breadcrumb-item active">จัดการไฟล์รูปภาพ</li>
                    </ol>
                </div>
                <h4 class="page-title">จัดการไฟล์รูปภาพ</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">แบบฟอร์มจัดการไฟล์เอกสาร</h4>
                <p class="sub-header">
                    
                </p>

                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <div class="dz-message needsclick">
                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                        <h4 class="mt-3">Drop files here or click to upload.</h4>
                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                            <strong>not</strong> actually uploaded.)</span>
                    </div>
                </form>
                <div class="clearfix text-right mt-3">
                    <button type="button" class="btn btn-success"> <i class="mdi mdi-send mr-1"></i> อัพโหลด</button>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->

</div> <!-- end content -->
@endsection


@section('js')
<!-- Plugins js -->
<script src="{{url('assets/default')}}/libs/dropzone/dropzone.min.js"></script>
@endsection
