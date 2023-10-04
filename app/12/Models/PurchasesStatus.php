<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesStatus extends Model
{
    use HasFactory;

    protected $table = 'purchases_status';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getData($id=0,$typeid=0,$parentId=0, $isCount=false)
    {
        if($typeid == '0'){

            $conditions = [
                'purchases_id' => (int) $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

            $query = self::where($conditions);

        }else{

            $conditions = [
                'purchases_status_to' => (int) $typeid,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

            $query = self::where($conditions)->where('is_status', '!=', '0')->where('is_status', '!=', '3');
        }
        
        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $purchases = DataSetting::getNameDataByValueAndType($row->purchases_status_update,'purchasesstatus');

                $titles = Purchases::where('id',$row->purchases_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($titles as $titles);
                
                $array[] = [
                    'id' => $row->id,
                    'purchases_status_date' => $row->purchases_status_date,
                    'purchases_status_message' => $row->purchases_status_message,
                    'purchases_status_file' => $row->purchases_status_file,
                    'purchases_status_to' => $row->purchases_status_to,
                    'purchases_status_update' => $purchases,
                    'purchases_id' => $row->purchases_id,
                    'purchases_name' => $titles->purchases_name,
                    'is_status' => $row->is_status,
                    'user_id' => $row->user_id
                ];
            }
        }


        return $array;
    }


    public static function insertRow($data, $returnId=false)
    {
        
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_status_date = isset($data['purchases_status_date'])  ? getInputDateToDB($data['purchases_status_date']) : NULL;
        $process->purchases_status_message = isset($data['purchases_status_message'])  ? trim($data['purchases_status_message']) : '';
        $process->purchases_status_file = isset($data['purchases_status_file'])  ? trim($data['purchases_status_file']) : '';
        $process->purchases_status_to = isset($data['purchases_status_to'])  ? trim($data['purchases_status_to']) : '0';
        $process->purchases_status_update = isset($data['purchases_status_update'])  ? trim($data['purchases_status_update']) : 0;
        $process->purchases_id = isset($data['purchases_id'])  ? trim($data['purchases_id']) : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->is_status = (int) 2;
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
        $process->purchases_status_date = isset($data['purchases_status_date'])  ? getInputDateToDB($data['purchases_status_date']) : NULL;
        $process->purchases_status_message = isset($data['purchases_status_message'])  ? trim($data['purchases_status_message']) : '';
        $process->purchases_status_file = isset($data['purchases_status_file'])  ? trim($data['purchases_status_file']) : '';
        $process->purchases_status_to = isset($data['purchases_status_to'])  ? trim($data['purchases_status_to']) : '0';
        $process->purchases_status_update = isset($data['purchases_status_update'])  ? trim($data['purchases_status_update']) : 0;
        $process->purchases_id = isset($data['purchases_id'])  ? trim($data['purchases_id']) : 0;
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRowStatus($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->is_status = isset($data['is_status'])  ? trim($data['is_status']) : '2';
        $process->purchases_status_to = isset($data['purchases_status_to'])  ? trim($data['purchases_status_to']) : '0';
        $process->user_id = isset($data['user_id'])  ? trim($data['user_id']) : 0;
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
