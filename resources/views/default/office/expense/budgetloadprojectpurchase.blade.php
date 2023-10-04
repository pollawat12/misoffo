@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<?php

        if(count($items) > 0){

?>
            
            
                <div class="form-group">
                    <label for="purchases_refer">รายการค่าใช่จ่าย </label>
                    <select name="input[purchases_refer]" id="purchases_refer" class="form-control" style="height: 45px;">
                        <option value="">--เลือก--</option>
                        <?php
                            if (!empty($items)) {
                                foreach ($items as $item) {

                                $costtypes = \App\Models\BudgetsrDetail::where('parent_id', $item['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                        ?>
                                <option value="{{$item['id']}}">{{$item['name']}}</option>       
                        <?php
                                    if(count($costtypes) > 0){
                                        $no2 = 1;
                                        foreach($costtypes as $costtype => $valcosttype){

                                            $costtypes1 = \App\Models\BudgetsrDetail::where('parent_id', $valcosttype->id)->where('is_deleted', '0')->where('is_active','1')->get();
                                                
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
            
            

<?php

        }else{


        }
?>


@endsection

@section('js')

@endsection
