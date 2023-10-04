<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getPurchases($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $purchasesstatus = DataSetting::getNameDataByValueAndType($row->purchases_purchasing_status,'purchasesstatus');

                $purchasesmethod = DataSetting::getNameDataByValueAndType($row->purchases_method,'purchasesmethod');
                $array[] = [
                    'id' => $row->id,
                    'purchases_order_number' => $row->purchases_order_number,
                    'purchases_invoice_date' => $row->purchases_invoice_date,
                    'purchases_name' => $row->purchases_name,
                    'purchases_company' => $row->purchases_company,
                    'purchases_allocated_budget' => $row->purchases_allocated_budget,
                    'purchases_middle_price' => $row->purchases_middle_price,
                    'purchases_method' => $purchasesmethod,
                    'purchases_contract_amount' => $row->purchases_contract_amount,
                    'purchases_purchasing_status' => $purchasesstatus,
                    
                ];
            }
        }


        return $array;
    }


    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_order_number = trim($data['purchases_order_number']);
        $process->purchases_invoice_date = isset($data['purchases_invoice_date'])  ? getInputDateToDB($data['purchases_invoice_date']) : NULL;
        $process->purchases_fiscal_year = isset($data['purchases_fiscal_year'])  ? trim($data['purchases_fiscal_year']) : NULL;
        $process->purchases_allocated_budget = isset($data['purchases_allocated_budget'])  ? trim($data['purchases_allocated_budget']) : '0.00';
        $process->purchases_middle_price = isset($data['purchases_middle_price'])  ? trim($data['purchases_middle_price']) : '0.00';
        $process->purchases_method = isset($data['purchases_method'])  ? trim($data['purchases_method']) : 0;
        $process->purchases_company = isset($data['purchases_company'])  ? trim($data['purchases_company']) : '';
        $process->purchases_contract_number = isset($data['purchases_contract_number'])  ? trim($data['purchases_contract_number']) : '';
        $process->purchases_contract_date = isset($data['purchases_contract_date'])  ? getInputDateToDB($data['purchases_contract_date']) : NULL;
        $process->purchases_contract_expiration_date = isset($data['purchases_contract_expiration_date'])  ? getInputDateToDB($data['purchases_contract_expiration_date']) : NULL;
        $process->purchases_contract_amount = isset($data['purchases_contract_amount'])  ? trim($data['purchases_contract_amount']) : '0.00';
        $process->purchases_margin_type = isset($data['purchases_margin_type'])  ? trim($data['purchases_margin_type']) : 0;
        $process->purchases_bank = isset($data['purchases_bank'])  ? trim($data['purchases_bank']) : NULL;
        $process->purchases_account_number = isset($data['purchases_account_number'])  ? trim($data['purchases_account_number']) : NULL;
        $process->purchases_contrac_dated = isset($data['purchases_contrac_dated'])  ? getInputDateToDB($data['purchases_contrac_dated']) : NULL;
        $process->purchases_insurance_amount = isset($data['purchases_insurance_amount'])  ? trim($data['purchases_insurance_amount']) : '0.00';    
        $process->purchases_warranty_start = isset($data['purchases_warranty_start'])  ? getInputDateToDB($data['purchases_warranty_start']) : NULL;
        $process->purchases_warranty_end = isset($data['purchases_warranty_end'])  ? getInputDateToDB($data['purchases_warranty_end']) : NULL;
        $process->purchases_date_committee = isset($data['purchases_date_committee'])  ? getInputDateToDB($data['purchases_date_committee']) : NULL;
        $process->purchases_date_return_due = isset($data['purchases_date_return_due'])  ? getInputDateToDB($data['purchases_date_return_due']) : NULL;
        $process->purchases_inspector = 0;
        $process->purchases_purchasing_status = isset($data['purchases_purchasing_status'])  ? trim($data['purchases_purchasing_status']) : 0;
        $process->purchases_check_date = isset($data['purchases_check_date'])  ? getInputDateToDB($data['purchases_check_date']) : NULL;
        $process->purchases_note = isset($data['purchases_note'])  ? trim($data['purchases_fiscal_year']) : NULL;
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
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_order_number = trim($data['purchases_order_number']);
        $process->purchases_invoice_date = isset($data['purchases_invoice_date'])  ? getInputDateToDB($data['purchases_invoice_date']) : NULL;
        $process->purchases_fiscal_year = isset($data['purchases_fiscal_year'])  ? trim($data['purchases_fiscal_year']) : NULL;
        $process->purchases_allocated_budget = isset($data['purchases_allocated_budget'])  ? trim($data['purchases_allocated_budget']) : '0.00';
        $process->purchases_middle_price = isset($data['purchases_middle_price'])  ? trim($data['purchases_middle_price']) : '0.00';
        $process->purchases_method = isset($data['purchases_method'])  ? trim($data['purchases_method']) : 0;
        $process->purchases_company = trim($data['purchases_company']);
        $process->purchases_contract_number = trim($data['purchases_contract_number']);
        $process->purchases_contract_date = isset($data['purchases_contract_date'])  ? getInputDateToDB($data['purchases_contract_date']) : NULL;
        $process->purchases_contract_expiration_date = isset($data['purchases_contract_expiration_date'])  ? getInputDateToDB($data['purchases_contract_expiration_date']) : NULL;
        $process->purchases_contract_amount = isset($data['purchases_contract_amount'])  ? trim($data['purchases_contract_amount']) : '0.00';
        $process->purchases_margin_type = isset($data['purchases_margin_type'])  ? trim($data['purchases_margin_type']) : 0;
        $process->purchases_bank = isset($data['purchases_bank'])  ? trim($data['purchases_bank']) : NULL;
        $process->purchases_account_number = isset($data['purchases_account_number'])  ? trim($data['purchases_account_number']) : NULL;
        $process->purchases_contrac_dated = isset($data['purchases_contrac_dated'])  ? getInputDateToDB($data['purchases_contrac_dated']) : NULL;
        $process->purchases_insurance_amount = isset($data['purchases_insurance_amount'])  ? trim($data['purchases_insurance_amount']) : '0.00';    
        $process->purchases_warranty_start = isset($data['purchases_warranty_start'])  ? getInputDateToDB($data['purchases_warranty_start']) : NULL;
        $process->purchases_warranty_end = isset($data['purchases_warranty_end'])  ? getInputDateToDB($data['purchases_warranty_end']) : NULL;
        $process->purchases_date_committee = isset($data['purchases_date_committee'])  ? getInputDateToDB($data['purchases_date_committee']) : NULL;
        $process->purchases_date_return_due = isset($data['purchases_date_return_due'])  ? getInputDateToDB($data['purchases_date_return_due']) : NULL;
        $process->purchases_inspector = 0;
        $process->purchases_purchasing_status = isset($data['purchases_purchasing_status'])  ? trim($data['purchases_purchasing_status']) : 0;
        $process->purchases_check_date = isset($data['purchases_check_date'])  ? getInputDateToDB($data['purchases_check_date']) : NULL;
        $process->purchases_note = isset($data['purchases_note'])  ? trim($data['purchases_fiscal_year']) : NULL;
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

    public static function updateRowStatus($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->purchases_purchasing_status = isset($data['purchases_status_update'])  ? trim($data['purchases_status_update']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

}
