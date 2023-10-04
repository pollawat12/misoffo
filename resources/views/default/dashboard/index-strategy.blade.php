@extends('default.layouts.main')


@section('css')
<!-- Plugin css -->

<style>
    
</style>
@endsection


@section('content')

<div class="content">
                    
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แดชบอร์ด</a></li>
                            <li class="breadcrumb-item active">บริหารงานยุทธศาสตร์</li>
                        </ol>
                    </div>
                    <h4 class="page-title">บริหารงานยุทธศาสตร์</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-lg-12">

                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">

                                <table class="table mb-0">
                                    <thead >
                                    <tr>
                                        <th colspan="4" style="text-align: center">
                                        รายงานราคา เช้า
                                        </th>
                                    </tr>
                                    <tr class="thead-light">
                                        <th colspan="4" style="text-align: center">
                                        8899999-34 ssd00
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td class="text-right">ราคาเมื่อวาน</td>
                                        <td class="text-right">ราคาวันนี้</td>
                                        <td class="text-right">เปลี่ยนแปลง</td>
                                    </tr>
                                    @if ($price_start_day)
                                    @foreach ($price_start_day as $arr)
                                    <tr>
                                        <td>{{ $arr['label'] }}</td>
                                        <td class="text-right">{{ $arr['s_price'] }}</td>
                                        <td class="text-right">{{ $arr['e_price'] }}</td>
                                        <td class="text-right">{{ $arr['diff_price'] }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-md-6">
                            <div class="table-responsive">

                                <table class="table mb-0">
                                    <thead class="">
                                        <tr>
                                            <th colspan="4" style="text-align: center">
                                            รายงานราคา ณ. สิ้นวัน
                                            </th>
                                        </tr>
                                        <tr class="thead-light">
                                            <th colspan="4" style="text-align: center">
                                            8899999-34 ssd00
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td class="text-right">ราคาเมื่อวาน</td>
                                            <td class="text-right">ราคาวันนี้</td>
                                            <td class="text-right">เปลี่ยนแปลง</td>
                                        </tr>
                                        @if ($price_end_day)
                                        @foreach ($price_end_day as $arr)
                                        <tr>
                                            <td>{{ $arr['label'] }}</td>
                                            <td class="text-right">{{ $arr['s_price'] }}</td>
                                            <td class="text-right">{{ $arr['e_price'] }}</td>
                                            <td class="text-right">{{ $arr['diff_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->

                    </div>  <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">

                        </div> <!-- end col -->
                    </div>  <!-- end row -->
                </div>

            </div>
            <!-- end col-12 -->
        </div> <!-- end row -->
        
    </div> <!-- end container-fluid -->

</div> <!-- end content -->

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/main.js') }}"></script>
<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/locales-all.js') }}"></script>


<script>
    
</script>
@endsection