<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCertificateCompany extends Model
{
    use HasFactory;

    protected $table = 'budget_company';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->company_name = isset($data['company_name'])  ? trim($data['company_name']) : '';
        $process->company_num = isset($data['company_num'])  ? trim($data['company_num']) : '';
        $process->company_date = isset($data['company_date'])  ? getInputDateToDB($data['company_date']) : null;
        $process->company_bank_num = isset($data['company_bank_num'])  ? trim($data['company_bank_num']) : '';
        $process->company_bank_name = isset($data['company_bank_name'])  ? trim($data['company_bank_name']) : '';
        $process->company_bank_account = isset($data['company_bank_account'])  ? trim($data['company_bank_account']) : '';
        $process->company_bank_branch = isset($data['company_bank_branch'])  ? trim($data['company_bank_branch']) : '';
        $process->company_contact = isset($data['company_contact'])  ? trim($data['company_contact']) : '';
        $process->company_tel = isset($data['company_tel'])  ? trim($data['company_tel']) : '';
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

    public static function updateRow($data , $id)
    {
        $process = self::find((int) $id);

        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->company_name = isset($data['company_name'])  ? trim($data['company_name']) : '';
        $process->company_num = isset($data['company_num'])  ? trim($data['company_num']) : '';
        $process->company_date = isset($data['company_date'])  ? getInputDateToDB($data['company_date']) : null;
        $process->company_bank_num = isset($data['company_bank_num'])  ? trim($data['company_bank_num']) : '';
        $process->company_bank_name = isset($data['company_bank_name'])  ? trim($data['company_bank_name']) : '';
        $process->company_bank_account = isset($data['company_bank_account'])  ? trim($data['company_bank_account']) : '';
        $process->company_bank_branch = isset($data['company_bank_branch'])  ? trim($data['company_bank_branch']) : '';
        $process->company_contact = isset($data['company_contact'])  ? trim($data['company_contact']) : '';
        $process->company_tel = isset($data['company_tel'])  ? trim($data['company_tel']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
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
