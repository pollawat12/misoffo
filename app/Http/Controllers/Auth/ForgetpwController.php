<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Base;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetpwController extends Base
{
    /**
     * index
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        // $template = 'template_emails.forget-pw';
        // $contents = [
        //     'subject' => 'แจ้งรหัสผ่านชั่วคราวเพื่อใช้งาน',
        //     'body' => 'test ...'
        // ];
        // Mail::to('labelcoder@gmail.com')->send(new \App\Mail\ForgetPwMail($template, $contents));
        // die;
        // view
        $data = [];
        return view('default.auth.forget_pw', compact($data));
    }

    public function save(Request $request)
    {
        $response = ['status' => false, 'msg' => 'ไม่พบอีเมลนี้ในระบบ กรุณาลองใหม่อีกครั้งค่ะ'];

        if ($request->ajax() && $request->isMethod('post')) {
            $email = $request->input('email');
            $conditions = ['is_active' => (int) 1, 'is_deleted' => (int) 0, 'is_login' => (int) 1];
            // $user = User::where('username', trim($email))->where($conditions)->first();


            
            $userInfo = UserInformation::where('email', trim($email))->first();
            if ($userInfo && !empty($userInfo)) {
                $newPw = randomNumbers();
                $result = User::where('id', (int) $userInfo->users_id)->where($conditions)->update(['password' => Hash::make($newPw)]);
                if ($result) {
                    // send email
                    $information = UserInformation::where('users_id', (int) $userInfo->users_id)->first();
                    $template = 'template_emails.forget-pw';
                    $contents = [
                        'subject' => 'แจ้งรหัสผ่านชั่วคราวเพื่อใช้งาน',
                        'name' => $information->firstname.' '.$information->lastname,
                        'new_password' => $newPw,
                        'body' => ''
                    ];
                    Mail::to(trim($email))->send(new \App\Mail\ForgetPwMail($template, $contents));

                    $response = ['status' => true, 'msg' => 'ระบบได้จัดส่งรหัสผ่านชั่วคราวให้คุณแล้วค่ะ'];
                }
            }
        }

        return response()->json($response, 200);
    }
}
