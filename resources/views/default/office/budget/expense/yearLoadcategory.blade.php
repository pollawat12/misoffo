@extends('default.layouts.load')

@section('css')

@endsection

@section('content')
<?php if(count($items) > 0){  ?>

<?php foreach($items as $item => $valItem){ 
    $costCategroys = \App\Models\DataSetting::where('group_type', "budgetcategory")->where('parent_id', $valItem->id)->where('is_deleted', '0')->where('is_active','1')->get();
    
?>  
    <tr>
        <th width="40%">ประเภทค่าใช้จ่าย</th>
        <th></th> 
        <th width="5%"></th>                                                   
    </tr>
    <tr>
        <th>
            
                    <input type="text" name="budgetcategory[<?php echo $valItem->id; ?>]"  id="budgetcategory" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valItem->name; ?>">
                    <input type="hidden" name="budgetcategoryid[<?php echo $valItem->id; ?>]"  id="budgetcategoryid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valItem->id; ?>"> 
                    
                
                
                
        </th>
        <th>
                <input type="text" name="sum_total_budgetcategory[<?php echo $valItem->id; ?>]"  class="form-control" placeholder="" style="height: 45px;"> 
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
                    <th width="40%">รายละเอียด</th>
                    <th>จำนวนเงิน</th> 
                    <th width="5%"></th>                                                   
                </tr>
                <tr>
                    <th width="40%">
                        <input type="text" name="budgetcategoryDetail[<?php echo $valItem->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">    
                    </th>
                    <th>
                        <input type="text" name="sum_total_budgetcategoryDetail[<?php echo $valItem->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
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
                $costbudgettype = \App\Models\DataSetting::where('group_type', "budgettype")->where('parent_id', $valcostCategroys->id)->where('is_deleted', '0')->where('is_active','1')->get();
     ?>  
            <tr>
                <th width="40%">ประเภท</th>
                <th></th> 
                <th></th>                                                     
            </tr>
            <tr>
                <th >
                    
                            <input type="text" name="budgettype[<?php echo $valcostCategroys->id; ?>]"  id="budgettype" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostCategroys->name; ?>">
                            <input type="hidden" name="budgettypeid[<?php echo $valcostCategroys->id; ?>]"  id="budgettypeid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostCategroys->id; ?>">  
                            
                </th>
                <th>
                            <input type="text" name="sum_total_budgettype[<?php echo $valcostCategroys->id; ?>]"  class="form-control" placeholder="" style="height: 45px;">
                    
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
                        <th width="40%">รายละเอียด</th>
                        <th>จำนวนเงิน</th> 
                        <th width="5%"></th>                                                   
                    </tr>
                    <tr>
                        <th width="40%">
                        <input type="text" name="budgettypeDetail[<?php echo $valcostCategroys->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">    
                        </th>
                        <th>
                        <input type="text" name="sum_total_budgettypeDetail[<?php echo $valcostCategroys->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
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
                        <th width="40%">ประเภทย่อย</th>
                        <th></th> 
                        <th></th>                                                   
                    </tr>
                    <tr>
                        <th>
                            
                                <input type="text" name="budgettype1[<?php echo $valcostbudgettype->id; ?>]"  id="budgettype" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostbudgettype->name; ?>">
                                <input type="hidden" name="budgettypeid1[<?php echo $valcostbudgettype->id; ?>]"  id="budgettypeid" class="form-control" placeholder="" style="height: 45px;" value="<?php echo $valcostbudgettype->id; ?>"> 
                                 
                        </th>
                        <th>
                                    <input type="text" name="sum_total_budgettype1[<?php echo $valcostbudgettype->id; ?>]"  class="form-control" placeholder="" style="height: 45px;">
                            
                        </th>  
                        <th>
                            <button type="button" class="btn btn-success btn-sm clicker2" value="<?php echo $valcostbudgettype->id; ?>">เพิ่ม</button>
                            
                        </th>                                                  
                    </tr>
                    <th colspan="3">
                        <table class="table  table-bordered input_fields_wrap2_<?php echo $valcostbudgettype->id; ?>">
                        <tr>
                            <th width="40%">รายละเอียด</th>
                            <th>จำนวนเงิน</th> 
                            <th width="5%"></th>                                                   
                        </tr>
                        <tr>
                            <th width="40%">
                            <input type="text" name="budgettypeDetail1[<?php echo $valcostbudgettype->id; ?>][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value="">   
                            </th>
                            <th>
                            <input type="text" name="sum_total_budgettypeDetail1[<?php echo $valcostbudgettype->id; ?>][]"  class="form-control" placeholder="" style="height: 45px;">
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
    var fname_lname_new_2 = ' <tr id="'+values+'"><th width="40%"><input type="text" name="budgetcategoryDetail['+values+'][]"  id="budgetcategoryDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th><input type="text" name="sum_total_budgetcategoryDetail['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><button type="button" class="btn btn-danger btn-sm remove" value="'+values+'">ลบ</button></th></tr>';
    
    e.preventDefault();
    if(x < max_fields){ 
        x++; //text box increment
        $(wrapper).append(fname_lname_new_2); 
    }

  });


  $(".clicker1").click(function (e) {

    let values = $(this).val();

    var wrapper = $(".input_fields_wrap1_"+values); 
    var fname_lname_new_2 = ' <tr><th width="40%"><input type="text" name="budgettypeDetail['+values+'][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th><input type="text" name="sum_total_budgettypeDetail['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><button type="button" class="btn btn-danger btn-sm remove1" value="'+values+'">ลบ</button></th></tr>';
    
    e.preventDefault();
    if(x < max_fields){ 
        x++; //text box increment
        $(wrapper).append(fname_lname_new_2); 
    }

  });

  $(".clicker2").click(function (e) {

    let values = $(this).val();

    var wrapper = $(".input_fields_wrap2_"+values); 
    var fname_lname_new_2 = ' <tr><th width="40%"><input type="text" name="budgettypeDetail1['+values+'][]"  id="budgettypeDetail" class="form-control" placeholder="" style="height: 45px;" value=""></th><th><input type="text" name="sum_total_budgettypeDetail1['+values+'][]"  class="form-control" placeholder="" style="height: 45px;"></th><th><button type="button" class="btn btn-danger btn-sm remove2" value="'+values+'">ลบ</button></th></tr>';
    
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
