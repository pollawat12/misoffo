<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="transfer" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ประวัติการช่วยปฏิบัติราชการ</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-transfer" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th rowspan="2" width="5%">ลำดับ</th>
                <th colspan="2" width="20%">ฝ่าย</th>
                <th colspan="2" width="20%">สำนัก/กอง</th>
                <th rowspan="2" width="10%">วันที่เริ่มช่วยปฏิบัติราชการ </th>
                <th rowspan="2" width="10%">วันที่สิ้นสุดทำงาน</th>
                <th rowspan="2" width="10%">สถานะการทำงาน</th>
                <th rowspan="2" width="10%">ไฟล์เอกสาร</th>
                <th rowspan="2" >จัดการ</th>
            </tr>
            <tr class="bg-dark text-white">
                <th width="10%">จาก</th>
                <th width="10%">ไป</th>
                <th width="10%">จาก</th>
                <th width="10%">ไป</th>
            </tr>
        </thead>


        <tbody>
            <?php $noTransferInOffice = 0;?>
            @if (!empty($TransferInOffice))
            @foreach ($TransferInOffice as $TransferInOffices)
            <?php $noTransferInOffice++;?>
                <tr>
                    <td class="align-middle" style="width: 8%">{{$noTransferInOffice}}</td>
                    <td class="align-middle">{{$TransferInOffices['from_department']}}</td>
                    <td class="align-middle">{{$TransferInOffices['to_department']}}</td>
                    <td class="align-middle">{{$TransferInOffices['from_institution']}}</td>
                    <td class="align-middle">{{$TransferInOffices['to_institution']}}</td>
                    <td class="align-middle" style="width: 12%">{{getDateTimeTH($TransferInOffices['date_start'] , false)}}</td>
                    <td class="align-middle" style="width: 12%">{{$TransferInOffices['date_end']}}</td>
                    <td class="align-middle">@if($TransferInOffices['is_present'] == 0) ภายในสำนักงาน @else ภายนอกสำนักงาน @endif</td>
                    <td class="align-middle" style="width:10%"> @if($TransferInOffices['transfer_file'] != NULL) <a href="{{url('')}}/{{$TransferInOffices['transfer_file']}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลด</i> </a> @endif</td>
                    <td style="width: 10%">
                        <select name="input_action" class="form-control btn-action">
                            <option value="">เลือก</option>
                            {{-- <option value="view" data-original-title="transfer" data-id="{{$dutyDetails['id']}}">ดูรายละเอียด</option> --}}
                            <option value="edit" data-original-title="transfer" data-id="{{$TransferInOffices['id']}}">แก้ไข</option>
                            <option value="delete" data-original-title="transfer" data-id="{{$TransferInOffices['id']}}">ลบ</option>
                        </select>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>

<div id="con-close-modal-transfer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-transfer-save" id="frm-transfer-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="transfer">
        <input type="hidden" name="edit_id" id="input-transfer-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลประวัติการช่วยปฏิบัติราชการ</h4>
            </div>
            <div class="modal-body">
                <?php 
                    // $positions = \App\Models\DataSetting::where('group_type','group_work')->where('is_deleted', '0')->where('is_active','1')->get();
                ?>
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_position">กลุ่ม (เดิม) </label>
                            <select name="input[from_position]" class="form-control" id="input-transfer-from_position" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @if (!empty($positions))
                                @foreach ($positions as $position)
                                    <option value="{{$position['id']}}">{{$position['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="to_position">กลุ่ม (ใหม่) </label>
                            <select name="input[to_position]" class="form-control" id="input-transfer-to_position" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @if (!empty($positions))
                                @foreach ($positions as $positionTo)
                                    <option value="{{$positionTo['id']}}">{{$positionTo['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div> --}}

                <?php 
                $departments = \App\Models\DataSetting::where('group_type','department')->where('is_deleted', '0')->where('is_active','1')->get();
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_department">ฝ่าย (เดิม) </label>
                            <select name="input[from_department]" class="form-control" id="input-transfer-from_department" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @if (!empty($departments))
                                @foreach ($departments as $department)
                                    <option value="{{$department['id']}}">{{$department['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="to_department">ฝ่าย/ส่วน (ใหม่) </label>
                            <input type="text" class="form-control" name="input[to_department]" id="input-transfer-to_department" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_institution">สำนัก/กอง (เดิม)</label>
                            <input type="text" class="form-control" name="input[from_institution]" id="input-transfer-from_institution" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="to_institution">สำนัก/กอง (ใหม่)</label>
                            <input type="text" class="form-control" name="input[to_institution]" id="input-transfer-to_institution" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="input-transfer-is_present" name="input[is_present]" type="checkbox" value="1">
                                <label for="input-transfer-is_present">
                                    ภายนอกสำนักงาน
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="leader_name">ชื่อหัวหน้า</label>
                            <input type="text" class="form-control" name="input[leader_name]" id="input-transfer-leader_name" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="leader_tel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="input[leader_tel]" id="input-transfer-leader_tel" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="leader_mobile">เบอร์มือถือ</label>
                            <input type="text" class="form-control" name="input[leader_mobile]" id="input-transfer-leader_mobile" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="leader_email">อีเมล</label>
                            <input type="text" class="form-control" name="input[leader_email]" id="input-transfer-leader_email" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่เริ่มช่วยปฏิบัติราชการ </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-transfer-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่สิ้นสุดทำงาน <code>(กรณีถึงปัจจุบัน ไม่ต้องเลือกวันที่)</code></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-transfer-date_end" placeholder="วว/ดด/ปปปป"  name="input[date_end]">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_loan">สถานะการทำงาน </label>
                            <select name="input[is_loan]" class="form-control" id="input-transfer-is_loan" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                <option value="0" >ทำงาน</option>
                                <option value="1" >ลาออก</option>
                                <option value="2" >เกษียณ</option>
                                <option value="3" >เข้างานใหม่</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_file">แนบไฟล์เอกสาร</label>
                            <input type="file" class="filestyle" name="upfile_transfer" id="input-transfer-transfer_file" placeholder="" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">หมายเหตุ </label>
                            <textarea name="input[note]" class="form-control" id="input-transfer-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_transfer" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

<script>
    $(function(){
        
        $("#input-transfer-is_present").on("click", function() {
        if($('#input-transfer-is_present:checked').length){
            $('#input-transfer-leader_name').removeAttr('disabled');
            $('#input-transfer-leader_tel').removeAttr('disabled');
            $('#input-transfer-leader_mobile').removeAttr('disabled');
            $('#input-transfer-leader_email').removeAttr('disabled');
        }else{
            $('#input-transfer-leader_name').attr('disabled','disabled');
            $('#input-transfer-leader_tel').attr('disabled','disabled');
            $('#input-transfer-leader_mobile').attr('disabled','disabled');
            $('#input-transfer-leader_email').attr('disabled','disabled');
            $('#input-transfer-leader_name').val('');
            $('#input-transfer-leader_tel').val('');
            $('#input-transfer-leader_mobile').val('');
            $('#input-transfer-leader_email').val('');
        }
    });
});
</script>