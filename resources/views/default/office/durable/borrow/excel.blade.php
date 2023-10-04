@extends('default.template-export')

@section('css')

@endsection


@section('content')

<table id="datatable" >

    <thead>
        <tr class="bg-dark text-white">
            <th>#</th>
            <th>รายการ</th>
            <th>Serial Number</th>
            <th>หมายเลขครุภัณฑ์</th>
            <th style="width: 8%;">วันที่ยืม</th>
            <th style="width: 8%;">ชื่อผู้ยืม</th>
            <th>สถานที่</th>
            <th style="width: 8%;">วันที่คืน</th>
            <th style="width: 8%;">ชื่อผู้คืน</th>
            <th>สถานะ</th>
        </tr>
    </thead>


    <tbody>
        <?php $no = 0;?>
        @if (!empty($items))
        @foreach ($items as $item)
        <?php $no++;?>
        <tr>
            <td class="align-middle">{{$no}}</td>
            <td class="align-middle">{{$item['durable_name']}}</td>
            <td class="align-middle">{{$item['durable_serial']}}</td>
            <td class="align-middle">{{$item['durable_number']}}</td>
            <td class="align-middle">{{getDateShow($item['borrow_date'])}}</td>
            <td class="align-middle">{{$item['borrow_user_name']}}</td>
            <td class="align-middle">{{$item['borrow_location']}}</td>
            <td class="align-middle">@if ($item['returns_date'] != '0000-00-00'){{getDateShow($item['returns_date'])}} @endif</td>
            <td class="align-middle">{{$item['returns_user_name']}}</td>
            <td class="align-middle">@if ($item['durable_status'] == 0) คืน @elseif($item['durable_status'] == 1) ยืม @else ตัดจำหน่าย @endif</td>
        </tr>
        @endforeach
        @endif
        

    </tbody>
</table>
@endsection

@section('js')

@endsection
