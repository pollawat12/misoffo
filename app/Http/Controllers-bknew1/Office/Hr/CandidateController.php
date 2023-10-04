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

class CandidateController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ProjectsWork::getDataAll();

        $arr = ['items'];

        // display
        $file = 'default.office.hr.candidate.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();

        $arr = ['years'];

        // display
        $file = 'default.office.hr.candidate.add';

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

            $result = ProjectsWork::inserRow($data , true);

            // -- upload file -- //
            if ($request->hasFile('file_work')) {
                
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesWork');

                $file = $request->file('file_work');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = ProjectsWork::where('id', (int) $result)->update(array('file_work' => $uploadFilename));
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ', 'id' => (int) $result];
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
        $items = ProjectsJobs::getDataAll($id);

        $info = ProjectsWork::find((int) $id);

        $arr = ['items' , 'info' , 'id'];

        // display
        $file = 'default.office.hr.candidate.views';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $items = UserInformation::where('positions_no', $id)->get();

        $info = ProjectsJobs::find((int) $id);

        $arr = ['items' , 'info' , 'id'];

        // display
        $file = 'default.office.hr.candidate.detail';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function interviewcreate($id , $jobid)
    {
        
        $items = UserInformation::find((int) $id);

        $info = ProjectsJobs::find((int) $jobid);

        $arr = ['info' , 'items' , 'jobid' , 'id'];

        // display
        $file = 'default.office.hr.candidate.interviewcreate';

        return view($file, compact($arr))->render();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function interviewstore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            $result = UserToInterview::inserRow($data , true);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ', 'id' => (int) $result];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scores($id)
    {
        $items = UserInformation::where('positions_no', $id)->get();

        $info = ProjectsJobs::find((int) $id);

        $directors = ProjectsDirector::where('job_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'info' , 'id' , 'directors'];

        // display
        $file = 'default.office.hr.candidate.scores';

        return view($file, compact($arr))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $items = UserInformation::where('positions_no', $id)->get();

        $info = ProjectsJobs::find((int) $id);

        $directors = ProjectsDirector::where('job_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'info' , 'id' , 'directors'];

        // display
        $file = 'default.office.hr.candidate.print';

        return view($file, compact($arr))->render();
    }

    
}
