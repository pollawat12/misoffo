<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Province;

class ProvinceTh extends Model
{
    use HasFactory;

    protected $table = 'province_th';
    
    public $timestamps = false;


    public static function dataUpdateLatLng()
    {
        $provinceTHInfo = self::all();

        foreach ($provinceTHInfo as $row) {
            $province_info = Province::where('PROVINCE_NAME', 'like', '%'.trim($row->province_name).'%')->first();
            if (!empty($province_info)) {
                $province_process = Province::where('PROVINCE_ID',(int) $province_info->PROVINCE_ID)->first();

                $province_process->PROVINCE_LAT = $row->province_lat;
                $province_process->PROVINCE_LNG = $row->province_lon;
                $province_process->PROVINCE_ZOOM = $row->province_zoom;
                $province_process->save();
            }
        }
    }
}
