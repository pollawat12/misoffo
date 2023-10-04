@extends('default.template')

@section('css')
<!-- Plugins css -->
<link href="{{url('assets/default')}}/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวมข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">สรุปภาพรวม :: งบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">เพิ่มรายการข้อมูลรายงาน</h4>
                        <p class="sub-header"></p>


                        <form action="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ปีงบประมาณ</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        <option value="" selected>ปี 2563</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">วันที่อัพเดท</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" value="02/08/2563">
                                </div>
                            </div>
                            
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">หมวดเรื่องรายงาน</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">เลือก</option>
                                        <option value="" selected>รายงานฐานะการเงินของกองทุนพัฒนาน้ําบาดาล</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">ไฟล์แนบ</label>
                                    <input type="file" class="form-control" id="fileupload" placeholder="">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">รายละเอียด</label>

                                    <div id="snow-editor" style="height: 300px;"></div>
                                    <!-- end Snow-editor-->
                                </div>
                            </div>
                        </div>
                        


                        <p></p>
                        <button class="btn btn-success">บันทึก</button>
                        <button class="btn btn-secondary">ย้อนกลับ</button>


                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->  

    </div>
</div>
@endsection


@section('js')
<!-- Plugins js -->
<script src="{{url('assets/default')}}/libs/katex/katex.min.js"></script>
<script src="{{url('assets/default')}}/libs/quill/quill.min.js"></script>

<!-- Init js-->
<script src="{{url('assets/default')}}/js/pages/form-quilljs.init.js"></script>
@endsection
