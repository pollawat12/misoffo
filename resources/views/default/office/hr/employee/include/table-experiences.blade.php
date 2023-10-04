<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="experience" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ข้อมูลประสบการณ์ทำงาน</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-experience" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th>ลำดับ</th>
                <th >ชื่อหน่วยงาน</th>
                <th>ตำแหน่ง</th>
                <th>เงินเดือน</th>
                <th>วันที่เริมทำงาน</th>
                <th>วันที่สิ้นสุดทำงาน</th>
                <th>จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $noExperiences = 0;?>
            @if (!empty($experiences))
            @foreach ($experiences as $experience)
            <?php $noExperiences++;?>
            <tr>
                <td class="align-middle" style="width:5%">{{$noExperiences}}</td>
                <td class="align-middle">{{$experience->company}}</td>
                <td class="align-middle">{{$experience->position}}</td>
                <td class="align-middle">{{$experience->salary}}</td>
                <td class="align-middle" style="width: 12%;">{{getDateTimeTH($experience->date_start , false)}}</td>
                <td class="align-middle" style="width: 12%;">@if($experience->date_end == NULL) ถึงปัจจุบัน @else {{getDateTimeTH($experience->date_end , false)}} @endif</td>
                <td style="width:10%">
                    <select name="input_action" class="form-control btn-action">
                        <option value="">เลือก</option>
                        {{-- <option value="view" data-original-title="experience" data-id="{{$experience->id}}">ดูรายละเอียด</option> --}}
                        <option value="edit" data-original-title="experience" data-id="{{$experience->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="experience" data-id="{{$experience->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>

<div id="con-close-modal-experience" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-experience-save" id="frm-experience-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="experience">

        <input type="hidden" name="edit_id" id="input-experience-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลประสบการณ์ทำงาน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="company">ชื่อหน่วยงาน <code>*</code></label>
                            <input type="text" class="form-control" name="input[company]" id="input-experience-company" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">ที่อยู่หน่วยงาน </label>
                            <textarea name="input[address]" class="form-control" id="input-experience-address" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">เงินเดือน </label>
                            <input type="text" class="form-control" name="input[salary]" id="input-experience-salary" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">ตำแหน่ง </label>
                            <input type="text" class="form-control" name="input[position]" id="input-experience-position" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="job_description">รายละเอียดงาน  </label>
                            <textarea name="input[job_description]" class="form-control" id="input-experience-job_description" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่เริ่มทำงาน <code>*</code></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-experience-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
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
                                    <input type="text" class="form-control datepicker-autoclose" id="input-experience-date_end" placeholder="วว/ดด/ปปปป"  name="input[date_end]">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_experience" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

