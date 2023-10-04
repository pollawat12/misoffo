<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableBorrowDetail extends Model
{
    use HasFactory;

    protected $table = 'durable_borrow_detail';
    
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
                    'purchases_id' => $row->purchases_id,
                    'position_id' => $row->position_id
                ];
            }
        }


        return $array;
    }


    public static function inserRow($value , $num , $add , $person , $groupsid , $returnId=false)
    {
        
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->durable_borrow_id = $returnId;
        $process->durable_id = $value;
        $process->durable_num = $num;
        $process->durable_location = $add;
        $process->durable_user = $person;
        $process->borrow_receive_status = (int) 0;
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
        $process->durable_borrow_id = $returnId;
        $process->durable_id = $value;
        $process->durable_num = $num;
        $process->durable_location = $add;
        $process->durable_user = $person;
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
