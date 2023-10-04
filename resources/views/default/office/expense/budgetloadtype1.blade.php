@extends('default.layouts.load')

@section('css')

@endsection

@section('content')

<?php

    if(count($items) > 0){

?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="projects_id">ประเภทหัวข้อ </label>
                    <select name="input[projects_id_2]" id="projects_id_2" class="form-control" style="height: 45px;">
                        <option value="">--เลือก--</option>
                        <?php
                            if (!empty($items)) {
                                foreach ($items as $item) {
                        ?>
                                <option value="{{$item['id']}}">{{$item['name']}}</option>       
                        <?php
                        
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

<?php

    }
?>


@endsection

@section('js')

@endsection
