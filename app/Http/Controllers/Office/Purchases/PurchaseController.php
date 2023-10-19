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
use App\Models\YearBudget;
use App\Models\BudgetCertificateCompany;
use App\Models\PurchasesInstallment;

class PurchaseController extends Base 
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
        $file = 'default.office.purchase.index';

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

        $t = $request->input('t');
        $pr = $request->input('pr');

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();

        //$Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $Year = YearBudget::where('is_deleted', '0')
        ->where('is_active', '1')
        ->orderBy('in_year', 'desc')
        ->get();

        $arr = ['purchasesstatus','purchasesmethod','purchasesmargin' , 'purchasesgroup' , 't' , 'pr' , 'employees' , 'Year'];
        
        // display
        $file = 'default.office.purchase.add';

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
            //$resp = ['status' => false, 'msg' =>  $data ];
            //return response()->json($resp, 200);
            $result = Purchases::inserRow($data , true);
           
            $inspector = $purchases_inspector[1];

            //return response()->json($result, 200);


            $position = $position_id[1];

            $numinspector = count($inspector);

            for ($i=0; $i < $numinspector; $i++) { 
                if($inspector[$i] != '' && $position[$i] != ''){
                    $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , 1 , $result);
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
        $file = 'default.office.purchase.show';

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

        $t = $request->input('t');
        $pr = $request->input('pr');

        $Year = YearBudget::where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $detail = PurchasesOfficer::where('purchases_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesstatus = DataSetting::where('group_type', "purchasesstatus")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmethod = DataSetting::where('group_type', "purchasesmethod")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesmargin = DataSetting::where('group_type', "purchasesmargin")->where('is_deleted', '0')->where('is_active','1')->get();

        $purchasesgroup = DataSetting::where('group_type', "purchasesgroup")->where('is_deleted', '0')->where('is_active','1')->get();

        $company = BudgetCertificateCompany::where('is_deleted', '0')->where('is_active','1')->get();

        $installments = PurchasesInstallment::where('purchases_id', $id)->where('group_id', '1')->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id','info','purchasesstatus','purchasesmethod','purchasesmargin' , 'employees' , 'purchasesgroup' , 'institution' , 'Year' , 'company' , 'installments'];
        
        // display
        $file = 'default.office.purchase.edit'.$t;

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
       // return response()->json($request, 200);
        //$data = $request;
        //return response()->json($data['xxxx2'] , 200);


        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;    
            // $purchases_inspector = $request->purchases_inspector;
            // $position_id = $request->position_id;

    
            // $process = PurchasesOfficer::where('purchases_id', $id)->delete();

            if($data['purchases_status'] == 1){
               
                $purchases_inspector = $request->purchases_inspector;
                $position_id = $request->position_id;

                $result = Purchases::updateRow($data, $id);
              
              
                $inspector = $purchases_inspector[1];


                $position = $position_id[1];

            

                $numinspector = count($inspector);

                
                // PurchasesOfficer::deleteRow($id);

                //
                for ($i=0; $i < $numinspector; $i++) { 
                    if($inspector[$i] != '' && $position[$i] != ''){
                        $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , 1 , $id);
                        // $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , 1 , $result);
                    }
                }

               // return response()->json($id, 200);
               // return response()->json($numinspector, 200);

               

            }elseif($data['purchases_status'] == 2){

                $purchases_inspector = $request->purchases_inspector;
                $position_id = $request->position_id;

                $result = Purchases::updateRow2($data, $id);

                $inspector = $purchases_inspector[2];

                $position = $position_id[2];

                $numinspector = count($inspector);

                //$result = true;

                for ($i=0; $i < $numinspector; $i++) { 
                    if($inspector[$i] != '' && $position[$i] != ''){
                        $resultDetail = PurchasesOfficer::inserRow($inspector[$i] , $position[$i] , 2 , $result);
                    }
                }

                // $inspector3 = $purchases_inspector[3];

                // $position3 = $position_id[3];

                // $numinspector3 = count($inspector3);

                // for ($i=0; $i < $numinspector3; $i++) { 
                //     if($inspector3[$i] != '' && $position3[$i] != ''){
                //         $resultDetail3 = PurchasesOfficer::inserRow($inspector[$i] , $position3[$i] , 3 , $result);
                //     }
                // }

            }elseif($data['purchases_status'] == 3){

                $result = Purchases::updateRow3($data, $id);
            }elseif($data['purchases_status'] == 4){

                $installmentN = $request->installment;
                $detailN = $request->detail;
                $installment_dateN = $request->installment_date;
                $installment_moneyN = $request->installment_money;

                $result = Purchases::updateRow4($data, $id);

                $installment = $installmentN[1];

                $detail = $detailN[1];

                $installment_date = $installment_dateN[1];

                $installment_money = $installment_moneyN[1];

                $numinspector = count($installment);
               
      

                for ($i=0; $i < $numinspector; $i++) { 
                    if($installment[$i] != '' && $installment_money[$i] != ''){
                        $resultDetail = PurchasesInstallment::inserRow($installment[$i] , $detail[$i] , $installment_date[$i] , $installment_money[$i] , 1 , $result , $id);
                    }
                }

                  
                // $resp = ['status' => false, 'msg' =>  $id];               
                // return response()->json($resp, 200);



            }elseif($data['purchases_status'] == 5){

                $result = Purchases::updateRow5($data, $id);
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
        $file = 'default.office.purchase.report';

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
        $file = 'default.office.purchase.detail';

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
        $file = 'default.office.purchase.loadPurchase';

        return view($file, compact($arr))->render();
    }
}
