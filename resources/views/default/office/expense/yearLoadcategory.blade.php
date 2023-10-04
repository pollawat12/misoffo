@extends('default.layouts.load')

@section('css')

@endsection

@section('content')
<?php if(count($items) > 0){  ?>

<?php foreach($items as $item => $valItem){ 
    $costCategroys = \App\Models\BudgetsTemplate::where('parent_id', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
    
?>  
    <tr>
        <th width="20%">ประเภทค่าใช้จ่าย</th>
        <th></th> 
        <th width="5%"></th>                                                   
    </tr>
    <tr>
        <th>
            
                    <input type="text" name="budgetcategory[<?php echo $valItem->id; ?>]"  id="budgetcategory" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valItem->name; ?>">
                    <input type="hidden" name="budgetcategoryid[<?php echo $valItem->id; ?>]"  id="budgetcategoryid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valItem->id; ?>"> 
                    
                
                
                
        </th>
        <th>
                <input type="hidden" name="sum_total_budgetcategory[<?php echo $valItem->id; ?>]"  class="form-control" placeholder="" value="0.00" style="height: 45px;"> 
        </th>
        <th>
            <?php if(count($costCategroys) > 0){  }else{ ?> <button type="button" class="btn btn-success btn-sm clicker" value="<?php echo $valItem->id; ?>">เพิ่ม</button> <?php } ?>
        </th>                                                     
    </tr>
    <tr >
        <?php if(count($costCategroys) > 0){  }else{ ?> 
             
            <th colspan="3">
                <table class="table  table-bordered input_fields_wrap_<?php echo $valItem->id; ?>">
                <tr>
                    <th width="20%">รายละเอียด</th>
                    <th width="75%">จำนวนเงิน</th> 
                    <th width="5%"></th>                                                   
                </tr>
                <tr>
                    <th width="20%">
                        <input type="text" name="budgetcategoryDetail[<?php echo $valItem->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">    
                    </th>
                    <th>
                        <input type="hidden" name="sum_total_budgetcategoryDetail[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">

                        <table class="table  table-bordered">
                            <tr>
                                <th>ต.ค.</th>
                                <th>พ.ย.</th>
                                <th>ธ.ค.</th>
                                <th>ม.ค.</th>
                                <th>ก.พ.</th>
                                <th>มี.ค.</th>
                                <th>เม.ย.</th>
                                <th>พ.ค.</th>
                                <th>มิ.ย.</th>
                                <th>ก.ค.</th>
                                <th>ส.ค.</th>
                                <th>ก.ค.</th>
                            </tr>  
                            <tr> 
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail10[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail11[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail12[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail1[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail2[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail3[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail4[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail5[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail6[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail7[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail8[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                                <th>
                                    <input type="text" name="sum_total_budgetcategoryDetail9[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                </th>
                            </tr>
                        </table>
                    </th>
                    <th>
                        
                    </th>
                </tr>
                </table>
            </th>
        <?php } ?>                                                 
    </tr>
    <?php 
        
        if(count($costCategroys) > 0){
            foreach($costCategroys as $costCategroys => $valcostCategroys){
                $costbudgettype = \App\Models\BudgetsTemplate::where('parent_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
     ?>  
            <tr>
                <th width="20%">ประเภท</th>
                <th></th> 
                <th></th>                                                     
            </tr>
            <tr>
                <th >
                    
                            <input type="text" name="budgettype[<?php echo $valcostCategroys->id; ?>]"  id="budgettype" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostCategroys->name; ?>">
                            <input type="hidden" name="budgettypeid[<?php echo $valcostCategroys->id; ?>]"  id="budgettypeid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostCategroys->id; ?>">  
                            
                </th>
                <th>
                            <input type="hidden" name="sum_total_budgettype[<?php echo $valcostCategroys->id; ?>]"  class="form-control" value="0.00" placeholder="" style="height: 45px;">
                    
                </th>
                <th>
                    <?php if(count($costbudgettype) > 0){ }else{  ?> <button type="button" class="btn btn-success btn-sm clicker1" value="<?php echo $valcostCategroys->id; ?>">เพิ่ม</button><?php }  ?>
                </th>                                                   
            </tr>
            <tr>
            <?php if(count($costbudgettype) > 0){ }else{  ?>

                <th colspan="3">
                    <table class="table  table-bordered input_fields_wrap1_<?php echo $valcostCategroys->id; ?>">
                    <tr>
                        <th width="20%">รายละเอียด</th>
                        <th width="75%">จำนวนเงิน</th> 
                        <th width="5%"></th>                                                   
                    </tr>
                    <tr>
                        <th width="20%">
                        <input type="text" name="budgettypeDetail[<?php echo $valcostCategroys->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">    
                        </th>
                        <th>
                        <input type="hidden" name="sum_total_budgettypeDetail[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                            <table class="table  table-bordered">
                                <tr>
                                    <th>ต.ค.</th>
                                    <th>พ.ย.</th>
                                    <th>ธ.ค.</th>
                                    <th>ม.ค.</th>
                                    <th>ก.พ.</th>
                                    <th>มี.ค.</th>
                                    <th>เม.ย.</th>
                                    <th>พ.ค.</th>
                                    <th>มิ.ย.</th>
                                    <th>ก.ค.</th>
                                    <th>ส.ค.</th>
                                    <th>ก.ค.</th>
                                </tr> 
                                <tr> 
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail10[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail11[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail12[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail1[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail2[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail3[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail4[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail5[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail6[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail7[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail8[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </th>
                                    <th>
                                        <input type="text" name="sum_total_budgettypeDetail9[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                    </tr>
                                </tr>
                            </table>
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                    </table>
                </th>
            <?php }  ?>                                                
            </tr>

            <?php 
                
                if(count($costbudgettype) > 0){
                    foreach($costbudgettype as $costbudgettype => $valcostbudgettype){
             ?>
                    <tr>
                        <th width="20%">ประเภทย่อย</th>
                        <th></th> 
                        <th></th>                                                   
                    </tr>
                    <tr>
                        <th>
                            
                                <input type="text" name="budgettypeN[<?php echo $valcostbudgettype->id; ?>]"  id="budgettype" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostbudgettype->name; ?>">
                                <input type="hidden" name="budgettypeidN[<?php echo $valcostbudgettype->id; ?>]"  id="budgettypeid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostbudgettype->id; ?>"> 
                                 
                        </th>
                        <th>
                                    <input type="text" name="sum_total_budgettypeN[<?php echo $valcostbudgettype->id; ?>]"  class="form-control" placeholder="" style="height: 45px;">
                            
                        </th>  
                        <th>
                            <button type="button" class="btn btn-success btn-sm clicker2" value="<?php echo $valcostbudgettype->id; ?>">เพิ่ม</button>
                            
                        </th>                                                  
                    </tr>
                    <th colspan="3">
                        <table class="table  table-bordered input_fields_wrap2_<?php echo $valcostbudgettype->id; ?>">
                        <tr>
                            <th width="20%">รายละเอียด</th>
                            <th width="75%">จำนวนเงิน</th> 
                            <th width="5%"></th>                                                   
                        </tr>
                        <tr>
                            <th width="20%">
                            <input type="text" name="budgettypeDetailN[<?php echo $valcostbudgettype->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">   
                            </th>
                            <th width="75%">
                            <input type="hidden" name="sum_total_budgettypeDetailN[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                <table class="table  table-bordered">
                                    <tr>
                                        <th>ต.ค.</th>
                                        <th>พ.ย.</th>
                                        <th>ธ.ค.</th>
                                        <th>ม.ค.</th>
                                        <th>ก.พ.</th>
                                        <th>มี.ค.</th>
                                        <th>เม.ย.</th>
                                        <th>พ.ค.</th>
                                        <th>มิ.ย.</th>
                                        <th>ก.ค.</th>
                                        <th>ส.ค.</th>
                                        <th>ก.ค.</th>
                                    </tr>  
                                    <tr>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN10[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN11[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN12[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN1[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN2[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN3[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN4[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN5[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN6[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN7[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN8[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                        <th>
                                            <input type="text" name="sum_total_budgettypeDetailN9[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
                                        </th>
                                    </tr>
                                </table>
                            </th>
                            <th>
                                
                            </th>
                        </tr>
                        </table>
                    </th>   
                            

             <?php
                    }

                }
            ?> 


    <?php
            }

        }
    ?> 
<?php }?>  
<?php } ?>

@endsection

@section('js')
<script type="text/javascript">

$(document).ready(function() {
  var max_fields      = 20; //maximum input boxes allowed   
  var x = 2;
  $(".clicker").click(function (e) {

    let values = $(this).val();

    var wrapper = $(".input_fields_wrap_"+values); 
    var fname_lname_new_2 = ' <tr id="'+values+'"><th width="20%"><input type="text" name="budgetcategoryDetail['+values+'][]"  id="budgetcategoryDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th><input type="hidden" name="sum_total_budgetcategoryDetail['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"><table class="table  table-bordered"><tr><th>ต.ค.</th><th>พ.ย.</th><th>ธ.ค.</th><th>ม.ค.</th><th>ก.พ.</th><th>มี.ค.</th><th>เม.ย.</th><th>พ.ค.</th><th>มิ.ย.</th><th>ก.ค.</th><th>ส.ค.</th><th>ก.ค.</th></tr><tr><th><input type="text" name="sum_total_budgetcategoryDetail10['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail11['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail12['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail1['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail2['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail3['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail4['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail5['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail6['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail7['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail8['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgetcategoryDetail9['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th></tr></table></th><th><button type="button" class="btn btn-danger btn-sm remove" value="'+values+'">ลบ</button></th></tr>';
    
    e.preventDefault();
    if(x < max_fields){ 
        x++; //text box increment
        $(wrapper).append(fname_lname_new_2); 
    }

  });

  


  $(".clicker1").click(function (e) {

    let values = $(this).val();

    var wrapper = $(".input_fields_wrap1_"+values); 
    var fname_lname_new_2 = ' <tr><th width="20%"><input type="text" name="budgettypeDetail['+values+'][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th><input type="hidden" name="sum_total_budgettypeDetail['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"><table class="table  table-bordered"><tr><th>ต.ค.</th><th>พ.ย.</th><th>ธ.ค.</th><th>ม.ค.</th><th>ก.พ.</th><th>มี.ค.</th><th>เม.ย.</th><th>พ.ค.</th><th>มิ.ย.</th><th>ก.ค.</th><th>ส.ค.</th><th>ก.ค.</th></tr><tr><th><input type="text" name="sum_total_budgetcategoryDetail10['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail11['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail12['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail1['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetai2['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail3['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail4['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail5['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail6['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail7['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail8['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetail9['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th></tr></table></th><th><button type="button" class="btn btn-danger btn-sm remove1" value="'+values+'">ลบ</button></th></tr>';
    
    e.preventDefault();
    if(x < max_fields){ 
        x++; //text box increment
        $(wrapper).append(fname_lname_new_2); 
    }

  });

  $(".clicker2").click(function (e) {

    let values = $(this).val();

    var wrapper = $(".input_fields_wrap2_"+values); 
    var fname_lname_new_2 = ' <tr><th width="20%"><input type="text" name="budgettypeDetailN['+values+'][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th width="20%"><input type="hidden" name="sum_total_budgettypeDetailN['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"><table class="table  table-bordered"><tr><th>ต.ค.</th><th>พ.ย.</th><th>ธ.ค.</th><th>ม.ค.</th><th>ก.พ.</th><th>มี.ค.</th><th>เม.ย.</th><th>พ.ค.</th><th>มิ.ย.</th><th>ก.ค.</th><th>ส.ค.</th><th>ก.ค.</th></tr><tr><th><input type="text" name="sum_total_budgetcategoryDetail10['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN11['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN12['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN1['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN2['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN3['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN4['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN5['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN6['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN7['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN8['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><input type="text" name="sum_total_budgettypeDetailN9['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th></tr></table></th><th><button type="button" class="btn btn-danger btn-sm remove2" value="'+values+'">ลบ</button></th></tr>';
    
    e.preventDefault();
    if(x < max_fields){ 
        x++; //text box increment
        $(wrapper).append(fname_lname_new_2); 
    }

  });
});

$(document).on('click', '.remove', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});

$(document).on('click', '.remove1', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});


$(document).on('click', '.remove2', function() {
    let values = $(this).val();
    
    $(this).parent().parent().remove();
});

</script>
@endsection
