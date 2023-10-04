<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsrDetailYear extends Model
{
    use HasFactory;

    protected $table = 'budgets_detail_year';
    
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


    public static function inserRow($name , $typeid , $budget , $budgetcategory , $budgettype , $exportval , $yearid , $parentid , $returnId=false)
    {

        $process = new self;
        $process->parent_id = (int) $parentid;
        $process->sort_order = (int) 1;
        $process->name = $name;
        $process->budget_year_id = $yearid;
        $process->statementtype_id = $typeid;
        $process->budget_id = $budget;
        $process->budgetcategory_id = $budgetcategory;
        $process->budgettype_id = $budgettype;
        $process->sum_total = $exportval;
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


    public static function inserRowNew($data , $id , $returnId=false)
    {

        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? (int) $data['parent_id'] : 0;
        $process->sort_order = isset($data['sort_order'])  ? $data['sort_order'] : 0;
        $process->month_10 = isset($data['month_10'])  ? trim($data['month_10']) : 0.00;
        $process->month_11 = isset($data['month_11'])  ? trim($data['month_11']) : 0.00;
        $process->month_12 = isset($data['month_12'])  ? trim($data['month_12']) : 0.00;
        $process->month_1 = isset($data['month_1'])  ? trim($data['month_1']) : 0.00;
        $process->month_2 = isset($data['month_2'])  ? trim($data['month_2']) : 0.00;
        $process->month_3 = isset($data['month_3'])  ? trim($data['month_3']) : 0.00;
        $process->month_4 = isset($data['month_4'])  ? trim($data['month_4']) : 0.00;
        $process->month_5 = isset($data['month_5'])  ? trim($data['month_5']) : 0.00;
        $process->month_6 = isset($data['month_6'])  ? trim($data['month_6']) : 0.00;
        $process->month_7 = isset($data['month_7'])  ? trim($data['month_7']) : 0.00;
        $process->month_8 = isset($data['month_8'])  ? trim($data['month_8']) : 0.00;
        $process->month_9 = isset($data['month_9'])  ? trim($data['month_9']) : 0.00;
        $process->budgets_detail_id = $id;
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


    public static function updateRowNew($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->month_10 = isset($data['month_10'])  ? trim($data['month_10']) : 0.00;
        $process->month_11 = isset($data['month_11'])  ? trim($data['month_11']) : 0.00;
        $process->month_12 = isset($data['month_12'])  ? trim($data['month_12']) : 0.00;
        $process->month_1 = isset($data['month_1'])  ? trim($data['month_1']) : 0.00;
        $process->month_2 = isset($data['month_2'])  ? trim($data['month_2']) : 0.00;
        $process->month_3 = isset($data['month_3'])  ? trim($data['month_3']) : 0.00;
        $process->month_4 = isset($data['month_4'])  ? trim($data['month_4']) : 0.00;
        $process->month_5 = isset($data['month_5'])  ? trim($data['month_5']) : 0.00;
        $process->month_6 = isset($data['month_6'])  ? trim($data['month_6']) : 0.00;
        $process->month_7 = isset($data['month_7'])  ? trim($data['month_7']) : 0.00;
        $process->month_8 = isset($data['month_8'])  ? trim($data['month_8']) : 0.00;
        $process->month_9 = isset($data['month_9'])  ? trim($data['month_9']) : 0.00;
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

    public static function getSelect($type='', $id=0 , $parentId =0 , $isCount=false)
    {   

        if($type == 'statementtype'){

            $conditions = [
                'institution_id' => (int) $id ,
                'budget_year_id' => (int) $parentId
            ];

            $group = 'statementtype_id';

            $query = self::where('parent_id', 0)->where($conditions);
            

        }elseif($type == 'budget'){

            $conditions = [
                'budget_year_id' => (int) $parentId ,
                'parent_id' => (int) $id
            ];

            $group = 'budget_id';

            $query = self::where('parent_id', '!=' , 0)->where($conditions);

        }elseif($type == 'budgetNew'){

            $conditions = [
                'parent_id' => (int) $id
            ];

            $group = 'budget_id';

            $query = self::where('parent_id', '!=' , 0)->where($conditions);
        }
        

        // $query = self::where($conditions)->groupBy('budget_year_id');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                if($type == 'statementtype'){ 

                    $data = DataSetting::getNameDataByValueAndType($row->statementtype_id,'statementtype');

                    $array[] = [
                        'id' => $row->id,
                        'name' => $data
                    ];

                }elseif($type == 'budget'){ 

                    $data = DataSetting::getNameDataByValueAndType($row->budget_id,'budget');

                    $array[] = [
                        'id' => $row->id,
                        'name' => $data
                    ];

                }elseif($type == 'budgetNew'){ 

                    $data = DataSetting::getNameDataByValueAndType($row->budget_id,'budget');

                    $array[] = [
                        'id' => $row->id,
                        'name' => $data
                    ];
                }
                
                
            }
        }


        return $array;
    }

    public static function getSelect1($type='', $id=0 , $parentId =0 , $isCount=false)
    {   

        if($type == 'statementtype'){

            $conditions = [
                'budget_year_id' => (int) $id
            ];

            $group = 'statementtype_id';

            $query = self::where('parent_id', 0)->where($conditions);
            

        }elseif($type == 'budget'){

            $conditions = [
                'budget_year_id' => (int) $parentId ,
                'parent_id' => (int) $id
            ];

            $group = 'budget_id';

            $query = self::where('parent_id', '!=' , 0)->where($conditions);
        }
        

        // $query = self::where($conditions)->groupBy('budget_year_id');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                if($type == 'statementtype'){ 

                    $data = DataSetting::getNameDataByValueAndType($row->statementtype_id,'statementtype');

                    $array[] = [
                        'id' => $row->id,
                        'name' => $data
                    ];

                }elseif($type == 'budget'){ 

                    $data = DataSetting::getNameDataByValueAndType($row->budget_id,'budget');

                    $array[] = [
                        'id' => $row->id,
                        'name' => $data
                    ];
                }
                
                
            }
        }


        return $array;
    }
}
