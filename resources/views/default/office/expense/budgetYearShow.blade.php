@extends('default.layouts.main')

@section('css')
<link href="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{url('assets/js/plugins/sweetalert/sweetalert.css')}}">
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
                            <li class="breadcrumb-item"><a href="{{url('/')}}">สรุปภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">จัดการข้อมูล</a></li>
                            <li class="breadcrumb-item active">งบประมาณ > ตั้งงบประมาณ</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ตั้งงบประมาณ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{url('office/budget/expenses/year/save')}}" method="POST" name="frm-save" id="frm-save">

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h4 class="header-title">
                                    <i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> รายละเอียดงบประมาณ</i></h4>
                                <p class="sub-header"></p>
                            </div>
                            <div class="col-6 text-right">
                                
                                
                            </div>
                        </div>
                        <?php foreach($project as $keydetail => $valDetail);?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                                    <label for="exampleInputEmail1">{{$valDetail['year_name']}}</label>
                                    
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="header-title" style="font-size:16px !important;">งบประมาณ (ได้รับการอนุมัติจริง)</h4>
                                    <label for="exampleInputEmail1"> {{number_format($valDetail['budget_money'],2,'.',',')}}</label>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row" >
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ข้อมูลการรายงาน</i> </h4>
                             <?php $no = 0;?>

                                @if (!empty($detail))
                                @foreach ($detail as $item)
                                <?php $no++;?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col" colspan="7"># ประเภทงบ : 
                                        @if (count($statementtype) > 0)
                                            @foreach($statementtype as $keystatementtype => $valstatementtype)

                                                @if($valstatementtype->id == $item['statementtype_id']) {{$valstatementtype->name}} @endif

                                            @endforeach
                                        @endif

                                        ประเภทค่าใช้จ่าย : 
                                        @if (count($budget) > 0)
                                            @foreach($budget as $keybudget => $valbudget)
                                                @if($valbudget->id == $item['budget_id']) {{$valbudget->name}} @endif
                                            @endforeach
                                        @endif

                                        งบประมาณ : {{number_format($item['sum_total'],2,'.',',')}}
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="8%">วันที่รายงาน</th>
                                            <th width="10%">เลขเอกสาร</th>
                                            <th width="10%">เลขฏีกา</th>
                                            <th width="10%">เลขที่ตัดยอด</th>
                                            <th width="20%">รายการรายจ่าย</th>
                                            <th width="10%">ประเภทรายจ่าย</th>
                                            <th width="10%">จำนวน</th>
                                        </tr>
                                        <?php
                                            $budgets= \App\Models\Budget::getDataReport($item['statementtype_id'] , $item['budget_id'] , $id); 
                                            if (!empty($budgets)){
                                            foreach ($budgets as $rowsbudget){
                                        ?>
                                            <tr>
                                                <td class="align-middle">{{getDateShow($rowsbudget['date_report'])}}</td>
                                                <td class="align-middle">{{$rowsbudget['page_number']}}</td>
                                                <td class="align-middle">{{$rowsbudget['petition_number']}}</td>
                                                <td class="align-middle">{{$rowsbudget['cut_top_number']}}</td>
                                                <td class="align-middle">{{$rowsbudget['expense_item']}}</td>
                                                <td class="align-middle">@if ($rowsbudget['cost_type'] == 1) ตั้งเบิก @else คืนเงิน @endif</td>
                                                <td class="align-middle">{{number_format($rowsbudget['cost_amount'],2,'.',',')}}</td>
                                            </tr>

                                        <?php } }?>
                                    </tbody>
                                </table>

                                @endforeach
                                @endif
                        
                    </div>
                </div>
                <!-- end col -->

            </div>
        </form>
        <!-- end row -->
        <div id="url-redirect-back" data-url="{{url('office/budget/expenses/year/lists')}}/"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('assets/js/datepicker-th/bootstrap-datepicker-th.min.js') }}"></script>
<script src="{{url('assets/default')}}/libs/bootstrap-datepicker/bootstrap-datepicker.th.js"></script>

<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('assets/js/plugins/validate/validate.js')}}"></script>

<script>
    $(".datepicker-autoclose").datepicker({
        language: 'th',
        autoclose: !0,
        todayHighlight: !0
    });

    $(function () {
        
        $.validator.setDefaults({
            submitHandler: function () {
                $(".btn-submit").attr("disabled", "disabled");

                ajaxSubmitForm("frm-save", "json", callBackFunc);
                return false;
            }
        });

        function callBackFunc(data) {
            var alertType = 'error';
            var alertTitle = 'แจ้งเตือน';
            var alertMsg = data.msg;
            var actionForm = $("input[name=action]").val();

            var urlRedirect = $("#url-redirect-back").attr("data-url");

            $(".btn-submit").attr("disabled", false);

            if (data.status) {
                setTimeout(() => {
                    window.location.href = urlRedirect;
                }, 2300);
                
                ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
            } else {
                ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
            }
        }

        $('#frm-save').validate({
            rules: {
                'input[name]': {
                    required: true
                }
            },
            messages: {
                'input[name]': {
                    required: "กรุณากรอกปีงบประมาณ"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection
