<?php

namespace App\Http\Controllers\Office\Durable;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;


use App\Models\importdata;
use App\Models\DurableImport;
use App\Imports\DurableDetailImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportsController extends Base 
{    
    protected $id;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct($id=0)
    {
        $this->id = $id;    
    }

    
    /**
     * invimport
     *
     * @param  mixed $req
     * @return void
     */
    public function invimport(Request $req)
    {
        set_time_limit(0);

        $response = ['status' => false, 'msg' => 'error!', 'report_id' => 0];

        if ($req->ajax() && $req->isMethod('post')) {
            $subject = $req->input('subjectid');

            // -- insert invoice_subjects -- //
            // $subjectId = DurableImport::insertOne($subject, true);

            // -- upload file --//
              $fileTmp = $req->file('file_upload');

              $importResult = Excel::import(new DurableDetailImport($subject), $fileTmp);

            if ($importResult) {
                $response = ['status' => true, 'msg' => 'นำเข้าข้อมูลสำเร็จ', 'report_id' => '1'];
            }
        }
        
        return response()->json($response, 200);
    }

}
