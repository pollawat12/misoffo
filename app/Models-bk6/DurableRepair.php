<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableRepair extends Model
{
    use HasFactory;

    protected $table = 'durable_repair';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getDurable($isCount=false)
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

                $product = Durable::getNameDataByValueAndType($row->durable_id);
                foreach ($product as $rows);
                
                $category = DataSetting::getNameDataByValueAndType($rows->category_id,'category');

                $typedata = DataSetting::getNameDataByValueAndType($rows->typedata_id,'typedata');

                $array[] = [
                    'id' => $row->id,
                    'durable_name' => $rows->durable_name,
                    'durable_number' => $rows->durable_number,
                    'date_report' => $row->date_report,
                    'user_name' => $row->user_name,
                    'price_sum' => $row->price_sum,
                    'is_approved' => $row->is_approved,
                    'note' => $row->note,
                    'category' => $category,
                    'typedata' => $typedata
                ];
            }
        }


        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? (int) $data['parent_id'] : 0;
        $process->sort_order = (int) 0;
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->user_name = isset($data['user_name'])  ? trim($data['user_name']) : '';
        $process->price_sum = isset($data['price_sum'])  ? trim($data['price_sum']) : 0.00;
        $process->is_approved = isset($data['is_approved'])  ? (int) $data['is_approved'] : 0;
        $process->note = isset($data['note'])  ? trim($data['note'])  : 0;
        $process->durable_id = isset($data['durable_id'])  ? trim($data['durable_id']) : 0;
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
        
        $process->parent_id = isset($data['parent_id'])  ? (int) $data['parent_id'] : 0;
        $process->sort_order = (int) 0;
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->user_name = isset($data['user_name'])  ? trim($data['user_name']) : '';
        $process->price_sum = isset($data['price_sum'])  ? trim($data['price_sum']) : 0.00;
        $process->is_approved = isset($data['is_approved'])  ? (int) $data['is_approved'] : 0;
        $process->note = isset($data['note'])  ? trim($data['note'])  : 0;
        $process->durable_id = isset($data['durable_id'])  ? trim($data['durable_id']) : 0;
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
