<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'district';
    
    public $timestamps = false;

    public $primaryKey  = 'DISTRICT_ID';

    
    /**
     * getDataWithAmphur
     *
     * @param  mixed $id
     * @return void
     */
    public static function getDataWithAmphur($id=0)
    {
        return self::where('AMPHUR_ID',(int) $id)->orderBy('DISTRICT_NAME', 'asc')->get();
    }
}
