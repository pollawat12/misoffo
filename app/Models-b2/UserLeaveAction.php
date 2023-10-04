<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeaveAction extends Model
{
    use HasFactory;

    protected $table = 'user_leave_actions';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->role_num = isset($data['role_num'])  ? (int) $data['role_num'] : 0;
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
        
        $process->role_num = isset($data['role_num'])  ? (int) $data['role_num'] : 0;
        $process->leave_id = isset($data['leave_id'])  ? trim($data['leave_id']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }
}
