<?php

namespace App\Http\Controllers\Office\Purchases;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\Purchases;
use App\Models\PurchasesOfficer;
use App\Models\PurchasesStatus;
use App\Models\DataSetting;
use App\Models\Project;
use App\Models\User;

class PurchasesController extends Base 
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
        $items = Purchases::getPurchases();

        $arr = ['items'];

        // display
        $file = 'default.office.purchases.index';

        return view($file, compact($arr))->render();
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $employees = User::getEmployees();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();


        $arr = ['purchasesstatus','purchasesmethod','purchasesmargin' , 'purchasesgroup' , 'employees'];
        
        // display
        $file = 'default.office.purchases.add';

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

            $result = Purchases::inserRow($data , true);

            $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($purchasesgroup as $purchasesgroups){

                $inspector = $purchases_inspector[$purchasesgroups['id']];

                $position = $position_id[$purchasesgroups['id']];

                $numinspector = count($inspector);

                for ($i=0; $i < $numinspector; $i++) { 
                    if($inspector[$i] != '' && $position[$i] != ''){
                        $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , $purchasesgroups['id'] , $result);
                    }
                }
            }

                
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
    public function show($id, Request $request)
    {
        $info = Purchases::find((int) $id);

        $employees = User::getEmployees();

        $items = PurchasesStatus::getData((int) $id);

        $detail = PurchasesOfficer::where('purchases_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','purchasesstatus','purchasesmethod','purchasesmargin' , 'employees' , 'detail' , 'items'];
        
        // display
        $file = 'default.office.purchases.show';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $info = Purchases::find((int) $id);

        $employees = User::getEmployees();

        $detail = PurchasesOfficer::where('purchases_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','purchasesstatus','purchasesmethod','purchasesmargin' , 'employees' , 'purchasesgroup'];
        
        // display
        $file = 'default.office.purchases.edit';

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
            $purchases_inspector = $request->purchases_inspector;
            $position_id = $request->position_id;

            $process = PurchasesOfficer::where('purchases_id', $id)->delete();

            $result = Purchases::updateRow($data, $id);

            $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($purchasesgroup as $purchasesgroups){

                $inspector = $purchases_inspector[$purchasesgroups['id']];

                $position = $position_id[$purchasesgroups['id']];

                $numinspector = count($inspector);

                for ($i=0; $i < $numinspector; $i++) { 
                    if($inspector[$i] != '' && $position[$i] != ''){
                        $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , $purchasesgroups['id'] , $id);
                    }
                }
            }

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
        $process = Purchases::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function report(Request $request)
    {
        $items = Purchases::getPurchases();

        $arr = ['items'];

        // display
        $file = 'default.office.purchases.report';

        return view($file, compact($arr))->render();
    }


    public function detail($id, Request $request)
    {
        $info = Purchases::find((int) $id);

        $employees = User::getEmployees();

        $items = PurchasesStatus::getData((int) $id);

        $detail = PurchasesOfficer::where('purchases_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','purchasesstatus','purchasesmethod','purchasesmargin' , 'employees' , 'detail' , 'items'];
        
        // display
        $file = 'default.office.purchases.detail';

        return view($file, compact($arr))->render();
    }

    public function purchasesinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');
            $type = $request->input('type');

            if($uid != 0){

                $user = PurchasesStatus::where('id',$uid)->get();
                foreach ($user as $row);

                $dataTmp = [
                    'purchases_status_name' => $row->purchases_status_name,
                    'purchases_status_message' => $row->purchases_status_message,
                    'purchases_status_pay' => $row->purchases_status_pay,
                    'purchases_status_file' => $row->purchases_status_file,
                    'purchases_status_to' => $row->purchases_status_to,
                    'purchases_status_update' => $row->purchases_status_update,
                    'purchases_id' => $row->purchases_id,
                    'is_status' => $row->is_status,
                    'purchases_status_date' => ($row->purchases_status_date) ? getDateFormatToInputThai($row->purchases_status_date) : null,
                    'id' => $row->id,
                ];

            }else{

                $dataTmp = [];     
            }

            

            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }

    /**
     * substore
     *
     * @param  mixed $request
     * @return void
     */
    public function substore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $action = $request->action_name;
            $data = $request->input;   

            if($id == 0){

                $result = PurchasesStatus::insertRow($data);  

                // -- upload file -- //
                if ($request->hasFile('upfile_purchases')) {
                        
                    // create folder
                    $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesPurchases');

                    $file = $request->file('upfile_purchases');
                    $fileName = rand(1,99).'Purchases'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                    // do upload
                    $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                    $uploadFilename = $pathUpload.'/'.$fileName;

                    $result = PurchasesStatus::where('id', (int) $result)->update(array('purchases_status_file' => $uploadFilename));
                }
            }else{
                $result = PurchasesStatus::updateRow($data, $id);

                // -- upload file -- //
                if ($request->hasFile('upfile_purchases')) {
                        
                    // create folder
                    $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesPurchases');

                    $file = $request->file('upfile_purchases');
                    $fileName = rand(1,99).'Purchases'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                    // do upload
                    $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                    $uploadFilename = $pathUpload.'/'.$fileName;

                    $result = PurchasesStatus::where('id', (int) $id)->update(array('purchases_status_file' => $uploadFilename));
                }
            }

            if ($result) {

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
            
        }

        return response()->json($resp, 200);
    }

    public function subdestroy($id)
    {
        $process = PurchasesStatus::deleteRow($id);

        return redirect()->back();
    }

    /**
     * substore
     *
     * @param  mixed $request
     * @return void
     */
    public function statusstore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $action = $request->action_name;
            $data = $request->input;   

            $result = PurchasesStatus::updateRowStatus($data, $id);

            $result1 = Purchases::updateRowStatus($data, $id);

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
    public function loadPurchase($id, Request $request)
    {
        $info = Purchases::find((int) $id);

        $employees = User::getEmployees();

        $items = PurchasesStatus::getData((int) $id);

        $detail = PurchasesOfficer::where('purchases_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','purchasesstatus','purchasesmethod','purchasesmargin' , 'employees' , 'detail' , 'items'];
        
        // display
        $file = 'default.office.purchases.loadPurchase';

        return view($file, compact($arr))->render();
    }
}
