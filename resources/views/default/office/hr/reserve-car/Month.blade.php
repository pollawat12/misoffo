@extends('default.template-print')

@section('css')

@endsection


@section('content')

<table id="datatable" >
    <thead>
        <tr class="bg-dark text-white">
            <th rowspan="2" style="width: 5%">#</th>
            <th rowspan="2" style="width: 10%">ชื่อ-นามสกุล</th>
            <th colspan="{{$numitems}}">ประเภทการลา</th>
        </tr>
    </thead>


    <tbody>
        

    </tbody>
</table>
@endsection

@section('js')

@endsection
