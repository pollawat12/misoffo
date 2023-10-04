@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="button" class="btn btn-success btn-sm add_field_button" data-id="{{$id}}">เพิ่มรายการ</button></h4>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="certificate_detail_name">รายการ <code>*</code> </label>
            <select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;">
                <option value="">--เลือก--</option>
                @if (count($items) > 0)
                @foreach($items as $valitems)
                <option value="{{$valitems['id']}}">{{$valitems['expense_item']}}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="certificate_detail_note"> หมายเหตุ </label>
            <input type="text" name="certificate_detail_note[]" class="form-control" placeholder="" style="height: 45px;"> 
        </div>
    </div>
</div>

<div class="input_fields_wrap">

</div>


@endsection

@section('js')

<script type="text/javascript">

$(document).ready(function() {
    
    var x = 1;
    var add_button      = $(".add_field_button"); 
    $(add_button).click(function(e){ 

        var id = $(this).attr('data-id');

        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); 
        
        var fname_lname_new = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="certificate_detail_name">รายการ <code>*</code> </label><select name="certificate_detail_name[]" id="certificate_detail_name" class="form-control" style="height: 45px;"><option value="">--เลือก--</option><?php if(count($items) > 0){ foreach($items as $valitems){ ?><option value="<?php echo $valitems['id']; ?>"><?php echo $valitems['expense_item'] ?></option><?php } }?></select></div></div><div class="col-md-5"><div class="form-group"><label for="certificate_detail_note"> หมายเหตุ </label><input type="text" name="certificate_detail_note[]" class="form-control" placeholder="" style="height: 45px;"></div></div><button type="button" class="form-control btn btn-danger btn-sm col-md-1 remove_field" style="height: 45px;margin-block:30px;"> ลบ </button></div>';
    
        e.preventDefault();
        if(x < max_fields){ 
            x++; //text box increment
            $(wrapper).append(fname_lname_new); 
        }
    });

    $(wrapper).on("click",".remove_field", function(e){             e.preventDefault(); $(this).parent().remove(); x--;
    })
});
</script>

@endsection
