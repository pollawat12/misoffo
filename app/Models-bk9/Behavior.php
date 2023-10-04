<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;

    protected $table = 'behavior';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {

        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 0;
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : '';
        $process->user_id = isset($data['id'])  ? trim($data['id']) : 0;
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
        
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : '';
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
