<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="educations" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ข้อมูลการศึกษา</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-educations" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th >ลำดับ</th>
                <th >ระดับการศึกษา</th>
                <th >สถาบัน</th>
                <th >คณะ</th>
                <th >สาขา</th>
                <th >ไฟล์เอกสาร</th>
                <th >จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $noEducations = 0;?>
            @if (!empty($educations))
            @foreach ($educations as $education)
            <?php $noEducations++;?>
            <tr>
                <td class="align-middle" style="width:2%">{{$noEducations}}</td>
                <td class="align-middle" style="width:10%">{{getEducationDegree($education->degress_no)}}</td>
                <td class="align-middle" style="width:10%">{{$education->institute_name}}</td>
                <td class="align-middle" style="width:10%">{{$education->faculty_name}}</td>
                <td class="align-middle" style="width:10%">{{$education->education_branch}} </td>
                <td class="align-middle" style="width:10%"> @if($education->education_file != NULL) <a href="{{url('')}}/{{$education->education_file}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลด</i> </a> @endif</td>
                <td style="width:8%">
                    <select name="input_action" class="form-control btn-action" >
                        <option value="">เลือก</option>
                        {{-- <option value="view" data-id="">ดูรายละเอียด</option> --}}
                        <option value="edit" data-original-title="educations" data-id="{{$education->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="educations" data-id="{{$education->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>


<div id="con-close-modal-educations" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-educations-save" id="frm-educations-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="educations">

        <input type="hidden" name="edit_id" id="input-educations-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลการศึกษา</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php $EducationDegree = getEducationDegree(); ?>
                            <label for="degress_no">ระดับการศึกษา </label>
                            <select name="input[degress_no]" class="form-control" id="input-educations-degress_no" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @foreach($EducationDegree as $keyEducationDegree => $valEducationDegree)
                                    <option value="{{$keyEducationDegree}}">{{$valEducationDegree}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institute_name">สถาบัน </label>
                            <input type="text" class="form-control" name="input[institute_name]" id="input-educations-institute_name" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_name">คณะ </label>
                            <input type="text" class="form-control" name="input[faculty_name]" id="input-educations-faculty_name" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="education_branch">สาขา </label>
                            <input type="text" class="form-control" name="input[education_branch]" id="input-educations-education_branch" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="education_degree">วุฒิการศึกษา </label>
                            <input type="text" class="form-control" name="input[education_degree]" id="input-educations-education_degree" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="faculty_name">แนบไฟล์วุฒิการศึกษา </label>
                            <input type="file" class="filestyle" name="upfile_education" id="input-educations-education_file" placeholder="" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">ปีที่เริ่มศึกษา </label>
                            <input type="text" class="form-control" name="input[year_start]" id="input-educations-year_start" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">ปีที่จบการศึกษา </label>
                            <input type="text" class="form-control" name="input[year_end]" id="input-educations-year_end" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note">หมายเหตุ </label>
                            <textarea name="input[note]" class="form-control" id="input-educations-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_educations" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

