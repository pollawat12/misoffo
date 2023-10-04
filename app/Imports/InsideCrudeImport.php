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

class InsideCrudeImport implements ToModel, WithStartRow
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
            $process->oil_price_ethanol_ref = '0.00';
            $process->oil_price_lpg_cargo = '0.00';
            $process->oil_price_ethanol_cas = 0.00;
            $process->oil_price_ethanol_mol = 0.00;
            $process->oil_price_ethanol_cas_mol = 0.00;
            $process->oil_price_b100 = 0.00;
            $process->oil_price_peninsula = 0.00;
            $process->oil_price_sabah = 0.00;
            $process->oil_price_type = 2;
            $process->detail = NULL;
            $process->is_deleted = (int) 0;
            $process->is_active = (int) 1;
            $process->created_at = getDateNow();
            $process->updated_at = getDateNow();
            $process->save();

            $oilCategorys = DataSetting::where('group_type', "oilCategory")->where('is_deleted', '0')->where('is_active','1')->get();
            foreach($oilCategorys as $oilCategory){

                $oilTypes = DataSetting::where('group_type', "oilType")->where('data_value', $oilCategory['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                foreach($oilTypes as $oilType){

                    $process1 = new OilPriceDetail();
                    $process1->parent_id = (int) 0;
                    $process1->sort_order = (int) 1;
                    $process1->oil_date = $paidDate;
                    $process1->oil_title = (int) 2;
                    if($oilType['id'] == 346){
                        $process1->oil_min = isset($row[1])  ? trim($row[1]) : '0.00';
                        $process1->oil_max = isset($row[2])  ? trim($row[2]) : '0.00';
                    }elseif($oilType['id'] == 347){
                        $process1->oil_min = isset($row[3])  ? trim($row[3]) : '0.00';
                        $process1->oil_max = isset($row[4])  ? trim($row[4]) : '0.00';
                    }elseif($oilType['id'] == 348){
                        $process1->oil_min = isset($row[5])  ? trim($row[5]) : '0.00';
                        $process1->oil_max = isset($row[6])  ? trim($row[6]) : '0.00';
                    }elseif($oilType['id'] == 349){
                        $process1->oil_min = isset($row[7])  ? trim($row[7]) : '0.00';
                        $process1->oil_max = isset($row[8])  ? trim($row[8]) : '0.00';
                    }elseif($oilType['id'] == 350){
                        $process1->oil_min = isset($row[9])  ? trim($row[9]) : '0.00';
                        $process1->oil_max = isset($row[10])  ? trim($row[10]) : '0.00';
                    }elseif($oilType['id'] == 351){
                        $process1->oil_min = isset($row[11])  ? trim($row[11]) : '0.00';
                        $process1->oil_max = isset($row[12])  ? trim($row[12]) : '0.00';
                    }elseif($oilType['id'] == 352){
                        $process1->oil_min = isset($row[13])  ? trim($row[13]) : '0.00';
                        $process1->oil_max = isset($row[14])  ? trim($row[14]) : '0.00';
                    }elseif($oilType['id'] == 353){
                        $process1->oil_min = isset($row[15])  ? trim($row[15]) : '0.00';
                        $process1->oil_max = isset($row[16])  ? trim($row[16]) : '0.00';
                    }elseif($oilType['id'] == 354){
                        $process1->oil_min = isset($row[17])  ? trim($row[17]) : '0.00';
                        $process1->oil_max = isset($row[18])  ? trim($row[18]) : '0.00';
                    }elseif($oilType['id'] == 355){
                        $process1->oil_min = isset($row[19])  ? trim($row[19]) : '0.00';
                        $process1->oil_max = isset($row[20])  ? trim($row[20]) : '0.00';
                    }elseif($oilType['id'] == 356){
                        $process1->oil_min = isset($row[21])  ? trim($row[21]) : '0.00';
                        $process1->oil_max = isset($row[22])  ? trim($row[22]) : '0.00';
                    }elseif($oilType['id'] == 357){
                        $process1->oil_min = isset($row[23])  ? trim($row[23]) : '0.00';
                        $process1->oil_max = isset($row[24])  ? trim($row[24]) : '0.00';
                    }elseif($oilType['id'] == 358){
                        $process1->oil_min = isset($row[25])  ? trim($row[25]) : '0.00';
                        $process1->oil_max = isset($row[26])  ? trim($row[26]) : '0.00';
                    }elseif($oilType['id'] == 359){
                        $process1->oil_min = isset($row[27])  ? trim($row[27]) : '0.00';
                        $process1->oil_max = isset($row[28])  ? trim($row[28]) : '0.00';
                    }elseif($oilType['id'] == 360){
                        $process1->oil_min = isset($row[29])  ? trim($row[29]) : '0.00';
                        $process1->oil_max = isset($row[30])  ? trim($row[30]) : '0.00';
                    }elseif($oilType['id'] == 361){
                        $process1->oil_min = isset($row[31])  ? trim($row[31]) : '0.00';
                        $process1->oil_max = isset($row[32])  ? trim($row[32]) : '0.00';
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
    }

    public function startRow(): int
    {
        return 5;
    }
}
