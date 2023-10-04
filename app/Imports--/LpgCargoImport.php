<?php

namespace App\Imports;

use App\Models\OilPrice;
use App\Models\OilPriceDetail;
use App\Models\DataSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class LpgCargoImport implements ToModel, WithStartRow
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
        
        if (!empty($row[0])) {

            $paidDate = (!empty($row[0])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]) : null;
            
            $process = new OilPrice();
            $process->parent_id = (int) 0;
            $process->sort_order = (int) 1;
            $process->oil_price_date = $paidDate;
            $process->oil_price_date_strart = NULL;
            $process->oil_price_date_end = NULL;
            $process->oil_price_buying = '0.00';
            $process->oil_price_selling = '0.00';
            $process->oil_price_propane = isset($row[1])  ? trim($row[1]) : '0.00';
            $process->oil_price_butane = isset($row[2])  ? trim($row[2]) : '0.00';
            $process->oil_price_exchange = '0.00';
            $process->oil_price_lpg_cargo = isset($row[3])  ? trim($row[3]) : '0.00';
            $process->oil_price_type = 3;
            $process->detail = NULL;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();
        }
    }

    public function startRow(): int
    {
        return 5;
    }
}
