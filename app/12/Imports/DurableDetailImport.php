<?php

namespace App\Imports;

use App\Models\ProductPriceMovemrntReport;
use App\Models\DataSetting;
use Maatwebsite\Excel\Concerns\ToModel;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

/**
 * DurableDetailImport
 */
class DurableDetailImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
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
     * bindValue
     *
     * @param  mixed $cell
     * @param  mixed $value
     * @return void
     */
    public function bindValue(Cell $cell, $value)
    {
        // dd(2211);
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }

        //$cell->setValueExplicit($value, DataType::TYPE_STRING);
        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        if (!empty($row[1])) {
            $paidDate = (!empty($row[0])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]) : null;


            $process = new ProductPriceMovemrntReport();
            $process->reportdate = $paidDate;
            $process->min_97_UNL = checkStrNull($row[1]);
            $process->max_97_UNL = checkStrNull($row[2]);
            $process->min_92_UNL = checkStrNull($row[3]);
            $process->max_92_UNL = checkStrNull($row[4]);
            $process->min_95_UNL = checkStrNull($row[5]);
            $process->max_95_UNL = checkStrNull($row[6]);
            $process->min_91_UNL = checkStrNull($row[7]);
            $process->max_91_UNL = checkStrNull($row[8]);
            $process->min_naphtha = checkStrNull($row[9]);
            $process->max_naphtha = checkStrNull($row[10]);
            $process->min_jet_kero = checkStrNull($row[11]);
            $process->max_jet_kero = checkStrNull($row[12]);
            $process->min_go_10 = checkStrNull($row[13]);
            $process->max_go_10 = checkStrNull($row[14]);
            $process->min_go_05 = checkStrNull($row[15]);
            $process->max_go_05 = checkStrNull($row[16]);
            $process->min_go_025 = checkStrNull($row[17]);
            $process->max_go_025 = checkStrNull($row[18]);
            $process->min_go_005 = checkStrNull($row[19]);
            $process->max_go_005 = checkStrNull($row[20]);
            $process->min_go_0005 = checkStrNull($row[21]);
            $process->max_go_0005 = checkStrNull($row[22]);
            $process->min_go_0001 = checkStrNull($row[23]);
            $process->max_go_0001 = checkStrNull($row[24]);
            $process->min_fo_180_2 = checkStrNull($row[25]);
            $process->max_fo_180_2 = checkStrNull($row[26]);
            $process->min_fo_180_35 = checkStrNull($row[27]);
            $process->max_fo_180_35 = checkStrNull($row[28]);
            $process->min_fo_180_380 = checkStrNull($row[29]);
            $process->max_fo_180_380 = checkStrNull($row[32]);
            $process->min_mtbe = checkStrNull($row[33]);
            $process->max_mtbe = checkStrNull($row[34]);
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();
        }
    }

    
    /**
     * batchSize
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
    
    /**
     * chunkSize
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
