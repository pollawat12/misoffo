@extends('default.layouts.load')

@section('css')

@endsection

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="2"># เพิ่มหัวข้อประเภทงบ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="25%">ลำดับ</th>
            <th>ชื่อประเภทงบ</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="input[sort_order]" class="form-control" placeholder="" style="height: 45px;">
            </th>
            <th>
                <input type="text" name="input[name]"  class="form-control" placeholder="" style="height: 45px;">
            </th>
        </tr>
    </tbody>

    <input type="hidden" name="input[sum_total]"  class="form-control" value="0.00" placeholder="" style="height: 45px;">

</table>

@endsection

@section('js')

@endsection
