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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แดชบอร์ด</a></li>
                            <li class="breadcrumb-item active">ภาพรวมงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ภาพรวมงบประมาณ</h4>
              
                </div>
            </div>
        </div>     
      
        <!-- start Chart -->
 
        <form action="{{url('office/budgets/institution/update')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตั้งงบประมาณ</i> </h4>

                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">

                            <input type="hidden" name="input[year_id]" value="{{$yearid}}">
                            <input type="hidden" name="input[budgets_id]" value="{{$budgetsid}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">ปีงบประมาณ <code>*</code></label>
                                        <select name="input[year_id]" id="year_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($year) > 0)
                                            @foreach($year as $keyyear => $valyear)
                                            {{-- <option value="{{$valyear['id']}}" @if($valyear['id'] == $yearid) selected @endif> {{$valyear['in_year']}} </option> --}}
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">หน่วยงาน <code>*</code></label>
                                        <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($institution) > 0)
                                            @foreach($institution as $keyinstitution => $valinstitution)
                                            <option value="{{$valinstitution->id}}" @if($valinstitution->id == $info->institution_id) selected @endif>{{$valinstitution->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year_id">ประเภทงบ <code>*</code></label>
                                        <select name="input[budgets_id]" id="budgets_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($budgetTitles) > 0)
                                            @foreach($budgetTitles as $keybudgetTitles => $vabudgetTitles)
                                            <option value="{{$vabudgetTitles->id}}" <?php if($vabudgetTitles->id == $budgetsid){ echo 'selected';}?>>{{$vabudgetTitles->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label>
                                        <input type="text" name="input[budget_money]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->budget_money}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-database-plus">ค้นหา</i></button>
            
                    </div>
                </div>
                <!-- end col -->
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                        
                                </div>

                                <div class="no-padding sticky-table sticky-rtl-cells">
                                    <table id="datatable" class="table table-bordered">

                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th style="width: 3%" rowspan="2">ลำดับ</th>
                                                <th style="width: 15%" rowspan="2">รายงาน</th>
                                                <th style="width: 10%" colspan="4">ไตรมาส 1 ปีงบประมาณ </th>
                                                <th style="width: 10%" colspan="4">ไตรมาส 2 ปีงบประมาณ </th>
                                                <th style="width: 10%" colspan="4">ไตรมาส 3 ปีงบประมาณ </th>
                                                <th style="width: 10%" colspan="4">ไตรมาส 4 ปีงบประมาณ </th>
                                                <th style="width: 15%" rowspan="2">รวมรายจ่าย ปีงบประมาณ </th>
                                                <!-- <th style="width: 15%" rowspan="2">งบประมาณที่ได้รับ </th> -->
                                            </tr>
                                            <tr>
                                                <th style="width: 5%">ต.ค.</th>
                                                <th style="width: 5%">พ.ย.</th>
                                                <th style="width: 5%">ธ.ค. </th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ม.ค. </th>
                                                <th style="width: 5%">ก.พ. </th>
                                                <th style="width: 5%">มี.ค </th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">เม.ย. </th>
                                                <th style="width: 5%">พ.ค. </th>
                                                <th style="width: 5%">มิ.ย. </th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ก.ค. </th>
                                                <th style="width: 5%">ส.ค. </th>
                                                <th style="width: 5%">ก.ย. </th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                            </tr>
                                        </thead>

                
                                
                                        <?php $no = 0;?>
                                        @if (!empty($budget_hr))
                                        @foreach ($budget_hr as $item)
                                            <?php 
                                                        
                                                $valdetails = \App\Models\BudgetsrDetailYear::where('budgets_detail_id', $item->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                            ?>
                                        <?php $no++;?>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle" align="right">{{$item->sort_order}}</td>
                                                <td class="align-middle">{{$item->name}}</td>
                                                @if (!empty($valdetails))
                                                @foreach ($valdetails as $valdetail)
                                                    <td style="width: 5%">{{number_format($valdetail['month_10'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_11'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_12'])}}</td>
                                                    <td style="width: 5%"><?php echo $valdetail['month_10'] + $valdetail['month_11'] + $valdetail['month_12']?></td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_1'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_2'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_3'])}}</td>
                                                    <td style="width: 5%"><?php echo number_format($valdetail['month_1'] + $valdetail['month_2'] + $valdetail['month_3'])?></td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_4'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_5'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_6'])}}</td>
                                                    <td style="width: 5%"><?php echo number_format($valdetail['month_4'] + $valdetail['month_5'] + $valdetail['month_6'])?></td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_7'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_8'])}}</td>
                                                    <td style="width: 5%">{{number_format($valdetail['month_9'])}}</td>
                                                    <td style="width: 5%"><?php echo number_format($valdetail['month_7'] + $valdetail['month_8'] + $valdetail['month_9'])?></td>
                                                    <td style="width: 5%"><?php echo number_format($valdetail['month_10'] + $valdetail['month_11'] + $valdetail['month_12'] + $valdetail['month_1'] + $valdetail['month_2'] + $valdetail['month_3'] + $valdetail['month_4'] + $valdetail['month_5'] + $valdetail['month_6'] + $valdetail['month_7'] + $valdetail['month_8'] + $valdetail['month_9'])?></td>
                                                @endforeach
                                                @endif
                                            </tr> 
                                        </tbody>
                                        <tbody id="loaddate{{$item->id}}">
                                                    
                                        </tbody>
                                        @endforeach
                                        @endif


                                    </table>
                                </div>
                  
                               
                    </div>
                </div>
                <!-- end col -->

            </div>


        
        </form>
                    

        
    </div> <!-- end container-fluid -->




    

</div> <!-- end content -->

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{url('assets/default')}}/libs/jszip/jszip.min.js"></script>
<script src="{{url('assets/default')}}/libs/pdfmake/pdfmake.min.js"></script>
<script src="{{url('assets/default')}}/libs/pdfmake/vfs_fonts.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Google Charts js -->
<script>
    $(function(){
        $("#datatable").DataTable({
            "ordering": true,
            "autoWidth": false,
            "columnDefs": [
                { "width": "8%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "width": "30%", "targets": 2 },
                { "width": "30%", "targets": 3 },
                { "width": "15%", "targets": 4 }
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
    });


</script>

@endsection