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

class ExchangeImport implements ToModel, WithStartRow
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
            $process->oil_price_propane = '0.00';
            $process->oil_price_butane = '0.00';
            $process->oil_price_exchange = $row[1];
            $process->oil_price_lpg_cargo = '0.00';
            $process->oil_price_type = 4;
            $process->detail = NULL;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();

            $oilTypes = DataSetting::where('group_type', "oilType")->where('id', '368')->where('data_value', '1')->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($oilTypes as $oilType){

                $process1 = new OilPriceDetail();
                $process1->parent_id = (int) 0;
                $process1->sort_order = (int) 1;
                $process1->oil_date = $paidDate;
                $process1->oil_title = (int) 4;
                $process1->oil_min = $row[2];
                $process1->oil_max = '0.00';
                $process1->oil_price_id = $process->id;
                $process1->oil_category = (int) $oilType['data_value'];
                $process1->oil_type = (int) $oilType['id'];
                $process1->is_deleted = (int) 0;
                $process1->is_active = (int) 1;
                $process1->created_at = getDateNow();
                $process1->updated_at = getDateNow();
                $process1->save();
            }

            $oilTypes2 = DataSetting::where('group_type', "oilType")->where('id', '369')->where('data_value', '1')->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($oilTypes2 as $oilType2){

                $process2 = new OilPriceDetail();
                $process2->parent_id = (int) 0;
                $process2->sort_order = (int) 1;
                $process2->oil_date = $paidDate;
                $process2->oil_title = (int) 4;
                $process2->oil_min = $row[3];
                $process2->oil_max = '0.00';
                $process2->oil_price_id = $process->id;
                $process2->oil_category = (int) $oilType2['data_value'];
                $process2->oil_type = (int) $oilType2['id'];
                $process2->is_deleted = (int) 0;
                $process2->is_active = (int) 1;
                $process2->created_at = getDateNow();
                $process2->updated_at = getDateNow();
                $process2->save();
            }


        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
