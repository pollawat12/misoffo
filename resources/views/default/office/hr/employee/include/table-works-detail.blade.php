
<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="works" data-id="0"><i class="mdi mdi-file-plus-outline" ></i> เพิ่ม ข้อมูลการทำงาน</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-works" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr class="bg-dark text-white">
                    <th >ลำดับ</th>
                    <th >ฝ่าย</th>
                    <th >ตำแหน่ง</th>
                    <th >กลุ่มงาน</th>
                    <th>วันที่เริ่มทำงาน</th>
                    <th>วันที่สิ้นสุดการทำงาน</th>
                    <th >สถานะการทำงาน</th>
                    <th >จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php $noWork = 0;?>
                @if (!empty($dutyDetail))
                @foreach ($dutyDetail as $dutyDetails)
                <?php $noWork++;?>
                    <tr>
                        <td class="align-middle" width="5%">{{$noWork}}</td>
                        <td class="align-middle" width="15%">{{$dutyDetails['department']}}</td>
                        <td class="align-middle" width="15%">{{$dutyDetails['position']}}</td>
                        <td class="align-middle" width="15%">{{$dutyDetails['group_work']}}</td>
                        <td class="align-middle" style="width: 12%;">{{getDateTimeTH($dutyDetails['date_start'] , false)}}</td>
                        <td class="align-middle" style="width: 12%;">{{$dutyDetails['date_end']}}</td>
                        <td class="align-middle" width="10%">{{$dutyDetails['status_work']}}</td>
                        <td style="width: 10%">
                            <select name="input_action" class="form-control btn-action">
                                <option value="">เลือก</option>
                                {{-- <option value="view" data-original-title="works" data-id="{{$dutyDetails['id']}}">ดูรายละเอียด</option> --}}
                                <option value="edit" data-original-title="works" data-id="{{$dutyDetails['id']}}">แก้ไข</option>
                                <option value="delete" data-original-title="works" data-id="{{$dutyDetails['id']}}">ลบ</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


<div id="con-close-modal-works" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-works-save" id="frm-works-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="works">
        <input type="hidden" name="edit_id" id="input-works-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลการทำงาน</h4>
            </div>
            <div class="modal-body">
                <?php 
                    $departments = \App\Models\DataSetting::where('group_type','department')->where('is_deleted', '0')->where('is_active','1')->get();
                    $groups = \App\Models\DataSetting::where('group_type','group_work')->where('is_deleted', '0')->where('is_active','1')->get();
                    $positions = \App\Models\DataSetting::where('group_type','position')->where('is_deleted', '0')->where('is_active','1')->get();
                    $governments = \App\Models\DataSetting::where('group_type','government')->where('is_deleted', '0')->where('is_active','1')->get();
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php $EmployeeType = getEmployeeType(); ?>
                            <label for="contract_type">ประเภทการจ้าง </label>
                            <select name="input[contract_type]" class="form-control" id="input-works-contract_type" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                @foreach($EmployeeType as $keyEmployeeType => $valEmployeeType)
                                    <option value="{{$keyEmployeeType}}">{{$valEmployeeType}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="government_no">ระดับสำหรับข้าราชการ </label>
                            <select name="input[government_no]" class="form-control" id="input-works-government_no" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                @if (!empty($governments))
                                @foreach ($governments as $government)
                                    <option value="{{$government['id']}}">{{$government['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="department_no">ฝ่าย </label>
                            <select name="input[department_no]" class="form-control" id="input-works-department_no" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                @if (!empty($departments))
                                @foreach ($departments as $department)
                                    <option value="{{$department['id']}}">{{$department['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="group_no">กลุ่มงาน </label>
                            <select name="input[group_no]" class="form-control" id="input-works-group_no" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                @if (!empty($groups))
                                @foreach ($groups as $group)
                                    <option value="{{$group['id']}}">{{$group['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="position_no">ตำแหน่ง </label>
                            <select name="input[position_no]" class="form-control" id="input-works-position_no" style="height: 45px;">
                                <option value="0">--เลือก--</option>
                                @if (!empty($positions))
                                @foreach ($positions as $position)
                                    <option value="{{$position['id']}}">{{$position['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่เริ่มทำงาน </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-works-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่สิ้นสุดการทำงาน <code>(กรณีถึงปัจจุบัน ไม่ต้องเลือกวันที่)</code></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-works-date_end" placeholder="วว/ดด/ปปปป"  name="input[date_end]">
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
                            <label for="contract_type">สถานะการทำงาน </label>
                            <select name="input[status_work]" class="form-control" id="input-works-status_work" style="height: 45px;">
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
                            <label for="government_number">ตำแหน่งเลขที่ </label>
                            <input type="text" class="form-control" name="input[government_number]" id="input-works-government_number" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">หมายเหตุ </label>
                            <textarea name="input[note]" class="form-control" id="input-works-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" class="form-control datepicker-autoclose" id="input-works-date_resign" placeholder="วว/ดด/ปปปป"  name="input[date_resign]" >
                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_works" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->



