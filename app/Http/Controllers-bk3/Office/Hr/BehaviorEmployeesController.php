<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Libraries\MyUtilities;

use App\Models\DataSetting; 
use App\Models\User; 
use App\Models\Behavior; 
use App\Models\BehaviorDetail; 

class BehaviorEmployeesController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = Behavior::where('user_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'items'];

        // display
        $file = 'default.office.hr.employee.behavior.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $arr = ['id'];

        // display
        $file = 'default.office.hr.employee.behavior.add';

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
            $result = Behavior::inserRow($data , true);
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
    public function detail($id)
    {
        $info = Behavior::find((int) $id);

        $items = BehaviorDetail::where('user_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'info' , 'items'];

        // display
        $file = 'default.office.hr.employee.behavior.detail';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {

        $arr = [];

        // display
        $file = 'default.office.hr.estimate.print';

        return view($file, compact($arr))->render();
    }

    
}
