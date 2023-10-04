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
use App\Models\UserInformation;
use App\Models\UserToInterview;
use App\Models\UserToEstimate;
use App\Models\UserDiagram;
use App\Models\BehaviorSum;

class EstimateEmployeesController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id , $typeid)
    {
        if($typeid == 0){
            $users = User::getEmployees();

        }else{

            $users = User::selcetUserDepartment($typeid);
        }
        
        $employees = UserInformation::where('users_id',$id)->get();
        

        $arr = ['id' , 'users' , 'employees' , 'typeid'];

        // display
        $file = 'default.office.hr.employee.estimate.index';

        return view($file, compact($arr))->render();
    }


    public function years($id , $typeid)
    {
        $years = YearBudget::getDataAll();
        $info = UserInformation::where('users_id',$id)->first();

        $arr = ['years' , 'id' , 'info' , 'typeid'];

        // display
        $file = 'default.office.hr.employee.estimate.years';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $arr = [];

        // display
        $file = 'default.office.hr.estimate.add';

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

            $result = BehaviorSum::inserRow($data , true);

                
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
    public function views($id)
    {

        $arr = [];

        // display
        $file = 'default.office.hr.estimate.views';

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
