<?php

namespace App\Imports;

use App\Models\IncomeFinance;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class IncomeFinanceImport implements ToModel, WithStartRow
{
    //
    protected $id;
    
    /**
     * __construct
     *
     * @param  mixed $id
     * @return void
     */
    public function __construct($id=0)
    {
        $this->id = $id;     
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

            $paidDate = (!empty($row[1])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]) : null;
            

            $process = new IncomeFinance();
            $process->parent_id = 0;
            $process->sort_order = 0;
            $process->income_date = $paidDate;
            $process->income_number = $row[2];
            $process->number_sum = $row[4];
            $process->type_id = $this->id;
            $process->detail = $row[3];
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();

        }

    }

    public function startRow(): int
    {
        return 2;
    }
}
