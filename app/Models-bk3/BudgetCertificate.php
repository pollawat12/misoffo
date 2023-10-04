<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCertificate extends Model
{
    use HasFactory;

    protected $table = 'budget_certificate';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->certificate_date = isset($data['certificate_date'])  ? getInputDateToDB($data['certificate_date']) : date('Y-m-d');
        $process->certificate_id = isset($data['certificate_id'])  ? trim($data['certificate_id']) : '';
        $process->certificate_num = isset($data['certificate_num'])  ? trim($data['certificate_num']) : '';
        $process->certificate_payfor = isset($data['certificate_payfor'])  ? trim($data['certificate_payfor']) : 0;
        $process->certificate_type = isset($data['certificate_type'])  ? trim($data['certificate_type']) : 0;
        $process->certificate_bank_num = isset($data['certificate_bank_num'])  ? trim($data['certificate_bank_num']) : '';
        $process->certificate_bank_name = isset($data['certificate_bank_name'])  ? trim($data['certificate_bank_name']) : '';
        $process->certificate_bank_account = isset($data['certificate_bank_account'])  ? trim($data['certificate_bank_account']) : '';
        $process->certificate_bank_branch = isset($data['certificate_bank_branch'])  ? trim($data['certificate_bank_branch']) : '';
        $process->certificate_check_num = isset($data['certificate_check_num'])  ? trim($data['certificate_check_num']) : '';
        $process->certificate_check_date = isset($data['certificate_check_date'])  ? getInputDateToDB($data['certificate_check_date']) : null;
        $process->certificate_organizer = isset($data['certificate_organizer'])  ? trim($data['certificate_organizer']) : '';
        $process->certificate_inspector = isset($data['certificate_inspector'])  ? trim($data['certificate_inspector']) : '';
        $process->certificate_approver = isset($data['certificate_approver'])  ? trim($data['certificate_approver']) : '';
        $process->certificate_payer = isset($data['certificate_payer'])  ? trim($data['certificate_payer']) : '';
        $process->certificate_recipient = isset($data['certificate_recipient'])  ? trim($data['certificate_recipient']) : '';
        $process->certificate_note = isset($data['certificate_note'])  ? trim($data['certificate_note']) : '';
        $process->type_id = isset($data['type_id'])  ? trim($data['type_id']) : '';
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
        $process->certificate_date = isset($data['certificate_date'])  ? getInputDateToDB($data['certificate_date']) : date('Y-m-d');
        $process->certificate_id = isset($data['certificate_id'])  ? trim($data['certificate_id']) : '';
        $process->certificate_num = isset($data['certificate_num'])  ? trim($data['certificate_num']) : '';
        $process->certificate_payfor = isset($data['certificate_payfor'])  ? trim($data['certificate_payfor']) : 0;
        $process->certificate_type = isset($data['certificate_type'])  ? trim($data['certificate_type']) : 0;
        $process->certificate_bank_num = isset($data['certificate_bank_num'])  ? trim($data['certificate_bank_num']) : '';
        $process->certificate_bank_name = isset($data['certificate_bank_name'])  ? trim($data['certificate_bank_name']) : '';
        $process->certificate_bank_account = isset($data['certificate_bank_account'])  ? trim($data['certificate_bank_account']) : '';
        $process->certificate_bank_branch = isset($data['certificate_bank_branch'])  ? trim($data['certificate_bank_branch']) : '';
        $process->certificate_check_num = isset($data['certificate_check_num'])  ? trim($data['certificate_check_num']) : '';
        $process->certificate_check_date = isset($data['certificate_check_date'])  ? getInputDateToDB($data['certificate_check_date']) : null;
        $process->certificate_organizer = isset($data['certificate_organizer'])  ? trim($data['certificate_organizer']) : '';
        $process->certificate_inspector = isset($data['certificate_inspector'])  ? trim($data['certificate_inspector']) : '';
        $process->certificate_approver = isset($data['certificate_approver'])  ? trim($data['certificate_approver']) : '';
        $process->certificate_payer = isset($data['certificate_payer'])  ? trim($data['certificate_payer']) : '';
        $process->certificate_recipient = isset($data['certificate_recipient'])  ? trim($data['certificate_recipient']) : '';
        $process->certificate_note = isset($data['certificate_note'])  ? trim($data['certificate_note']) : '';
        $process->type_id = isset($data['type_id'])  ? trim($data['type_id']) : '';
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
