@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">

<link rel="stylesheet" href="{{url('assets/default/css/jquery.stickytable.min.css')}}">
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
                            <li class="breadcrumb-item active">งบประมาณ > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> แก้ไขข้อมูล ตั้งงบประมาณ</i> </h4>

                        
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="edit_id" value="{{$id}}">
                            <?php 
                            foreach($yearsDetail as $keydetail => $valyear);
                            ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                        <select name="year_id_n" id="year_id_n" class="form-control" style="height: 40px; width: 90%;">
                                            <option value="">--เลือก--</option>
                                            @if (count($year) > 0)
                                            @foreach($year as $valyears)
                                            <option value="{{$valyears['id']}}" @if($valyears['id'] == $id) selected @endif>{{$valyears['year_name']}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
                                        
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year_id">หน่วยงาน <code>*</code></label>
                                        <select name="input[institution_id]" id="institution_id" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (count($institution) > 0)
                                            @foreach($institution as $keyinstitution => $valinstitution)
                                            <option value="{{$valinstitution->id}}" @if($valinstitution->id == $institutionId) selected @endif>{{$valinstitution->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small id="year_id" class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="budget_money">งบปนะมาณที่ได้รับ <code>*</code></label >
                                        <input type="text" disabled name="input[budget_money]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->budget_money}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">ลักษณะโครงการ <code>*</code></label>
                                        <textarea name="input[description]" disabled class="form-control">{{$info->description}}</textarea>
                                        <small id="description" class="form-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4">
                            <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i> <a href="{{url('office/budget/expenses/year/repost/export/')}}/{{$id}}/{{$institutionId}}" class="btn btn-primary"><i class="mdi mdi-table-large"> นำออกข้อมูล</i></a></h4>
                        
                             <?php $no = 0;?>
                                <div class="input_fields_wrap">
                                @if (!empty($detail))
                                @foreach ($detail as $item)
                                <?php $no++;?>


                                @endforeach
                                @endif

                                
                            
                                </div>

                                <div class="no-padding sticky-table sticky-rtl-cells">
                                    <table id="datatable" class="table table-bordered">

                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th style="width: 3%" rowspan="2">ลำดับ</th>
                                                <th style="width: 15%" rowspan="2">รายงาน</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 1 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 2 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 3 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 20%" colspan="4">ไตรมาส 4 ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 15%" rowspan="2">รวมรายจ่าย ปีงบประมาณ {{$valyear->in_year}}</th>
                                                <th style="width: 15%" rowspan="2">งบประมาณที่ได้รับ </th>
                                            </tr>
                                            <tr>
                                                <th style="width: 5%">ต.ค. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">พ.ย. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">ธ.ค. {{$valyear->in_year - 1}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ม.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ก.พ. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">มี.ค {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">เม.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">พ.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">มิ.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                                <th style="width: 5%">ก.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ส.ค. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">ก.ย. {{$valyear->in_year}}</th>
                                                <th style="width: 5%">รวมไตรมาส</th>
                                            </tr>
                                        </thead>


                                        

                                            <?php $noN = 0;?>
                                            @if (!empty($detail))
                                            @foreach ($detail as $details)
                                            
                                            <?php $noN++;?>
                                            <tbody>
                                                <tr>
                                                    <td class="align-middle">{{ $noN }}</td>
                                                    <?php 
                                                    
                                                        $statementtype = \App\Models\DataSetting::getNameDataByValueAndType($details['statementtype_id'],'statementtype');
                                                    ?>
                                                    <td class="align-middle"> {{$statementtype}}</td>
                                                    <td>
                                                        <?php
                                                            $sum163 = 0;
                                                            $sra163 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra163) > 0){
                                                                foreach($sra163 as $sra163s ){
                                                                    $sum163 += $sra163s['pay_oil'];
                                                                }
                                                                echo number_format($sum163,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum263 = 0;
                                                            $sra263 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra263) > 0){
                                                                foreach($sra263 as $sra263s ){
                                                                    $sum263 += $sra263s['pay_oil'];
                                                                    
                                                                }
                                                                echo number_format($sum263,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum363 = 0;
                                                            $sra363 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra363) > 0){
                                                                foreach($sra363 as $sra363s ){
                                                                    $sum363 += $sra363s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum363,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                $sum1 = $sum163+$sum263+$sum363;
                                                                echo number_format($sum1,2,'.',',');
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $sum164 = 0;
                                                            $sra164 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra164) > 0){
                                                                foreach($sra164 as $sra164s ){
                                                                    $sum164 += $sra164s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum164,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum264 = 0;
                                                            $sra264 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra264) > 0){
                                                                foreach($sra264 as $sra264s ){
                                                                    $sum264 += $sra264s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum264,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum364 = 0;
                                                            $sra364 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra364) > 0){
                                                                foreach($sra364 as $sra364s ){
                                                                    $sum364 += $sra364s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum364,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                $sum2 = $sum164+$sum264+$sum364;
                                                                echo number_format($sum2,2,'.',',');
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $sum464 = 0;
                                                            $sra464 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra464) > 0){
                                                                foreach($sra464 as $sra464s ){
                                                                    $sum464 += $sra464s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum464,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum564 = 0;
                                                            $sra564 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra564) > 0){
                                                                foreach($sra564 as $sra564s ){
                                                                    $sum564 += $sra564s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum564,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum664 = 0;
                                                            $sra664 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra664) > 0){
                                                                foreach($sra664 as $sra664s ){
                                                                    $sum664 += $sra664s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum664,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                $sum3 = $sum464+$sum564+$sum664;
                                                                echo number_format($sum3,2,'.',',');
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $sum764 = 0;
                                                            $sra764 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra764) > 0){
                                                                foreach($sra764 as $sra764s ){
                                                                    $sum764 += $sra764s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum764,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum864 = 0;
                                                            $sra864 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra864) > 0){
                                                                foreach($sra864 as $sra864s ){
                                                                    $sum864 += $sra864s['pay_oil'];
                                                                    
                                                                }

                                                                echo number_format($sum864,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                            $sum964 = 0;
                                                            $sra964 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('budget_categroy', $details['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                                                            if(count($sra964) > 0){
                                                                foreach($sra964 as $sra964s ){
                                                                    $sum964 += $sra964s['pay_oil'];
                                                                }

                                                                echo number_format($sum964,2,'.',',');
                                                            }else{echo '0.00';}
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                $sum4 = $sum764+$sum864+$sum964;
                                                                echo number_format($sum4,2,'.',',');
                                                            ?>
                                                    </td>
                                                    <td class="align-middle" align="right">{{number_format($sum4+$sum3+$sum2+$sum1,2,'.',',')}}</td>
                                                    <td class="align-middle" align="right">{{number_format($details['sum_total'],2,'.',',')}}</td>
                                                </tr> 
                                            </tbody>
                                            <?php
                                            
                                                $items = \App\Models\BudgetYearDetail::where('parent_id', $details['id'])->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                                            
                                            ?>
                                            <tbody>
                                            <?php 
                                                if(count($items) > 0){ 
                                                    $no = 1;
                                                    foreach($items as $item => $valItem){ 
                                            ?>
                                                        <tr>
                                                            <td class="align-middle" align="right"></td>
                                                            <td class="align-middle"><?php echo  $noN.'.'.$no.' ';?>{{$valItem->name}}</td>
                                                            <td>
                                                                <?php
                                                                    $sum1631 = 0;
                                                                    $sra1631 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra1631) > 0){
                                                                        foreach($sra1631 as $sra163s1 ){
                                                                            $sum1631 += $sra163s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum1631,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum2631 = 0;
                                                                    $sra2631 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra2631) > 0){
                                                                        foreach($sra2631 as $sra263s1 ){
                                                                            $sum2631 += $sra263s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum2631,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum3631 = 0;
                                                                    $sra3631 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra3631) > 0){
                                                                        foreach($sra3631 as $sra363s1 ){
                                                                            $sum3631 += $sra363s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum3631,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                    <?php
                                                                        $sum11 = $sum1631+$sum2631+$sum3631;
                                                                        echo number_format($sum11,2,'.',',');
                                                                    ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $sum1641 = 0;
                                                                    $sra1641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra1641) > 0){
                                                                        foreach($sra1641 as $sra164s1 ){
                                                                            $sum1641 += $sra164s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum1641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum2641 = 0;
                                                                    $sra2641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra2641) > 0){
                                                                        foreach($sra2641 as $sra264s1 ){
                                                                            $sum2641 += $sra264s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum2641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum3641 = 0;
                                                                    $sra3641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra3641) > 0){
                                                                        foreach($sra3641 as $sra364s1 ){
                                                                            $sum3641 += $sra364s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum3641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                    <?php
                                                                        $sum21 = $sum1641+$sum2641+$sum3641;
                                                                        echo number_format($sum21,2,'.',',');
                                                                    ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $sum4641 = 0;
                                                                    $sra4641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra4641) > 0){
                                                                        foreach($sra4641 as $sra464s1 ){
                                                                            $sum4641 += $sra464s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum4641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum5641 = 0;
                                                                    $sra5641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra5641) > 0){
                                                                        foreach($sra5641 as $sra564s1 ){
                                                                            $sum5641 += $sra564s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum5641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum6641 = 0;
                                                                    $sra6641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra6641) > 0){
                                                                        foreach($sra6641 as $sra664s1 ){
                                                                            $sum6641 += $sra664s1['pay_oil'];
                                                                            
                                                                        }

                                                                        echo number_format($sum6641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                    <?php
                                                                        $sum31 = $sum4641+$sum5641+$sum6641;
                                                                        echo number_format($sum31,2,'.',',');
                                                                    ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $sum7641 = 0;
                                                                    $sra7641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra7641) > 0){
                                                                        foreach($sra7641 as $sra764s1 ){
                                                                            $sum7641 += $sra764s1['pay_oil'];
                                                                            
                                                                        }
                                                                        echo number_format($sum7641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum8641 = 0;
                                                                    $sra8641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra8641) > 0){
                                                                        foreach($sra8641 as $sra864s1 ){
                                                                            $sum8641 += $sra864s1['pay_oil'];
                                                                            
                                                                        }
                                                                        echo number_format($sum8641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                                    $sum9641 = 0;
                                                                    $sra9641 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('budget_type', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                    if(count($sra9641) > 0){
                                                                        foreach($sra9641 as $sra964s1 ){
                                                                            $sum9641 += $sra964s1['pay_oil'];
                                                                            
                                                                        }
                                                                        echo number_format($sum9641,2,'.',',');
                                                                    }else{echo '0.00';}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                    <?php
                                                                        $sum41 = $sum7641+$sum8641+$sum9641;
                                                                        echo number_format($sum41,2,'.',',');
                                                                    ?>
                                                            </td>
                                                            <td class="align-middle" align="right">{{number_format($sum41+$sum31+$sum21+$sum11,2,'.',',')}}</td>
                                                            <td class="align-middle" align="right">{{number_format($valItem->sum_total,2,'.',',')}}</td>
                                                        </tr>  
                                            <?php 
                                                            $costCategroys = \App\Models\BudgetYearDetail::where('parent_id', $valItem->id)->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

                                                            if(count($costCategroys) > 0){
                                                                $no1 = 1;
                                                                foreach($costCategroys as $costCategroys => $valcostCategroys){

                                                                        $costtypes = \App\Models\BudgetYearDetail::where('parent_id', $valcostCategroys->id)->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                                            ?>
                                                                        <tr>
                                                                            <td class="align-middle" align="right"></td>
                                                                            <td class="align-middle"><span style='margin: 0 0 0 30px'><?php if(count($costtypes) > 0){ echo  $noN.'.'.$no.'.'.$no1.' '; }?>{{$valcostCategroys->name}}</span></td>
                                                                            <td>
                                                                                <?php
                                                                                    $sum1632 = 0;
                                                                                    $sra1632 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra1632) > 0){
                                                                                        foreach($sra1632 as $sra163s2 ){
                                                                                            $sum1632 += $sra163s2['pay_oil'];
                                                                                            
                                                                                        }

                                                                                        echo number_format($sum1632,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum2632 = 0;
                                                                                    $sra2632 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra2632) > 0){
                                                                                        foreach($sra2632 as $sra263s2 ){
                                                                                            $sum2632 += $sra263s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum2632,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum3632 = 0;
                                                                                    $sra3632 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra3632) > 0){
                                                                                        foreach($sra3632 as $sra363s2 ){
                                                                                            $sum3632 += $sra363s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum3632,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                    <?php
                                                                                        $sum12 = $sum1632+$sum2632+$sum3632;
                                                                                        echo number_format($sum12,2,'.',',');
                                                                                    ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sum1642 = 0;
                                                                                    $sra1642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra1642) > 0){
                                                                                        foreach($sra1642 as $sra164s2 ){
                                                                                            $sum1642 += $sra164s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum1642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum2642 = 0;
                                                                                    $sra2642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra2642) > 0){
                                                                                        foreach($sra2642 as $sra264s2 ){
                                                                                            $sum2642 += $sra264s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum2642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum3642 = 0;
                                                                                    $sra3642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra3642) > 0){
                                                                                        foreach($sra3642 as $sra364s2 ){
                                                                                            $sum3642 += $sra364s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum3642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                    <?php
                                                                                        $sum22 = $sum1642+$sum2642+$sum3642;
                                                                                        echo number_format($sum22,2,'.',',');
                                                                                    ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sum4642 = 0;
                                                                                    $sra4642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra4642) > 0){
                                                                                        foreach($sra4642 as $sra464s2 ){
                                                                                            $sum4642 += $sra464s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum4642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum5642 = 0;
                                                                                    $sra5642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra5642) > 0){
                                                                                        foreach($sra5642 as $sra564s2 ){
                                                                                            $sum5642 += $sra564s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum5642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum6642 = 0;
                                                                                    $sra6642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra6642) > 0){
                                                                                        foreach($sra6642 as $sra664s2 ){
                                                                                            $sum6642 += $sra664s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum6642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                    <?php
                                                                                        $sum32 = $sum4642+$sum5642+$sum6642;
                                                                                        echo number_format($sum32,2,'.',',');
                                                                                    ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                    $sum7642 = 0;
                                                                                    $sra7642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra7642) > 0){
                                                                                        foreach($sra7642 as $sra764s2 ){
                                                                                            $sum7642 += $sra764s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum7642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum8642 = 0;
                                                                                    $sra8642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra8642) > 0){
                                                                                        foreach($sra8642 as $sra864s2 ){
                                                                                            $sum8642 += $sra864s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum8642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php
                                                                                    $sum9642 = 0;
                                                                                    $sra9642 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('projects_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                    if(count($sra9642) > 0){
                                                                                        foreach($sra9642 as $sra964s2 ){
                                                                                            $sum9642 += $sra964s2['pay_oil'];
                                                                                            
                                                                                        }
                                                                                        echo number_format($sum9642,2,'.',',');
                                                                                    }else{echo '0.00';}
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                    <?php
                                                                                        $sum42 = $sum7642+$sum8642+$sum9642;
                                                                                        echo number_format($sum42,2,'.',',');
                                                                                    ?>
                                                                            </td>
                                                                            <td class="align-middle" align="right">{{number_format($sum42+$sum32+$sum22+$sum12,2,'.',',')}}</td>
                                                                            <td class="align-middle" align="right"></td>
                                                                        </tr> 

                                            <?php
                                                                            

                                                                            if(count($costtypes) > 0){
                                                                                $no2 = 1;
                                                                                foreach($costtypes as $costtype => $valcosttype){

                                                                                    $costtypes1 = \App\Models\BudgetYearDetail::where('parent_id', $valcosttype->id)->where('budget_year_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();
                                            ?>
                                                                                    <tr>
                                                                                        <td class="align-middle" align="right"></td>
                                                                                        <td class="align-middle"><span style='margin: 0 0 0 60px'><?php if(count($costtypes1) > 0){ echo  '('.$no2.') '; }?>{{$valcosttype->name}}</span></td>
                                                                                        <td>
                                                                                            <?php
                                                                                                $sum16321 = 0;
                                                                                                $sra16321 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra16321) > 0){
                                                                                                    foreach($sra16321 as $sra163s21 ){
                                                                                                        $sum16321 += $sra163s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum16321,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum26321 = 0;
                                                                                                $sra26321 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra26321) > 0){
                                                                                                    foreach($sra26321 as $sra263s21 ){
                                                                                                        $sum26321 += $sra263s21['pay_oil'];
                                                                                                        
                                                                                                    }

                                                                                                    echo number_format($sum26321,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum36321 = 0;
                                                                                                $sra36321 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra36321) > 0){
                                                                                                    foreach($sra36321 as $sra363s21 ){
                                                                                                        $sum36321 += $sra363s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum36321,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                                <?php
                                                                                                    $sum121 = $sum16321+$sum26321+$sum36321;
                                                                                                    echo number_format($sum121,2,'.',',');
                                                                                                ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                                $sum16421 = 0;
                                                                                                $sra16421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra16421) > 0){
                                                                                                    foreach($sra16421 as $sra164s21 ){
                                                                                                        $sum16421 += $sra164s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum16421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum26421 = 0;
                                                                                                $sra26421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra26421) > 0){
                                                                                                    foreach($sra26421 as $sra264s21 ){
                                                                                                        $sum26421 += $sra264s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum26421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum36421 = 0;
                                                                                                $sra36421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra36421) > 0){
                                                                                                    foreach($sra36421 as $sra364s21 ){
                                                                                                        $sum36421 += $sra364s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum36421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                                <?php
                                                                                                    $sum221 = $sum1641+$sum2641+$sum36421;
                                                                                                    echo number_format($sum221,2,'.',',');
                                                                                                ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                                $sum46421 = 0;
                                                                                                $sra46421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra46421) > 0){
                                                                                                    foreach($sra46421 as $sra464s21 ){
                                                                                                        $sum46421 += $sra464s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum46421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum56421 = 0;
                                                                                                $sra56421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra56421) > 0){
                                                                                                    foreach($sra56421 as $sra564s21 ){
                                                                                                        $sum56421 += $sra564s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum56421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum66421 = 0;
                                                                                                $sra66421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra66421) > 0){
                                                                                                    foreach($sra66421 as $sra664s21 ){
                                                                                                        $sum66421 += $sra664s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum66421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                                <?php
                                                                                                    $sum321 = $sum46421+$sum56421+$sum66421;
                                                                                                    echo number_format($sum321,2,'.',',');
                                                                                                ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php
                                                                                                $sum76421 = 0;
                                                                                                $sra76421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra76421) > 0){
                                                                                                    foreach($sra76421 as $sra764s21 ){
                                                                                                        $sum7641 += $sra764s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum7641,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum86421 = 0;
                                                                                                $sra86421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra86421) > 0){
                                                                                                    foreach($sra86421 as $sra864s21 ){
                                                                                                        $sum86421 += $sra864s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum86421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                        <?php
                                                                                                $sum96421 = 0;
                                                                                                $sra96421 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('projects_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                if(count($sra96421) > 0){
                                                                                                    foreach($sra96421 as $sra964s21 ){
                                                                                                        $sum96421 += $sra964s21['pay_oil'];
                                                                                                        
                                                                                                    }
                                                                                                    echo number_format($sum96421,2,'.',',');
                                                                                                }else{echo '0.00';}
                                                                                            ?>
                                                                                        </td>
                                                                                        <td>
                                                                                                <?php
                                                                                                    $sum421 = $sum76421+$sum86421+$sum96421;
                                                                                                    echo number_format($sum421,2,'.',',');
                                                                                                ?>
                                                                                        </td>
                                                                                        <td class="align-middle" align="right">{{number_format($sum421+$sum321+$sum221+$sum121,2,'.',',')}}</td>
                                                                                        <td class="align-middle" align="right"></td>
                                                                                    </tr>
                                            <?php

                                                                                        if(count($costtypes1) > 0){
                                                                                            $no3 = 1;
                                                                                            foreach($costtypes1 as $costtype1 => $valcosttype1){    
                                            ?>
                                                                                                <tr>
                                                                                                    <td class="align-middle" align="right"></td>
                                                                                                    <td class="align-middle"><span style='margin: 0 0 0 90px'>{{$valcosttype1->name}}</span></td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                            $sum16322 = 0;
                                                                                                            $sra16322 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '10')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra16322) > 0){
                                                                                                                foreach($sra16322 as $sra163s22 ){
                                                                                                                    $sum16322 += $sra163s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum16322,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum26322 = 0;
                                                                                                            $sra26322 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '11')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra26322) > 0){
                                                                                                                foreach($sra26322 as $sra263s22 ){
                                                                                                                    $sum26322 += $sra263s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum26322,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum36322 = 0;
                                                                                                            $sra36322 = \App\Models\Budget::whereYear('date_report', '=', '2020')->whereMonth('date_report', '=', '12')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra3632) > 0){
                                                                                                                foreach($sra36322 as $sra363s22 ){
                                                                                                                    $sum36322 += $sra363s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum36322,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                            <?php
                                                                                                                $sum122 = $sum16322+$sum26322+$sum36322;
                                                                                                                echo number_format($sum122,2,'.',',');
                                                                                                            ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                            $sum16422 = 0;
                                                                                                            $sra16422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '01')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra16422) > 0){
                                                                                                                foreach($sra16422 as $sra164s22 ){
                                                                                                                    $sum16422 += $sra164s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum16422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum26422 = 0;
                                                                                                            $sra26422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '02')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra26422) > 0){
                                                                                                                foreach($sra26422 as $sra264s22 ){
                                                                                                                    $sum26422 += $sra264s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum26422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum36422 = 0;
                                                                                                            $sra36422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '03')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra36422) > 0){
                                                                                                                foreach($sra36422 as $sra364s22 ){
                                                                                                                    $sum36422 += $sra364s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum36422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                            <?php
                                                                                                                $sum222 = $sum16422+$sum26422+$sum36422;
                                                                                                                echo number_format($sum222,2,'.',',');
                                                                                                            ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                            $sum46422 = 0;
                                                                                                            $sra46422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '04')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra46422) > 0){
                                                                                                                foreach($sra46422 as $sra464s22 ){
                                                                                                                    $sum46422 += $sra464s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum46422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum56422 = 0;
                                                                                                            $sra56422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '05')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra56422) > 0){
                                                                                                                foreach($sra56422 as $sra564s22 ){
                                                                                                                    $sum56422 += $sra564s2['pay_oil'];
                                                                                                                
                                                                                                                }
                                                                                                                echo number_format($sum56422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum66422 = 0;
                                                                                                            $sra66422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '06')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra66422) > 0){
                                                                                                                foreach($sra66422 as $sra664s22 ){
                                                                                                                    $sum66422 += $sra664s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum66422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                            <?php
                                                                                                                $sum322 = $sum46422+$sum56422+$sum66422;
                                                                                                                echo number_format($sum322,2,'.',',');
                                                                                                            ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                            $sum76422 = 0;
                                                                                                            $sra76422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '07')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra76422) > 0){
                                                                                                                foreach($sra76422 as $sra764s22 ){
                                                                                                                    $sum76422 += $sra764s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum76422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum86422 = 0;
                                                                                                            $sra86422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '08')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra86422) > 0){
                                                                                                                foreach($sra86422 as $sra864s22 ){
                                                                                                                    $sum86422 += $sra864s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum86422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <?php
                                                                                                            $sum96422 = 0;
                                                                                                            $sra96422 = \App\Models\Budget::whereYear('date_report', '=', '2021')->whereMonth('date_report', '=', '09')->where('projects_id', $valcosttype1->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                                                                            if(count($sra96422) > 0){
                                                                                                                foreach($sra96422 as $sra964s22 ){
                                                                                                                    $sum96422 += $sra964s22['pay_oil'];
                                                                                                                    
                                                                                                                }
                                                                                                                echo number_format($sum96422,2,'.',',');
                                                                                                            }else{echo '0.00';}
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                            <?php
                                                                                                                $sum422 = $sum76422+$sum86422+$sum96422;
                                                                                                                echo number_format($sum422,2,'.',',');
                                                                                                            ?>
                                                                                                    </td>
                                                                                                    <td class="align-middle" align="right">{{number_format($sum422+$sum322+$sum222+$sum122,2,'.',',')}}</td>
                                                                                                    <td class="align-middle" align="right"></td>
                                                                                                </tr>
                                            <?php
                                                                                            $no3++;}
                                                                                        }

                                                                                $no2++;}
                                                                            }

                                                                $no1++;}

                                                            }

                                                    $no++;}

                                                }
                                            ?>

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
        <!-- end row -->
        <div id="div-data-url" data-url="{{url('office/budget/expenses/year/edit')}}/{{$id}}"></div>
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/year/lists')}}/{{$id}}"></div>
    </div>
