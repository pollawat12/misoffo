<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Libraries\MyUtilities;
// model
use App\Models\DataSetting;
use App\Models\TimeattendanceLog;
use App\Models\UserTimeAttendance;

use App\Models\BudgetsrFund;
use App\Models\User;
use App\Models\UserBenefits;
use App\Models\UserInformation;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;

class TimeattendanceController extends Base 
{
    // public function index()
    // {
    //     $conditions = [
    //         'is_deleted' => (int) 0,
    //         'is_active' => (int) 1
    //     ];
    //     $times = UserTimeAttendance::where($conditions)->get();
    //     // $rooms = DataSetting::getDataAll('meeting_room');
        
    //     ///Applications/MAMP/htdocs/works_2/efai-dev/upfiles/hr/time_attendance/1-31_October.txt
    //     // $txtFile = file_get_contents(base_path('upfiles/hr/time_attendance/1-31_October.txt'));
    //     // $myfile = fopen(base_path('upfiles/hr/time_attendance/1-31_October.txt'), "r") or die("Unable to open file!");
    //     // $times = fread($myfile, filesize(base_path('upfiles/hr/time_attendance/1-31_October.txt')));
        
    //     // fclose($myfile);

    //     // $open = fopen(base_path('upfiles/hr/time_attendance/1-31_October.txt'),'r');
 
    //     // while (!feof($open)) 
    //     // {
    //     //     $getTextLine = fgets($open);
    //     //     $explodeLine = explode(" ", $getTextLine);
            
    //     //     $tmp = [];
    //     //     if (is_array($explodeLine) && count($explodeLine) > 0) {
    //     //         foreach ($explodeLine as $index => $val) {
    //     //             if ($val != '') {
    //     //                 $tmp[] = $val;
    //     //             }
    //     //         }
    //     //     }
            
    //     // //     // list($emp_code,$date,$time) = $explodeLine;

    //     // //     // echo 'code :' . $emp_code . ' date : ' . $date. ' time : ' . $time .' <br>';
            
    //     // //     // $qry = "insert into empoyee_details (name, city,postcode,job_title) values('".$name."','".$city."','".$postcode."','".$job_title."')";
    //     // //     // mysqli_query($conn,$qry);
    //     // }
        
    //     // fclose($open);

    //     // exit;
    //     // dd($txtFile);
    //     # code...
    //     $data = ['times'];
    //     return view('default.office.hr.timeattendance.index', compact($data))->render();
    // }

    public function index()
    {
        // $conditions = ['is_employee' => (int) 0];
        $conditions = [];
        $day = 0;
        $employees = User::getEmployees($conditions);
        $data = ['employees' , 'day'];
        return view('default.office.hr.timeattendance.index', compact($data))->render();
    }


