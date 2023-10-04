<?php

namespace App\Http\Controllers\Office\Management;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\StrategySubject;
use App\Models\ImportData;
/**
 * SubjectController
 */
class SubjectController extends Base 
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
     * index
     *
     * @return void
     */
    public function index()
    {
        $subjects = StrategySubject::getDataAll();
        
        # code...
        $data = ['subjects'];
        return view('default.office.management.subject.index', compact($data))->render();
    }
    
    
    /**
     * add
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        # code...
        $data = [];
        return view('name', compact($data))->render();
    }


    /**
     * importform
     *
     * @param  mixed $request
     * @return void
     */
    public function report(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        $groupoil = ImportData::where('type_id', $t)->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['t' , 'pr' , 'groupoil'];

        // display
        $file = 'default.office.management.subject.report'.$t;
        
        return view($file, compact($arr))->render();
    }
    
}
