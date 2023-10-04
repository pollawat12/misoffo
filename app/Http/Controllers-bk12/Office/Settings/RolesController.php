<?php

namespace App\Http\Controllers\Office\Settings;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Models\Role;

use App\Models\ModulePermission;
use App\Models\ModuleFunction;

class RolesController extends Base
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Role::getAll();

        $arr = ['items'];

        // display
        $file = 'default.office.setting.roles.index';

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
        $menus = ModuleFunction::getFunctionForRoles();
        $roleInfo = Role::find((int) $id);

        $arr = ['id','menus', 'roleInfo'];

        // display
        $file = 'default.office.setting.roles.edit';

        return view($file, compact($arr))->render();
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

    public function updatepermiss(Request $request)
    {
        $resp = ['status' => false, 'msg' => 'error!'];


        if ($request->ajax() && $request->isMethod('post')) {
            $info = $request->input('info');
            $editId = $request->input('edit_id');
            $mainCheckeds = $request->input('input_main_checked');
            $mainCheckeds2 = $request->input('input_main_checked2');
            $checkeds = $request->input('input_checked');
            $checkeds2 = $request->input('input_checked2');

            $del = ModulePermission::where('roles_id' , $editId)->delete();
            
            $result = Role::updateWithArray($info, $editId);

            if ($result) {
                ModulePermission::insertWithArray($mainCheckeds , $mainCheckeds2 , $checkeds , $checkeds2 , $editId);

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($resp, 200);



        $inputs = $request->input();


    }
}
