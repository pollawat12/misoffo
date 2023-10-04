<?php

namespace App\Http\Controllers\Office\Durable;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Models\DataSetting;
use App\Models\DurableDecline;
use App\Models\DurableImport;

class DurablesettingController extends Base
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

        $file = 'default.office.setting.durable.'.$t.'.index';
        

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
        $file = 'default.office.setting.durable.'.$t.'.add';

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
        $file = 'default.office.setting.durable.'.$t.'.edit';

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


    public function info(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');

            $decline = DurableDecline::where('durable_id',$uid)->get();
            $declineCount = $decline->count();

            if($declineCount > 0){
                foreach ($decline as $row);

                $dataTmp = [
                    'is_year' => $row->is_year,
                    'is_decline' => $row->is_decline,
                    'durable_id' => $uid,
                    'id' => $row->id,
                    'action' => 'edit',
                ];

                

            }else{

                $dataTmp = [
                    'is_year' => '',
                    'is_decline' => '',
                    'durable_id' => $uid,
                    'id' => '',
                    'action' => 'add',
                ];

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
    public function savedecline(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            if($data['action'] == 'add'){

                $result = DurableDecline::inserRow($data);

            }else{

                $result = DurableDecline::updateRow($data, $data['edit_id']);

            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importindex()
    {  
        $reports = DurableImport::getItems();
        $arr = ['reports'];

        // display
        $file = 'default.office.durable.import.index';
        
        return view($file, compact($arr))->render();
    }


    /**
     * importform
     *
     * @param  mixed $request
     * @return void
     */
    public function importform(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $arr = ['t' , 'pr'];

        // display
        $file = 'default.office.durable.import.import-file';
        
        return view($file, compact($arr))->render();
    }
}
