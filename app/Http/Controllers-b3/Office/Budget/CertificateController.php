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
use App\Models\BudgetCertificateCompany;
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

        $company = BudgetCertificateCompany::where('is_deleted', '0')->where('is_active','1')->get();

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id , Request $request)
    {
        $info = BudgetCertificate::find((int) $id);

        $t = $request->input('t');
        $pr = $request->input('pr');

        $company = BudgetCertificateCompany::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'info' , 't' , 'pr' , 'company'];

        // display
        $file = 'default.office.budget.certificate.edit';

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;    

            $result = BudgetCertificate::updateRow($data, $id);

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


    public function getinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');

            $infos = BudgetCertificateCompany::where('id',$uid)->get();
            $infosCount = $infos->count();

            if($infosCount > 0){
                foreach ($infos as $row);

                $dataTmp = [
                    'company_bank_num' => $row->company_bank_num,
                    'company_bank_name' => $row->company_bank_name,
                    'company_bank_account' => $row->company_bank_account,
                    'company_bank_branch' => $row->company_bank_branch,
                ];

            }else{

                $dataTmp = [];

            }
               
            $json = ['status' => true, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companyindex(Request $request)
    {

        $items = BudgetCertificateCompany::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items'];

        // display
        $file = 'default.office.budget.certificate.company';
        
        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companycreate(Request $request)
    {
        
        $arr = [];

        // display
        $file = 'default.office.budget.certificate.companyadd';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function companystore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;
            $certificate_detail_name = $request->certificate_detail_name;
            $certificate_detail_note = $request->certificate_detail_note;

            $result = BudgetCertificateCompany::inserRow($data , true);

            if ($request->hasFile('company_file')) {
                        
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesBudgetCertificateCompany');

                $file = $request->file('company_file');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = BudgetCertificateCompany::where('id', (int) $result)->update(array('company_file' => $uploadFilename));
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
    public function companyedit($id , Request $request)
    {
        $info = BudgetCertificateCompany::find((int) $id);

        $arr = ['id' , 'info'];

        // display
        $file = 'default.office.budget.certificate.companyedit';

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyupdate(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;    

            $result = BudgetCertificateCompany::updateRow($data, $id);

            if ($request->hasFile('company_file')) {
                        
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesBudgetCertificateCompany');

                $file = $request->file('company_file');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = BudgetCertificateCompany::where('id', (int) $result)->update(array('company_file' => $uploadFilename));
            }

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }
}
