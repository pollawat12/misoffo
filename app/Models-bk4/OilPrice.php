<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilPrice extends Model
{
    use HasFactory;

    protected $table = 'oil_price';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->oil_price_date = isset($data['oil_price_date'])  ? getInputDateToDB($data['oil_price_date']) : NULL;
        $process->oil_price_date_strart = isset($data['oil_price_date_strart'])  ? getInputDateToDB($data['oil_price_date_strart']) : NULL;
        $process->oil_price_date_end = isset($data['oil_price_date_end'])  ? getInputDateToDB($data['oil_price_date_end']) : NULL;
        $process->oil_price_buying = isset($data['oil_price_buying'])  ? trim($data['oil_price_buying']) : '0.00';
        $process->oil_price_selling = isset($data['oil_price_selling'])  ? trim($data['oil_price_selling']) : '0.00';
        $process->oil_price_propane = isset($data['oil_price_propane'])  ? trim($data['oil_price_propane']) : '0.00';
        $process->oil_price_butane = isset($data['oil_price_butane'])  ? trim($data['oil_price_butane']) : '0.00';
        $process->oil_price_exchange = isset($data['oil_price_exchange'])  ? trim($data['oil_price_exchange']) : '0.00';
        $process->oil_price_lpg_cargo = isset($data['oil_price_lpg_cargo'])  ? trim($data['oil_price_lpg_cargo']) : '0.00';
        $process->oil_price_type = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
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
        $process->oil_price_date = isset($data['oil_price_date'])  ? getInputDateToDB($data['oil_price_date']) : NULL;
        $process->oil_price_date_strart = isset($data['oil_price_date_strart'])  ? getInputDateToDB($data['oil_price_date_strart']) : NULL;
        $process->oil_price_date_end = isset($data['oil_price_date_end'])  ? getInputDateToDB($data['oil_price_date_end']) : NULL;
        $process->oil_price_buying = isset($data['oil_price_buying'])  ? trim($data['oil_price_buying']) : '0.00';
        $process->oil_price_selling = isset($data['oil_price_selling'])  ? trim($data['oil_price_selling']) : '0.00';
        $process->oil_price_propane = isset($data['oil_price_propane'])  ? trim($data['oil_price_propane']) : '0.00';
        $process->oil_price_butane = isset($data['oil_price_butane'])  ? trim($data['oil_price_butane']) : '0.00';
        $process->oil_price_exchange = isset($data['oil_price_exchange'])  ? trim($data['oil_price_exchange']) : '0.00';
        $process->oil_price_lpg_cargo = isset($data['oil_price_lpg_cargo'])  ? trim($data['oil_price_lpg_cargo']) : '0.00';
        $process->oil_price_type = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
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
