<?php

namespace App\Http\Controllers\Office\Settings;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Models\Role;

use App\Models\User;
use App\Models\UserInformation;

class UsersroleController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = User::getEmployeesRole();

        $arr = ['items'];

        // display
        $file = 'default.office.setting.usersroles.index';

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
        //
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
        $roleInfo = User::find((int) $id);

        $UserInformationInfo = UserInformation::where('users_id',$id)->get();

        $role = Role::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['id' , 'role' , 'roleInfo' , 'UserInformationInfo'];

        // display
        $file = 'default.office.setting.usersroles.edit';

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

            $result = User::updateRowRoloe($data, $id);

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
        //
    }

    public function updatepermiss(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('post')) {
            $info = $request->input('info');
            $editId = $request->input('edit_id');
            $mainCheckeds = $request->input('input_main_checked');
            $checkeds = $request->input('input_checked');

            $result = Role::updateWithArray($info, $editId);

            if ($result) {
                ModulePermission::insertWithArray($mainCheckeds, $checkeds , $editId);

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);



        $inputs = $request->input();


    }
}
