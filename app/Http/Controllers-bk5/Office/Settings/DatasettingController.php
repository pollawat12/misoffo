<?php

namespace App\Http\Controllers\Office\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Models\DataSetting;
use App\Models\PositionAction;

class DatasettingController extends Base 
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

        $items = DataSetting::getDataAll($t, $pr);

        $arr = ['items','t','pr'];

        // display
        $file = 'default.office.setting.'.$t.'.index';

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
        $file = 'default.office.setting.'.$t.'.add';

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

            $result = DataSetting::inserRow($data);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $info = DataSetting::find((int) $id);

        $arr = ['t','pr', 'id','info'];
        
        // display
        $file = 'default.office.setting.'.$t.'.edit';

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

            $result = DataSetting::updateRow($data, $id);

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
    public function destroy($id)
    {
        $process = DataSetting::deleteRow($id);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exports(Request $request)
    {
        
        $arr = [];

        // display
        $file = 'default.office.setting.exports.index';

        return view($file, compact($arr))->render();
    }


    public function info(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');
            $typeid = $request->input('typeid');

            if($typeid == 'position'){

                $decline = PositionAction::where('position_id',$uid)->get();
                $declineCount = $decline->count();

                if($declineCount > 0){
                    foreach ($decline as $row);

                    $dataTmp = [
                        'position_min' => $row->position_min,
                        'position_max' => $row->position_max,
                        'position_id' => $uid,
                        'id' => $row->id,
                        'action' => 'edit',
                    ];

                }else{

                    $dataTmp = [
                        'position_min' => '',
                        'position_max' => '',
                        'position_id' => $uid,
                        'id' => '',
                        'action' => 'add',
                    ];
                }

            }else{

                $dataTmp = [];
            }
               
            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function infosave(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $typeid = $request->input('typeid');
            $data = $request->input;

            if($typeid == 'position'){

                if($data['action'] == 'add'){

                    $result = PositionAction::inserRow($data);

                }else{

                    $result = PositionAction::updateRow($data, $data['edit_id']);

                }

            }else{


            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }
}
