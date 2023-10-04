@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<?php 
    if($budgetId == '325'){
?>

    <div class="row">
        <div class="col-md-12">
            <?php //$projects = \App\Models\Project::where('in_year', $info->id)->where('is_deleted', '0')->where('is_active','1')->get(); ?>
            <div class="form-group">
                <label for="projects_id">โครงการ </label>
                <select name="input[projects_id]" id="projects_id" class="form-control" style="height: 45px;">
                    <option value="">--เลือก--</option>
                    <option value="0">สำนักงาน</option>
                    <?php
                        if (!empty($items)) {
                            foreach ($items as $item) {
                    ?>
                             <option value="{{$item['id']}}">{{$item['project_name']}}</option>       
                    <?php
                    
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>

<?php

    }else{
        if(count($items) > 0){

?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="projects_id">รายการค่าใช่จ่าย </label>
                        <select name="input[projects_id]" id="projects_id" class="form-control" style="height: 45px;">
                            <option value="">--เลือก--</option>
                            <?php
                                if (!empty($items)) {
                                    foreach ($items as $item) {

                                    $costtypes = \App\Models\BudgetYearDetail::where('parent_id', $item['id'])->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();
                            ?>
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>       
                            <?php
                                        if(count($costtypes) > 0){
                                            $no2 = 1;
                                            foreach($costtypes as $costtype => $valcosttype){

                                                $costtypes1 = \App\Models\BudgetYearDetail::where('parent_id', $valcosttype->id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();
                                                    
                            ?>
                                                <option value="{{$valcosttype->id}}"><span style='margin: 0 0 0 60px'>{{$valcosttype->name}}</span></option>  
                            <?php
                                                    if(count($costtypes1) > 0){
                                                        $no3 = 1;
                                                        foreach($costtypes1 as $costtype1 => $valcosttype1){
                            ?>
                                                            <option value="{{$valcosttype1->id}}"><span style='margin: 0 0 0 90px'>{{$valcosttype1->name}}</span></option> 
                            <?php

                                                        }

                                                    }
                                            }

                                        }
                            
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- <span id="loadtype">
                        
        
            </span>
            <span id="loadtype1">
                    
    
            </span> -->

<?php

        }else{


        }
    }
?>


@endsection

@section('js')

@endsection
