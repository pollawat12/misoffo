<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    
    public $timestamps = false;
    
        
    /**
     * insertOneWithArray
     *
     * @param  mixed $data
     * @param  mixed $returnId
     * @return void
     */
    public static function insertOneWithArray($data=[], $returnId=false)
    {
        $insertResult = DB::table('activity_logs')->insert($data);

        if ($returnId) { return DB::getPdo()->lastInsertId(); }

        return $insertResult;
    }
    
    /**
     * getByPositionId
     *
     * @param  mixed $positionId
     * @return void
     */
    public static function getByPositionId($positionId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            // 'position_id' => (int) $positionId
        ];
        $activities = self::where($conditions)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('created_at', 'desc')->get();

        return $activities;
    }
}
