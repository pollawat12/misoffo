<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="money" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ข้อมูลการปรับเงินเดือน</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-money" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th width="5%">ลำดับ</th>
                <th width="8%">วันที่ปรับเงินเดือน</th>
                <th width="8%">คะแนนประเมิน</th>
                <th width="8%">ร้อยละที่ได้เลื่อน</th>
                <th width="8%">ระดับผลการประเมิน</th>
                <th width="8%">เงินเดือนก่อนปรับ</th>
                <th width="8%">เงินเดือนที่ได้รับ</th>
                <th width="8%">สถานะ</th>
                <th width="10%">จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $noEvaluations = 0;?>
            @if (!empty($evaluations))
            @foreach ($evaluations as $evaluation)
            <?php $noEvaluations++;?>
            <tr>
                <td class="align-middle" style="width: 8%">{{$noEvaluations}}</td>
                <td class="align-middle">{{getDateTimeTH($evaluation->date_start , false)}}</td>
                <td class="align-middle">{{$evaluation->result_eval}}</td>
                <td class="align-middle">{{$evaluation->salary_div}}</td>
                <td class="align-middle" style="width: 10%">@if ($evaluation->salary_number == 1) ปรับปรุง @elseif($evaluation->salary_number == 2) พอใช้  @elseif($evaluation->salary_number == 3) ดี @elseif($evaluation->salary_number == 4) ดีมาก @elseif($evaluation->salary_number == 5) ดีเด่น @else  @endif </td>
                <td class="align-middle">{{number_format($evaluation->salary_start,2,'.',',')}} </td>
                <td class="align-middle">{{number_format($evaluation->salary_sum,2,'.',',')}} </td>
                <td class="align-middle" style="width: 10%">@if ($evaluation->is_approved == 0) อนุมัติ @elseif($evaluation->is_approved == 1) ไม่อนุมัติ  @else  @endif </td>
                <td>
                    <select name="input_action" class="form-control btn-action">
                        <option value="">เลือก</option>
                        <option value="viewmoney" data-original-title="money" data-id="{{$evaluation->id}}">ปริ๊นใบเงินเดือน</option>
                        <option value="edit" data-original-title="money" data-id="{{$evaluation->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="money" data-id="{{$evaluation->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>

<div id="con-close-modal-money" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-money-save" id="frm-money-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="money">

        <input type="hidden" name="edit_id" id="input-money-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลการปรับเงินเดือน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dob">วันที่ปรับเงินเดือน </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-money-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="result_eval">คะแนนประเมิน</label>
                            <input type="text" class="form-control" name="input[result_eval]" id="input-money-result_eval" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="salary_div">ร้อยละที่ได้เลื่อน</label>
                            <input type="text" class="form-control" name="input[salary_div]" id="input-money-salary_div" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="salary_number">ระดับผลการประเมิน <code>*</code></label>
                            <select name="input[salary_number] " class="form-control" style="height: 45px;" id="input-money-salary_number">
                                <option value="0">--เลือก--</option>
                                <option value="5">ดีเด่น</option>
                                <option value="4">ดีมาก</option>
                                <option value="3">ดี</option>
                                <option value="2">พอใช้</option>
                                <option value="1">ปรับปรุง</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_start">เงินเดือนก่อนปรับ </label>
                            <input type="text" class="form-control" name="input[salary_start]" id="input-money-salary_start" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_end">เงินที่ได้เลื่อน </label>
                            <input type="text" class="form-control" name="input[salary_end]" id="input-money-salary_end" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_end"> เงินเดือนปัจจุบันที่ได้รับ </label>
                            <input type="text" class="form-control" name="input[salary_sum]" id="input-money-salary_sum" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_approved">สถานะ <code>*</code></label>
                            <select name="input[is_approved] " class="form-control" style="height: 45px;" id="input-money-is_approved">
                                <option value="">--เลือก--</option>
                                <option value="0">อนุมัติ</option>
                                <option value="1">ไม่อนุมัติ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note">หมายเหตุ </label>
                            <textarea name="input[note]" class="form-control" id="input-money-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_money" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->