    public function searchAll(Request $request)
    {
        $data = $request->input;

        $day = $data['day'];

        $conditions = [];
        $employees = User::getEmployees($conditions);
        $data = ['employees' , 'day'];
        return view('default.office.hr.timeattendance.index', compact($data))->render();
    }
    
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        // dd(MyUtilities::mkDirPathUpload(23));
        # code...
        $data = [];
        return view('default.office.hr.timeattendance.add', compact($data))->render();
    }

    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        set_time_limit(0);
        
        $response = ['status' => false, 'msg' => 'error!'];

        $auth_info = $request->session()->get('auth_info');
        $array = [];
        if ($request->ajax() && $request->isMethod('post')) {
            // -- upload file --//
            $fileTmp = $request->file('upload_file');
            $no = rand(1,1000);
            $ext = strtolower($fileTmp->extension());
            $filename = time().'_'.$no.'.'.$ext;
            $path = MyUtilities::mkDirPathUpload($no);
            $upload_result = MyUtilities::doUpload($fileTmp, base_path($path), $filename);

            if ($upload_result) {
                $array = [
                    'file_name' => $filename,
                    'file_path' => $path,
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1,
                    'created_at' => getDateNow(),
                    'updated_at' => getDateNow(),
                    'created_by' => (int) $auth_info['user_id'],
                    'updated_by' => (int) $auth_info['user_id']
                ];
                $insert_id = TimeattendanceLog::insertArray($array, true);

                $path_load_file = base_path($path.'/'.$filename);

                $open_file = fopen($path_load_file,'r');
 
                while (!feof($open_file)) {
                    $getTextLine = fgets($open_file);
                    $explodeLine = explode(" ", $getTextLine);
                    
                    $tmp = [];
                    if (is_array($explodeLine) && count($explodeLine) > 0) {
                        foreach ($explodeLine as $index => $val) {
                            if ($val != '') {
                                $tmp[] = $val;
                            }
                        }

                        if (isset($tmp[0]) && isset($tmp[0]) && isset($tmp[0])) {

                            list($d,$m,$y) = explode('/', $tmp[1]);

                            $array = [
                                'user_id' => (int) 0,
                                'code' => $tmp[0],
                                'time_type' => null,
                                'date_checked' => implode('-', [$y, $m, $d]).' '.$tmp[2].':00',
                                'time_checked' => $tmp[2],
                                'is_deleted' => (int) 0,
                                'is_active' => (int) 1,
                                'created_at' => getDateNow(),
                                'updated_at' => getDateNow(),
                                'timeattendance_logs_id' => (int) $insert_id
                            ];
                            UserTimeAttendance::insertArray($array);
                        }
                    }
                }

                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ!'];
            }
        }

        return response()->json($response, 200);
    }




    public function indexmonth()
    {
        $date_start = date("Y-m-d");

        $day = 0;
        $date_end =date("Y-m-d", strtotime("+1 month",strtotime($date_start)));

        while($date_start<$date_end)
        {
        $date_start =date("Y-m-d", strtotime("+1 day",strtotime($date_start)));
        $day++;
        }
        
        $moth = date('m');

        $year = date('Y');

        $conditions = [];
        $user_id = 0;
        $employees = User::getEmployees($conditions);
        $data = ['employees' , 'day' , 'date_start' , 'user_id' , 'moth' , 'year'];
        return view('default.office.hr.timeattendance.indexmonth', compact($data))->render();
    }


    public function searchAllmonth(Request $request)
    {
        $data = $request->input;

        $date_start = $data['year'].'-'.$data['month'].'-01';

        $day = 0;
        $date_end =date("Y-m-d", strtotime("+1 month",strtotime($date_start)));

        while($date_start<$date_end)
        {
        $date_start =date("Y-m-d", strtotime("+1 day",strtotime($date_start)));
        $day++;
        }

        
        $moth = $data['month'];

        $year = $data['year'];

        $user_id = $data['user_id'];

        $conditions = [];
        $employees = User::getEmployees($conditions);
        $data = ['employees' , 'day' , 'date_start' , 'user_id' , 'moth' , 'year'];
        return view('default.office.hr.timeattendance.indexmonth', compact($data))->render();
        
    }









    public function indexpay(Request $request)
    {

        $auth_info = $request->session()->get('auth_info');

        $date_start = date("Y-m-d");

        $day = 0;
        $date_end =date("Y-m-d", strtotime("+1 month",strtotime($date_start)));

        while($date_start<$date_end)
        {
        $date_start =date("Y-m-d", strtotime("+1 day",strtotime($date_start)));
        $day++;
        }
        
        $moth = date('m');

        $year = date('Y');

        $conditions = [];
        $user_id = 0;
        $employees = User::getEmployees($conditions);


        $data_pay = DataSetting::where('group_type', 'pay')->where('is_deleted', '0')->where('is_active','1')->get();
        $pay_month772 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',772)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month785 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',785)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();

                $pay_month785 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',785)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();

        $pay_month786 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',786)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month787 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',787)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month790 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->leftJoin('behavior_fund','data_settings.id', '=', 'behavior_fund.behavior_id')
                ->where('user_benefits.category_name','welfare')
                ->where('user_benefits.type_id',790)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();

        $Fund = BudgetsrFund::where('behavior_id',790)->where('is_deleted', '0')->where('is_active','1')->get(); 


        $data = ['employees' , 'day' , 'date_start' , 'user_id' , 'moth' , 'year','data_pay','pay_month772','pay_month785','pay_month786','pay_month787','pay_month790','Fund'];
        return view('default.office.hr.timeattendance.indexpay', compact($data))->render();
    }





    public function searchPaymonth(Request $request)
    {


        $type_pay = $request->input('id');
    
        $conditions = [];

        $employees = User::getEmployees($conditions);


        $data_pay = DataSetting::where('group_type', 'pay')->where('is_deleted', '0')->where('is_active','1')->get();

        $pay_month = DB::table('user_benefits')
                    ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                    ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                    ->where('user_benefits.category_name','pay')
                    ->where('user_benefits.is_deleted', '0')
                    ->where('user_benefits.is_active','1')->get();

                    
        $pay_month772 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',772)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month785 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',785)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();

        $pay_month786 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',786)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month787 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->where('user_benefits.category_name','pay')
                ->where('user_benefits.type_id',787)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $pay_month790 = DB::table('user_benefits')
                ->leftJoin('user_informations','user_benefits.user_id', '=', 'user_informations.users_id')
                ->leftJoin('data_settings','user_benefits.type_id', '=', 'data_settings.id')
                ->leftJoin('behavior_fund','data_settings.id', '=', 'behavior_fund.behavior_id')
                ->where('user_benefits.category_name','welfare')
                ->where('user_benefits.type_id',790)
                ->where('user_benefits.is_deleted', '0')
                ->where('user_benefits.is_active','1')->get();


        $Fund = BudgetsrFund::where('behavior_id',790)->where('is_deleted', '0')->where('is_active','1')->get(); 


        $data = ['employees' , 'pay_month', 'data_pay' ,'type_pay' ,'pay_month772','pay_month785','pay_month786','pay_month787','pay_month790','Fund'];



        return view('default.office.hr.timeattendance.indexpay', compact($data))->render();
        
    }

    
}
