@extends('default.layouts.load')

@section('css')

@endsection

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="2"># เพิ่มหัวข้อประเภทงบ ({{$info->name}})</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="10%">ลำดับ</th>
            <th>ชื่อประเภทงบ</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="input[sort_order]" class="form-control" placeholder="" style="height: 45px;" value="{{$info->sort_order}}.{{$sum}}">
            </th>
            <th>
                <input type="text" name="input[name]"  class="form-control" placeholder="" style="height: 45px;" >
            </th>
        </tr>
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
                            <input type="text" name="input[month_10]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_11]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_12]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_1]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_2]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_3]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_4]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_5]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_6]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_7]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_8]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                        <th>
                            <input type="text" name="input[month_9]"  class="form-control" placeholder="" style="height: 45px;">
                        </th>
                    </tr>
                </table>
            </th>
        </tr>
    </tbody>

    <input type="hidden" name="input[sum_total]"  class="form-control" value="0.00" placeholder="" style="height: 45px;">

    <input type="hidden" name="input[parent_id]" id="input-budget_id"  value="{{$id}}">

</table>

@endsection

@section('js')

@endsection
