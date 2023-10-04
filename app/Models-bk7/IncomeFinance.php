<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeFinance extends Model
{
    use HasFactory;

    protected $table = 'income_finance';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->income_date = isset($data['income_date'])  ? getInputDateToDB($data['income_date']) : NULL;
        $process->income_number = isset($data['income_number'])  ? trim($data['income_number']) : '';
        $process->number_sum = isset($data['number_sum'])  ? trim($data['number_sum']) : '0.00';
        $process->type_id = isset($data['type_id'])  ? trim($data['type_id']) : '';
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : NULL;
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
        $process->sort_order = (int) 1;
        $process->income_date = isset($data['income_date'])  ? getInputDateToDB($data['income_date']) : NULL;
        $process->income_number = isset($data['income_number'])  ? trim($data['income_number']) : '';
        $process->number_sum = isset($data['number_sum'])  ? trim($data['number_sum']) : '0.00';
        $process->type_id = isset($data['type_id'])  ? trim($data['type_id']) : '';
        $process->detail = isset($data['detail'])  ? trim($data['detail']) : NULL;
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
