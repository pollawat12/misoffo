@extends('default.template-export')

@section('css')

@endsection


@section('content')

<table id="datatable" >
    <thead>
        <tr class="bg-dark text-white">
            <th style="width: 5%">#</th>
            <th style="width: 10%">ชื่อ-นามสกุล</th>
            <th style="width: 15%">วันที่ยื่นใบลา</th>
            <th style="width: 10%">ประเภทการลา</th>
            <th style="width: 10%">จำนวนวันลา</th>
            <th style="width: 10%">วันที่เริ่มลา</th>
            <th style="width: 10%">วันที่สิ้นสุด</th>
            <th style="width: 10%">สถานะการอนุมัติ</th>
        </tr>
    </thead>


    <tbody>
        <?php $no = 0;?>
        @if (!empty($Leave))
        @foreach ($Leave as $item)
        <?php $no++;?>
        <tr>
            <td class="align-middle">{{$no}}</td>
            <td class="align-middle">{{$item['name']}}</td>
            <td class="align-middle">{{getDateShow($item['date_resign'])}}</td>
            <td class="align-middle">{{$item['leave_type']}}</td>
            <td class="align-middle">
                <?php
                    echo round((strtotime($item['date_end']) - strtotime($item['date_start']))/60/60/24) + 1;
                ?>
            </td>
            <td class="align-middle">{{getDateShow($item['date_start'])}}</td>
            <td class="align-middle">{{getDateShow($item['date_end'])}}</td>
            <td class="align-middle">@if($item['is_approved'] == '1') อนมุัติ @elseif($item['is_approved'] == '2') ไม่อนมุัติ @else รอการอนุมัติ @endif</td>
        </tr>
        @endforeach
        @endif
        

    </tbody>
</table>
@endsection

@section('js')

@endsection
