@extends('default.template')

@section('css')
{{-- <link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="{{ url('assets/js/datepicker-th/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{url('assets/public/js/plugins/sweetalert/sweetalert.css')}}">

<link href="{{url('assets/default')}}/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ตั้งค่า</a></li>
                            <li class="breadcrumb-item active">กลุ่มผู้ใช้งานระบบ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">กำหนดสิทธิการใช้งาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> กำหนดสิทธิการใช้งาน</i> </h4>

                    <form action="{{url('office/settings/roles/update/permis/save')}}" method="POST" name="frm-save" id="frm-save">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{{$id}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">กลุ่มผู้ใช้งาน <code>*</code></label>
                                    <input type="text" name="info[name]" class="form-control" id="info-budget-year" placeholder="" value="{{ $roleInfo->name }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">นามแฝง (Name Alias) <code>*</code></label>
                                    <input type="text" name="info[name_alias]" class="form-control" id="info-budget-year" placeholder="" value="{{ $roleInfo->name_alias }}">
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>ฟังก์ชั่นการใช้งาน</th>
                                            <th width="15%" class="text-center">เลือก</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 0;?>
                                        @if(count($menus) > 0)
                                        @foreach ($menus as $menu)
                                        <?php $no++;?>
                                            <tr class="table-active">
                                                <td>{{ $no }} &nbsp; {{ $menu['name'] }}</td>
                                                <td class="text-center">
                                                    <div class="switchery-demo">
                                                        <input type="checkbox" value="{{ $menu['id'] }}" data-plugin="switchery"  name="input_main_checked[]" data-color="#039cfd"/>
                                                    </div>
                                                </td>
                                            </tr>
                                                <?php $no1 = 0;?>
                                                @if(count($menu['sub_menus']) > 0)
                                                @foreach ($menu['sub_menus'] as $sub_menu)
                                                <?php $no1++;?>
                                                <tr>
                                                    <td>
                                                        <span class="ml-5">{{ $no }}.{{ $no1 }} &nbsp; {{ $sub_menu['name'] }}</span></td>
                                                    <td class="text-center">
                                                        <div class="switchery-demo">
                                                            <input type="checkbox" value="{{ $sub_menu['id'] }}" data-plugin="switchery" name="input_checked[]" data-color="#039cfd"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                    <?php $no2 = 0;?>
                                                    @if(count($sub_menu['sub_menus']) > 0)
                                                    @foreach ($sub_menu['sub_menus'] as $sub_menu2)
                                                    <?php $no2++;?>
                                                    <tr>
                                                        <td>
                                                            <span class="ml-5 pl-5">{{ $no }}.{{ $no1 }}.{{ $no2 }} ) &nbsp; {{ $sub_menu2['name'] }}</span></td>
                                                        <td class="text-center">
                                                            <div class="switchery-demo">
                                                                <input type="checkbox" value="{{ $sub_menu2['id'] }}" data-plugin="switchery" name="input_checked[]" data-color="#039cfd"/>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                @endforeach
                                                @endif
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-database-plus"> บันทึก</i>
                            </button>
                            <a href="{{URL('office/settings/budget-year')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                                "> ยกเลิก</i></a>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
</div>
@endsection

@section('js')
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> --}}
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
{{-- <script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker-thai.js"></script> --}}
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>


<script src="{{url('assets/public/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/public/js/plugins/validate/validate.js')}}"></script>

<script src="{{url('assets/default')}}/libs/switchery/switchery.min.js"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        // language: 'th',
        language:'th-th',
        thaiyear: true,
        autoclose: !0,
        todayHighlight: !0
    });

    $(function () {
        $('[data-plugin="switchery"]').each(function (a, n) {
            new Switchery($(this)[0], $(this).data())
        });
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.reload();
                }, 2300);
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'info[name]': {
                    required: true
                },
                'info[name_alias]': {
                    required: true
                }
            },
            messages: {
                'info[name]': {  
                    required: "กรุณากรอก กลุ่มผู้ใช้งาน"
                },
                'info[name_alias]': {
                    required: "กรุณากรอก นามแฝง (Name Alias)"
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
            }
        });
    });
</script>
@endsection
