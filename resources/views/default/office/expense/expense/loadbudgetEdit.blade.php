@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="2"># แก้ไขหัวข้อฐานะการเงิน ({{$item->name}})</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th width="50%">ชื่อฐานะการเงิน</th>
            <th>จำนวนเงิน</th>
        </tr>
        <tr>
            <th>
                <select name="input[type_id]" id="type_id" class="form-control" style="height: 45px;">
                    <option value="">--เลือก--</option>
                    @if (count($checkNum) > 0)
                    @foreach($checkNum as $checkNum => $val)
                    <option value="{{$val->id}}"  @if($val->id == $info->type_id) selected @endif>{{$val->name}}</option>
                    @endforeach
                    @endif
                </select>
            </th>
            <th>
                <input type="text" name="input[sum_total]"  class="form-control" placeholder="" style="height: 45px;" value="{{$info->sum_total}}">
            </th>
        </tr>
        <tr>
            <th colspan="2">หมายเหตุ</th>
        </tr>
        <tr>
            <th colspan="2">
                <textarea name="input[description]" class="form-control">{{$info->description}}</textarea>
            </th>
        </tr>

    </tbody>

    <input type="hidden" name="edit_detail_id" value="{{$item['id']}}">

    <input type="hidden" name="edit_id" value="{{$id}}">

    <input type="hidden" name="input[parent_id]" id="input-budget_id"  value="{{$info->parent_id}}">

</table>

@endsection

@section('js')

@endsection
