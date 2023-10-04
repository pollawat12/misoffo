@extends('default.template')

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
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียดโครงการ</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            
                            
                        </div>
                    </div>
                    @foreach ($project as $projects)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">แผนงาน/โครงการ</h4>
                                <label for="exampleInputEmail1"> {{$projects['project_name']}}</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">พื้นที่ดำเนินงาน</h4>
                                <label for="exampleInputEmail1"> {{$projects['area_process']}}</label>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">หน่วยงานที่รับผิดชอบ</h4>
                                <label for="exampleInputEmail1"> {{$projects['owner_name']}}</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">วันที่เริ่มต้น โครงการ</h4>
                                <label for="exampleInputPassword1"> {{getDateShow($projects['date_start'])}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">วันที่สิ้นสุด โครงการ</h4>
                                <label for="exampleInputPassword1"> {{getDateShow($projects['date_end'])}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                <label for="exampleInputEmail1"> {{$projects['in_year']}}</label>
                                
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">งบประมาณ (ได้รับการอนุมัติจริง)</h4>
                                <label for="exampleInputEmail1"> {{number_format($projects['budget_amount'],2,'.',',')}}</label>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:18px !important;">งบประมาณ (ที่ขออนุมัติ)</h4>
                                <label for="exampleInputEmail1"> {{number_format($projects['budget_amount'],2,'.',',')}}</label>
                                
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ค่าใช้จ่ายโครงการ</i></h4>
                            <p class="sub-header"></p>
                        </div>
                        <div class="col-6 text-right">
                            
                            <a href="{{url('office/budget/confirm/add')}}/{{$id}}/?t=2" class="btn btn-secondary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%">ลำดับ</th>
                                <th width="8%">วันที่รายงาน</th>
                                <th width="12%">จำนวน</th>
                                <th width="12%">ประเภทค่าใช้จ่าย</th>
                                <th style="width: 8%">จัดการ</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{getDateShow($item['date_report'])}}</td>
                                <td class="align-middle">{{number_format($item['amount'],2,'.',',')}}</td>
                                <td class="align-middle">@if ($item['cost_type'] == 1) จำนวนเงินโอน @else เบิกจ่ายส่วนกลาง @endif</td>
                                <td>
                                    <select name="input_action" class="form-control" >
                                        <option value="">เลือก</option>
                                        <option value="view" data-id="{{$item['id']}}">ดูรายละเอียด</option>
                                        <option value="edit" data-id="{{$item['id']}}">แก้ไข</option>
                                        <option value="delete" data-id="{{$item['id']}}">ลบ</option>
                                    </select>
                                </td>
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

    $('select').change(function(){
        var id = $(this).find(':selected').attr('data-id');
        var values = $(this).find(':selected').attr('value');

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/budget/confirm')}}'+ '/' + values + '/' + id + '/{{$id}}/?t=2';
        }

        
    });
</script>
@endsection

@if (!empty($items))
@foreach ($items as $itemModal)
<div id="con-close-modal-objective{{$itemModal['id']}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">รายละเอียดค่าใช้จ่ายโครงการ</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">แผนงาน/โครงการ</h4>
                            <label for="projects_id">{{$itemModal['project_name']}}</label>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">วันที่รายงาน</h4>
                            <label for="date_report">{{getDateShow($itemModal['date_report'])}}</label>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">ปีงบประมาณ</h4>
                            <label for="year_budgets_id ">ปีงบประมาณ {{$itemModal['yearbudgets_year']}} ระหว่าง เดือน {{getDateMonthTH($itemModal['yearbudgets_start'])}} - {{getDateMonthTH($itemModal['yearbudgets_end'])}}</label>
                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">ครั้งที่อนุมัติ</h4>
                            <label for="year_budgets_id ">{{$itemModal['approved_time']}}</label>
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">หน่วยงานที่รับผิดชอบ</h4>
                            <label for="date_report">{{$itemModal['owner_name']}}</label>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">ลักษณะโครงการ</h4>
                            <label for="date_report">{{$itemModal['description']}}</label>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">ระยะเวลาโครงการ</h4>
                            <label for="year_budgets_id ">{{$itemModal['duration']}}</label>
                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">จำนวน</h4>
                            <label for="amount"> {{number_format($itemModal['amount'],2,'.',',')}} บาท</label>
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">ประเภทค่าใช้จ่าย</h4>
                            <label for="cost_type"> @if ($itemModal['cost_type'] == 1) เงินโอนไปส่วนภูมิภาค @elseif ($itemModal['cost_type'] == 2) เบิกจ่ายส่วนกลาง @else คืนเข้า กนพ.  @endif</label>
                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">สถานะอนุมัติ</h4>
                            <label for="status_approved"> @if ($itemModal['status_approved'] == 0) อยู่ระหว่างดำเนินการ  @elseif ($itemModal['status_approved'] == 1) รออนุมัติ @else อนุมัติ @endif</label>
                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:18px !important;">หมายเหตุ</h4>
                            <label for="comment">{{$itemModal['comment']}}</label>
                           
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
@endforeach
@endif
