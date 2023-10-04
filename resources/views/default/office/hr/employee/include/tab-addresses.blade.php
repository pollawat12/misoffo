<form action="{{url('office/hr/employees/sub/save/')}}" method="POST" name="frm-addresses-save" id="frm-addresses-save" enctype="multipart/form-data">
    <input type="hidden" name="action_name" value="addresses">
    <input type="hidden" name="input[user_id]" value="{{$id}}">
    <p>
        <?php $AddressesCount = $addresses->count(); ?>
        @if ($AddressesCount > 0)
            <?php foreach ($addresses as $addresse); ?>
                <input type="hidden" name="edit_id" value="{{$addresse['id']}}">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ที่อยู่ในทะเบียนบ้าน</i> </h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่ </label>
                                        <textarea name="input[address]" class="form-control" id="input-area_process" cols="30" rows="4">{{$addresse['address']}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $provinces = \App\Models\Province::get();
                                        ?>
                                        <label for="province_no">จังหวัด </label>
                                        <select name="input[province_no]" id="province_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (!empty($provinces))
                                                @foreach ($provinces as $province)
                                                    <option value="{{$province['PROVINCE_ID']}}" @if($province['PROVINCE_ID'] == $addresse['province_no']) selected @endif>{{$province['PROVINCE_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $amphurs = \App\Models\Amphur::where(['PROVINCE_ID' => (int) $addresse['province_no']])->orderBy('AMPHUR_NAME', 'asc')->get();
                                        ?>
                                        <label for="district_no">อำเภอ </label>
                                        <select name="input[district_no]" id="district_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (!empty($amphurs))
                                                @foreach ($amphurs as $amphur)
                                                    <option value="{{$amphur['AMPHUR_ID']}}" @if($amphur['AMPHUR_ID'] == $addresse['district_no']) selected @endif>{{$amphur['AMPHUR_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $subdistricts = \App\Models\District::where(['AMPHUR_ID' => (int) $addresse['district_no']])->orderBy('DISTRICT_NAME', 'asc')->get();
                                        ?>
                                        <label for="subdistrict_no">ตำบล </label>
                                        <select name="input[subdistrict_no]" id="subdistrict_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (!empty($subdistricts))
                                                @foreach ($subdistricts as $subdistrict)
                                                    <option value="{{$subdistrict['DISTRICT_ID']}}" @if($subdistrict['DISTRICT_ID'] == $addresse['subdistrict_no']) selected @endif>{{$subdistrict['DISTRICT_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode">รหัสไปรษณีย์ </label>
                                        <span id="zipcode">
                                            <input type="text" class="form-control" name="input[zipcode]" placeholder="" value="{{$addresse['zipcode']}}">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ที่อยู่ปัจจุบัน</i> </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="input-is_present" name="input[is_present]" type="checkbox" @if(2 == $addresse['is_present']) checked @endif value="2">
                                            <label for="input-is_present">
                                                ตามที่อยู่ในทะเบียนบ้าน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่ </label>
                                        <textarea name="input[address_present]" class="form-control" id="area_process" cols="30" rows="4" @if(2 == $addresse['is_present']) disabled @endif>@if(2 == $addresse['is_present']) {{$addresse['address']}} @else {{$addresse['address_present']}} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_no_present">จังหวัด </label>
                                        <select name="input[province_no_present]" id="province_no_present" class="form-control" style="height: 45px;" @if(2 == $addresse['is_present']) disabled @endif>
                                            <option value="">--เลือก--</option>
                                            @if (!empty($provinces))
                                                @foreach ($provinces as $province_present)
                                                    <option value="{{$province_present['PROVINCE_ID']}}" @if(2 == $addresse['is_present']) @if($province_present['PROVINCE_ID'] == $addresse['province_no']) selected @endif @else @if($province_present['PROVINCE_ID'] == $addresse['province_no_present']) selected @endif @endif >{{$province_present['PROVINCE_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_no_present">อำเภอ </label>
                                        <?php 
                                            if(2 == $addresse['is_present']){
                                                $amphurs_p = $amphurs;
                                            }else{  
                                                $amphurs_p = \App\Models\Amphur::where(['PROVINCE_ID' => (int) $addresse['province_no_present']])->orderBy('AMPHUR_NAME', 'asc')->get();
                                            }
                                       ?>
                                        <select name="input[district_no_present]" id="district_no_present" class="form-control" style="height: 45px;" @if(2 == $addresse['is_present']) disabled @endif>
                                            <option value="">--เลือก--</option>
                                            @if (!empty($amphurs_p))
                                                @foreach ($amphurs_p as $amphur_present)
                                                    <option value="{{$amphur_present['AMPHUR_ID']}}"  @if(2 == $addresse['is_present']) @if($amphur_present['AMPHUR_ID'] == $addresse['district_no']) selected @endif @else @if($amphur_present['AMPHUR_ID'] == $addresse['district_no_present']) selected @endif @endif>{{$amphur_present['AMPHUR_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subdistrict_no_present">ตำบล </label>
                                        <?php 
                                            if(2 == $addresse['is_present']){
                                                $subdistricts_p = $subdistricts;
                                            }else{
                                                $subdistricts_p = \App\Models\District::where(['AMPHUR_ID' => (int) $addresse['district_no_present']])->orderBy('DISTRICT_NAME', 'asc')->get();
                                            }
                                            
                                        ?>
                                        <select name="input[subdistrict_no_present]" id="subdistrict_no_present" class="form-control" style="height: 45px;" @if(2 == $addresse['is_present']) disabled @endif>
                                            <option value="">--เลือก--</option>
                                            
                                            @if (!empty($subdistricts_p))
                                                @foreach ($subdistricts_p as $subdistrict_present)
                                                    <option value="{{$subdistrict_present['DISTRICT_ID']}}" @if(2 == $addresse['is_present'])  @if($subdistrict_present['DISTRICT_ID'] == $addresse['subdistrict_no']) selected @endif @else  @if($subdistrict_present['DISTRICT_ID'] == $addresse['subdistrict_no_present']) selected @endif @endif>{{$subdistrict_present['DISTRICT_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode_present">รหัสไปรษณีย์ </label>
                                        <span id="zipcode_present">
                                            <input type="text" class="form-control" name="input[zipcode_present]" id="zipcode_present_check" placeholder="" value="@if(2 == $addresse['is_present']) {{$addresse['zipcode']}} @else {{$addresse['zipcode_present']}} @endif" @if(2 == $addresse['is_present']) disabled @endif>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="button_addresses" class="btn btn-primary"><i class="mdi mdi-database-plus"></i><br>&nbsp;บันทึก</button>
                        <a href="{{URL('office/hr/employees')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-reverse-outline
                    "></i><br>&nbsp; ยกเลิก</a>
                    </div>
                </div>
        @else
                <input type="hidden" name="edit_id" value="0">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ที่อยู่ในทะเบียนบ้าน</i> </h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่ </label>
                                        <textarea name="input[address]" class="form-control" id="input-area_process" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $provinces = \App\Models\Province::get();
                                        ?>
                                        <label for="province_no">จังหวัด </label>
                                        <select name="input[province_no]" id="province_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                            @if (!empty($provinces))
                                                @foreach ($provinces as $province)
                                                    <option value="{{$province['PROVINCE_ID']}}">{{$province['PROVINCE_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_no">อำเภอ </label>
                                        <select name="input[district_no]" id="district_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subdistrict_no">ตำบล </label>
                                        <select name="input[subdistrict_no]" id="subdistrict_no" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode">รหัสไปรษณีย์ </label>
                                        <span id="zipcode">
                                            <input type="text" class="form-control" name="input[zipcode]" placeholder="" value="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title mb-4"><i class="mdi mdi-file-document-box-plus" style="font-size: 16px !important; "> ที่อยู่ปัจจุบัน</i> </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="input-is_present" name="input[is_present]" type="checkbox" value="2">
                                            <label for="input-is_present">
                                                ตามที่อยู่ในทะเบียนบ้าน
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">ที่อยู่ </label>
                                        <textarea name="input[address_present]" class="form-control" id="area_process" cols="30" rows="4" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_no_present">จังหวัด </label>
                                        <select name="input[province_no_present]" id="province_no_present" class="form-control" style="height: 45px;" >
                                            <option value="">--เลือก--</option>
                                            @if (!empty($provinces))
                                                @foreach ($provinces as $province_present)
                                                    <option value="{{$province_present['PROVINCE_ID']}}">{{$province_present['PROVINCE_NAME']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_no_present">อำเภอ </label>
                                        <select name="input[district_no_present]" id="district_no_present" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subdistrict_no_present">ตำบล </label>
                                        <select name="input[subdistrict_no_present]" id="subdistrict_no_present" class="form-control" style="height: 45px;">
                                            <option value="">--เลือก--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode_present">รหัสไปรษณีย์ </label>
                                        <span id="zipcode_present">
                                            <input type="text" class="form-control" name="input[zipcode_present]" id="zipcode_present_check" placeholder="" value="" >
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="button_addresses" class="btn btn-primary"><i class="mdi mdi-database-plus"></i><br>&nbsp;บันทึก</button>
                        <a href="{{URL('office/hr/employees')}}"  class="btn btn-secondary"><i class=" mdi mdi-backspace-reverse-outline
                    "></i><br>&nbsp; ยกเลิก</a>
                    </div>
                </div>
        @endif
    </p>
</form>

<div data-url="{{URL('/')}}" id="base-url-api"></div>

<script>
$(function(){
    
    $(document).on("change", "#province_no", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=province&id=" + _itemValue;

        $("#subdistrict_no").html('<option value="">--เลือก--</option>');
        $("#zipcode").html('<input type="text" class="form-control" name="input[zipcode]" placeholder="">');
        $.get(_url, function(data){
            $("#district_no").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#district_no", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=district&id=" + _itemValue;

        $("#zipcode").html('<input type="text" class="form-control" name="input[zipcode]" placeholder="">');
        $.get(_url, function(data){
            $("#subdistrict_no").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#subdistrict_no", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=subdistrict&id=" + _itemValue;

        $.get(_url, function(data){
            $("#zipcode").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#province_no_present", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=province&id=" + _itemValue;

        $("#subdistrict_no_present").html('<option value="">--เลือก--</option>');
        $("#zipcode_present").html('<input type="text" class="form-control" name="input[zipcode_present]" placeholder="">');
        $.get(_url, function(data){
            $("#district_no_present").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#district_no_present", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=district&id=" + _itemValue;

        $("#zipcode_present").html('<input type="text" class="form-control" name="input[zipcode_present]" placeholder="">');
        $.get(_url, function(data){
            $("#subdistrict_no_present").html(data.elem_html);
        }, "json");
    });

    $(document).on("change", "#subdistrict_no_present", function(){
        var _itemValue = $(this).val();
        var _url = $("#base-url-api").attr("data-url") + "/office/hr/employees/get/addresses/?t=subdistrict_p&id=" + _itemValue;

        $.get(_url, function(data){
            $("#zipcode_present").html(data.elem_html);
        }, "json");
    });

    $("#input-is_present").on("click", function() {
        if($('#input-is_present:checked').length){
            $('#area_process').attr('disabled','disabled');
            $('#province_no_present').attr('disabled','disabled');
            $('#district_no_present').attr('disabled','disabled');
            $('#subdistrict_no_present').attr('disabled','disabled');
            $('#zipcode_present_check').attr('disabled','disabled');
        }else{
            $('#area_process').removeAttr('disabled');
            $('#province_no_present').removeAttr('disabled');
            $('#district_no_present').removeAttr('disabled');
            $('#subdistrict_no_present').removeAttr('disabled');
            $('#zipcode_present_check').removeAttr('disabled');
        }
    });
});
</script>