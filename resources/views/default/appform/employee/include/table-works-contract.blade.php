
<div class="row">
    <div class="col-md-12 mb-3 text-right">
        <button class="btn btn-primary btn-action-add" type="button" data-original-title="contract" data-id="0"><i class="mdi mdi-file-plus-outline" ></i> เพิ่ม ข้อมูลการต่อสัญญา</button>
    </div>
    <div class="col-md-12">
        <table id="datatable-contract" class="table table-bordered  table-striped  dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr class="bg-dark text-white">
                    <th >ลำดับ</th>
                    <th>ตำแหน่ง</th>
                    <th>ตำแหน่งเลขที่</th>
                    <th>วันที่ต่อสัญญา</th>
                    <th>วันที่เริ่มสัญญา</th>
                    <th>วันที่สิ้นสุดสัญญา</th>
                    <th>ไฟล์เอกสาร</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php $noContracts = 0;?>
                @if (!empty($dutyContracts))
                @foreach ($dutyContracts as $dutyContracts)
                <?php $noContracts++;?>
                    <tr>
                        <td class="align-middle" width="8%">{{$noContracts}}</td>
                        <td class="align-middle">{{$dutyContracts['position']}}</td>
                        <td class="align-middle" width="10%">{{$dutyContracts['government_number']}}</td>
                        <td class="align-middle" width="15%">{{getDateTimeTH($dutyContracts['contracts_date'] , false)}}</td>
                        <td class="align-middle" width="15%">{{getDateTimeTH($dutyContracts['date_start'] , false)}}</td>
                        <td class="align-middle" width="15%">{{$dutyContracts['date_end']}}</td>
                        <td class="align-middle" style="width:10%"> @if($dutyContracts['contracts_file'] != NULL) <a href="{{url('')}}/{{$dutyContracts['contracts_file']}}" class="btn btn-outline-warning waves-effect width-md waves-light btn-sm" target="_blank"><i class="mdi mdi-file-download-outline">ดาวน์โหลด</i> </a> @endif</td>
                        <td style="width: 10%">
                            <select name="input_action" class="form-control btn-action">
                                <option value="">เลือก</option>
                                {{-- <option value="view" data-original-title="works" data-id="{{$dutyDetails['id']}}">ดูรายละเอียด</option> --}}
                                <option value="edit" data-original-title="contract" data-id="{{$dutyContracts['id']}}">แก้ไข</option>
                                <option value="delete" data-original-title="contract" data-id="{{$dutyContracts['id']}}">ลบ</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


<div id="con-close-modal-contract" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 85%;">
        <form action="{{url('appform/sub/save')}}" method="POST" name="frm-contract-save" id="frm-contract-save" enctype="multipart/form-data">
        <input type="hidden" name="action_name" value="contract">
        <input type="hidden" name="edit_id" id="input-contract-edit_id"  value="0">    
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ข้อมูลการต่อสัญญา</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duty_id">ตำแหน่ง </label>
                            <select name="input[duty_id]" class="form-control" id="input-contract-duty_id" style="height: 45px;">
                                <option value="">--เลือก--</option>
                                @if (!empty($dutyDetail))
                                @foreach ($dutyDetail as $RowdutyDetail)
                                    <option value="{{$RowdutyDetail['id']}}">{{$RowdutyDetail['position']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="government_number">ตำแหน่งเลขที่ </label>
                            <input type="text" class="form-control" name="input[government_number]" id="input-contract-government_number" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่ต่อสัญญา </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-contract-contracts_date" placeholder="วว/ดด/ปปปป"  name="input[contracts_date]" value="{{getDateFormatToInputThai(date("Y-m-d"))}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contracts_file">แนบไฟล์ </label>
                            <input type="file" class="filestyle" name="upfile_contract" id="input-contract-contracts_file" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่เริ่มสัญญา </label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-contract-date_start" placeholder="วว/ดด/ปปปป"  name="input[date_start]" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">วันที่สิ้นสุดสัญญา <code>(กรณีถึงปัจจุบัน ไม่ต้องเลือกวันที่)</code></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker-autoclose" id="input-contract-date_end" placeholder="วว/ดด/ปปปป"  name="input[date_end]">
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
                            <label for="address">หมายเหตุ </label>
                            <textarea name="input[note]" class="form-control" id="input-contract-note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="input[user_id]" value="{{$id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-arrow-left"> ปิดหน้าต่าง</i></button>
                <button type="submit" id="button_contract" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save"> บันทึก</i></button>
            </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->



