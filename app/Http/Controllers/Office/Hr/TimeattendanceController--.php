<?php

namespace App\Http\Controllers\Office\Hr;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Libraries\MyUtilities;
// model
use App\Models\DataSetting;
use App\Models\TimeattendanceLog;
use App\Models\UserTimeAttendance;
use App\Models\User;

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

    
}
