<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetting extends Model
{
    use HasFactory;

    protected $table = 'leave_settings';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 0;
        $process->number_date = isset($data['number_date'])  ? (int) $data['number_date'] : 0;
        $process->sum_not_over = isset($data['sum_not_over'])  ? (int) $data['sum_not_over'] : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->leave_id = isset($data['leave_id'])  ? trim($data['leave_id']) : 0;
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
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 0;
        $process->number_date = isset($data['number_date'])  ? (int) $data['number_date'] : 0;
        $process->sum_not_over = isset($data['sum_not_over'])  ? (int) $data['sum_not_over'] : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->leave_id = isset($data['leave_id'])  ? trim($data['leave_id']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function deleteRow($id=0)
    {
        $process = self::find((int) $id);
        
        $process->is_deleted = (int) 1;
        $process->is_active = (int) 0;
        $process->updated_at = getDateNow();
        $process->save();
        
        return $process->save();
    }
}
