@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">ข้อมูลผังเจ้าหน้าที่</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง ข้อมูลผังเจ้าหน้าที่</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: ข้อมูลผังเจ้าหน้าที่</h4>
                            <p class="sub-header"></p>
                        </div>
                    </div>
                    

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 5%"># ลำดับ</th>
                                <th style="width: 20%">สำนักงาน</th>
                                <th style="width: 20%">ผู้อำนวยการ</th>
                                <th style="width: 20%">เจ้าหน้าที่</th>
                                <th style="width: 10%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr style="background: #f2f2f2; ">
                                <td class="align-middle">{{$no}}  </td>
                                <td class="align-middle">{{$item['name']}} 
                                        <!-- <a href="{{URL('office/hr/diagram/sub/')}}/{{$item['id']}}"><i class="mdi mdi-pencil-plus-outline">กลุ่มงาน</i> </a>   -->

                                        
                                </td>
                                <td class="align-middle">
                                    <?php 
                                        $Diagrams = \App\Models\UserDiagram::where('department_id', $item['id'])->where('level_id', '1')->where('is_deleted', '0')->where('is_active','1')->get();
                                        $DiagramCount = $Diagrams->count();
                                        if($DiagramCount > 0){
                                            foreach ($Diagrams as $Diagram);

                                            $Users = \App\Models\UserInformation::where('users_id',$Diagram['user_id'])->get();
                                            foreach ($Users as $User);

                                            echo $User['firstname'].' '. $User['lastname'];



                                            ?>
                                                
                                                <a href="{{url('office/hr/diagram/deleted')}}/{{$Diagram['id']}}">ลบ</a> <br/>
                                            <?php
                                        } 
                                    
                                    ?>
                                </td>
                                <td class="align-middle">

                                    <?php 
                                        $DiagramDs = \App\Models\UserDiagram::where('department_id', $item['id'])->where('level_id', '2')->where('is_deleted', '0')->where('is_active','1')->get();
                                        $DiagramDCount = $DiagramDs->count();
                                        if($DiagramDCount > 0){
                                            foreach ($DiagramDs as $DiagramD){

                                            $UserDs = \App\Models\UserInformation::where('users_id',$DiagramD['user_id'])->get();
                                            foreach ($UserDs as $UserD);

                                            echo $UserD['firstname'].' '. $UserD['lastname'];

                                    ?>
                                            <a href="{{url('office/hr/diagram/deleted')}}/{{$DiagramD['id']}}">ลบ</a> <br/>
                                    <?php

                                            }
                                        } 
                                    
                                    ?>
                                </td>
                                <td class="align-middle" style="width: 10%">
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <option value="boss" data-id="{{$item['id']}}">หัวหน้าฝ่าย</option>
                                        <option value="add" data-id="{{$item['id']}}">เจ้าหน้าที่ฝ่าย</option>
                                    </select>
                                </td>
                            </tr>
                                <?php 
                                    $groups = \App\Models\DataSetting::where('group_type', "group_work")->where('data_value', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                    $groupsCountN = $groups->count();
                                    if($groupsCountN > 0){
                                ?>
                                <?php $nos = 0;?>
                                @if (!empty($groups))
                                @foreach ($groups as $group)
                                <?php $nos++;?>
                                <tr>
                                    <td class="align-middle"> <b style="color:#fff;">{{$no}}.{{$nos}}</b>  </td>
                                    <td class="align-middle">{{$no}}.{{$nos}} {{$group['name']}} 
                                            <!-- <a href="{{URL('office/hr/diagram/sub/')}}/{{$item['id']}}"><i class="mdi mdi-pencil-plus-outline">กลุ่มงาน</i> </a>   -->
                                            
                                    </td>
                                    <td class="align-middle">
                                        <?php 
                                            $DiagramsN = \App\Models\UserDiagram::where('department_id', $group['id'])->where('level_id', '1')->where('is_deleted', '0')->where('is_active','1')->get();
                                            $DiagramCountN = $DiagramsN->count();
                                            if($DiagramCountN > 0){
                                                foreach ($DiagramsN as $DiagramN);

                                                $UsersN = \App\Models\UserInformation::where('users_id',$DiagramN['user_id'])->get();
                                                foreach ($UsersN as $UserN);

                                                echo $UserN['firstname'].' '. $UserN['lastname'];
                                                ?>
                                                
                                                <a href="{{url('office/hr/diagram/deleted')}}/{{$DiagramN['id']}}">ลบ</a> <br/>
                                            <?php
                                            } 
                                        
                                        ?>
                                    </td>
                                    <td class="align-middle">

                                        <?php 
                                            $DiagramDsN = \App\Models\UserDiagram::where('department_id', $group['id'])->where('level_id', '2')->where('is_deleted', '0')->where('is_active','1')->get();
                                            $DiagramDCountN = $DiagramDsN->count();
                                            if($DiagramDCountN > 0){
                                                foreach ($DiagramDsN as $DiagramDN){

                                                $UserDsN = \App\Models\UserInformation::where('users_id',$DiagramDN['user_id'])->get();
                                                foreach ($UserDsN as $UserDN);

                                                echo $UserDN['firstname'].' '. $UserDN['lastname'];

                                        ?>
                                                <a href="{{url('office/hr/diagram/deleted')}}/{{$DiagramDN['id']}}">ลบ</a> <br/>
                                        <?php

                                                }
                                            } 
                                        
                                        ?>
                                    </td>
                                    <td class="align-middle" style="width: 10%">
                                        <select name="input_action" class="form-control" >
                                            <option value="">เลือก</option>
                                            <option value="boss" data-id="{{$group['id']}}">หัวหน้าฝ่าย</option>
                                            <option value="add" data-id="{{$group['id']}}">เจ้าหน้าที่ฝ่าย</option>
                                        </select>
                                    </td>
                                </tr>            
                                @endforeach
                                @endif
                                <?php } ?>
                            @endforeach
                            @endif
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/diagram/all')}}"></div>

        <div id="div-data-url" data-url="{{url('office/hr/diagram')}}"></div>

    </div>
</div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/diagram/save')}}" method="POST" name="frm-save" id="frm-save" enctype="multipart/form-data">
        <input type="hidden" name="input[action]" id="input-action" >
        <input type="hidden" name="input[edit_id]" id="input-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูล เจ้าหน้าที่</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_id">เจ้าหน้าที่ </label>
                            <select name="input[user_id]" id="input-user_id" class="form-control" style="height: 45px;" data-toggle="select2">
                                <option value="">--เลือก--</option>
                                @if (count($employees) > 0)
                                @foreach($employees as $val1)
                                <option value="{{$val1['id']}}" >{{$val1['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">อีเมล์ </label>
                            <input type="text" class="form-control" name="input[email]" id="input-email" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel">เบอร์โทรศัพท์ </label>
                            <input type="text" class="form-control" name="input[tel]" id="input-tel" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobile">เบอร์มือถือ </label>
                            <input type="text" class="form-control" name="input[mobile]" id="input-mobile" placeholder="" >
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[level_id]" id="input-level_id">
                
                <input type="hidden" name="input[department_id]" id="input-department_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_action" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->
@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="https://cdn.tiny.cloud/1/ltwvtej6azwayx0ecmbi942hdese05ryj1m3ic9dfsgfra6d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script src="{{url('assets/default')}}/libs/select2/select2.min.js"></script>

<script src="{{url('assets/default')}}/js/pages/form-advanced.init.js"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "oLanguage": {
                "sZeroRecords": "-ไม่พบรายการข้อมูล-",
                "sLengthMenu": "แสดง  _MENU_  รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
                "sSearch": "ค้นหา"
            }
        });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });


        // var a = $("#datatable-buttons").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // });
        // $("#key-table").DataTable({
        //     keys: !0
        // }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
        //     select: {
        //         style: "multi"
        //     }
        // }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });

    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });
