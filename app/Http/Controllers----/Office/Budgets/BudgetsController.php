<?php

namespace App\Http\Controllers\Office\Budgets;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;
use App\Libraries\MyLogs;

use Auth;

use App\Models\DataSetting;

class BudgetsController extends Base
{
    public function index(Request $request)
    {
        $budgets = DataSetting::where('group_type', "budgets")->where('is_deleted', '0')->where('is_active','1')->get();

        $arr = ['budgets'];

        // display
        $file = 'default.office.budgets.budget.index';
        
        return view($file, compact($arr))->render();
    }

}
