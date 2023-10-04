<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiagram extends Model
{
    use HasFactory;

    protected $table = 'user_diagram';
    
    public $timestamps = false;

    public static function insertRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->sort_order = isset($data['date_resign'])  ? trim($data['department_id']) : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : NULL;
        $process->level_id = isset($data['level_id'])  ? trim($data['level_id']) : NULL;
        $process->department_id = isset($data['department_id'])  ? trim($data['department_id']) : NULL;
        $process->email = isset($data['email'])  ? trim($data['email']) : NULL;
        $process->tel = isset($data['tel'])  ? trim($data['tel']) : NULL;
        $process->mobile = isset($data['mobile'])  ? trim($data['mobile']) : NULL;
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
        
        $process->parent_id = isset($data['leave_type'])  ? trim($data['leave_type']) : 0;
        $process->sort_order = isset($data['date_resign'])  ? trim($data['department_id']) : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : NULL;
        $process->level_id = isset($data['level_id'])  ? trim($data['level_id']) : NULL;
        $process->department_id = isset($data['department_id'])  ? trim($data['department_id']) : NULL;
        $process->email = isset($data['email'])  ? trim($data['email']) : NULL;
        $process->tel = isset($data['tel'])  ? trim($data['tel']) : NULL;
        $process->mobile = isset($data['mobile'])  ? trim($data['mobile']) : NULL;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
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
