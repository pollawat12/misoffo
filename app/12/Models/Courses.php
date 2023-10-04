<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    
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
    public static function getDataAll($id=0,$isCount=false)
    {
        if($id == 0){
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }else{
            $conditions = [
                'id' => $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }
        
        
        $query = self::where($conditions)->orderBy('date_start', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $categroy = DataSetting::getNameDataByValueAndType($row->categroy_courses_id,'course');

                $array[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'place' => $row->place,
                    'lecturer_name' => $row->lecturer_name,
                    'budget_year' => $row->budget_year,
                    'date_start' => $row->date_start,
                    'date_end' => $row->date_end,
                    'time_start' => $row->time_start,
                    'time_end' => $row->time_end,
                    'categroy' => $categroy,
                    'score_sum' => $row->score_sum,
                    'score_grade' => $row->score_grade,
                ];
            }
        }


        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->place = isset($data['place'])  ? trim($data['place']) : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->time_start = (isset($data['time_start'])) ? $data['time_start']: null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->time_end = (isset($data['time_end'])) ? $data['time_end']: null;
        $process->price = isset($data['price'])  ? trim($data['price']) : 0.00;
        $process->budget_year = isset($data['budget_year'])  ? trim($data['budget_year']) : '';
        $process->person_amount  = isset($data['person_amount'])  ?  (int) $data['person_amount '] : '';
        $process->lecturer_name = isset($data['lecturer_name'])  ? trim($data['lecturer_name']) : '';
        $process->score_sum = isset($data['score_sum'])  ?  (int) $data['score_sum'] : 0;
        $process->score_grade = isset($data['score_grade'])  ? trim($data['score_grade']) : '';
        $process->categroy_courses_id = isset($data['categroy_courses_id'])  ? (int) $data['categroy_courses_id'] : 0;
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
        
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = isset($data['sort_order'])  ? trim($data['sort_order']) : 1;
        $process->name = isset($data['name'])  ? trim($data['name']) : '';
        $process->place = isset($data['place'])  ? trim($data['place']) : '';
        $process->date_start = (isset($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->time_start = (isset($data['time_start'])) ? $data['time_start']: null;
        $process->date_end = (isset($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->time_end = (isset($data['time_end'])) ? $data['time_end']: null;
        $process->price = isset($data['price'])  ? trim($data['price']) : 0.00;
        $process->budget_year = isset($data['budget_year'])  ? trim($data['budget_year']) : '';
        $process->person_amount  = isset($data['person_amount'])  ?  (int) $data['person_amount '] : '';
        $process->lecturer_name = isset($data['lecturer_name'])  ? trim($data['lecturer_name']) : '';
        $process->score_sum = isset($data['score_sum'])  ?  (int) $data['score_sum'] : 0;
        $process->score_grade = isset($data['score_grade'])  ? trim($data['score_grade']) : '';
        $process->categroy_courses_id = isset($data['categroy_courses_id'])  ? (int) $data['categroy_courses_id'] : 0;
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
