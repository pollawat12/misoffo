<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
use Hash;
use URL;
use Session;
// model
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserTimeAttendance;

/**
 * LoginController
 */
class LoginController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        // dd(URL('auth/login'));
        # code...
        $data = [];
        return view('default.auth.login', $data)->render();
    }
    
    /**
     * verifyLogin
     *
     * @param  mixed $request
     * @return void
     */
    public function verifyLogin(Request $request)
    {
        $resJonson = ['status' => false, 'msg' => 'ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $username = $request->input('username');

            $conditions = ['username' => trim(strtolower($username)), 
                'is_deleted' => (int) 0, 
                'is_active' => (int) 1, 
                'is_login' => (int) 1
            ];
            $user = User::where($conditions)->first();
            if ($user) {
                $password = trim($request->input('password'));
                if (Hash::check($password, $user->password)) {
                    $user_information = $user->information;
                    $userArray = [
                        'is_logined' => true,
                        'auth_info' => [
                            'user_id' => $user->id,
                            'user_code' => $user_information->code,
                            'user_name' => $user_information->firstname. ' ' . $user_information->lastname,
                            'role_id' => $user->roles_id,
                            'last_login_at' => ''
                        ]
                    ];
                    $request->session()->put($userArray);

                    $array = [
                        'user_id' => (int) $user->id,
                        'code' => $user_information->code,
                        'time_type' => null,
                        'date_checked' => getDateNow(),
                        'time_checked' => getTimeNow(),
                        'is_deleted' => (int) 0,
                        'is_active' => (int) 1,
                        'created_at' => getDateNow(),
                        'updated_at' => getDateNow(),
                        'timeattendance_logs_id' => (int) 0,
                        'wordin' => (int) $request->input('wordin')
                    ];
                    UserTimeAttendance::insertArray($array);

                    $resJonson = ['status' => true, 'msg' => 'เข้าระบบสำเร็จ'];
                }
            }
        }

        return response()->json($resJonson, 200);
    }
}
