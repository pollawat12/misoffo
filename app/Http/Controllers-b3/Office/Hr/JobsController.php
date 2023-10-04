<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Libraries\MyUtilities;

use App\Models\DataSetting; 
use App\Models\User; 
use App\Models\ProjectsWork; 
use App\Models\YearBudget;
use App\Models\ProjectsJobs;
use App\Models\ProjectsDirector;

class JobsController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = ProjectsJobs::getDataAll($id);

        $info = ProjectsWork::find((int) $id);

        $arr = ['items' , 'info' , 'id'];

        // display
        $file = 'default.office.hr.jobs.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $employees = User::getEmployees();

        $departments = DataSetting::where('group_type', "department")->where('is_deleted', '0')->where('is_active','1')->get();

        $groups = DataSetting::where('group_type', "group_work")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['departments' , 'groups' , 'employees' , 'id'];

        // display
        $file = 'default.office.hr.jobs.add';

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
            $purchases_inspector = $request->purchases_inspector;
            $position_id = $request->position_id;

            $result = ProjectsJobs::inserRow($data , true);

            $inspector = $purchases_inspector[1];

            $position = $position_id[1];

            $numinspector = count($inspector);

            for ($i=0; $i < $numinspector; $i++) { 
                if($inspector[$i] != '' && $position[$i] != ''){
                    $resultDetail = ProjectsDirector::inserRow($inspector[$i] , $position[$i] , $result);
                }
            }

                
            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    
}
