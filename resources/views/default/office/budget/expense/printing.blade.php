@extends('default.layouts.main')

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

        {{-- <div class="row">
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
                                <h4 class="header-title" style="font-size:16px !important;">วันที่สิ้นสุด โครงกา</h4>
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
        </div>  --}}
        <!-- end row -->

        <?php foreach ($project as $projects);?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">
                                <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายการข้อมูล ค่าใช้จ่ายโครงการ :: {{$projects['project_name']}}</i></h4>
                            <p class="sub-header"></p>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th rowspan="2" width="8%" style="vertical-align : middle;text-align:center;">ลำดับ</th>
                                <th rowspan="2" width="8%" style="vertical-align : middle;text-align:center;">วันที่</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">เลขเอกสาร</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">เลขฏีกา</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">เลขที่ตัดยอด</th>
                                <th rowspan="2" width="20%" style="vertical-align : middle;text-align:center;">รายการรายจ่าย</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">ประเภทรายจ่าย</th>
                                <th colspan="2" width="10%" style="vertical-align : middle;text-align:center;">จำนวน</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">รวมเดือน</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">หน่วยงานที่รับผิดชอบ</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">ประเภท</th>
                                {{-- <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">รหัส คก.</th>
                                <th rowspan="2" width="10%" style="vertical-align : middle;text-align:center;">โครงการ</th> --}}
                            </tr>
                            <tr class="bg-dark text-white">
                                <th  width="5%">ตั้งเบิก</th>
                                <th  width="5%">คืนเงิน</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($items))
                            @foreach ($items as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">{{$no}}</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">{{getDateShow($item['date_report'])}}</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">@if ($item['page_number'] != '') {{$item['page_number']}} @else - @endif</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">@if ($item['petition_number'] != '') {{$item['petition_number']}} @else - @endif</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">@if ($item['cut_top_number'] != '') {{$item['cut_top_number']}} @else - @endif</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:left;">{{$item['expense_item']}}</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:center;">@if ($item['budget_categroy'] != '') {{$item['budget_categroy']}} @else - @endif</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($item['cost_type'] == '1') {{number_format($item['cost_amount'],2,'.',',')}} @else - @endif </td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($item['cost_type'] == '2') {{number_format($item['cost_amount'],2,'.',',')}} @else - @endif </td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">  </td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($item['institution'] != '') {{$item['institution']}} @else - @endif</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($item['cost_categroy'] != '') {{$item['cost_categroy']}} @else  @endif</td>
                                {{-- <td class="align-middle" style="vertical-align : middle;text-align:right;">{{$item['project_id']}}</td>
                                <td class="align-middle" style="vertical-align : middle;text-align:right;">{{$item['project_name']}}</td> --}}
                            </tr>
                            <?php
                                $noCheck = 0;
                                $Checkdetail = \App\Models\Budget::where('projects_id', $id)->where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                $CheckdetailCount = $Checkdetail->count();

                                if($CheckdetailCount){
                                    $details = \App\Models\Budget::getDataAll($id , $item['id']);
                                    foreach ($details as $detail){
                                    $noCheck++;
                            ?>
                                        <tr>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;color:#fff;">{{$no}}.{{$noCheck}}</td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" >{{$detail['expense_item']}}</td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:center;"></td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($detail['institution'] != '') {{$detail['institution']}} @else - @endif</td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:right;">@if ($detail['cost_categroy'] != '') {{$detail['cost_categroy']}} @else  @endif</td>
                                            {{-- <td class="align-middle" style="vertical-align : middle;text-align:right;">{{$detail['project_id']}}</td>
                                            <td class="align-middle" style="vertical-align : middle;text-align:right;">{{$detail['project_name']}}</td> --}}
                                        </tr>
                            <?php 
                                    }
                                } 
                            ?>
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
            window.location='{{URL('office/budget/expenses')}}'+ '/' + values + '/' + id + '/{{$id}}';
        }

        
    });
</script>
@endsection


