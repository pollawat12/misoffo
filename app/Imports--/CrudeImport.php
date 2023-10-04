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

class CrudeImport implements ToModel, WithStartRow
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
            $process->oil_price_buying = isset($row[14])  ? trim($row[14]) : '0.00';
            $process->oil_price_selling = isset($row[15])  ? trim($row[15]) : '0.00';
            $process->oil_price_propane = '0.00';
            $process->oil_price_butane = '0.00';
            $process->oil_price_exchange = '0.00';
            $process->oil_price_lpg_cargo = '0.00';
            $process->oil_price_type = 1;
            $process->detail = NULL;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();

            $oilTypes = DataSetting::where('group_type', "oilType")->where('data_value', '0')->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($oilTypes as $oilType){

                $process1 = new OilPriceDetail();
                $process1->parent_id = (int) 0;
                $process1->sort_order = (int) 1;
                $process1->oil_date = $paidDate;
                $process1->oil_title = (int) 1;
                if($oilType['id'] == 362){
                    $process1->oil_min = isset($row[2])  ? trim($row[2]) : '0.00';
                    $process1->oil_max = isset($row[3])  ? trim($row[3]) : '0.00';
                }elseif($oilType['id'] == 363){
                    $process1->oil_min = isset($row[4])  ? trim($row[4]) : '0.00';
                    $process1->oil_max = isset($row[5])  ? trim($row[5]) : '0.00';
                }elseif($oilType['id'] == 364){
                    $process1->oil_min = isset($row[6])  ? trim($row[6]) : '0.00';
                    $process1->oil_max = isset($row[7])  ? trim($row[7]) : '0.00';
                }elseif($oilType['id'] == 365){
                    $process1->oil_min = isset($row[8])  ? trim($row[8]) : '0.00';
                    $process1->oil_max = isset($row[9])  ? trim($row[9]) : '0.00';
                }elseif($oilType['id'] == 366){
                    $process1->oil_min = isset($row[10])  ? trim($row[10]) : '0.00';
                    $process1->oil_max = isset($row[11])  ? trim($row[11]) : '0.00';
                }elseif($oilType['id'] == 367){
                    $process1->oil_min = isset($row[12])  ? trim($row[12]) : '0.00';
                    $process1->oil_max = isset($row[13])  ? trim($row[13]) : '0.00';
                }
                $process1->oil_price_id = $process->id;
                $process1->oil_category = (int) $oilType['data_value'];
                $process1->oil_type = (int) $oilType['id'];
                $process1->is_deleted = (int) 0;
                $process1->is_active = (int) 1;
                $process1->created_at = getDateNow();
                $process1->updated_at = getDateNow();
                $process1->save();
            }

        }
    }

    public function startRow(): int
    {
        return 7;
    }
}
