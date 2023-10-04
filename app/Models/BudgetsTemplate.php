<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsTemplate extends Model
{
    use HasFactory;

    protected $table = 'budgets_template';
    
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
}
