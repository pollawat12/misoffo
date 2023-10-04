<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAction extends Model
{
    use HasFactory;

    protected $table = 'project_actions';
    
    public $timestamps = false;
    
    /**
     * getActionOfProject
     *
     * @param  mixed $projectId
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getActionOfProject($projectId=0, $parentId=0, $isCount=false)
    {   
        $condtions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'parent_id' => (int) $parentId,
            'projects_id' => (int) $projectId
        ];
        $query = self::where($condtions);

        return $query->orderBy('id', 'asc')->get();
    }
    
    /**
     * doUpdateStatus
     *
     * @param  mixed $status
     * @param  mixed $actionId
     * @return void
     */
    public static function doUpdateStatus($status=1,$actionId=0)
    {
        $process = self::find((int) $actionId);

        $process->status_action = $status;
        $process->updated_at = getDateNow();
        return $process->save();
    }

    
    /**
     * getArrayActionOfProject
     *
     * @param  mixed $projectId
     * @return void
     */
    public static function getArrayActionOfProject($projectId=0)
    {   
        $array = [];

        $condtions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'parent_id' => (int) 0,
            'projects_id' => (int) $projectId
        ];
        $rs = self::where($condtions)->orderBy('sort_order', 'asc')->get();

        if (!empty($rs)) {
            foreach ($rs as $row) {
                $tmp = [];
                // sub
                $subCondtions = [
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1,
                    'parent_id' => (int) $row->id,
                    'projects_id' => (int) $projectId
                ];

                $subRecords = self::where($subCondtions)->orderBy('sort_order', 'asc')->get();

                if (!empty($subRecords)) {
                    foreach ($subRecords as $subRecord) {

                        $rangeDate = (!empty($subRecord->date_start)) ? getDateTimeTH($subRecord->date_start, false, true).' ' : '';
                        $rangeDate .= (!empty($subRecord->date_end)) ? ' - '.getDateTimeTH($subRecord->date_end, false, true).' ' : '';

                        $tmp[] = [
                            'id' => $subRecord->id,
                            'parent_id' => $row->id,
                            'name' => $subRecord->name,
                            'range_date' => $rangeDate,
                            'percent_amount' => $subRecord->weight_percent,
                            'status' => getLabelStatusApprovedReport($subRecord->status_action)
                        ];
                    }
                }

                $rangeDate = (!empty($row->date_start)) ? getDateTimeTH($row->date_start, false, true).' ' : '';
                $rangeDate .= (!empty($row->date_end)) ? ' - '.getDateTimeTH($row->date_end, false, true).' ' : '';

                $array[] = [
                    'id' => $row->id,
                    'parent_id' => $row->id,
                    'name' => $row->name,
                    'range_date' => $rangeDate,
                    'percent_amount' => $row->weight_percent,
                    'status' => '',
                    'childs' => $tmp
                ];//getLabelStatusApprovedReport($row->status_action)
            }// end foreach $rs
        }

        return $array;
    }

    
    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public static function insertRow($data, $id=0)
    {
        $process = new self;

        $process->parent_id = (int) $data['parent_id'];
        $process->sort_order = (int) 1;
        $process->name = $data['name'];
        $process->weight_percent = $data['weight_percent'];
        $process->date_start = (!empty($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (!empty($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->date_report = (!empty($data['date_report'])) ? getInputDateToDB($data['date_report']) : null;
        $process->date_approved = (!empty($data['date_approved'])) ? getInputDateToDB($data['date_approved']) : null;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->projects_id = (int) $id;
        $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) $data['parent_id'];
        $process->name = $data['name'];
        $process->weight_percent = $data['weight_percent'];
        $process->date_start = (!empty($data['date_start'])) ? getInputDateToDB($data['date_start']) : null;
        $process->date_end = (!empty($data['date_end'])) ? getInputDateToDB($data['date_end']) : null;
        $process->date_report = (!empty($data['date_report'])) ? getInputDateToDB($data['date_report']) : null;
        $process->date_approved = (!empty($data['date_approved'])) ? getInputDateToDB($data['date_approved']) : null;
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
