<?php

namespace App\Http\Controllers\office\strategic;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;

use App\Models\ExchangeRate;
use App\Models\OilRate;

class SettingsController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        
        $t = $request->input('t');
        $pr = $request->input('pr');

        if($t == 'exchange'){

            $infos = ExchangeRate::where('is_deleted', '0')->where('is_active','1')->orderBy('period', 'DESC')->get();

        }elseif($t == 'oilprice'){

            $infos = OilRate::where('is_deleted', '0')->where('is_active','1')->orderBy('period', 'DESC')->get();
        }


        $arr = ['infos','t','pr'];

        // display
        $file = 'default.office.strategic.settings.'.$t.'.index';

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

        $arr = ['t','pr'];

        // display
        $file = 'default.office.strategic.settings.'.$t.'.add';

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

            if($data['group_type'] == 'exchange'){
            
                $result = ExchangeRate::inserRow($data , true);

            }elseif($data['group_type'] == 'oilprice'){

                $result = OilRate::inserRow($data , true);

            }else{


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
        $t = $request->input('t');
        $pr = $request->input('pr');

        if($t == 'exchange'){

            $info = ExchangeRate::find((int) $id);

        }elseif($t == 'oilprice'){

            $info = OilRate::find((int) $id);
        }

        $arr = ['t','pr','info' , 'id'];

        // display
        $file = 'default.office.strategic.settings.'.$t.'.edit';

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

            if($data['group_type'] == 'exchange'){
            
                $$result = ExchangeRate::updateRow($data, $id);

            }elseif($data['group_type'] == 'oilprice'){

                $result = OilRate::updateRow($data, $id);

            }else{


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

        if($t == 'exchange'){

            $process = ExchangeRate::deleteRow($id);

        }elseif($t == 'oilprice'){

            $process = OilRate::deleteRow($id);
        }

        return redirect()->back();
    }
}
