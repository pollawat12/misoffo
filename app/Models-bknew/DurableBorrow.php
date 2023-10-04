<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableBorrow extends Model
{
    use HasFactory;

    protected $table = 'durable_borrow';
    
    public $timestamps = false;
    //
    /**
     * getDataAll
     *
     * @param  mixed $type
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataAll($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'parent_id' => (int) $parentId
        ];

        $query = self::where($conditions);

        if (!empty($type)) {
            $query->where('durable_type', trim($type));
        }

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('sort_order','asc')->get();
    }


    public static function getDataDashboard()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'durable_type' => 'durable'
        ];

        $query = self::where($conditions);
        $results = $query->orderBy('sort_order','asc')->get();

        $array = [];
        $no = 0;
        if ($results) {
            foreach ($results as $result) {
                $no++;
                $diff_price = 0;
                $array[] = [
                    'no' => $no,
                    'item_name' => $result->durable_name,
                    'import_date' => getDateMonthTH($result->durable_received_date, false, true),
                    'item_code' => $result->durable_number,
                    'item_status' => getLabelStatusDurable($result->durable_status),
                    'item_price' => getNumberCurrency($result->durable_price),
                    'item_dep_price' => getNumberCurrency($diff_price)
                ];
            }
        }

        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) $data['parent_id'];
        $process->sort_order = (int) 1;
        $process->borrow_number = trim($data['borrow_number']);
        $process->borrow_date = isset($data['borrow_date'])  ? getInputDateToDB($data['borrow_date']) : NULL;
        $process->borrow_user_name = isset($data['borrow_user_name'])  ? trim($data['borrow_user_name']) : '';
        $process->borrow_affiliate = (isset($data['borrow_affiliate'])) ? $data['borrow_affiliate'] : (int) 0;
        $process->borrow_institution = (isset($data['borrow_institution'])) ? $data['borrow_institution'] : (int) 0;
        $process->borrow_status = (isset($data['borrow_status'])) ? $data['borrow_status'] : (int) 0;
        $process->borrow_night_date = isset($data['borrow_night_date'])  ? getInputDateToDB($data['borrow_night_date']) : NULL;
        $process->borrow_night_detail = isset($data['borrow_night_detail'])  ? trim($data['borrow_night_detail']) : '';
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
        
        $process->parent_id = (int) $data['parent_id'];
        $process->sort_order = (int) 1;
        $process->borrow_number = trim($data['borrow_number']);
        $process->borrow_date = isset($data['borrow_date'])  ? getInputDateToDB($data['borrow_date']) : NULL;
        $process->borrow_user_name = isset($data['borrow_user_name'])  ? trim($data['borrow_user_name']) : '';
        $process->borrow_affiliate = (isset($data['borrow_affiliate'])) ? $data['borrow_affiliate'] : (int) 0;
        $process->borrow_institution = (isset($data['borrow_institution'])) ? $data['borrow_institution'] : (int) 0;
        $process->borrow_status = (isset($data['borrow_status'])) ? $data['borrow_status'] : (int) 0;
        $process->borrow_night_date = isset($data['borrow_night_date'])  ? getInputDateToDB($data['borrow_night_date']) : NULL;
        $process->borrow_night_detail = isset($data['borrow_night_detail'])  ? trim($data['borrow_night_detail']) : '';
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


    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getDurable($type='', $parentId=0, $isCount=false)
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
                    'borrow_number' => $row->borrow_number,
                    'borrow_date' => $row->borrow_date,
                    'borrow_status' => $row->borrow_status,
                    'borrow_user_name' => $row->borrow_user_name
                ];
            }
        }


        return $array;
    }

    public static function updateReceiveRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->borrow_approve_status = (isset($data['borrow_approve_status'])) ? $data['borrow_approve_status'] : (int) 0;
        $process->borrow_receive_date = isset($data['borrow_receive_date'])  ? getInputDateToDB($data['borrow_receive_date']) : NULL;
        $process->borrow_receive_name = isset($data['borrow_receive_name'])  ? trim($data['borrow_receive_name']) : '';
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    
}
