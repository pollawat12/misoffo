<?php

namespace App\Http\Controllers\Office\My;

use Auth;
use URL;
use Hash;
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\User;

class ChangepassController extends Base 
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
    public function index()
    {
        $arr = [];

        $file = 'default.office.profile.changepass.index';

        return view($file, compact($arr))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $nav_login_info = Session()->get('auth_info');

            $oldPassword = $request->input('old_password');
            $newPassword = $request->input('new_password');
            $confPassword = $request->input('confirm_password');

            // if (!Hash::check(trim($oldPassword),$nav_login_info['password'])) {
            //     $response = ['status' => false, 'msg' => 'รหัสผ่านเดิมไม่ถูกต้อง!'];
            //     return response()->json($response, 200);
            // }

            // save password
            $process = User::find((int) $nav_login_info['user_id']);
            $process->password = Hash::make(trim($newPassword));
            if ($process->save()) {
                $response = ['status' => true, 'msg' => 'เปลี่ยนรหัสผ่านสำเร็จ!'];
            }
        }

        return response()->json($response, 200);
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
    public function destroy($id)
    {
        //
    }
}
