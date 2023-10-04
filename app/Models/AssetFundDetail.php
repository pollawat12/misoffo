<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetFundDetail extends Model
{
    use HasFactory;

    protected $table = 'asset_fund_detail';
    
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

    public static function inserRow($value , $typeid , $id)
    {
        $process = new self;
        $process->parent_id = 0;
        $process->sort_order = 0;
        $process->asset_id = $id;
        $process->type_id = $typeid;
        $process->sum_total = $value;
        $process->description = '';
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function updateRow($value, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->sum_total = $value;
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
