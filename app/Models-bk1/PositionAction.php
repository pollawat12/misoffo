<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionAction extends Model
{
    use HasFactory;

    protected $table = 'position_actions';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->position_min = isset($data['position_min'])  ? (int) $data['position_min'] : 0;
        $process->position_max = isset($data['position_max'])  ? (int) $data['position_max'] : 0;
        $process->position_id = isset($data['position_id'])  ? trim($data['position_id']) : 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->position_min = isset($data['position_min'])  ? (int) $data['position_min'] : 0;
        $process->position_max = isset($data['position_max'])  ? (int) $data['position_max'] : 0;
        $process->position_id = isset($data['position_id'])  ? trim($data['position_id']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }
}
