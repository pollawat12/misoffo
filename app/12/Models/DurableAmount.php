<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableAmount extends Model
{
    use HasFactory;

    protected $table = 'durable_amount';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        list($mm,$dd,$yyyy) = explode('/', $data['amount_date']);
        $year = $yyyy + 543;
        $amount_Lot_No = $year.''.$dd.''.$mm.'P'.$data['value_id'];

        $process = new self;
        $process->amount_Lot_No = $amount_Lot_No;
        $process->amount_date = isset($data['amount_date'])  ? getInputDateToDB($data['amount_date']) : date('Y-m-d');
        $process->amount_number = isset($data['amount_number'])  ? trim($data['amount_number']) : '';
        $process->amount_name = isset($data['amount_name'])  ? trim($data['amount_name']) : 0;
        $process->invoice_file = isset($data['invoice_file'])  ? trim($data['invoice_file']) : '';
        $process->amount_price = isset($data['amount_price'])  ? trim($data['amount_price']) : '';
        $process->amount_vat = isset($data['amount_vat'])  ? trim($data['amount_vat']) : '';
        $process->amount_sum = isset($data['amount_sum'])  ? trim($data['amount_sum']) : '';
        $process->amount_num = isset($data['amount_num'])  ? trim($data['amount_num']) : '';
        $process->distribute_num = isset($data['amount_num'])  ? trim($data['amount_num']) : '';
        $process->money_id = isset($data['money_id'])  ? trim($data['money_id']) : '';
        $process->project_id = isset($data['borrow_project'])  ? trim($data['borrow_project']) : '';
        $process->durable_id = isset($data['value_id'])  ? trim($data['value_id']) : '';
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
        
        $process->amount_date = isset($data['amount_date'])  ? getInputDateToDB($data['amount_date']) : date('Y-m-d');
        $process->amount_number = isset($data['amount_number'])  ? trim($data['amount_number']) : '';
        $process->amount_name = isset($data['amount_name'])  ? trim($data['amount_name']) : 0;
        $process->invoice_file = isset($data['invoice_file'])  ? trim($data['invoice_file']) : '';
        $process->amount_price = isset($data['amount_price'])  ? trim($data['amount_price']) : '';
        $process->amount_vat = isset($data['amount_vat'])  ? trim($data['amount_vat']) : '';
        $process->amount_sum = isset($data['amount_sum'])  ? trim($data['amount_sum']) : '';
        $process->amount_num = isset($data['amount_num'])  ? trim($data['amount_num']) : '';
        $process->money_id = isset($data['money_id'])  ? trim($data['money_id']) : '';
        $process->project_id = isset($data['borrow_project'])  ? trim($data['borrow_project']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRowSum($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->distribute_num = $data;
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
