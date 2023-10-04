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

                // $purchasesstatus = DataSetting::getNameDataByValueAndType($row->purchases_purchasing_status,'purchasesstatus');

                // $purchasesmethod = DataSetting::getNameDataByValueAndType($row->purchases_method,'purchasesmethod');
                $array[] = [
                    'id' => $row->id,
                    'purchases_invoice_date' => $row->purchases_invoice_date,
                    'purchases_name' => $row->purchases_name,
                    'purchases_allocated_budget' => $row->purchases_allocated_budget,
                    'purchases_status' => $row->purchases_status,
                    
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
        $process->purchases_allocated_budget = isset($data['purchases_allocated_budget'])  ? trim($data['purchases_allocated_budget']) : '0.00';
        $process->purchases_refer = isset($data['purchases_refer'])  ? trim($data['purchases_refer']) : '';
        $process->purchases_board = isset($data['purchases_board'])  ? trim($data['purchases_board']) : '';
        $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : '';
        $process->budget_categroy = isset($data['budget_categroy'])  ? trim($data['budget_categroy']) : '';
        $process->institution_id = isset($data['institution_id'])  ? trim($data['institution_id']) : '';
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : '';
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
        $process->purchases_allocated_budget = isset($data['purchases_allocated_budget'])  ? trim($data['purchases_allocated_budget']) : '0.00';
        $process->purchases_refer = isset($data['purchases_refer'])  ? trim($data['purchases_refer']) : '';
        $process->purchases_board = isset($data['purchases_board'])  ? trim($data['purchases_board']) : '';
        // $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : '';
        $process->budget_categroy = isset($data['budget_categroy'])  ? trim($data['budget_categroy']) : '';
        $process->institution_id = isset($data['institution_id'])  ? trim($data['institution_id']) : '';
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRow2($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_order_number = trim($data['purchases_order_number']);
        $process->purchases_invoice_date_2 = isset($data['purchases_invoice_date_2'])  ? getInputDateToDB($data['purchases_invoice_date_2']) : NULL;
        $process->purchases_middle_price = isset($data['purchases_middle_price'])  ? trim($data['purchases_middle_price']) : '0.00';
        $process->purchases_method = isset($data['purchases_method'])  ? trim($data['purchases_method']) : '';
        $process->purchases_board_buy = isset($data['purchases_board_buy'])  ? trim($data['purchases_board_buy']) : '';
        $process->purchases_board_check = isset($data['purchases_board_check'])  ? trim($data['purchases_board_check']) : '';
        $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRow3($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_order_number = trim($data['purchases_order_number']);
        $process->purchases_invoice_date_3 = isset($data['purchases_invoice_date_3'])  ? getInputDateToDB($data['purchases_invoice_date_3']) : NULL;
        $process->purchases_offer_price = isset($data['purchases_offer_price'])  ? trim($data['purchases_offer_price']) : '0.00';
        $process->purchases_offer_name = isset($data['purchases_offer_name'])  ? trim($data['purchases_offer_name']) : '';
        $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRow4($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_order_number = trim($data['purchases_order_number']);
        $process->purchases_invoice_date_4 = isset($data['purchases_invoice_date_4'])  ? getInputDateToDB($data['purchases_invoice_date_4']) : NULL;
        $process->purchases_category_contract = isset($data['purchases_category_contract'])  ? trim($data['purchases_category_contract']) : 0;
        $process->purchases_pair_contract = isset($data['purchases_pair_contract'])  ? trim($data['purchases_pair_contract']) : '';
        $process->purchases_num_contract = isset($data['purchases_num_contract'])  ? trim($data['purchases_num_contract']) : '';
        $process->purchases_add_contract = isset($data['purchases_add_contract'])  ? trim($data['purchases_add_contract']) : '';
        $process->purchases_guarantee_contract = isset($data['purchases_guarantee_contract'])  ? trim($data['purchases_guarantee_contract']) : '';
        $process->purchases_guarantee_price_contract = isset($data['purchases_guarantee_price_contract'])  ? trim($data['purchases_guarantee_price_contract']) : '0.00';
        $process->purchases_guarantee_performance = isset($data['purchases_guarantee_performance'])  ? trim($data['purchases_guarantee_performance']) : 0;
        $process->purchases_guarantee_price_performance = isset($data['purchases_guarantee_price_performance'])  ? trim($data['purchases_guarantee_price_performance']) : '0.00';
        $process->purchases_installment = isset($data['purchases_installment'])  ? trim($data['purchases_installment']) : 0;
        $process->purchases_installment_day = isset($data['purchases_installment_day'])  ? getInputDateToDB($data['purchases_installment_day']) : NULL;
        $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }


    public static function updateRow5($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_name = trim($data['purchases_name']);
        $process->purchases_invoice_date_5 = isset($data['purchases_invoice_date_5'])  ? getInputDateToDB($data['purchases_invoice_date_5']) : NULL;
        $process->purchases_num_installment = isset($data['purchases_num_installment'])  ? trim($data['purchases_num_installment']) : 0;
        $process->purchases_invoice_date_51 = isset($data['purchases_invoice_date_51'])  ? getInputDateToDB($data['purchases_invoice_date_51']) : NULL;
        $process->purchases_detail_check = isset($data['purchases_detail_check'])  ? trim($data['purchases_detail_check']) : '';
        $process->purchases_invoice_date_52 = isset($data['purchases_invoice_date_52'])  ? getInputDateToDB($data['purchases_invoice_date_52']) : NULL;
        $process->purchases_numsuss_installment = isset($data['purchases_numsuss_installment'])  ? trim($data['purchases_numsuss_installment']) : '';
        $process->purchases_order_installment = isset($data['purchases_order_installment'])  ? trim($data['purchases_order_installment']) : '';
        $process->purchases_price_installment = isset($data['purchases_price_installment'])  ? trim($data['purchases_price_installment']) : '0.00';
        $process->purchases_status = isset($data['purchases_status'])  ? trim($data['purchases_status']) : '';
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
