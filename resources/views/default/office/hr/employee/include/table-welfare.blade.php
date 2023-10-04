<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="welfare" data-id="0"><i class="mdi mdi-file-plus-outline"></i> เพิ่ม ข้อมูลสวัสดิการ</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-money" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

        <thead>
            <tr class="bg-dark text-white">
                <th width="5%">ลำดับ</th>
                <th width="40%">สวัสดิการ</th>
                <th width="30%">จำนวนเงิน</th>
                <th width="8%">จัดการ</th>
            </tr>
        </thead>


        <tbody>
            <?php $nowelfare = 0;?>
            @if (!empty($welfares))
            @foreach ($welfares as $welfare)
            <?php $nowelfare++;?>
            <tr>
                <td class="align-middle" style="width: 8%">{{$nowelfare}}</td>
                <td class="align-middle">
                    <?php $prenames = \App\Models\DataSetting::find((int) $welfare->type_id); 
                        echo $prenames->name;
                    ?>
                </td>
                <td class="align-middle">
                <?php if($welfare->type_id == 790){
                    if($welfare->pay_sum < 17000){
                        $vat = ($welfare->pay_sum * 3) / 100;
    
                        $sum = ($welfare->pay_sum) / 100;

                    }else{
                        $Fund = \App\Models\BudgetsrFund::where('behavior_id',$welfare->type_id)->where('value_min', '<=',  $welfare->pay_sum)
                                                         ->where('value_max', '>=',  $welfare->pay_sum)
                                                         ->where('is_deleted', '0')
                                                         ->where('is_active','1')->first(); 
                        

                        $vat = ($welfare->pay_sum * 3) / 100;
    
                        $sum = ($welfare->pay_sum * $Fund->value_percent) / 100;
                    }
                    

                    $total = $sum + $vat;

                    echo 'เงินเดือน : '.number_format($welfare->pay_sum,2,'.',',').' หัก 3 % :'.number_format($vat,2,'.',',').' เงินสมทบทางองค์กร : '.number_format($sum,2,'.',',').' รวม : '.number_format($total,2,'.',',');

                }else{

                    echo $welfare->pay_sum;
                } 
                
                ?></td>
                <td>
                    <select name="input_action" class="form-control btn-action">
                        <option value="">เลือก</option>
                        {{-- <option value="view" data-original-title="welfare" data-id="{{$welfare->id}}">ดูรายละเอียด</option> --}}
                        <option value="edit" data-original-title="welfare" data-id="{{$welfare->id}}">แก้ไข</option>
                        <option value="delete" data-original-title="welfare" data-id="{{$welfare->id}}">ลบ</option>
                    </select>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>

</div>

<div id="con-close-modal-welfare" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 50%;">
        <form action="{{url('office/hr/employees/sub/save')}}" method="POST" name="frm-welfare-save" id="frm-welfare-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="welfare">

        <input type="hidden" name="edit_id" id="input-welfare-edit_id"  value="0">  

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">สวัสดิการ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_start">สวัสดิการ </label>
                            <select name="input[type_id] " class="form-control" style="height: 45px;" id="input-welfare-type_id">
                            
                                <option value="">--เลือก--</option>
                                <?php $typewelfares = \App\Models\DataSetting::where('group_type','welfare')->where('is_deleted', '0')->where('is_active','1')->get();
                                foreach ($typewelfares as $typewelfare){
                                ?>
                                <option value="{{$typewelfare->id}}">{{$typewelfare->name}}</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary_end">จำนวนเงิน </label>
                            <input type="text" class="form-control" name="input[pay_sum]" id="input-welfare-pay_sum" placeholder="">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="input[user_id]" value="{{$id}}">
                <input type="hidden" name="input[category_name]" id="input-category_name" value="welfare">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_welfare" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->