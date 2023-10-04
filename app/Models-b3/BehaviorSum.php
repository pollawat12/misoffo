<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorSum extends Model
{
    use HasFactory;

    protected $table = 'behavior_sum';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {

        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 0;
        $process->value_sum = isset($data['value_sum'])  ? trim($data['value_sum']) : 0.00;
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : '';
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->years_id = isset($data['years_id'])  ? trim($data['years_id']) : 0;
        $process->ep_value = isset($data['ep_value'])  ? trim($data['ep_value']) : 0;
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
        
        $process->value_sum = isset($data['value_sum'])  ? trim($data['value_sum']) : 0.00;
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : '';
        $process->user_id = isset($data['id'])  ? trim($data['id']) : 0;
        $process->years_id = isset($data['years_id'])  ? trim($data['years_id']) : 0;
        $process->ep_value = isset($data['ep_value'])  ? trim($data['ep_value']) : 0;
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
