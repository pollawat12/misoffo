<?php

namespace App\Http\Controllers\Office\Durable;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;

use App\Models\Durable;
use App\Models\DurableReport;
use App\Models\DurableAmount;
use App\Models\DurableDisbursement;
use App\Models\DurableDistribution;
use App\Models\DataSetting;
use App\Models\DurableRepair;
use App\Models\Project;
use App\Models\PurchasesStatus;
use App\Models\BudgetYear;
use App\Models\YearBudget;
use App\Models\User;
use App\Models\DurableBorrow;
use App\Models\DurableBorrowDetail;
class DurableController extends Base 
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
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $t = $request->input('t');
        $pr = $request->input('pr');

        $items = Durable::getDurable($t, $pr);

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $arr = ['items','t','pr','purchases' , 'id'];

        // display
        $file = 'default.office.durable.'.$t.'.index';

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

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();

        $arr = ['t','pr','category','typedata','unitcount','money','means' , 'brand' , 'year' , 'institution'];
        
        // display
        $file = 'default.office.durable.'.$t.'.add';

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

            if($data['durable_type'] == 'durable'){

                if ($data['durable_purchase'] != '' && $data['durable_price'] != '') {

                    $result = Durable::inserRow($data , true);

                    // -- upload file -- //
                    if ($request->hasFile('durable_image')) {
                        
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesDurable');

                        $file = $request->file('durable_image');
                        $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload.'/'.$fileName;

                        $result = Durable::where('id', (int) $result)->update(array('durable_image' => $uploadFilename));
                    }

                    // -- upload file -- //
                    if ($request->hasFile('durable_invoice_file')) {
                        
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($result, 'upfilesDurable');

                        $file = $request->file('durable_invoice_file');
                        $fileName = rand(1,99).'INV'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload.'/'.$fileName;

                        $result = Durable::where('id', (int) $result)->update(array('durable_invoice_file' => $uploadFilename));
                    }

                    if ($result) {
                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ', 'id' => (int) $result];
                    }

                }else{

                    $resp = ['status' => false, 'msg' => 'กรุณาข้อมูลรายละเอียดการสั่งซื้อ!'];

                } 
            }else{
                $result = Durable::inserRow($data , true);

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => (int) $result];
                }
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','money','means' , 'brand'];
        
        // display
        $file = 'default.office.durable.'.$t.'.edit';

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

            $result = Durable::updateRow($data, $id);

            // -- upload file -- //
            if ($request->hasFile('durable_image')) {
                    
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($id, 'upfilesDurable');

                $file = $request->file('durable_image');
                $fileName = rand(1,99).'IMG'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = Durable::where('id', (int) $id)->update(array('durable_image' => $uploadFilename));
            }

            // -- upload file -- //
            if ($request->hasFile('durable_invoice_file')) {
                
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($id, 'upfilesDurable');

                $file = $request->file('durable_invoice_file');
                $fileName = rand(1,99).'INV'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = Durable::where('id', (int) $id)->update(array('durable_invoice_file' => $uploadFilename));
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
        $process = Durable::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Show the form for report the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $items = Durable::getDurableDetail($id);

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info' , 'items' , 'money' , 'means' , 'brand'];
        
        // display
        $file = 'default.office.durable.'.$t.'.report';

        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function activity(Request $request)
    {
        
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $t = $request->input('t');
        $pr = $request->input('pr');

        

        $items = Durable::getActivity($t, $pr);

        $arr = ['items','t','pr' , 'id' , 'purchases'];

        

        // display
        $file = 'default.office.durable.'.$t.'.index';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activityCreate(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $groups = DataSetting::where('group_type', "group_work")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item' , 'project' , 'brand' , 'groups' , 'institution' , 'employees'];
        
        // display
        $file = 'default.office.durable.'.$t.'.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activityUpdate(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->value_id;
            $id1 = $request->value1_id;
            $data = $request->input;    

            if($id != 0){
                $result = Durable::updateActivityRow($data, $id);

                $result_check = DurableReport::inserRow($data, $id);
            }else{
                $result = Durable::updateActivityRow($data, $id1);

                $result_check = DurableReport::inserRow($data, $id);
            } 
            
            // -- upload file -- //
            if ($request->hasFile('borrow_file')) {
                
                // create folder
                $pathUpload = MyUtilities::mkDirPathUpload($id, 'upfilesDurable');

                $file = $request->file('borrow_file');
                $fileName = rand(1,99).'BOR'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                // do upload
                $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                $uploadFilename = $pathUpload.'/'.$fileName;

                $result = Durable::where('id', (int) $id)->update(array('borrow_file' => $uploadFilename));
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
    public function activityEdit($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','brand' , 'institution' , 'project'];
        
        // display
        $file = 'default.office.durable.'.$t.'.edit';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activityPrint($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $arr = ['t','pr', 'id','info'];
        
        // display
        $file = 'default.office.durable.'.$t.'.print';

        return view($file, compact($arr))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activityDestroy($id)
    {
        $process = Durable::deleteActivityRow($id);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function searchAll(Request $request)
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $t = $request->input('t');
        $pr = $request->input('pr');

        if($t == 'durable'){
            $items = Durable::getDurable($t, $pr);
        }else{
            $items = Durable::getActivity($t, $pr);
        }

        $arr = ['items','t','pr' , 'id' , 'purchases'];

        // display
        $file = 'default.office.durable.'.$t.'.excel';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function amount($id, Request $request)
    {
        
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $items = DurableAmount::where('durable_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','items'];
        
        // display
        $file = 'default.office.durable.'.$t.'.amount';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function amountCreate($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $year = YearBudget::where('is_deleted', '0')->where('is_active','1')->orderBy('in_year', 'DESC')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','project','money','institution','year'];
        
        // display
        $file = 'default.office.durable.'.$t.'.amountAdd';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activityStore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $action = $request->action;
            $data = $request->input;

            if($id == 0){

                $result = DurableAmount::inserRow($data);

            }else{

                $result = DurableAmount::updateRow($data, $id);

            }
            

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function amountEdit($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $amount = DurableAmount::find((int) $id);

        $info = Durable::find((int) $amount->durable_id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','project','money','amount'];
        
        // display
        $file = 'default.office.durable.'.$t.'.amountEdit';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function amountReport($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $items = DurableAmount::where('durable_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','items','money','means'];
        
        // display
        $file = 'default.office.durable.'.$t.'.report';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function amountDetail($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $items = DurableAmount::find((int) $id);

        $info = Durable::getDurableDetail($items->durable_id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','items','money','means'];
        
        // display
        $file = 'default.office.durable.'.$t.'.detail';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disbursement(Request $request)
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $t = $request->input('t');
        $pr = $request->input('pr');
        
        $items = DurableDisbursement::getDurable();

        $arr = ['items','t','pr','id','purchases'];
        
        // display
        $file = 'default.office.durable.disbursement.index';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function disbursementCreate(Request $request)
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $t = $request->input('t');
        $pr = $request->input('pr');

        $item = Durable::where('durable_type', "supplies")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item','money','project' , 'institution' , 'id' , 'purchases'];
        
        // display
        $file = 'default.office.durable.disbursement.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disbursementStore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;

            $items = DurableAmount::where('durable_id', $data['value_id'])->where('project_id', $data['borrow_project'])->where('distribute_num', '>' , 0)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'asc')->limit(1)->get();
            if (!empty($items)) {
                foreach ($items as $item);

                $sum = $item['distribute_num'] - $data['amount_num'];

                $result = DurableAmount::updateRowSum($sum, $item['id']);
            }

            $result = DurableDisbursement::inserRow($data , $item['id']);

            
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
    public function disbursementPrint($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = DurableDisbursement::find((int) $id);
        

        $arr = ['t','pr', 'id','info'];
        
        // display
        $file = 'default.office.durable.disbursement.print';

        return view($file, compact($arr))->render();
    }


    public function getCategory(Request $request) 
    {
        $id = $request->id;
        $type = $request->t;

        $html = '';

        switch ($type) {
            case 'category':
                $html = '<option value="0">--เลือก--</option>';
                $items = \App\Models\DataSetting::where(['parent_id' => (int) $id])->where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->orderBy('data_value', 'asc')->get();

                if (!empty($items)) {
                    foreach ($items as $item) {
                        $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
                    }
                }
                break;

            case 'typedata':

                    $yearid = $request->yearid;

                    if($yearid != 0){

                        $year = YearBudget::find((int) $yearid);

                        $yearname = substr(($year->in_year),2);

                    }else{

                        $year = date('Y');

                        $yearname = substr(($year + 543),2);

                    }

                    

                    $Durables = Durable::where('durable_type', 'durable')->whereYear('created_at', '=', $year)->where('is_deleted', '0')->where('is_active','1')->get();

                    $CountDurables = count($Durables) + 1;

                    $strlenDurables = strlen($CountDurables);

                    if($strlenDurables == 1){

                        $NumDurables = '000'.$CountDurables;
                    }elseif($strlenDurables == 2){

                        $NumDurables = '00'.$CountDurables;
                    }elseif($strlenDurables == 3){

                        $NumDurables = '0'.$CountDurables;    
                    }else{

                        $NumDurables = $CountDurables;
                    }

                    $institutionid = $request->institutionid;

                    $items = \App\Models\DataSetting::where(['id' => (int) $id])->get();

                    
                    $institutions = \App\Models\DataSetting::where(['id' => (int) $institutionid])->get();
                    foreach ($institutions as $institution);
    
                    if (!empty($items)) {
                        foreach ($items as $item);

                        $itemsSub = \App\Models\DataSetting::where(['id' => (int) $item->parent_id])->get();
                        foreach ($itemsSub as $itemSub);

                        
                        // $html = '<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;" value="'.$itemSub->data_value.'-'.$item->data_value.'-">';

                        // $html = '<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;" value="'.$institution->name.' '.$itemSub->data_value.''.$item->data_value.''.$NumDurables.'/'.$yearname.'">';

                        $html = '<input type="text" name="input[durable_number]" id="durable_number" class="form-control" placeholder="" style="height: 45px;" value="'.$itemSub->data_value.''.$item->data_value.''.$NumDurables.'/'.$yearname.'">';
                    }
                    break;

            case 'project':
                        $html = '<option value="0">--เลือก--</option>';
                        $items = DurableAmount::select('project_id', DurableAmount::raw('count(*) as total'))->where('durable_id', $id)->where('is_deleted', '0')->where('is_active','1')->orderBy('project_id', 'asc')->groupBy('project_id')->get();
        
                        if (!empty($items)) {
                            foreach ($items as $item) {

                                if($item->project_id == 0){
                                    $name = 'สำนักงาน';
                                }else{
                                    $info = Project::find((int) $item->project_id);

                                    $name = $info->project_name;
                                }    
                                $html .= '<option value="'.$item->project_id.'">'.$name.'</option>';
                            }
                        }
                        break;

            case 'institution':

                    $year = $request->parentId;

                    $html = '<option value="0">--เลือก--</option>';
                    $items = \App\Models\Purchases::where('institution_id', (int) $id)->where('year_id', (int) $year)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'asc')->get();
    
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            $html .= '<option value="'.$item->id.'">'.$item->purchases_order_number.'</option>';
                        }
                    }
                    break;

            case 'purchase':
                $items = \App\Models\Purchases::find((int) $id);

                $name = \App\Models\BudgetCertificateCompany::find((int) $items->purchases_offer_name);

                
                

                $html = $name->company_name;
                break;
        }

        return response()->json(['elem_html' => $html], 200);
    }

    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function repair(Request $request)
    {
        $infos = BudgetYear::where('is_deleted', '0')->where('is_active','1')->orderBy('year_id', 'DESC')->limit(1)->get();
        foreach ($infos as $info);

        $id = $info['id'];

        $purchases = PurchasesStatus::getData((int) $id , (int) 4);

        $t = $request->input('t');
        $pr = $request->input('pr');
        
        $items = DurableRepair::getDurable();

        $arr = ['items','t','pr','id','purchases'];
        
        // display
        $file = 'default.office.durable.repair.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repairCreate(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item'];
        
        // display
        $file = 'default.office.durable.repair.add';

        return view($file, compact($arr))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function repairStore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;

            if($id == 0){
                $result = DurableRepair::inserRow($data);
            }else{
                $result = DurableRepair::updateRow($data, $id);
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
    public function repairDestroy($id)
    {
        $process = DurableRepair::deleteRow($id);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function repairEdit($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = DurableRepair::find((int) $id);

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','item'];
        
        // display
        $file = 'default.office.durable.repair.edit';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for amount the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportSupplies($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $item = DurableAmount::where('durable_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $info = Durable::getDurableDetail($id);

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $category = DataSetting::where('group_type', "category")->where('is_deleted', '0')->where('is_active','1')->get();

        $typedata = DataSetting::where('group_type', "typedata")->where('is_deleted', '0')->where('is_active','1')->get();

        $unitcount = DataSetting::where('group_type', "unitcount")->where('is_deleted', '0')->where('is_active','1')->get();

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info','category','typedata','unitcount','item','money','means'];
        
        // display
        $file = 'default.office.durable.'.$t.'.reportSupplies';

        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function borrowindex(Request $request)
    {
        
        $t = $request->input('t');
        $pr = $request->input('pr');

        $items = DurableBorrow::getDurable($t, $pr);

        $arr = ['items','t','pr'];

        // display
        $file = 'default.office.durable.'.$t.'.index';

        return view($file, compact($arr))->render();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrowcreate(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $groups = DataSetting::where('group_type', "group_work")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item' , 'project' , 'brand' , 'groups' , 'institution' , 'employees'];
        
        // display
        $file = 'default.office.durable.'.$t.'.add';

        return view($file, compact($arr))->render();
    }



    public function borrowstore(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->input;
            $value_id = $request->value_id;
            $num_id = $request->num;
            $add_id = $request->add;
            $person_id = $request->person;

            $result = DurableBorrow::inserRow($data , true);

            $value = $value_id[1];

            $num = $num_id[1];

            $add = $add_id[1];

            $person = $person_id[1];
            

            $numvalue = count($value);

            for ($i=0; $i < $numvalue; $i++) { 
                if($value[$i] != '' && $person[$i] != ''){
                    $resultDetail = DurableBorrowDetail::inserRow($value[$i] , $num[$i] , $add[$i] , $person[$i] , 1 , $result);
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
    public function borrowedit($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = DurableBorrow::find((int) $id);

        $details = DurableBorrowDetail::where('durable_borrow_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $groups = DataSetting::where('group_type', "group_work")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item' , 'project' , 'brand' , 'groups' , 'institution' , 'employees' , 'id' , 'info' , 'details'];
        
        // display
        $file = 'default.office.durable.'.$t.'.edit';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrowreceive($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = DurableBorrow::find((int) $id);

        $details = DurableBorrowDetail::where('durable_borrow_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

        $item = Durable::where('durable_type', "durable")->where('durable_status', '0')->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $groups = DataSetting::where('group_type', "group_work")->where('is_deleted', '0')->where('is_active','1')->get();

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $employees = User::getEmployees();

        $institution = DataSetting::where('group_type', "institution")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr','item' , 'project' , 'brand' , 'groups' , 'institution' , 'employees' , 'id' , 'info' , 'details'];
        
        // display
        $file = 'default.office.durable.'.$t.'.receive';

        return view($file, compact($arr))->render();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrowreceiveupdate(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $id = $request->edit_id;
            $data = $request->input;  

            $result = DurableBorrow::updateReceiveRow($data, $id);

            $value_id = $request->value_id;
            $checkbox_id = $request->checkbox_id;

            $value = $value_id[1];

            $checkboxs = $checkbox_id[1];

            $numvalue = count($value);

            $details = DurableBorrowDetail::where('durable_borrow_id', $id)->where('is_deleted', '0')->where('is_active','1')->get();

            for ($i=0; $i < $numvalue; $i++) { 
                if($value[$i] != '' && $person[$i] != ''){
                    $resultDetail = DurableBorrowDetail::inserRow($value[$i] , $num[$i] , $add[$i] , $person[$i] , 1 , $result);
                }
            }
            

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);
    }

    /**
     * Show the form for report the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id, Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $info = Durable::find((int) $id);

        $items = Durable::getDurableDetail($id);

        $money = DataSetting::where('group_type', "money")->where('is_deleted', '0')->where('is_active','1')->get();

        $brand = DataSetting::where('group_type', "brand")->where('is_deleted', '0')->where('is_active','1')->get();

        $means = DataSetting::where('group_type', "means")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t','pr', 'id','info' , 'items' , 'money' , 'means' , 'brand'];
        
        // display
        $file = 'default.office.durable.'.$t.'.print';

        return view($file, compact($arr))->render();
    }

    
}
