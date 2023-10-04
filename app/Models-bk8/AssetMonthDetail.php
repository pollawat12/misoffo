<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMonthDetail extends Model
{
    use HasFactory;

    protected $table = 'asset_month_detail';
    
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
                    'type_id' => $row->type_id,
                    'sum_total' => $row->sum_total,
                ];
            }
        }


        return $array;
    }


    // public static function inserRow($name , $typeid , $budget , $budgetcategory , $budgettype , $exportval , $yearid , $parentid , $returnId=false)
    // {

    //     $process = new self;
    //     $process->parent_id = (int) $parentid;
    //     $process->sort_order = (int) 1;
    //     $process->name = $name;
    //     $process->budget_year_id = $yearid;
    //     $process->statementtype_id = $typeid;
    //     $process->budget_id = $budget;
    //     $process->budgetcategory_id = $budgetcategory;
    //     $process->budgettype_id = $budgettype;
    //     $process->sum_total = $exportval;
    //     $process->is_deleted = (int) 0;
    //     $process->is_active = (int) 1;
    //     $process->created_at = getDateNow();
    //     $process->updated_at = getDateNow();
        
    //     if ($returnId) { 
    //         $process->save();

    //         return $process->id;
    //     } 
        
    //     return $process->save();
    // }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 0;
        $process->asset_id = isset($data['asset_id'])  ? trim($data['asset_id']) : 0;
        $process->type_id = isset($data['type_id'])  ? $data['type_id'] : 0;
        $process->sum_total = isset($data['sum_total'])  ? trim($data['sum_total']) : 0.00;
        $process->description = isset($data['description'])  ? trim($data['description']) : '';
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
