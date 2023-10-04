<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\ReserveMeeting;

/**
 * StrategyController
 */
class StrategyController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $meeting_lists = ReserveMeeting::getMeetingLists();


        $price_end_day = [
            ['label' => 'Dubai','s_price' => '70.8600','e_price' => '71.6900','diff_price' => '+0.8300'],
            ['label' => 'Brent','s_price' => '72.9200','e_price' => '','diff_price' => ''],
            ['label' => 'WTI','s_price' => '69.7200','e_price' => '','diff_price' => ''],
            ['label' => 'Unl 95','s_price' => '81.7500','e_price' => '82.7300','diff_price' => '+0.9800'],
            ['label' => 'Unl 91 (Non-Oxy)','s_price' => '80.9800','e_price' => '81.8100','diff_price' => '+0.8300'],
            ['label' => 'Gasoil 0.05','s_price' => '76.8700','e_price' => '77.7600','diff_price' => '+0.8900'],
            ['label' => 'Gasoil 0.001','s_price' => '80.2700','e_price' => '81.1900','diff_price' => '+0.9200'],
            ['label' => 'LPG','s_price' => '697.0000','e_price' => '703.5000','diff_price' => '+6.5000'],
            ['label' => 'Exchange','s_price' => '32.8858','e_price' => '32.9551','diff_price' => '+0.0693']
        ];
        $price_start_day = [
            ['label' => 'Dubai','s_price' => '70.8600','e_price' => '71.6900','diff_price' => '+0.8300'],
            ['label' => 'Brent','s_price' => '72.9200','e_price' => '','diff_price' => ''],
            ['label' => 'WTI','s_price' => '69.7200','e_price' => '','diff_price' => ''],
            ['label' => 'Unl 95','s_price' => '81.7500','e_price' => '82.7300','diff_price' => '+0.9800'],
            ['label' => 'Unl 91 (Non-Oxy)','s_price' => '80.9800','e_price' => '81.8100','diff_price' => '+0.8300'],
            ['label' => 'Gasoil 0.05','s_price' => '76.8700','e_price' => '77.7600','diff_price' => '+0.8900'],
            ['label' => 'Gasoil 0.001','s_price' => '80.2700','e_price' => '81.1900','diff_price' => '+0.9200'],
            ['label' => 'LPG','s_price' => '697.0000','e_price' => '703.5000','diff_price' => '+6.5000'],
            ['label' => 'Exchange','s_price' => '32.8858','e_price' => '32.9551','diff_price' => '+0.0693']
        ];
        
        # code...
        $data = ['auth_status', 'auth_info', 'meeting_lists','price_start_day','price_end_day'];
        return view('default.dashboard.index-strategy', compact($data))->render();
    }
}
