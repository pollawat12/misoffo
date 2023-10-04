<?php

namespace App\Imports;

use App\Models\importdata;
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
            

            if($this->id == '332'){
                $paidDate = (!empty($row[0])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]) : null;
                $arr = array('TAPIS_MiN' => checkStrNull($row[1]), 'TAPIS_MAX' => checkStrNull($row[2]), 'OMAN_MiN' => checkStrNull($row[3]), 'OMAN_MAX' => checkStrNull($row[4]), 'DUBAI_MiN' => checkStrNull($row[5]), 'DUBAI_MAX' => checkStrNull($row[6]), 'BRENT_MiN' => checkStrNull($row[7]), 'BRENT_MAX' => checkStrNull($row[8]), 'FORCADOS_MiN' => checkStrNull($row[9]), 'FORCADOS_MAX' => checkStrNull($row[10]), 'WTI_MiN' => checkStrNull($row[11]), 'WTI_MAX' => checkStrNull($row[12]), 'BUYING' => checkStrNull($row[13]), 'SELLING' => checkStrNull($row[14]));
            }elseif($this->id == '334'){

                $paidDate = null;
                $arr = array( 'Year' => checkStrNull($row[0]) , 'Month' => checkStrNull($row[1]) , 'Octane91' => checkStrNull($row[2]), 'Octane95' => checkStrNull($row[3]), 'E20' => checkStrNull($row[4]), 'E85' => checkStrNull($row[5]), 'petrol' => checkStrNull($row[6]), 'sumpetrol' => checkStrNull($row[7]), 'B7' => checkStrNull($row[8]), 'B72' => checkStrNull($row[9]), 'B73' => checkStrNull($row[10]), 'B74' => checkStrNull($row[11]), 'B75' => checkStrNull($row[12]), 'B20' => checkStrNull($row[13]), 'sumb' => checkStrNull($row[14]), '10PPM' => checkStrNull($row[15]) , '50PPM' => checkStrNull($row[16]), 'brimstone' => checkStrNull($row[17]), 'county' => checkStrNull($row[18]), 'sumC' => checkStrNull($row[19]), 'sumdiesel' => checkStrNull($row[20]), 'JETA1' => checkStrNull($row[21]), 'LPG' => checkStrNull($row[22]), 'stove' => checkStrNull($row[23]));

            }

            $process = new importdata();
            $process->date_report = $paidDate;
            $process->date_json = json_encode($arr);
            $process->type_id = $this->id;
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
