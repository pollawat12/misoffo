<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetImport extends Model
{
    use HasFactory;

    protected $table = 'budget_import';
    
    public $timestamps = false;

    /**
     * getItems
     *
     * @param  mixed $returnCount
     * @return void
     */
    public static function getItems($returnCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $exeItems = self::where($conditions)->orderBy('created_at', 'desc')->get();

        $array = [];
        if (!empty($exeItems)) {
            foreach ($exeItems as $row) {
                $array[] = [
                    'id' => $row->id,
                    'subject' => $row->subject,
                    'create_report_date' => getDateTimeTH($row->create_report_date, false, true),
                    'note' => $row->note,
                ];
            }
        }

        return $array;
    }


    /**
     * insertOne
     *
     * @param  mixed $array
     * @param  mixed $returnId
     * @return void
     */
    public static function insertOne($array=[], $returnId= false)
    {
        $process = new self();

        $process->subject = 1;
        $process->note = trim($array['note']);
        $process->create_report_date = date('Y-m-d');
        $process->is_approved = (int) 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->save();

        if ($returnId) return $process->id;
        
        return true;
    }
}
