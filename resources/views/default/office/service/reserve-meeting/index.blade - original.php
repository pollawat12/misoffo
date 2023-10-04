@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">งานบริการ</a></li>
                            <li class="breadcrumb-item active">จองห้องประชุม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แสดง จองห้องประชุม</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: จองห้องประชุม</h4>
                            <p class="sub-header"></p>
                        </div>

                        <div class="col-6 text-right">
                            <a href="{{URL('office/services/reserve-meeting/add')}}" class="btn btn-sm btn-primary width-md waves-light"><i class="mdi mdi-database-plus"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    
                    
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive "
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th>ลำดับ</th>
                                <th>หัวข้อการประชุม</th>
                                <th>ห้องประชุม</th>
                                <th>วันที่</th>
                                <th>เวลา</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                                {{-- <th>การอนุมัติ</th> --}}
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($meetings))
                            @foreach ($meetings as $item)
                            <?php $no++;?>
                            <?php 
                            $start_date = getDateTimeTH($item->date_start, false, true);
                            $end_date = getDateTimeTH($item->date_end, false, true);
                            ?>
                            <tr>
                                <td class="align-middle">{{ $no }}</td>
                                <td class="align-middle">{{ $item->title }}</td>
                                <td class="align-middle">{{ $item->meeting_room}}</td>
                                <td class="align-middle">{{$start_date}}</td>
                                <td class="align-middle">{{ $item->time_start }} - {{ $item->time_end }} น.</td>
                                <td class="align-middle">
                                    {!! getBadgeDataStatus('is_deleted', $item->is_deleted) !!}
                                </td>
                                <td class="align-middle">
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <option value="edit" data-id="{{ $item->id }}">แก้ไข</option>
                                        <option value="delete" data-id="{{ $item->id }}">ลบ</option>
                                    </select>
                                </td>
                                {{-- <td class="align-middle">
                                        <button type="button" class="btn btn-success waves-effect width-md waves-light">
                                            <i class="mdi mdi-checkbox-marked-circle"></i>อนุมัติ
                                        </button>

                                         <button type="button" class="btn btn-danger waves-effect width-md waves-light mt-1">
                                        <i class="mdi mdi-close-box"></i>ไม่อนุมัติ
                                        </button>
                                </td> --}}
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
               
                    </table>
          
                </div>
            </div>
        </div> <!-- end row -->

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

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/vadateli.js')}}"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "autoWidth": false,
            "columnDefs": [
                { "width": "8%", "targets": 0 },
                { "width": "30%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "15%", "targets": 3 },
                { "width": "15%", "targets": 4 },
                { "width": "12%", "targets": 5 },
                { "width": "18%", "targets": 6 }
            ],
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
    });

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var __action = $(this).find(':selected').attr('value');
        var __url = "{{ url('office/services/reserve-meeting') }}";


        if (__action == "edit") {
            window.location = __url+ '/' + __action + '/' + id;
         
        } else {
            setTimeout(() => {
                    // window.location.reload();
                    window.location.href = "{{ url('office/services/reserve-meeting') }}";
                }, 2300);
            
            var __url = __url+"/delete";
            ajaxConfirmDel(id, __url, true);
        }
    });
</script>
@endsection