</script>

<script>
    
    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'boss'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-email").val(res.info.email);
                $("#frm-save #input-tel").val(res.info.tel);
                $("#frm-save #input-mobile").val(res.info.mobile);
                $("#frm-save #input-level_id").val(res.info.level_id);
                $("#frm-save #input-department_id").val(res.info.department_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else if(values == 'add'){

            var _url = $("#div-data-url").attr("data-url")+"/get/info/?id="+id+"&type="+values;

            $('#con-close-modal').modal('show');

            $.get(_url, function(res){
                $("#frm-save #input-user_id").val(res.info.user_id);
                $("#frm-save #input-email").val(res.info.email);
                $("#frm-save #input-tel").val(res.info.tel);
                $("#frm-save #input-mobile").val(res.info.mobile);
                $("#frm-save #input-level_id").val(res.info.level_id);
                $("#frm-save #input-department_id").val(res.info.department_id);
                $("#frm-save #input-action").val(res.info.action);
                $("#frm-save #input-edit_id").val(res.info.id);
            }, "json");

        }else{

        }
    });

    $('#button_action').click(function(){ 

        function callBackFuncInsert(data) {
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
                'input[user_id]': {
                    required: true
                }
            },
            messages: {
                'input[user_id]': {
                    required: "กรุณาเลือกเจ้าหน้า"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFuncInsert);
                return false;
            }
        });
    });
</script>
@endsection
