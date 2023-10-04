<div class="row">
    <div class="col-md-12 mb-3 text-right">
        {{-- <a href="{{URL('office/hr/leave/add')}}/{{$id}}"> <button class="btn btn-secondary" type="button" data-original-title="experience" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ยื่นใบลา</button></a> --}}
        {{-- <button class="btn btn-primary btn-action-add" type="button" data-original-title="leave" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ยื่นใบลา</button> --}}
    </div>
    <div class="col-md-12">
        <table id="datatable-leave" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th style="width: 5%">ลำดับ</th>
                <th style="width: 20%">วันที่ยื่นใบลา</th>
                <th style="width: 20%">ประเภทการลา</th>
                <th style="width: 10%">จำนวนวันลา</th>
                <th style="width: 20%">วันที่เริ่มลา</th>
                <th style="width: 20%">วันที่สิ้นสุด</th>
                <th style="width: 15%">สถานะการอนุมัติ</th>
                {{-- <th style="width: 15%">จัดการ</th> --}}
            </tr>
        </thead>

        <tbody>
            <?php $noLeave = 0;?>
            @if (!empty($Leave))
            @foreach ($Leave as $Leaves)
            <?php $noLeave++;?>
            <tr>
                <td class="align-middle">{{$noLeave}}</td>
                <td class="align-middle">{{getDateTimeTH($Leaves['date_resign'])}}</td>
                <td class="align-middle">{{$Leaves['leave_type']}}</td>
                <td class="align-middle">
                    <?php
                        echo round((strtotime($Leaves['date_end']) - strtotime($Leaves['date_start']))/60/60/24) + 1;
                    ?>
                </td>
                <td class="align-middle">{{getDateTimeTH($Leaves['date_start'] , false)}}</td>
                <td class="align-middle">{{getDateTimeTH($Leaves['date_end'] , false)}}</td>
                <td class="align-middle">@if($Leaves['is_approved'] == '1') อนมุัติ @elseif($Leaves['is_approved'] == '2') ไม่อนมุัติ @endif</td>
                {{-- <td class="align-middle">
                    <select name="input_action" class="form-control btn-action" >
                        <option value="">เลือก</option>
                        <option value="view" data-original-title="experience" data-id="{{$experience->id}}">ดูรายละเอียด</option>
                        <option value="edit" data-original-title="leave" data-id="{{$Leaves['id']}}">แก้ไข</option>
                        <option value="delete" data-original-title="leave" data-id="{{$Leaves['id']}}">ลบ</option>
                    </select>
                </td> --}}
            </tr>
            @endforeach
            @endif
            
        </tbody>
    </table>
    </div>
</div>

<div id="con-close-modal-leave" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('appform/sub/save')}}" method="POST" name="frm-leave-save" id="frm-leave-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="leave">

        <input type="hidden" name="edit_id" id="input-leave-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ยื่นใบลา (ระเบียบการลา)</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="leave_type">ประเภทการลา </label>
                            <?php 
                            $categoryLeave = \App\Models\DataSetting::where('group_type', "leave")->where('is_deleted', '0')->where('is_active','1')->get();
                            ?>
                            <select name="input[leave_type]" id="input-leave-leave_type" class="form-control" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @if (count($categoryLeave) > 0)
                                @foreach($categoryLeave as $key => $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_resign">วันที่กรอก </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-leave-date_resign" placeholder="วว/ดด/ปปปป"  name="input[date_resign]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_start">วันที่เริ่ม </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-leave-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_end">วันที่สิ้นสุด </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-leave-date_end" placeholder="วว/ดด/ปปปป"  name="input[date_end]">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note">หมายเหตุ  </label>
                            <textarea name="input[note]" class="form-control" id="input-leave-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_leave" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->