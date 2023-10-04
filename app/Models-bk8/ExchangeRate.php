<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $table = 'exchange_rate';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->period = isset($data['period'])  ? getInputDateToDB($data['period']) : NULL;
        $process->currency_type = isset($data['currency_type'])  ? trim($data['currency_type']) : '';
        $process->rate = isset($data['rate'])  ? trim($data['rate']) : '0.00';
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
        $process->period = isset($data['period'])  ? getInputDateToDB($data['period']) : NULL;
        $process->currency_type = isset($data['currency_type'])  ? trim($data['currency_type']) : '';
        $process->rate = isset($data['rate'])  ? trim($data['rate']) : '0.00';
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
