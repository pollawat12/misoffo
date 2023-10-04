<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsWork extends Model
{
    use HasFactory;

    protected $table = 'projects_work';
    
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
    public static function getDataAll($isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'status_approved' => (int) 0,
        ];

        $query = self::where($conditions);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->day_start = isset($data['day_start'])  ? getInputDateToDB($data['day_start']) : date('Y-m-d');
        $process->day_end = isset($data['day_end'])  ? getInputDateToDB($data['day_end']) : date('Y-m-d');
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : 0;
        $process->file_work = isset($data['file_work'])  ? trim($data['file_work']) : '';
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->status_approved = isset($data['status_approved'])  ? trim($data['status_approved']) : 0;
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

    public static function updateRow($data , $id)
    {
        $process = self::find((int) $id);

        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->day_start = isset($data['day_start'])  ? getInputDateToDB($data['day_start']) : date('Y-m-d');
        $process->day_end = isset($data['day_end'])  ? getInputDateToDB($data['day_end']) : date('Y-m-d');
        $process->year_id = isset($data['year_id'])  ? trim($data['year_id']) : 0;
        $process->file_work = isset($data['file_work'])  ? trim($data['file_work']) : '';
        $process->note = isset($data['note'])  ? trim($data['note']) : '';
        $process->status_approved = isset($data['status_approved'])  ? trim($data['status_approved']) : 0;
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


    public static function getDataAllChekTime($date , $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'status_approved' => (int) 0,
        ];

        $query = self::where($conditions)->where('day_end' , '>=' , $date);

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('id','desc')->get();
    }
}
