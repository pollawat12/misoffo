<?php

namespace App\Http\Controllers\Office\Management;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\StrategySubject;

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
    
}
