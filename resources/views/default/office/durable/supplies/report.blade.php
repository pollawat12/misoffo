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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบพัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">พัสดุ/อุปกรณ์</a></li>
                            <li class="breadcrumb-item active">ข้อมูลพัสดุ/อุปกรณ์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">การรับพัสดุ/อุปกรณ์</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูล พัสดุ/อุปกรณ์</i> </h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="durable_name">พัสดุอุปกรณ์ <code>*</code></label>
                                                <input type="text" name="input[durable_name]" class="form-control" placeholder="" disabled style="height: 45px;" value="{{$info->durable_name}}">
                                                <small id="durable_name" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="unitcount_id">หน่วยนับ <code>*</code></label>
                                                <select name="input[unitcount_id]" class="form-control" style="height: 45px;" disabled>
                                                    <option value="1">--เลือก--</option>
                                                    @if (count($unitcount) > 0)
                                                    @foreach($unitcount as $key => $val)
                                                    <option value="{{$val->id}}" @if($val->id == $info->unitcount_id) selected @endif>{{$val->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <small id="unitcount_id" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>ลำดับ</th>  
                                        <th>วันที่รับพัสดุ/อุปกรณ์</th> 
                                        <th>ยกมา</th>
                                        <th>รับ</th>
                                        <th>รวม</th>
                                        <th>จ่าย</th>
                                        <th>คงเหลือ</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;?>
                                        @if (!empty($items))
                                        @foreach ($items as $item)
                                        <?php $no++;?>

                                            <?php
                                                $Checkitems = \App\Models\DurableDisbursement::where('lot_id', $item->id)->where('is_deleted', '0')->where('is_active','1')->sum('amount_num');

                                                if($item->project_id == 0){
                                                    $name = 'สำนักงาน';
                                                }else{
                                                    $info = \App\Models\Project::find((int) $item->project_id);

                                                    $name = $info->project_name;
                                                } 
                                            ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{getDateShow($item->amount_date)}}</td>
                                                <td>{{$item->amount_num}}</td>
                                                <td></td>
                                                <td>{{$item->amount_num}}</td>
                                                <td>{{$Checkitems}}</td>
                                                <td>{{$item->distribute_num}}</td>
                                                <td>{{$name}}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>    
                            </div>
                        </div>

                        
                        <a href="{{URL('office/durable/lists')}}?t=supplies&pr=0"  class="btn btn-secondary"><i class=" mdi mdi-backspace-outline
                            "> กลับหน้าแรก</i></a>
                    
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/durable/lists')}}/?t={{$t}}&pr={{$pr}}"></div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
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
            "dom": 'Bfrtip',
            "buttons": [
                'excel' , 'print'
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
</script>
@endsection
