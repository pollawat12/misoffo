@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<?php foreach ($items as $item); ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="2"># แก้ไขหัวข้อประเภทงบ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="10%">ลำดับ</th>
            <th>ชื่อประเภทงบ</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="input[sort_order]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->sort_order}}">
            </th>
            <th>
                <input type="text" name="input[name]"  class="form-control" placeholder="" style="height: 45px;" value="{{$info->name}}">
            </th>
        </tr>

        <?php if($info->parent_id != 0){ ?>


            <tr>
                <th colspan="2">
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
                                <input type="text" name="input[month_10]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_10']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_11]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_11']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_12]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_12']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_1]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_1']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_2]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_2']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_3]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_3']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_4]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_4']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_5]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_5']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_6]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_6']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_7]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_7']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_8]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_8']}}">
                            </th>
                            <th>
                                <input type="text" name="input[month_9]"  class="form-control" placeholder="" style="height: 45px;" value="{{$item['month_9']}}">
                            </th>
                        </tr>
                    </table>
                </th>
            </tr>
            
        <?php } ?>
    </tbody>

    <input type="hidden" name="edit_detail_id" value="{{$item['id']}}">

    <input type="hidden" name="input[sum_total]"  class="form-control" value="{{$info->sum_total}}" placeholder="" style="height: 45px;">

    <input type="hidden" name="edit_id" value="{{$id}}">

    <input type="hidden" name="input[parent_id]" id="input-budget_id"  value="{{$info->parent_id}}">

</table>

@endsection

@section('js')

@endsection
