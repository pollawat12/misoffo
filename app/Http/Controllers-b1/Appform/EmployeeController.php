<?php

namespace App\Http\Controllers\Appform;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserAddress;
use App\Models\UserDutyDetail;
use App\Models\UserContract;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserTransferInOffice;
use App\Models\Userleave;
use App\Models\UserEvaluations;
use App\Models\UserToCourses;
use App\Models\UserFamilies;
use App\Models\Courses;
use App\Models\ProjectsWork; 
use App\Models\ProjectsJobs;
use App\Models\ProjectsDirector;


class EmployeeController extends Base
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
    public function projects(Request $request)
    {
        $date = date('Y-m-d');
        $items = ProjectsWork::getDataAllChekTime($date);

        $arr = ['items'];

        // display
        $file = 'default.appform.employee.projects';

        return view($file, compact($arr))->render();
    }

    public function jobs($id)
    {
        $items = ProjectsJobs::getDataAll($id);

        $info = ProjectsWork::find((int) $id);

        $arr = ['items' , 'info' , 'id'];

        // display
        $file = 'default.appform.employee.jobs';

        return view($file, compact($arr))->render();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $t = $request->input('t');
        
        $user = User::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = UserInformation::where('users_id',$id)->get();

        $addresses = UserAddress::where('users_id',$id)->get();

        $dutyDetail = UserDutyDetail::getDataAll($id);

        $dutyContracts = UserContract::getDataAll($id);

        $educations = UserEducation::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $experiences = UserExperience::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $TransferInOffice = UserTransferInOffice::getDataAll($id);

        $evaluations = UserEvaluations::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $Leave = Userleave::getLeave($id);

        $Courses = UserToCourses::getCourses($id);

        $families = UserFamilies::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['user','employees' , 'addresses' ,'id' , 't' , 'dutyDetail' , 'dutyContracts' , 'educations' , 'experiences' , 'TransferInOffice' , 'Leave' , 'evaluations' , 'Courses' , 'families'];

        // display
        $file = 'default.appform.employee.add';

        return view($file, compact($arr))->render();
    }

    public function create($id)
    {
        $infos = ProjectsJobs::find((int) $id);

        $departments = \App\Models\DataSetting::getDataAll('department');
        $groups = \App\Models\DataSetting::getDataAll('group_work');
        $positions = \App\Models\DataSetting::getDataAll('position');

        $arr = ['departments','groups','positions' , 'infos'];

        // display
        return view('default.appform.employee.add-sub', compact($arr))->render();
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

            $result = User::insertSubAppFormRow($data);

            if ($result) {
                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ' , 'id' => $result];
            }
        }

        return response()->json($resp, 200);
    }
    //sme_dgr
    //FO8MoFfK

    
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

            if($action == 'general'){
                $result = UserInformation::updateRow($data, $id);  
                 
                // -- upload file -- //
                if ($request->hasFile('upfile')) {
                    // create folder
                    $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                    $file = $request->file('upfile');
                    $fileName = rand(1,99).'PF'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                    // do upload
                    $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                    $avatarImage = $pathUpload.'/'.$fileName;

                    // $avatarId = Auth::user()->id;
                    $result = UserInformation::where('users_id', (int) $data['user_id'])->update(array('avatar_image' => $avatarImage));
                }

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                }

            }elseif($action == 'addresses'){

                if($id == 0){
                    $result = UserAddress::insertRow($data);  
                }else{
                    $result = UserAddress::updateRow($data, $id);
                }

                if ($result) {

                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                }
                

            }elseif($action == 'works'){

                $startProject = strtotime(getInputDateToDB($data['date_start']));

                if($data['date_end']){ $endProject = strtotime(getInputDateToDB($data['date_end'])); }else{ $endProject = strtotime(date('Y-m-d')); }

                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันที่สิ้นสุดไม่ถูกต้อง!'];

                }else{

                    if($id == 0){
                        $result = UserDutyDetail::insertRow($data);  
                    }else{
                        $result = UserDutyDetail::updateRow($data, $id);
                    }

                    if ($result) {

    
                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    }

                }
                
                
            
            }elseif($action == 'contract'){

                $startProject = strtotime(getInputDateToDB($data['date_start']));

                if($data['date_end']){ $endProject = strtotime(getInputDateToDB($data['date_end'])); }else{ $endProject = strtotime(date('Y-m-d')); }

                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันที่สิ้นสุดไม่ถูกต้อง!'];

                }else{

                    if($id == 0){
                        // -- upload file -- //
                        if ($request->hasFile('upfile_contract')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                            $file = $request->file('upfile_contract');
                            $fileName = rand(1,99).'WC'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $data['contracts_file'] = $uploadFilename;
                        }

                        $result = UserContract::insertRow($data);  
                    }else{
                        $result = UserContract::updateRow($data, $id);

                        // -- upload file -- //
                        if ($request->hasFile('upfile_contract')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                            $file = $request->file('upfile_contract');
                            $fileName = rand(1,99).'WC'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $result = UserContract::where('id', (int) $id)->update(array('contracts_file' => $uploadFilename));
                        }
                    }

                    if ($result) {

                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    }

                }

            }elseif($action == 'family'){
                
                if($id == 0){
                    $result = UserFamilies::insertRow($data);
                }else{
                    $result = UserFamilies::updateRow($data, $id);
                }

                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    
                }
                
            }elseif($action == 'educations'){
                
                

                
                if($id == 0){

                    // -- upload file -- //
                    if ($request->hasFile('upfile_education')) {
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                        $file = $request->file('upfile_education');
                        $fileName = rand(1,99).'EC'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload.'/'.$fileName;

                        $data['education_file'] = $uploadFilename;
                    }
                    
                    $result = UserEducation::insertRow($data);
                }else{
                    $result = UserEducation::updateRow($data, $id);

                    // -- upload file -- //
                    if ($request->hasFile('upfile_education')) {
                        // create folder
                        $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                        $file = $request->file('upfile_education');
                        $fileName = rand(1,99).'EC'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                        // do upload
                        $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                        $uploadFilename = $pathUpload.'/'.$fileName;


                        $result = UserEducation::where('id', (int) $id)->update(array('education_file' => $uploadFilename));
                    }
                }

                if ($result) {

                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    
                }

            }elseif($action == 'experience'){

                $startProject = strtotime(getInputDateToDB($data['date_start']));

                if($data['date_end']){ $endProject = strtotime(getInputDateToDB($data['date_end'])); }else{ $endProject = strtotime(date('Y-m-d')); }

                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันที่สิ้นสุดไม่ถูกต้อง!'];

                }else{
                
                    if($id == 0){
                        $result = UserExperience::insertRow($data);
                    }else{
                        $result = UserExperience::updateRow($data, $id);
                    }

                    if ($result) {

                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    }

                }
                
            }elseif($action == 'transfer'){

                $startProject = strtotime(getInputDateToDB($data['date_start']));

                if($data['date_end']){ $endProject = strtotime(getInputDateToDB($data['date_end'])); }else{ $endProject = strtotime(date('Y-m-d')); }

                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันที่สิ้นสุดไม่ถูกต้อง!'];

                }else{

                    
                    if($id == 0){
                        // -- upload file -- //
                        if ($request->hasFile('upfile_transfer')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                            $file = $request->file('upfile_transfer');
                            $fileName = rand(1,99).'TF'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $data['transfer_file'] = $uploadFilename;
                        }
                    

                        $result = UserTransferInOffice::insertRow($data);
                    }else{
                        $result = UserTransferInOffice::updateRow($data, $id);

                        // -- upload file -- //
                        if ($request->hasFile('upfile_transfer')) {
                            // create folder
                            $pathUpload = MyUtilities::mkDirPathUpload($data['user_id']);

                            $file = $request->file('upfile_transfer');
                            $fileName = rand(1,99).'TF'.date('YmdHis') . '.' .$file->getClientOriginalExtension();

                            // do upload
                            $upload = MyUtilities::doUpload($file, base_path($pathUpload), $fileName);
                            $uploadFilename = $pathUpload.'/'.$fileName;

                            $result = UserTransferInOffice::where('id', (int) $id)->update(array('transfer_file' => $uploadFilename));
                        }
                    
                    }

                    if ($result) {

                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                    }

                }

            }elseif($action == 'leave'){

                $startProject = strtotime(getInputDateToDB($data['date_start']));

                $endProject = strtotime(getInputDateToDB($data['date_end']));

                if ($startProject > $endProject) {

                    $resp = ['status' => false, 'msg' => 'ระบุวันที่สิ้นสุดไม่ถูกต้อง!'];

                }else{
                    
                    if($id == 0){
                        
                        $result = Userleave::insertRow($data , true);

                        $employee = Userleave::getCheckEmplyooLeave($result);
                        foreach ($employee as $row);

                        $numday = round((strtotime($row['date_end']) - strtotime($row['date_start']))/60/60/24) + 1;

                        MyNotification::notiEmployeeLeave($row['name'], $row['leave_type'], $start=getDateTimeTH($row['date_start'] , false), $end=getDateTimeTH($row['date_end'] , false), $numday);
                    }else{
                        $result = Userleave::updateRow($data, $id);
                    }

                    if ($result) {
                        
                        $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];

                    }

                }
                
            }elseif($action == 'money'){
                
                if($id == 0){
                    $result = UserEvaluations::insertRow($data);
                }else{
                    $result = UserEvaluations::updateRow($data, $id);
                }
                
                if ($result) {
                    $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
                }
            }
            
            
            
        }

        return response()->json($resp, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeesPrint($id, Request $request)
    {
        $t = $request->input('t');

        $user = User::where('id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $employees = UserInformation::where('users_id',$id)->get();

        $addresses = UserAddress::where('users_id',$id)->get();

        $dutyDetail = UserDutyDetail::getDataAll($id);

        $educations = UserEducation::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $experiences = UserExperience::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $TransferInOffice = UserTransferInOffice::getDataAll($id);

        $evaluations = UserEvaluations::where('users_id',$id)->where('is_deleted', '0')->where('is_active','1')->get();

        $Leave = Userleave::getLeave($id);

        $arr = ['user','employees' , 'addresses' ,'id' , 't' , 'dutyDetail' , 'educations' , 'experiences' , 'TransferInOffice' , 'Leave' , 'evaluations'];

        // display

        if($t == 'profile'){
            $file = 'default.appform.employee.print';
        }else{
            $file = 'default.appform.employee.printMoney';
        }

         

        return view($file, compact($arr))->render();
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , $userid , $type)
    {
        if($type == 'works'){

            $process = UserDutyDetail::deleteRow($id); 

        }elseif($type == 'contract'){

            $process = UserContract::deleteRow($id);

        }elseif($type == 'family'){

            $process = UserFamilies::deleteRow($id);

        }elseif($type == 'educations'){

            $process = UserEducation::deleteRow($id);

        }elseif($type == 'experience'){

            $process = UserExperience::deleteRow($id);

        }elseif($type == 'transfer'){

            $process = UserTransferInOffice::deleteRow($id);

        }elseif($type == 'leave'){

            $process = Userleave::deleteRow($id);

        }elseif($type == 'money'){

            $process = UserEvaluations::deleteRow($id);

        }
        elseif($type == 'employees'){

            $process = User::deleteRow($id);

        }
        

        return redirect()->back();
    }

    public function getAddresses(Request $request) 
    {
        $id = $request->id;
        $type = $request->t;

        $html = '';

        switch ($type) {
            case 'province':
                $html = '<option value="0">--เลือก--</option>';
                $items = \App\Models\Amphur::where(['PROVINCE_ID' => (int) $id])->orderBy('AMPHUR_CODE', 'asc')->get();

                if (!empty($items)) {
                    foreach ($items as $item) {
                        $html .= '<option value="'.$item->AMPHUR_ID.'">'.$item->AMPHUR_NAME.'</option>';
                    }
                }
                break;

            case 'district':
                $html = '<option value="0">--เลือก--</option>';
                $items = \App\Models\District::where(['AMPHUR_ID' => (int) $id])->get();

                if (!empty($items)) {
                    foreach ($items as $item) {
                        $html .= '<option value="'.$item->DISTRICT_ID.'">'.$item->DISTRICT_NAME.'</option>';
                    }
                }
                break;
            case 'subdistrict':
                    $items = \App\Models\Zipcode::where(['DISTRICT_ID' => (int) $id])->get();
    
                    if (!empty($items)) {
                        foreach ($items as $item);

                        $html = '<input type="text" class="form-control" name="input[zipcode]" placeholder="" value="'.$item->ZIPCODE.'">';
                    }
                    break;
            case 'subdistrict_p':
                        $items = \App\Models\Zipcode::where(['DISTRICT_ID' => (int) $id])->get();
        
                        if (!empty($items)) {
                            foreach ($items as $item);
    
                            $html = '<input type="text" class="form-control" name="input[zipcode_present]" placeholder="" value="'.$item->ZIPCODE.'">';
                        }
                        break;
        }

        return response()->json(['elem_html' => $html], 200);
    }

    public function hrinfo(Request $request) 
    {
        $json = ['status' => false, 'info' => ''];

        if ($request->ajax()) {
            $uid = $request->input('id');
            $type = $request->input('type');

            if($uid != 0){

                if($type == 'works'){
                    
                    $user = UserDutyDetail::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'contract_type' => $row->contract_type,
                        'department_no' => $row->department_no,
                        'position_no' => $row->position_no,
                        'group_no' => $row->group_no,
                        'government_no' => $row->government_no,
                        'government_number' => $row->government_number,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'date_end' => ($row->date_end) ? getDateFormatToInputThai($row->date_end) : null,
                        'date_resign' => ($row->date_resign) ? getDateFormatToInputThai($row->date_resign) : null,
                        'status_work' => $row->status_work,
                        'note' => $row->note,
                        'id' => $row->id,
                    ];

                }elseif($type == 'contract'){

                    $user = UserContract::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'duty_id' => $row->duty_id,
                        'government_number' => $row->government_number,
                        'contracts_file' => $row->contracts_file,
                        'note' => $row->note,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'date_end' => ($row->date_end) ? getDateFormatToInputThai($row->date_end) : null,
                        'contracts_date' => ($row->contracts_date) ? getDateFormatToInputThai($row->contracts_date) : null,
                        'id' => $row->id,
                    ];
                
                }elseif($type == 'family'){

                    $user = UserFamilies::where('id',$uid)->get();
                    foreach ($user as $row);

                    if($row->is_present == 1){

                        $addresses = UserAddress::where('users_id',$row->users_id)->get();
                        foreach ($addresses as $addresse);

                        $provinces = \App\Models\Province::find((int) $addresse['province_no']);
                        $amphurs = \App\Models\Amphur::find((int) $addresse['district_no']);
                        $subdistricts = \App\Models\District::find((int) $addresse['subdistrict_no']);

                        $contact_info = $addresse['address'].' แขวง/ตำบล '.$subdistricts->DISTRICT_NAME.' เขต/อำเภอ '.$amphurs->AMPHUR_NAME.' จังหวัด '.$provinces->PROVINCE_NAME.' รหัสไปรษณีย์ '.$addresse['zipcode'];

                        $is_contact_info = 'disabled';

                        $is_present = true;
                        
                    }else{

                        $contact_info = $row->contact_info;
                        $is_contact_info = '';
                        $is_present = false;
                    }

                    $dataTmp = [
                        'prename' => $row->prename,
                        'firstname' => $row->firstname,
                        'lastname' => $row->lastname,
                        'card_no' => $row->card_no,
                        'tax_no' => $row->tax_no,
                        'contact_info' => $contact_info,
                        'relation_type' => $row->relation_type,
                        'is_contact_info' => $is_contact_info,
                        'is_present' => $is_present,
                        'id' => $row->id,
                    ];

                }elseif($type == 'educations'){

                    $user = UserEducation::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'degress_no' => $row->degress_no,
                        'institute_name' => $row->institute_name,
                        'faculty_name' => $row->faculty_name,
                        'education_degree' => $row->education_degree,
                        'education_file' => $row->education_file,
                        'education_branch' => $row->education_branch,
                        'year_start' => $row->year_start,
                        'year_end' => $row->year_end,
                        'note' => $row->note,
                        'id' => $row->id,
                    ];

                }elseif($type == 'experience'){

                    $user = UserExperience::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'company' => $row->company,
                        'address' => $row->address,
                        'salary' => $row->salary,
                        'position' => $row->position,
                        'job_description' => $row->job_description,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'date_end' => ($row->date_end) ? getDateFormatToInputThai($row->date_end) : null,
                        'id' => $row->id,
                    ];

                }elseif($type == 'transfer'){
                    
                    $user = UserTransferInOffice::where('id',$uid)->get();
                    foreach ($user as $row);

                    if($row->is_present == 1){

                        
                        $is_leader_name = '';
                        $is_leader_tel = '';
                        $is_leader_mobile = '';
                        $is_leader_email = '';
                        $is_present = true;
                        
                    }else{

                        $is_leader_name = 'disabled';
                        $is_leader_tel = 'disabled';
                        $is_leader_mobile = 'disabled';
                        $is_leader_email = 'disabled';
                        $is_present = false;
                    }

                    $dataTmp = [
                        'from_department' => $row->from_department,
                        'from_position' => $row->from_position,
                        'to_department' => $row->to_department,
                        'to_position' => $row->to_position,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'date_end' => ($row->date_end) ? getDateFormatToInputThai($row->date_end) : null,
                        'is_loan' => $row->is_loan,
                        'note' => $row->note,
                        'leader_name' => $row->leader_name,
                        'leader_tel' => $row->leader_tel,
                        'leader_mobile' => $row->leader_mobile,
                        'leader_email' => $row->leader_email,
                        'is_leader_name' => $is_leader_name,
                        'is_leader_tel' => $is_leader_tel,
                        'is_leader_mobile' => $is_leader_mobile,
                        'is_leader_email' => $is_leader_email,
                        'is_present' => $is_present,
                        'id' => $row->id,
                    ];

                }elseif($type == 'leave'){
                    
                    $user = Userleave::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'leave_type' => $row->leave_type,
                        'date_resign' => ($row->date_resign) ? getDateFormatToInputThai($row->date_resign) : null,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'date_end' => ($row->date_end) ? getDateFormatToInputThai($row->date_end) : null,
                        'note' => $row->note,
                        'id' => $row->id,
                    ];

                }elseif($type == 'money'){
                    
                    $user = UserEvaluations::where('id',$uid)->get();
                    foreach ($user as $row);

                    $dataTmp = [
                        'result_eval' => $row->result_eval,
                        'salary_start' => $row->salary_start,
                        'salary_end' => $row->salary_end,
                        'salary_div' => $row->salary_div,
                        'salary_number' => $row->salary_number,
                        'salary_sum' => $row->salary_sum,
                        'date_start' => ($row->date_start) ? getDateFormatToInputThai($row->date_start) : null,
                        'note' => $row->note,
                        'is_approved' => $row->is_approved,
                        'id' => $row->id,
                    ];

                }elseif($type == 'course'){
                    
                    $Courses = Courses::getDataAll($uid);
                    foreach ($Courses as $row);

                    $dataTmp = [
                        'name' => $row['name'],
                        'budget_year' => $row['budget_year'],
                        'categroy' => $row['categroy'],
                        'date_start' => getDateFormatToInputThai($row['date_start']).' - '.getDateFormatToInputThai($row['date_end']),
                        'time_start' => $row['time_start'].' - '.$row['time_end'],
                        'place' => $row['place'],
                        'lecturer_name' => $row['lecturer_name'],
                    ];


                }else{

                }

            }else{

                $dataTmp = [];     
            }

            

            $json = ['status' => false, 'info' => $dataTmp];
        }

        return response()->json($json, 200);
    }
}
