<?php

namespace App\Imports;

use App\Models\DataSetting;
use App\Models\BudgetsTemplate;
use App\Models\BudgetsrDetail;
use App\Models\BudgetsrDetailYear;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class BudgetsImport implements ToModel, WithStartRow
{
    //
    protected $id;
    
    /**
     * __construct
     *
     * @param  mixed $id
     * @return void
     */
    public function __construct($id=0,$budgetsid=0,$yearid=0,$institutionid=0)
    {
        $this->id = $id;  
        $this->budgetsid = $budgetsid; 
        $this->yearid = $yearid; 
        $this->institutionid = $institutionid;    
    }

    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo $row[0];
        if (!empty($row[0])) {

            // $paidDate = (!empty($row[0])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]) : null;
            

            $process = new BudgetsrDetail();
            $process->parent_id = 0;
            $process->sort_order = $row[0];
            $process->name = $row[1];
            $process->institution_id = $this->institutionid;
            $process->budget_year_id = $this->yearid;
            $process->budget_id = $this->budgetsid;
            $process->budgettype_id = $this->id;
            $process->sum_total = 0;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();

            $process1 = new BudgetsrDetailYear();
            $process1->parent_id = (int) 0;
            $process1->sort_order = (int) $row[0];
            $process1->month_10 = $row[2];
            $process1->month_11 = $row[3];
            $process1->month_12 = $row[4];
            $process1->month_1 = $row[5];
            $process1->month_2 = $row[6];
            $process1->month_3 = $row[7];
            $process1->month_4 = $row[8];
            $process1->month_5 = $row[9];
            $process1->month_6 = $row[10];
            $process1->month_7 = $row[11];
            $process1->month_8 = $row[12];
            $process1->month_9 = $row[13];
            $process1->budgets_detail_id = $process->id;
            $process1->is_deleted = (int) 0;
            $process1->is_active = (int) 1;
            $process1->created_at = getDateNow();
            $process1->updated_at = getDateNow();
            $process1->save();
        }

    }

    public function startRow(): int
    {
        return 1;
    }
}
