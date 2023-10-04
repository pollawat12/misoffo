<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="benefits" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ข้อมูลการค่าตอบแทน</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-money" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th width="5%">ลำดับ</th>
                <th width="40%">ค่าตอบแทน</th>
                <th width="30%">จำนวนเงิน</th>
                <th width="8%">จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $nobenefits = 0;?>
            @if (!empty($benefits))
            @foreach ($benefits as $benefit)
            <?php $nobenefits++;?>
            <tr>
                <td class="align-middle" style="width: 8%">{{$nobenefits}}</td>
                <td class="align-middle">
                    <?php $prenames = \App\Models\DataSetting::find((int) $benefit->type_id); 
                        echo $prenames->name;
                    ?>
                </td>
                <td class="align-middle">{{$benefit->pay_sum}}</td>
                <td>
                    <select name="input_action" class="form-control btn-action">
                        <option value="">เลือก</option>
                        {{-- <option value="view" data-original-title="benefits" data-id="{{$benefit->id}}">ดูรายละเอียด</option> --}}
                        <option value="edit" data-original-title="benefits" data-id="{{$benefit->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="benefits" data-id="{{$benefit->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
    
</div>

<div id="con-close-modal-benefits" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-benefits-save" id="frm-benefits-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="benefits">

        <input type="hidden" name="edit_id" id="input-benefits-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ค่าตอบแทน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_start">ค่าตอบแทน </label>
                            <select name="input[type_id] " class="form-control" style="height: 45px;" id="input-benefits-type_id">
                            
                                <option value="">--เลือก--</option>
                                <?php $typebenefits = \App\Models\DataSetting::where('group_type','pay')->where('is_deleted', '0')->where('is_active','1')->get();
                                foreach ($typebenefits as $typebenefit){
                                ?>
                                <option value="{{$typebenefit->id}}">{{$typebenefit->name}}</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_end">จำนวนเงิน </label>
                            <input type="text" class="form-control" name="input[pay_sum]" id="input-benefits-pay_sum" placeholder="">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
                <input type="hidden" name="input[category_name]" id="input-category_name" value="pay">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_benefits" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->