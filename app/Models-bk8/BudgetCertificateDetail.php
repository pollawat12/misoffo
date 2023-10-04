<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCertificateDetail extends Model
{
    use HasFactory;

    protected $table = 'budget_certificate_detail';
    
    public $timestamps = false;

    public static function inserRow($certificate_detail_name , $certificate_detail_note, $returnId=false)
    {
        $Budget = Budget::where('id',$certificate_detail_name)->where('is_deleted', '0')->where('is_active','1')->get();
        foreach ($Budget as $rowBudget);

        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->certificate_detail_date = isset($rowBudget['date_report'])  ? $rowBudget['date_report'] : date('Y-m-d');
        $process->certificate_detail_name = isset($rowBudget['expense_item'])  ? trim($rowBudget['expense_item']) : '';
        $process->certificate_detail_money = isset($rowBudget['expenses_amount'])  ? trim($rowBudget['expenses_amount']) : '';
        $process->certificate_detail_vat = 0;
        $process->certificate_detail_tax = isset($rowBudget['deduct_amount'])  ? trim($rowBudget['deduct_amount']) : 0;
        $process->certificate_detail_note = $certificate_detail_note;
        $process->certificate_id = $returnId;
        $process->budget_costs_id = $certificate_detail_name;
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
}
