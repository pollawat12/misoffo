<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';
    
    public $timestamps = false;

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->address = (isset($data['address'])) ? $data['address'] : null;
        $process->province_no = (isset($data['province_no'])) ? $data['province_no'] : (int) 0;
        $process->district_no = (isset($data['district_no'])) ? $data['district_no'] : (int) 0;
        $process->subdistrict_no = (isset($data['subdistrict_no'])) ? $data['subdistrict_no'] : (int) 0;
        $process->zipcode = (isset($data['zipcode'])) ? $data['zipcode'] : null;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->address_present = (isset($data['address_present'])) ? $data['address_present'] : null;
        $process->province_no_present = (isset($data['province_no_present'])) ? $data['province_no_present'] : (int) 0;
        $process->district_no_present = (isset($data['district_no_present'])) ? $data['district_no_present'] : (int) 0;
        $process->subdistrict_no_present = (isset($data['subdistrict_no_present'])) ? $data['subdistrict_no_present'] : (int) 0;
        $process->zipcode_present = (isset($data['zipcode_present'])) ? $data['zipcode_present'] : null;
        
        return $process->save();
    }

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->sort_order = 0;
        $process->address = (isset($data['address'])) ? $data['address'] : null;
        $process->province_no = (isset($data['province_no'])) ? $data['province_no'] : (int) 0;
        $process->district_no = (isset($data['district_no'])) ? $data['district_no'] : (int) 0;
        $process->subdistrict_no = (isset($data['subdistrict_no'])) ? $data['subdistrict_no'] : (int) 0;
        $process->zipcode = (isset($data['zipcode'])) ? $data['zipcode'] : null;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->address_present = (isset($data['address_present'])) ? $data['address_present'] : null;
        $process->province_no_present = (isset($data['province_no_present'])) ? $data['province_no_present'] : (int) 0;
        $process->district_no_present = (isset($data['district_no_present'])) ? $data['district_no_present'] : (int) 0;
        $process->subdistrict_no_present = (isset($data['subdistrict_no_present'])) ? $data['subdistrict_no_present'] : (int) 0;
        $process->zipcode_present = (isset($data['zipcode_present'])) ? $data['zipcode_present'] : null;
        $process->users_id = (int) $data['user_id'];
        $process->is_present = (int) 0;
        $process->tel_present = '';
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        return $process->save();
    }
}
