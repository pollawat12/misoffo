<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    protected $table = 'budget_disbursement';
    
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
    public static function getDataAll($id=0 , $typeid=0 , $parentId=0, $isCount=false)
    {
        if($typeid == 1){
            $conditions = [
                'budget_type' => $typeid,
                'year_budgets_id' =>  $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }else{
            $conditions = [
                'budget_type' => $typeid,
                'projects_id' =>  $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }
        
        
        $query = self::where($conditions)->orderBy('id', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($Project as $rowProject);

                $YearBudgets = YearBudget::where('id',$row->year_budgets_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($YearBudgets as $rowYearBudgets)
                if($typeid == 1){
                    $array[] = [
                        'id' => $row->id,
                        'budget_type' => $row->budget_type,
                        'date_report' => $row->date_report,
                        'approved_time' => $row->approved_time,
                        'duration' => $row->duration,
                        'amount' => $row->amount,
                        'cost_type' => $row->cost_type,
                        'comment' => $row->comment,
                        'status_approved' => $row->status_approved,
                        'yearbudgets_year' => $rowYearBudgets->in_year,
                        'yearbudgets_start' => $rowYearBudgets->date_start,
                        'yearbudgets_end' => $rowYearBudgets->date_end,
                    ];
                }else{
                    $array[] = [
                        'id' => $row->id,
                        'budget_type' => $row->budget_type,
                        'date_report' => $row->date_report,
                        'approved_time' => $row->approved_time,
                        'duration' => $row->duration,
                        'amount' => $row->amount,
                        'cost_type' => $row->cost_type,
                        'comment' => $row->comment,
                        'status_approved' => $row->status_approved,
                        'project_name' => $rowProject->project_name,
                        'owner_name' => $rowProject->owner_name,
                        'description' => $rowProject->description,
                        'yearbudgets_year' => $rowYearBudgets->in_year,
                        'yearbudgets_start' => $rowYearBudgets->date_start,
                        'yearbudgets_end' => $rowYearBudgets->date_end,
                    ];    
                }
            }
        }


        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : '';
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->approved_time = isset($data['approved_time'])  ? trim($data['approved_time']) : '';
        $process->duration = isset($data['duration'])  ? trim($data['duration']) : '';
        $process->amount = isset($data['amount'])  ? trim($data['amount']) : '';
        $process->cost_type = isset($data['cost_type'])  ? trim($data['cost_type']) : 1;
        $process->file_name = isset($data['file_name'])  ? trim($data['file_name']) : '';
        $process->comment = isset($data['comment'])  ? trim($data['comment']) : '';
        $process->status_approved = isset($data['status_approved'])  ? (int) $data['status_approved'] : 0;
        $process->projects_id  = isset($data['projects_id'])  ? (int) $data['projects_id'] : 0;
        $process->year_budgets_id = isset($data['year_budgets_id'])  ? trim($data['year_budgets_id']) : 0;
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
        
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : '';
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->approved_time = isset($data['approved_time'])  ? trim($data['approved_time']) : '';
        $process->duration = isset($data['duration'])  ? trim($data['duration']) : '';
        $process->amount = isset($data['amount'])  ? trim($data['amount']) : '';
        $process->cost_type = isset($data['cost_type'])  ? trim($data['cost_type']) : 1;
        $process->file_name = isset($data['file_name'])  ? trim($data['file_name']) : '';
        $process->comment = isset($data['comment'])  ? trim($data['comment']) : '';
        $process->status_approved = isset($data['status_approved'])  ? (int) $data['status_approved'] : 0;
        $process->projects_id  = isset($data['projects_id'])  ? (int) $data['projects_id'] : 0;
        $process->year_budgets_id = isset($data['year_budgets_id'])  ? trim($data['year_budgets_id']) : 0;
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
