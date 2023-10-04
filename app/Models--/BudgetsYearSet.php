<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsYearSet extends Model
{
    use HasFactory;

    protected $table = 'budgets_year_set';
    
    public $timestamps = false;

    public static function getdata($parentId=0, $isCount=false)
    {
        if($parentId != 0){

            $conditions = [
                'id' => (int) $parentId,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

        }else{

            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

        }
        

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $Year = YearBudget::where('id', $row->year_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($Year as $rowYear) {
                    $array[] = [
                        'id' => $row->id,
                        'year_name' => $rowYear->in_year,
                        'budget_money' => $row->budget_money,
                        'status_approved' => $row->status_approved,
                    ];
                }
            }
        }


        return $array;
    }
    
    /**
     * inserRow
     *
     * @param  mixed $data
     * @param  mixed $returnId
     * @return void
     */
    public static function insertRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : 0;
        $process->budgets_money = isset($data['budgets_money'])  ? trim($data['budgets_money']) : 0.00;
        $process->budgets_id = isset($data['budgets_id'])  ? trim($data['budgets_id']) : 0;
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
    
    /**
     * updateRow
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : 0;
        $process->budgets_money = isset($data['budgets_money'])  ? trim($data['budgets_money']) : 0.00;
        $process->budgets_id = isset($data['budgets_id'])  ? trim($data['budgets_id']) : 0;
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
