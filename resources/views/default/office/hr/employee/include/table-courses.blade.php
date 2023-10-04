<div class="row">
    {{-- <div class="col-md-12 mb-3 text-right">
        <a href="{{URL('office/hr/course/upload')}}">
            <button type="button"class="btn btn-primary"><i class="mdi mdi-file-document-box-plus-outline">อัพโหลดเอกสารการอบรม</i></button>
        </a>
        
    </div> --}}
    <div class="col-md-12">
        <table id="datatable-course" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th># ลำดับ</th>
                <th style="width: 20%">ปีงบประมาณ</th>
                <th style="width: 20%">หลักสูตรการฝึกอบรม</th>
                <th style="width: 20%">ประเภทการฝึกอบรม</th>
                <th style="width: 20%">วันที่ฝึกอบรม</th>
                {{-- <th style="width: 10%">จำนวนรวม</th> --}}
                <th >จัดการ</th>
            </tr>
        </thead>

        <tbody>
            <?php $noCourses = 0;?>
            @if (!empty($Courses))
            @foreach ($Courses as $Course)
            <?php $noCourses++;?>
            <tr>
                <td class="align-middle" style="width: 8%">{{$noCourses}}</td>
                <td class="align-middle">{{$Course['budget_year']}}</td>
                <td class="align-middle">{{$Course['name']}}</td>
                <td class="align-middle">{{$Course['categroy']}}</td>
                <td class="align-middle">{{getDateTimeTH($Course['date_start'] , false)}} - {{getDateTimeTH($Course['date_end'] , false)}}</td>
                <td class="align-middle" style="width: 10%">
                    <select name="input_action" class="form-control" data-id="{{$Course['id']}}">
                        <option value="">เลือก</option>
                        <option value="view" data-original-title="course" data-id="{{$Course['courses_id']}}">ดูรายละเอียด</option>
                        <option value="upload" >อัพโหลดเอกสาร</option>
                        {{-- <option value="edit" data-original-title="leave" data-id="{{$Course['courses_id']}}">แก้ไข</option> --}}
                        {{-- <option value="delete" data-original-title="leave" data-id="{{$Course['id']}}">ลบ</option> --}}
                    </select>

                </td>
            </tr>
            @endforeach
            @endif
            
        </tbody>
        
    </table>
    </div>
</div>

<div id="con-close-modal-course" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-course-save" id="frm-course-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="course">

        <input type="hidden" name="edit_id" id="input-course-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">การฝึกอบรม </h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">หลักสูตรการฝึกอบรม</h4>
                            <label for="exampleInputEmail1" id="input-course-name"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ปีงบประมาณ</h4>
                            <label for="exampleInputEmail1" id="input-course-budget_year"></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ประเภทการฝึกอบรม</h4>
                            <label for="exampleInputEmail1" id="input-course-categroy"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">วันที่เริ่มต้น - วันที่สิ้นสุด</h4>
                            <label for="exampleInputEmail1" id="input-course-date_start"> </label>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">เวลาที่เริ่มต้น - เวลาที่สิ้นสุด</h4>
                            <label for="exampleInputEmail1" id="input-course-time_start">  </label>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">สถานที่</h4>
                            <label for="exampleInputPassword1" id="input-course-place"> </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 class="header-title" style="font-size:16px !important;">ผู้บรรยาย</h4>
                            <label for="exampleInputEmail1" id="input-course-lecturer_name"> </label>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

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
    });
</script>