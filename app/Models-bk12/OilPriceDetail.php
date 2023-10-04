<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilPriceDetail extends Model
{
    use HasFactory;

    protected $table = 'oil_price_detail';
    
    public $timestamps = false;

    public static function inserRow($dateOil , $max=0 , $min=0 , $typeid , $oiltype , $oilcategory , $returnId=false)
    {
        
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->oil_date = getInputDateToDB($dateOil);
        $process->oil_title = $typeid;
        $process->oil_min = isset($min)  ? trim($min) : '0.00';
        $process->oil_max = isset($max)  ? trim($max) : '0.00';
        $process->oil_price_id = $returnId;
        $process->oil_category = $oilcategory;
        $process->oil_type = $oiltype;
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


    public static function updateRow($dateOil , $max=0 , $min=0 , $typeid , $oiltype , $oilcategory , $id)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->oil_date = getInputDateToDB($dateOil);
        $process->oil_title = $typeid;
        $process->oil_min = isset($min)  ? trim($min) : '0.00';
        $process->oil_max = isset($max)  ? trim($max) : '0.00';
        $process->oil_category = $oilcategory;
        $process->oil_type = $oiltype;
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
