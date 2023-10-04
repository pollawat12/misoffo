<?php

namespace App\Models;

use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActionReport extends Model
{
    use HasFactory;

    protected $table = 'project_action_reports';
    
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
    public static function getDataAll($id=0 , $parentId=0, $isCount=false)
    {
        if($id != 0){
            $conditions = [
                'project_report_id' =>  $id,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }else{
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
        }
        
        
        
        $query = self::where($conditions)->orderBy('id', 'ASC');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $ProjectAction = ProjectAction::where('id',$row->project_actions_id)->where('is_deleted', '0')->where('is_active','1')->get();;
                foreach ($ProjectAction as $ProjectActions);

                $ProjectActionTitle = ProjectAction::where('id',$ProjectActions->parent_id)->where('is_deleted', '0')->where('is_active','1')->get();;
                foreach ($ProjectActionTitle as $ProjectActionTitles);

                $array[] = [
                    'id' => $row->id,
                    'name' => $ProjectActions->name,
                    'nametile' => $ProjectActionTitles->name,
                    'report_date' => $row->report_date,
                    'approved_date' => $row->approved_date
                ];
            }
        }


        return $array;
    }

    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $actionId
     * @return void
     */
    public static function insertRow($data, $actionId=0)
    {
        $process = new self;
        $process->description = $data['description'];
        $process->weight_percent = $data['weight_percent'];
        $process->expense_amount = $data['expense_amount'];
        $process->expense_percent = $data['expense_percent'];
        $process->propblem_detail = $data['propblem_detail'];
        $process->solution_detail = $data['solution_detail'];
        $process->filepath = '';
        $process->report_date = $data['report_date'];
        $process->approved_date = $data['approved_date'];
        $process->status_report = (int) 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->project_actions_id = $data['project_actions_id'];
        $process->project_actions_sub_id = $data['parent_id'];
        $process->projects_id = $data['projects_id'];
        $process->project_report_id = $data['project_report_id'];
        $process->save();

        return $process->id;
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->description = $data['description'];
        $process->weight_percent = $data['weight_percent'];
        $process->expense_amount = $data['expense_amount'];
        $process->expense_percent = $data['expense_percent'];
        $process->propblem_detail = $data['propblem_detail'];
        $process->solution_detail = $data['solution_detail'];
        $process->filepath = '';
        $process->report_date = $data['report_date'];
        $process->approved_date = $data['approved_date'];
        $process->project_actions_id = $data['project_actions_id'];
        $process->project_actions_sub_id = $data['parent_id'];
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


    public static function doUpdateStatus($status=1,$id=0)
    {
        $process = self::find((int) $id);

        $process->status_report = $status;
        $process->updated_at = getDateNow();
        return $process->save();
    }

    public static function getWithDrawIncomeTotal($projectId=0)
    {
        $conditions = [
            'projects_id' => $projectId,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $sumTotals = self::where($conditions)->sum('expense_amount');

        return $sumTotals;
    }
}
