<?php

namespace App\Http\Controllers\Office\Budget;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\Budget;
use App\Models\BudgetCertificate;
use App\Models\BudgetCertificateDetail;
use App\Models\DataSetting;

class CertificateController extends Base
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
        
        $items = BudgetCertificate::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 't' , 'pr'];

        // display
        $file = 'default.office.budget.certificate.index';
        
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

        $company = DataSetting::where('group_type', "company")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t' , 'pr' , 'company'];

        // display
        $file = 'default.office.budget.certificate.add';

        return view($file, compact($arr))->render();
    }

    public function loadDetail($id)
    {
        $items = Budget::where('pay_for', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items' , 'id'];
        
        // display
        $file = 'default.office.budget.certificate.loadDetail';

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
            $certificate_detail_name = $request->certificate_detail_name;
            $certificate_detail_note = $request->certificate_detail_note;

            $result = BudgetCertificate::inserRow($data , true);

            if ($request->hasFile('certificate_file')) {
                        
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesBudgetCertificate');

                $file = $request->file('certificate_file');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = BudgetCertificate::where('id', (int) $result)->update(array('certificate_file' => $uploadFilename));
            }

            $numinspector = count($certificate_detail_name);

            for ($i=0; $i < $numinspector; $i++) { 
                if($certificate_detail_name[$i] != '' && $certificate_detail_note[$i] != ''){
                    $resultDetail = BudgetCertificateDetail::inserRow($certificate_detail_name[$i] , $certificate_detail_note[$i] , $result);
                }
            }

                
            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }


    public function view($id , Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $company = DataSetting::where('group_type', "company")->where('is_deleted', '0')->where('is_active','1')->get();

        $info = BudgetCertificate::find((int) $id);

        $items = BudgetCertificateDetail::where('certificate_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();


        $arr = ['items' , 'id' , 'info' , 't' , 'pr' , 'company'];
        
        // display
        $file = 'default.office.budget.certificate.view';

        return view($file, compact($arr))->render();
    }
}
