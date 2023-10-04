<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMonth extends Model
{
    use HasFactory;

    protected $table = 'asset_month';
    
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
                        'asset_date' => $row->asset_date,
                        'description' => $row->description,
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
    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : 0;
        $process->asset_date = isset($data['asset_date'])  ? getInputDateToDB($data['asset_date']) : NULL;
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
        $process->asset_date = isset($data['asset_date'])  ? getInputDateToDB($data['asset_date']) : NULL;
        $process->description = isset($data['description'])  ? trim($data['description']) : '';
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

    public static function getdataGroupYear($parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        

        $query = self::select('year_id')->where($conditions);

        $records = $query->groupBy('year_id')->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $Year = YearBudget::where('id', $row->year_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($Year as $rowYear) {
                    $array[] = [
                        'id' => $row->id,
                        'year_id' => $row->year_id,
                        'year_name' => $rowYear->in_year,
                        'budget_money' => $row->budget_money,
                        'status_approved' => $row->status_approved,
                    ];
                }
            }
        }


        return $array;
    }

    public static function getdataNew($parentId=0, $isCount=false)
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
