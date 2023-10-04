<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategySubject extends Model
{
    use HasFactory;

    protected $table = 'strategy_subjects';
    
    public $timestamps = false;
    
        
    /**
     * getDataAll
     *
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataAll($isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);
        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('sort_order','asc')->get();
    }
}
