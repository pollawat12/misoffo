@extends('default.layouts.appform')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ใบสมัครออนไลน์</a>
                            </li>
                            <li class="breadcrumb-item active">ประกาศรับสมัครงาน
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">ประกาศรับสมัครงาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">

                    <div class="row mb-3">
                        <div class="col-10">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus"
                                    style="font-size: 16px !important; "> ประกาศรับสมัครงาน</i>
                            </h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-2 text-right">
                            
                            
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%" class="text-center align-middle">ลำดับ</th>
                                <th width="15%" class="align-middle">เรื่อง</th>
                                <th class="text-center align-middle">วันที่เริ่มประกาศ</th>
                                <th class="text-center align-middle">วันที่สิ้นสุดประกาศ</th>
                                <th class="text-center align-middle">ไฟล์แนบ</th>
                                <th class="text-center align-middle">ดูรายละเอียด</th>
                            </tr>
                        </thead>


                        <tbody>

                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle text-center">{{$no}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle text-center">{{getDateShow($item['day_start'])}}</td>
                                <td class="align-middle text-center">{{getDateShow($item['day_end'])}}</td>
                                <td class="align-middle text-center"><a href="{{ URL($item['file_work']) }}">ไฟล์เอกสาร</a></td>
                                <td class="align-middle text-center">
                                    <a href="{{URL('appform/jobs')}}/{{$item['id']}}">
                                        <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="tooltip" data-placement="top" title data-original-title="preview">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div id="url-redirect-back" data-url="{{url('office/hr/announce')}}"></div>

    </div>
</div>
@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

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

    $(document).on('change', '.select-action', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'report'){

            window.open('{{URL('office/hr/employees/print')}}' + '/' + id + '/?t=profile' , '_blank');

        }else if(values == 'reportMoney'){

            window.open('{{URL('office/hr/employees/print')}}' + '/' + id + '/?t=money' , '_blank');

        }else if(values == 'edit'){

            window.location='{{URL('office/hr/employees/add')}}' + '/' + id + '/?t=general';

        }else if(values == 'deleted'){

            window.location='{{URL('office/hr/employees')}}'+ '/' + values + '/' + id + '/0/employees/';

        }else{

        }  
    
    });

</script>
@endsection
