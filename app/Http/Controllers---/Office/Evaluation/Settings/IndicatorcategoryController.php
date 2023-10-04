<?php

namespace App\Http\Controllers\Office\Evaluation\Settings;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use App\Models\IndicatorCategory;

class IndicatorcategoryController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $conditions = [
            'parent_id' => (int) 0, 
            'is_deleted' => (int) 0, 
            'is_active' => (int) 1, 
        ];
        $categories = IndicatorCategory::where($conditions)->orderBy('sort_order', 'asc')->get();
        
        # code...
        $data = ['categories'];
        return view('default.office.evaluation.settings.indicator.index', compact($data))->render();
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
        return view('default.office.evaluation.settings.indicator.add', compact($data))->render();
    }

    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        $response = ['status' => false, 'msg' => 'error!'];

        if ($request->ajax() && $request->isMethod('POST')) {
            $input = $request->input();

            $array = [
                'parent_id' => (int) 0,
                'sort_order' => (int) 1,
                'name' => $input['name'],
                'group_type' => $input['group_type'],
                'value_type' => (int) 0,
                'data_value' => (int) 0,
                'data_string' => '-',
                'is_deleted' => (int) $input['is_deleted'],
                'is_active' => (int) 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'amount' => (int) $input['amount']
            ];
            
            $result = DataSetting::insertArray($array);

            if ($result) {
                $response = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }
}
