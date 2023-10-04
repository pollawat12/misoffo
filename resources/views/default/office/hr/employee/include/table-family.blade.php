<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="family" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่มข้อมูลบุคคลที่สามารถติดต่อได้</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-family" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th>ลำดับ</th>
                <th>ชื่อ - นามสกุล</th>
                <th>ความสัมพันธ์</th>
                <th>เบอร์โทรศัทพ์</th>
                <th>จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $noFamily = 0;?>
            @if (!empty($families))
            @foreach ($families as $family)
            <?php $noFamily++;?>
            <tr>
                <td class="align-middle" style="width:5%">{{$noFamily}}</td>
                <td class="align-middle">{{$family->firstname}} {{$family->lastname}}</td>
                <td class="align-middle" style="width:20%">{{getRelation($family->relation_type)}}</td>
                <td class="align-middle" style="width:20%">{{$family->tax_no}}</td>
                <td style="width:10%">
                    <select name="input_action" class="form-control btn-action">
                        <option value="">เลือก</option>
                        {{-- <option value="view" data-original-title="family" data-id="{{$family->id}}">ดูรายละเอียด</option> --}}
                        <option value="edit" data-original-title="family" data-id="{{$family->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="family" data-id="{{$family->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>

<div id="con-close-modal-family" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-family-save" id="frm-family-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="family">

        <input type="hidden" name="edit_id" id="input-family-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลครอบครัว</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">ชื่อ </label>
                            <input type="text" class="form-control" name="input[firstname]" id="input-family-firstname" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">นามสกุล </label>
                            <input type="text" class="form-control" name="input[lastname]" id="input-family-lastname" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="card_no">รหัสบัตรประชาชน </label>
                            <input type="text" class="form-control" name="input[card_no]" id="input-family-card_no" placeholder="" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php $relation = getRelation(); ?>
                            <label for="relation_type">ความสัมพันธ์ </label>
                            <select name="input[relation_type]" class="form-control" id="input-family-relation_type" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @foreach($relation as $keyRelation => $valRelation)
                                    <option value="{{$keyRelation}}" >{{$valRelation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tax_no">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="input[tax_no]" id="input-family-tax_no" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="input-family-is_present" name="input[is_present]" type="checkbox" value="1">
                                <label for="input-family-is_present">
                                    ตามที่อยู่ในทะเบียนบ้าน (ตามเจ้าหน้าที่)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contact_info">ที่อยู่  </label>
                            <textarea name="input[contact_info]" class="form-control" id="input-family-contact_info" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_family" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

<script>
    $(function(){
        
        $("#input-family-is_present").on("click", function() {
        if($('#input-family-is_present:checked').length){
            $('#input-family-contact_info').attr('disabled','disabled');
        }else{
            $('#input-family-contact_info').removeAttr('disabled');
        }
    });
});
</script>