<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amphur extends Model
{
    use HasFactory;

    protected $table = 'amphur';

    public $primaryKey  = 'AMPHUR_ID';
    
    public $timestamps = false;
    
    /**
     * getDataWithProvince
     *
     * @param  mixed $id
     * @return void
     */
    public static function getDataWithProvince($id=0)
    {
        return self::where('PROVINCE_ID',(int) $id)->orderBy('AMPHUR_NAME', 'asc')->get();
    }
}
