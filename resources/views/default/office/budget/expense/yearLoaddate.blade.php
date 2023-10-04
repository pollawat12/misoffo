@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<?php 
    if(count($items) > 0){ 
        $no = 1;
        foreach($items as $item => $valItem){ 
?>
            <tr>
                <td class="align-middle" align="right"></td>
                <td class="align-middle"><?php echo  $num.'.'.$no.' ';?>{{$valItem->name}}</td>
                <td class="align-middle" align="right">{{number_format($valItem->sum_total,2,'.',',')}}</td>
                <td>
                </td>
            </tr>  
<?php 
                $costCategroys = \App\Models\BudgetYearDetail::where('parent_id', $valItem->id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();

                if(count($costCategroys) > 0){
                    $no1 = 1;
                    foreach($costCategroys as $costCategroys => $valcostCategroys){

                            $costtypes = \App\Models\BudgetYearDetail::where('parent_id', $valcostCategroys->id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();
?>
                            <tr>
                                <td class="align-middle" align="right"></td>
                                <td class="align-middle"><span style='margin: 0 0 0 30px'><?php if(count($costtypes) > 0){ echo  $num.'.'.$no.'.'.$no1.' '; }?>{{$valcostCategroys->name}}</span></td>
                                <td class="align-middle" align="right"></td>
                                <td>
                                </td>
                            </tr> 

<?php
                                

                                if(count($costtypes) > 0){
                                    $no2 = 1;
                                    foreach($costtypes as $costtype => $valcosttype){

                                        $costtypes1 = \App\Models\BudgetYearDetail::where('parent_id', $valcosttype->id)->where('budget_year_id', $yearid)->where('is_deleted', '0')->where('is_active','1')->get();
?>
                                        <tr>
                                            <td class="align-middle" align="right"></td>
                                            <td class="align-middle"><span style='margin: 0 0 0 60px'><?php if(count($costtypes1) > 0){ echo  '('.$no2.') '; }?>{{$valcosttype->name}}</span></td>
                                            <td class="align-middle" align="right"></td>
                                            <td>
                                            </td>
                                        </tr>
<?php

                                            if(count($costtypes1) > 0){
                                                $no3 = 1;
                                                foreach($costtypes1 as $costtype1 => $valcosttype1){    
?>
                                                    <tr>
                                                        <td class="align-middle" align="right"></td>
                                                        <td class="align-middle"><span style='margin: 0 0 0 90px'>{{$valcosttype1->name}}</span></td>
                                                        <td class="align-middle" align="right"></td>
                                                        <td>
                                                        </td>
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



@endsection

@section('js')

@endsection
