<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomesDetail extends Model
{
    use HasFactory;

    protected $table = 'incomes_detail';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getData($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {
                
                $array[] = [
                    'id' => $row->id,
                    'incomes_id' => $row->incomes_id,
                    'oil_type_id' => $row->oil_type_id,
                    'export_total' => $row->export_total,
                    'price_oil_today' => $row->price_oil_today,
                    'income_penecnt' => $row->income_penecnt,
                    'grand_total' => $row->grand_total,
                    'incomes_total' => $row->incomes_total
                ];
            }
        }


        return $array;
    }


    public static function inserRow($typeid , $exportval , $incomesid , $returnId=false)
    {
        $oil = DataSetting::where('id', $typeid)->where('is_deleted', '0')->where('is_active','1')->get();
        foreach ($oil as $rowOil);

        $oilPrice = IncomesOilPrice::where('oil_id', $typeid)->where('is_deleted', '0')->where('is_active','1')->orderBy('id', 'DESC')->limit(1)->get();
        foreach ($oilPrice as $rowOilPrice);

        $grand_total = $exportval * $rowOilPrice->oil_price;

        $incomes_total = $grand_total * $rowOil->amount;

        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->incomes_id = $incomesid;
        $process->oil_type_id = $typeid;
        $process->export_total = $exportval;
        $process->price_oil_today = $rowOilPrice->oil_price;
        $process->price_oil_today_id = $rowOilPrice->id;
        $process->income_penecnt = $rowOil->amount;
        $process->grand_total = $grand_total;
        $process->incomes_total = $incomes_total;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->incomes_company = isset($data['incomes_company'])  ? trim($data['incomes_company']) : '';
        $process->incomes_day = isset($data['incomes_day'])  ? getInputDateToDB($data['incomes_day']) : NULL;
        $process->incomes_note = isset($data['incomes_note'])  ? trim($data['incomes_note']) : '';
        $process->incomes_file = isset($data['incomes_file'])  ? trim($data['incomes_file']) : '';
        $process->incomes_status = isset($data['incomes_status'])  ? trim($data['incomes_status']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function deleteRow($id=0)
    {
        $process = self::find((int) $id);
        
        $process->is_deleted = (int) 1;
        $process->is_active = (int) 0;
        $process->updated_at = getDateNow();
        $process->save();
        
        return $process->save();
    }
}
