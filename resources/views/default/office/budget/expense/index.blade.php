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
                                <?php 
                                
                                    $budgetCategroys = \App\Models\BudgetYear::getdata($projects['in_year']); 
                                    foreach ($budgetCategroys as $rowBudgetCategroys)
                                ?>
                                <label for="exampleInputEmail1"> {{$rowBudgetCategroys['year_name']}}</label>
                                
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:16px !important;">งบประมาณ (ได้รับการอนุมัติจริง)</h4>
                                <label for="exampleInputEmail1"> {{number_format($projects['budget_amount'],2,'.',',')}}</label>
                                
                            </div>
                        </div>
                    </div>

                            <?php 
                                // if (!empty($items)){
                                //     $sum = 0;
                                //     foreach ($items as $itemSum){

                                //         $sum += $itemSum['cost_amount'];
                                //     }

                                // }
                            
                            ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="header-title" style="font-size:18px !important;">งบประมาณ (ที่ขออนุมัติ)</h4>
                                <label for="exampleInputEmail1"> 
                                    <!-- number_format($sum,2,'.',',') -->
                                </label>
                                
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
                            
                            <a href="{{url('office/budget/expenses/add')}}/{{$id}}" class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline"> เพิ่มข้อมูล</i></a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th width="5%">ลำดับ</th>
                                <th width="8%">วันที่รายงาน</th>
                                <th width="10%">เลขเอกสาร</th>
                                <th width="10%">เลขฏีกา</th>
                                <th width="10%">เลขที่ตัดยอด</th>
                                <th width="20%">รายการรายจ่าย</th>
                                <th width="10%">ประเภทรายจ่าย</th>
                                <th width="10%">จำนวน</th>
                                <!-- <th style="width: 8%">จัดการ</th> -->
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
                                <td class="align-middle">{{$item['page_number']}}</td>
                                <td class="align-middle">{{$item['petition_number']}}</td>
                                <td class="align-middle">{{$item['cut_top_number']}}</td>
                                <td class="align-middle">{{$item['expense_item']}}</td>
                                <td class="align-middle">@if ($item['cost_type'] == 1) ตั้งเบิก @else คืนเงิน @endif</td>
                                <td class="align-middle">{{number_format($item['cost_amount'],2,'.',',')}}</td>
                                 {{--<td>
                                    <select name="input_action" class="form-control "  data-id="{{$item['id']}}">
                                        <option value="">เลือก</option>
                                        <option value="view" >ดูรายละเอียด</option> 
                                        <option value="detail">ค่าใช้จ่ายย่อย</option>
                                        <option value="edit" >แก้ไข</option>
                                        <option value="delete" >ลบ</option>
                                    </select>
                                </td>--}}
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


    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
        }else if(values != ''){
            window.location='{{URL('office/budget/expenses')}}'+ '/' + values + '/' + id + '/{{$id}}';
        } 
    });
</script>
@endsection


