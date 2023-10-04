@extends('default.layouts.main')

@section('css')
<!-- third party css -->
<link href="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ระบบบริหารงานบุคคล</a></li>
                            <li class="breadcrumb-item active">การฝึกอบรม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รวม การฝึกอบรม - all</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="header-title">รายการข้อมูล :: การฝึกอบรม</h4>
                            <p class="sub-header"></p>
                        </div>

                    </div>
                    

                    <table id="datatable" class="table table-bordered table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr class="bg-dark text-white">
                                <th style="width: 2%" >#</th>
                                <th style="width: 5%">ปีงบประมาณ</th>
                                <th style="width: 25%">หลักสูตรการฝึกอบรม</th>
                                <th style="width: 15%">ประเภทการฝึกอบรม</th>
                                <th style="width: 12%">วันที่เริ่มฝึกอบรม</th>
                                {{-- <th style="width: 12%">ผู้บรรยาย</th> --}}
                                {{-- <th style="width: 10%">จำนวนรวม</th> --}}
                                <th style="width: 10%">ดาวน์โหลดเอกสาร</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            <?php $no = 0;?>
                            @if (!empty($courses))
                            @foreach ($courses as $item)
                            <?php $no++;?>
                            <tr>
                                <td class="align-middle">{{$no}}</td>
                                <td class="align-middle">{{$item['budget_year']}}</td>
                                <td class="align-middle">{{$item['name']}}</td>
                                <td class="align-middle">{{$item['categroy']}}</td>
                                <td class="align-middle">{{getDateShow($item['date_start'])}}</td>
                                {{-- <td class="align-middle">{{$item['lecturer_name']}}</td> --}}
                                {{-- <td class="align-middle">2</td> --}}
                                <td class="align-middle">
                                    {{-- <button type="button" value="view" data-original-title="course" data-id="{{$item['id']}}" class="btn btn-warning"  style="font-size: 16px; padding:8px 16px 8px 16px">ดาวน์โหลด</button> --}}

                                    {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">ดาวน์โหลด</button> --}}

                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModal" data-id="{{$item['id']}}">ดาวน์โหลด</button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            

                        </tbody>
                    </table>
                </div>
            </div>
           <p>{{$item['categroy']}}</p>
        </div> <!-- end row -->
        
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$item['id']}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <table class="table table-bordered table-striped  dt-responsive nowrap">
                <thead>
                    <tr class="bg-dark text-white">
                        <th style="width: 10%" >อัพโหลดโดย</th>
                        <th style="width: 10%">ลิงก์ดาวน์โหลด</th>       
                    </tr>


                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">user-1</td>
                        <td class="align-middle"><a href="#">link1</a></td>
                    </tr>
                    <tr>
                        <td class="align-middle">user-2</td>
                        <td class="align-middle"><a href="#">link2</a></td>
                    </tr>
                   
                </tbody>
            </table>
           


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('js')
<!-- Required datatable js -->
<script src="{{url('assets/default')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.bootstrap4.min.js"></script>

<script src="{{url('assets/default')}}/libs/datatables/buttons.html5.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.print.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/buttons.colVis.js"></script>

<!-- Responsive examples -->
<script src="{{url('assets/default')}}/libs/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('assets/default')}}/libs/datatables/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $("#datatable").DataTable({
            "ordering": true,
            "oLanguage": {
                "sZeroRecords": "-ไม่พบรายการข้อมูล-",
                "sLengthMenu": "แสดง  _MENU_  รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 จากทั้งหมด 0 รายการ",
                "sInfo": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
                "sSearch": "ค้นหา"
            }
        });


        $(".input-change-action").change(function(){
            var __url = $(this).val();//input-change-action
            
            window.location.href == __url;
        });


        // var a = $("#datatable-buttons").DataTable({
        //     lengthChange: !1,
        //     buttons: ["copy", "excel", "pdf", "colvis"]
        // });
        // $("#key-table").DataTable({
        //     keys: !0
        // }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({
        //     select: {
        //         style: "multi"
        //     }
        // }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
    });




    $(document).on('change', 'select', function(params) {
        let id = $(this).attr('data-id');
        let values = $(this).val();

        if(values == 'view'){
            $('#con-close-modal-objective'+id).modal('show'); 
            
        }else if(values != ''){
            window.location='{{URL('office/hr/course')}}'+ '/' + values + '/' + id;
        }    
    });




    
</script>

<script>

    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })



    // $(document).on('change', '.btn-action', function(params) {
    //     let id = $(this).find(':selected').attr('data-id');
    //     let values = $(this).val();
    //     let title = $(this).find(':selected').attr('data-original-title');

    //     if(values == 'view'){

    //         $('#con-close-modal-'+title).modal('show'); 

    //         var _url = $("#div-data-url").attr("data-url")+"/get/hrinfo/?id="+id+"&type="+title;

    //         if(title == 'course'){

    //             $.get(_url, function(res){
    //                 $("#frm-"+title+"-save #input-"+title+"-name").text(res.info.name);
    //                 $("#frm-"+title+"-save #input-"+title+"-budget_year").text(res.info.budget_year);
    //                 $("#frm-"+title+"-save #input-"+title+"-categroy").text(res.info.categroy);
    //                 $("#frm-"+title+"-save #input-"+title+"-date_start").text(res.info.date_start);
    //                 $("#frm-"+title+"-save #input-"+title+"-time_start").text(res.info.time_start);
    //                 $("#frm-"+title+"-save #input-"+title+"-place").text(res.info.place);
    //                 $("#frm-"+title+"-save #input-"+title+"-lecturer_name").text(res.info.lecturer_name);
    //             }, "json");

    //         }else{

    //         }
        
    //     }
    
    // });
    
</script>
@endsection
