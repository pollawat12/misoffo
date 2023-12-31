<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Libraries\MyUtilities;

use App\Models\DataSetting; 
use App\Models\User; 
use App\Models\ProjectsWork; 
use App\Models\YearBudget;

class AnnounceController extends Base
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
        $file = 'default.office.hr.announce.index';

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
        $file = 'default.office.hr.announce.add';

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {

        $info = ProjectsWork::find((int) $id);

        $years = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();

        $arr = ['years' ,'id' , 'info'];

        // display
        $file = 'default.office.hr.announce.edit';

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

            $result = ProjectsWork::updateRow($data, $id);

            // -- upload file -- //
            if ($request->hasFile('file_work')) {
                    
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($id, 'upfilesDurable');

                $file = $request->file('file_work');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = Durable::where('id', (int) $id)->update(array('file_work' => $uploadFilename));
            }

            // -- upload file -- //
            if ($request->hasFile('file_work')) {
                
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($id, 'upfilesDurable');

                $file = $request->file('file_work');
                $fileName = rand(1,99).'INV'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = ProjectsWork::where('id', (int) $id)->update(array('file_work' => $uploadFilename));
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    
}
