<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holiday';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->is_year = isset($data['is_year'])  ? (int) $data['is_year'] : 0;
        $process->is_date  = isset($data['is_date'])  ? getDateFromInputDate($data['is_date']) : date('Y-m-d');
        $process->holiday_id = isset($data['holiday_id'])  ? trim($data['holiday_id']) : 0;
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
        
        $process->is_year = isset($data['is_year'])  ? (int) $data['is_year'] : 0;
        $process->is_date  = isset($data['is_date'])  ? getDateFromInputDate($data['is_date']) : date('Y-m-d');
        $process->holiday_id = isset($data['holiday_id'])  ? trim($data['holiday_id']) : 0;
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
