<?php

namespace App\Http\Controllers\Office\Strategic;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;

use App\Models\OilPrice;
use App\Models\OilPriceDetail;
use App\Models\DataSetting;

use DB;

class OilController extends Base
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        
        $t = $request->input('t');
        $pr = $request->input('pr');

        if($pr < '100'){

            if($pr == '6' || $pr == '7'){

                $infos = OilPrice::select(DB::raw('YEAR(oil_price_date) year'))->where('oil_price_type', $pr)->where('is_deleted', '0')->where('is_active','1')->groupby('year')->orderBy('year', 'DESC')->get();

                $arr = ['infos','t','pr'];

                // display
                $file = 'default.office.strategic.'.$t.'.title';

            }else{

                $infos = OilPrice::where('oil_price_type', $pr)->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_price_date', 'DESC')->get();

                $arr = ['infos','t','pr'];

                // display
                $file = 'default.office.strategic.'.$t.'.index';

            }
            
        }else{

            $infos = OilPrice::where('oil_price_type', $t)->whereYear('oil_price_date', '=', $pr)->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_price_date', 'DESC')->get();

            if($t == 6){

                $t = 'situation';

                $pr = '6';

                $arr = ['infos','t','pr'];
                // display
                $file = 'default.office.strategic.'.$t.'.index';
                
            }elseif($t == 7){

                $t = 'supply';

                $pr = '7';

                $arr = ['infos','t','pr'];
                // display
                $file = 'default.office.strategic.'.$t.'.index';
            }
            
        }

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        if($pr == '1'){
            
            $oilType = DataSetting::where('group_type', "oilType")->where('data_value', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilType'];

        }elseif($pr == '2'){

            $oilCategory = DataSetting::where('group_type', "oilCategory")->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilCategory'];

        }elseif($pr == '3'){

            $arr = ['t','pr'];

        }elseif($pr == '4'){

            $oilType = DataSetting::where('group_type', "oilType")->where('data_value', '1')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilType'];

        }elseif($pr == '5'){

            $oilGroup = DataSetting::where('group_type', "oilGroup")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilGroup'];

        }elseif($pr == '6'){

            $oilGroup = DataSetting::where('group_type', "situation")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilGroup'];

        }elseif($pr == '7'){

            $domestic = DataSetting::where('group_type', "domestic")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $portage = DataSetting::where('group_type', "portage")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $business = DataSetting::where('group_type', "business")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','domestic','portage','business'];

        }elseif($pr == '8'){

            $oilType = DataSetting::where('group_type', "oils")->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilType'];
            
        }elseif($pr == '9'){

            $oilType = DataSetting::where('group_type', "lpg")->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilType'];
            
        }elseif($pr == '10'){

            $oilType = DataSetting::where('group_type', "lpgRetail")->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilType'];
            
        }

        
        // display
        $file = 'default.office.strategic.'.$t.'.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;
            
            $oil_max = $request->oil_max;
            $oil_min = $request->oil_min;

            if($data['parent_id'] == '3'){

                $data['oil_price_lpg_cargo'] = $data['oil_price_propane'] * 0.5 + $data['oil_price_butane'] * 0.5;
            }

            $result = OilPrice::inserRow($data , true);

            if($data['parent_id'] == '1'){

                $oilTypes = DataSetting::where('group_type', "oilType")->where('data_value', '0')->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '2'){

                $oilCategorys = DataSetting::where('group_type', "oilCategory")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilCategorys as $oilCategory){

                    $oilTypes = DataSetting::where('group_type', "oilType")->where('data_value', $oilCategory['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                    foreach($oilTypes as $oilType){
                        
                        $max = $oil_max[$oilType['id']];

                        $min = $oil_min[$oilType['id']];

                        $numoil = count($max);

                        for ($i=0; $i < $numoil; $i++) { 
                            // if($max[$i] != '' && $min[$i] != ''){
                                $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                            // }
                        }

                    }
                }
                
            }elseif($data['parent_id'] == '4'){

                $oilTypes = DataSetting::where('group_type', "oilType")->where('data_value', '1')->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '5'){

                $oilTypes = DataSetting::where('group_type', "oilGroup")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '6'){

                $oilTypes = DataSetting::where('group_type', "situation")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '7'){

                $domestic = DataSetting::where('group_type', "domestic")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($domestic as $domestics){

                    $max = $oil_max[$domestics['id']];

                    $min = $oil_min[$domestics['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $domestics['id'] , $domestics['data_value'] , $result);
                        // }
                    }
                }

                $portage = DataSetting::where('group_type', "portage")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($portage as $portages){

                    $maxP = $oil_max[$portages['id']];

                    $minP = $oil_min[$portages['id']];

                    $numoilP = count($maxP);

                    for ($iP=0; $iP < $numoilP; $iP++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$iP] , $min[$iP] , $data['parent_id'] , $portages['id'] , $portages['data_value'] , $result);
                        // }
                    }
                }


                $business = DataSetting::where('group_type', "business")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($business as $businesss){

                    $maxB = $oil_max[$businesss['id']];

                    $minB = $oil_min[$businesss['id']];

                    $numoilB = count($maxB);

                    for ($iB=0; $iB < $numoilB; $iB++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$iB] , $min[$iB] , $data['parent_id'] , $businesss['id'] , $businesss['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '8'){

                $oilTypes = DataSetting::where('group_type', "oils")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '9'){

                $oilTypes = DataSetting::where('group_type', "lpg")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }elseif($data['parent_id'] == '10'){

                $oilTypes = DataSetting::where('group_type', "lpgRetail")->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $max = $oil_max[$oilType['id']];

                    $min = $oil_min[$oilType['id']];

                    $numoil = count($max);

                    for ($i=0; $i < $numoil; $i++) { 
                        // if($max[$i] != '' && $min[$i] != ''){
                            $resultDetail = OilPriceDetail::inserRow($data['oil_price_date'] , $max[$i] , $min[$i] , $data['parent_id'] , $oilType['id'] , $oilType['data_value'] , $result);
                        // }
                    }
                }

            }
            

                
            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $info = OilPrice::find((int) $id);

        $t = $request->input('t');
        $pr = $request->input('pr');

        if($pr == '1' || $pr == '4' || $pr == '8' || $pr == '9' || $pr == '10'){

            $oilType = OilPriceDetail::where('oil_price_id', $id)->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();

            $arr = ['t','pr','oilType' , 'info' , 'id'];

        }elseif($pr == '2'){

            $oilCategory = DataSetting::where('group_type', "oilCategory")->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilCategory' , 'info' , 'id'];

        }elseif($pr == '3'){

            $arr = ['t','pr' , 'info' , 'id'];

        }elseif($pr == '5'){

            $oilGroup = DataSetting::where('group_type', "oilGroup")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilGroup' , 'info' , 'id'];

        }elseif($pr == '6'){

            $oilGroup = DataSetting::where('group_type', "situation")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','oilGroup' , 'info' , 'id'];

        }elseif($pr == '7'){

            $domestic = DataSetting::where('group_type', "domestic")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $portage = DataSetting::where('group_type', "portage")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $business = DataSetting::where('group_type', "business")->where('parent_id', '0')->where('is_deleted', '0')->where('is_active','1')->get();

            $arr = ['t','pr','domestic','portage','business' , 'info' , 'id'];

        }

        // display
        $file = 'default.office.strategic.'.$t.'.edit';

        return view($file, compact($arr))->render();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;  
            
            if($data['parent_id'] == '3'){

                $data['oil_price_lpg_cargo'] = $data['oil_price_propane'] * 0.5 + $data['oil_price_butane'] * 0.5;
            }

            $result = OilPrice::updateRow($data, $id);

            $oilTypes = OilPriceDetail::where('oil_price_id', $id)->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();
            if (!empty($oilTypes)){
                foreach($oilTypes as $oilType){

                    $max = $request->oil_max[$oilType['id']]; 
                    $min = $request->oil_min[$oilType['id']]; 
                    $resultDetail = OilPriceDetail::updateRow($data['oil_price_date'] , $max , $min , $data['parent_id'] , $oilType['oil_type'] , $oilType['oil_category'] , $oilType['id']);
                }
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $process = OilPrice::deleteRow($id);

        $oilTypes = OilPriceDetail::where('oil_price_id', $id)->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();
        if (!empty($oilTypes)){
            foreach($oilTypes as $oilType){
                $process = OilPriceDetail::deleteRow($oilType['id']);
            }
        }

        return redirect()->back();
    }
}
