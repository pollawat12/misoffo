<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesInstallment extends Model
{
    use HasFactory;

    protected $table = 'purchases_installment';
    
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
                    'group_id' => $row->group_id,
                    'installment' => $row->installment,
                    'detail' => $row->detail,
                    'installment_date' => $row->installment_date,
                    'installment_money' => $row->installment_money
                ];
            }
        }


        return $array;
    }


    public static function inserRow($installment , $detail , $installment_date  , $installment_money , $groupsid , $returnId=false)
    {
        
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->purchases_id = $returnId;
        $process->group_id = $groupsid;
        $process->installment = $installment;
        $process->detail = $detail;
        $process->installment_date = getInputDateToDB($installment_date);
        $process->installment_money = $installment_money;
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
        $process->purchases_id = $purchasesid;
        $process->position_id = $positionid;
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
