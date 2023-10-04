<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsrFund extends Model
{
    use HasFactory;

    protected $table = 'behavior_fund';
    
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
                    'budget_year_id' => $row->budget_year_id,
                    'statementtype_id' => $row->statementtype_id,
                    'budget_id' => $row->budget_id,
                    'sum_total' => $row->sum_total,
                ];
            }
        }


        return $array;
    }


    public static function inserRowNew($data , $returnId=false)
    {

        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? (int) $data['parent_id'] : 0;
        $process->sort_order = isset($data['sort_order'])  ? $data['sort_order'] : 0;
        $process->value_min = isset($data['value_min'])  ? (int) $data['value_min'] : 0.00;
        $process->value_max = isset($data['value_max'])  ? (int) $data['value_max'] : 0.00;
        $process->value_percent = isset($data['value_percent'])  ? (int) $data['value_percent'] : 0.00;
        $process->behavior_id = isset($data['behavior_id'])  ? (int) $data['behavior_id'] : 0;
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
        $process->value_min = isset($data['value_min'])  ? (int) $data['value_min'] : 0.00;
        $process->value_max = isset($data['value_max'])  ? (int) $data['value_max'] : 0.00;
        $process->value_percent = isset($data['value_percent'])  ? (int) $data['value_percent'] : 0.00;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }


    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
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