</div>
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 70%;">
        <form action="{{url('office/budget/expenses/year/subsave')}}" method="POST" name="frm-save-new" id="frm-save-new" enctype="multipart/form-data">

        <input type="hidden" name="budget_year_id" id="input-budget_year_id"  value="{{$id}}">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
            </div>
            <div class="modal-body" id="loadbudgetyear">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_add" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->
@endsection

@section('js')
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(document).ready(function () {
        // $("#datatable").DataTable({
        //     "ordering": true,
        //     "pageLength": 25,
        //     "oLanguage": {
        //         "sZeroRecords": "-ไม่พบรายการข้อมูล-",
        //         "sLengthMenu": "แสดง  _MENU_  รายการ",
        //         "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
        //         "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
        //         "oPaginate": {
        //             "sFirst": "หน้าแรก",
        //             "sPrevious": "ก่อนหน้า",
        //             "sNext": "ถัดไป",
        //             "sLast": "หน้าสุดท้าย"
        //         },
        //         "sSearch": "ค้นหา"
        //     }
        // });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });
    });

    $(function () {
        
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
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกปีงบประมาณ"
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

    $('#button_add').click(function(){ 

        function callBackFuncInsertFamily(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#div-data-url").attr("data-url");

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

        $('#frm-save-new').validate({
            rules: {
                'statementtype_id': {
                    required: true
                }
            },
            messages: {
                'statementtype_id': {
                    required: "กรุณากรอก"
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

                ajaxSubmitFormImage("frm-save-new", "json", callBackFuncInsertFamily);
                return false;
            }
        });
    });
</script>

<script type="text/javascript">

    $('#button_add_new').click(function(){

        $('#con-close-modal').modal('show'); 

        $('#loadbudgetyear').load('{{URL('office/budget/expenses/year/get/loadbudget')}}');
        
    });

    function loaddate(id , yearid , num){
        $('#loaddate'+id).load('{{URL('office/budget/expenses/year/get/loaddate')}}' + '/' + id + '/' + yearid + '/' + num);
    }

    $(document).on('change', '#year_id_n', function(params) {
        let values = $(this).val();

        let institutionId = $('#institution_id').val();

        window.location='{{URL('office/budget/expenses/year/repost/get')}}'+ '/' +values + '/' +institutionId;
        
    });

    $(document).on('change', '#institution_id', function(params) {
        let values = $('#year_id_n').val();

        let institutionId = $(this).val();

        window.location='{{URL('office/budget/expenses/year/repost/get')}}'+ '/' +values + '/' +institutionId;
        
    });
</script>
@endsection
