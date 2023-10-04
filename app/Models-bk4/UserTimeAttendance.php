<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeAttendance extends Model
{
    use HasFactory;

    protected $table = 'user_time_attendances';
    
    public $timestamps = false;

    
    /**
     * insertArray
     *
     * @param  mixed $array
     * @param  mixed $return_id
     * @return void
     */
    public static function insertArray($array, $return_id=false)
    {
        // $query = new self;
        if ($return_id) {
            return self::create($array)->id;
        }
        return self::insert($array);
    }

}
