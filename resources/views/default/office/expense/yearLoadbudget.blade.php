@extends('default.layouts.load')

@section('css')

@endsection

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="2"># ประเภทงบประมาณ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="20%">ประเภทงบ</th>
            <th>จำนวนงบ</th>
            <th width="5%">จัดการ</th>
        </tr>
        <tr>
            <th>
                <select name="statementtype_id" id="statementtype_id" class="form-control btn-add-new" style="height: 40px;">
                    <option value="">--เลือก--</option>
                    <?php if(count($statementtype) > 0){ 
                        foreach($statementtype as $keystatementtype => $valstatementtype){ ?>
                            <option value="<?php echo $valstatementtype->id ?>" data-original-title="1" data-id="1"><?php echo $valstatementtype->name ?></option>
                    <?php } }?>
                </select>
            </th>
            <th>
                <input type="hidden" name="sum_total_statement"  class="form-control" value="0.00" placeholder="" style="height: 45px;">
            </th>
        </tr>
    </tbody>
    <tbody id="loadcategory11">
        
    </tbody>
</table>

@endsection

@section('js')
<script type="text/javascript">
    $(document).on('change', '.btn-add-new', function(params) {
        let id = $(this).find(':selected').attr('data-id');
        let values = $(this).val();
        let title = $(this).find(':selected').attr('data-original-title');

        $('#loadcategory'+id+''+title).load('{{URL('office/expenses/year/loadcategory')}}' + '/' + values + '/' + id + '/' + title);
        
    });
</script>
@endsection
