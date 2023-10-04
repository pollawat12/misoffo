<?php

namespace App\Http\Controllers\Office\Strategic;

use Illuminate\Http\Request;
use App\Http\Controllers\Base;

use App\Libraries\MyUtilities;

use App\Models\OilPrice;
use App\Models\OilPriceDetail;
use App\Models\DataSetting;
use App\Imports\ExchangeImport;
use App\Imports\CrudeImport;
use App\Imports\InsideCrudeImport;
use App\Imports\LpgCargoImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Base
{
    /**
     * importform
     *
     * @return void
     */
    public function importform(Request $request)
    {
        $t = $request->input('t');
        $pr = $request->input('pr');

        # code...
        $arr = ['t','pr'];
        $file = 'default.office.strategic.'.$t.'.imports';

        return view($file, compact($arr))->render();
    }


    /**
     * invimport
     *
     * @param  mixed $req
     * @return void
     */
    public function importsave(Request $req)
    {
        set_time_limit(0);

        $response = ['status' => false, 'msg' => 'error!'];

        if ($req->ajax() && $req->isMethod('post')) {
            // -- upload file --//
            $fileTmp = $req->file('file_upload');

            $t = $req->input('t');
            $pr = $req->input('pr');

            if($pr == 1){
                $importResult = Excel::import(new CrudeImport(0), $fileTmp);
            }elseif($pr == 2){
                $importResult = Excel::import(new InsideCrudeImport(0), $fileTmp);
            }elseif($pr == 3){
                $importResult = Excel::import(new LpgCargoImport(0), $fileTmp);
            }elseif($pr == 4){
                $importResult = Excel::import(new ExchangeImport(0), $fileTmp);
            }
            

            if ($importResult) {

                $resp = ['status' => true, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
            }
        }
        
        return response()->json($resp, 200);
    }
}
