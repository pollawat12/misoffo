<?php

namespace App\Http\Controllers\Office\Strategy;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
use App\Imports\StrategydataImport;
use Maatwebsite\Excel\Facades\Excel;

// model
use App\Models\StrategySubject;
/**
 * SubjectController
 */
class SubjectController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        # code...
        $data = [];
        return view('default.office.strategy.data.index', compact($data))->render();
    }
    
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        $type_id = $request->type_id;
        $type_info = StrategySubject::find((int) $type_id);
        

        # code...
        $data = ['type_info', 'type_id'];
        return view('default.office.strategy.data.add', compact($data))->render();
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function edit($id, Request $request)
    {
        
        # code...
        $data = ['id'];
        return view('default.office.strategy.data.add', compact($data))->render();
    }

    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        $file_attach = $request->file('upload_file');

        Excel::import(new StrategydataImport, $file_attach);
    }
    
}
