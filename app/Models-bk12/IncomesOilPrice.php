<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomesOilPrice extends Model
{
    use HasFactory;

    protected $table = 'incomes_oil_price';
    
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

                $typeoil = DataSetting::getNameDataByValueAndType($row->oil_id,'typeoil');

                $array[] = [
                    'id' => $row->id,
                    'oil_id' => $typeoil,
                    'oil_day' => $row->oil_day,
                    'oil_price' => $row->oil_price,
                ];
            }
        }


        return $array;
    }


    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->oil_id = isset($data['oil_id'])  ? trim($data['oil_id']) : 0;
        $process->oil_day = isset($data['oil_day'])  ? getInputDateToDB($data['oil_day']) : NULL;
        $process->oil_price = isset($data['oil_price'])  ? trim($data['oil_price']) : '0.00';
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
        $process->oil_id = isset($data['oil_id'])  ? trim($data['oil_id']) : 0;
        $process->oil_day = isset($data['oil_day'])  ? getInputDateToDB($data['oil_day']) : NULL;
        $process->oil_price = isset($data['oil_price'])  ? trim($data['oil_price']) : '0.00';
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
