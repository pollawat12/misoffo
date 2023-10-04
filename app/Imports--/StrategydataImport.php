<?php

namespace App\Imports;

use App\Models\StrategyDataInformation;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
// use PhpOffice\PhpSpreadsheet\Cell\Cell;
// use PhpOffice\PhpSpreadsheet\Cell\DataType;
// use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

/**
 * StrategydataImport
 */
// class StrategydataImport implements ToModel 
class StrategydataImport implements ToModel 
{

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }




    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $str_date = date('Y-m-d');
        
        for ($i=0; $i < 10; $i++) { 
            if ($i == 0) {
                $paidDate = $this->transformDate($row[$i]);
                echo $paidDate  . ' | ';
            } else {
                echo (string) $row[$i] . ' | ';
            }
            if ($i == 9) { echo '<br>'; }
        }
    }
}
