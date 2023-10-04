<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeattendanceLog extends Model
{
    use HasFactory;

    protected $table = 'timeattendance_logs';
    
    public $timestamps = false;

    protected $fillable = ['file_name'];

    /**
     * insertArray
     *
     * @param  mixed $array
     * @param  mixed $return_id
     * @return void
     */
    public static function insertArray($array, $return_id=false)
    {
        if ($return_id) {
            return self::create($array)->id;
        }
        return self::insert($array);
    }

    /**
     * updateArray
     *
     * @param  mixed $input
     * @param  mixed $return_id
     * @return void
     */
    public static function updateArray($array, $id=0)
    {
        // $query = new self;
        return self::where('id', $id)->update($array);
    }
}
