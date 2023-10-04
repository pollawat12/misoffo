<?php

namespace App\Http\Controllers\Office\Durable;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Models\Durable;
use App\Models\DurableAmount;
use App\Models\DurableDisbursement;
use App\Models\DataSetting;
use App\Models\DurableRepair;
use App\Models\Project;

class ReportController extends Base
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
    public function index(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        if($t == 'durable'){
            $items = Durable::where('durable_type', 'durable')->where('is_deleted', '0')->where('is_active','1')->get();
        }elseif($t == 'office'){
            $items = Durable::where('durable_type', 'durable')->where('borrow_project', '0')->where('is_deleted', '0')->where('is_active','1')->get();
        }elseif($t == 'borrow'){
            $items = Durable::where('durable_type', 'durable')->where('durable_status', '1')->where('is_deleted', '0')->where('is_active','1')->get();
        }elseif($t == 'borrow'){
            $items = Durable::where('durable_type', 'durable')->where('durable_status', '1')->where('is_deleted', '0')->where('is_active','1')->get();
        }elseif($t == 'distribution'){
            $items = Durable::where('durable_type', 'durable')->where('durable_status', '2')->where('is_deleted', '0')->where('is_active','1')->get();
        }elseif($t == 'supplies'){
            $items = Durable::getDurable('supplies', $pr); 
        }elseif($t == 'disbursement'){
            $items = DurableDisbursement::getDurable();
        }else{
            $items = Durable::where('is_deleted', '0')->where('is_active','1')->get();
        }

        $project = Project::where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['items','t','pr','project'];

        // display
        $file = 'default.office.durable.report.'.$t;

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
