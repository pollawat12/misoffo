<?php

namespace App\Models;

use DB;
use URL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Province;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->eproproject_id = '';
        $process->project_name = trim($data['project_name']);
        $process->data_json = '';
        $process->description = isset($data['description'])  ? trim($data['description']) : '';
        $process->reason_detail = isset($data['reason_detail'])  ? trim($data['reason_detail']) : '';
        $process->goal_detail = isset($data['goal_detail'])  ? trim($data['goal_detail']) : '';
        $process->area_process = isset($data['area_process'])  ? trim($data['area_process']) : '';
        $process->owner_name = isset($data['owner_name'])  ? trim($data['owner_name']) : '';
        $process->lat_value = isset($data['lat_value'])  ? trim($data['lat_value']) : '';
        $process->lng_value = isset($data['lng_value'])  ? trim($data['lng_value']) : '';
        $process->status_project = isset($data['status_project'])  ? (int) $data['status_project'] : 2;
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : NULL;
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : NULL;
        $process->in_year = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->eproyear_id = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->budget_amount = isset($data['budget_amount'])  ? trim($data['budget_amount']) : '0.00';
        $process->budget_real_amount = isset($data['budget_amount'])  ? trim($data['budget_amount']) : '0.00';
        $process->province_id = (int) 0;
        $process->amphur_id = (int) 0;
        $process->district_id = (int) 0;
        $process->budget_categroy = isset($data['budget_categroy'])  ? (int) $data['budget_categroy'] : 0;
        $process->budget_type = isset($data['budget_type'])  ? (int) $data['budget_type'] : 0;
        $process->institution_id = isset($data['institution_id'])  ? (int) $data['institution_id'] : 0;
        $process->objective = isset($data['objective'])  ? $data['objective'] : '';
        $process->target = isset($data['target'])  ? $data['target'] : '';
        $process->split = isset($data['split'])  ? $data['split'] : '';
        $process->project_file = isset($data['project_file'])  ? $data['institutiproject_fileon_id'] : '';
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
        $process->eproproject_id = '';
        $process->project_name = trim($data['project_name']);
        $process->data_json = '';
        $process->description = isset($data['description'])  ? trim($data['description']) : '';
        $process->reason_detail = isset($data['reason_detail'])  ? trim($data['reason_detail']) : '';
        $process->goal_detail = isset($data['goal_detail'])  ? trim($data['goal_detail']) : '';
        $process->area_process = isset($data['area_process'])  ? trim($data['area_process']) : '';
        $process->owner_name = isset($data['owner_name'])  ? trim($data['owner_name']) : '';
        $process->lat_value = isset($data['lat_value'])  ? trim($data['lat_value']) : '';
        $process->lng_value = isset($data['lng_value'])  ? trim($data['lng_value']) : '';
        $process->status_project = isset($data['status_project'])  ? (int) $data['status_project'] : 2;
        $process->date_start = isset($data['date_start'])  ? getInputDateToDB($data['date_start']) : NULL;
        $process->date_end = isset($data['date_end'])  ? getInputDateToDB($data['date_end']) : NULL;
        $process->in_year = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->eproyear_id = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->budget_amount = isset($data['budget_amount'])  ? trim($data['budget_amount']) : '0.00';
        $process->budget_real_amount = isset($data['budget_amount'])  ? trim($data['budget_amount']) : '0.00';
        $process->province_id = (int) 0;
        $process->amphur_id = (int) 0;
        $process->district_id = (int) 0;
        $process->budget_categroy = isset($data['budget_categroy'])  ? (int) $data['budget_categroy'] : 0;
        $process->budget_type = isset($data['budget_type'])  ? (int) $data['budget_type'] : 0;
        $process->institution_id = isset($data['institution_id'])  ? (int) $data['institution_id'] : 0;
        $process->objective = isset($data['objective'])  ? $data['objective'] : '';
        $process->target = isset($data['target'])  ? $data['target'] : '';
        $process->split = isset($data['split'])  ? $data['split'] : '';
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    
    /**
     * getDataAll
     *
     * @return void
     */
    public static function getDataAll()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        return $query->orderBy('in_year','desc')->orderBy('date_start', 'desc')->get();
    }
    
    /**
     * getWithUserAndDepartment
     *
     * @param  mixed $userId
     * @param  mixed $departmentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getWithUserAndDepartment($userId=0, $departmentId=0, $isCount=false)
    {
        $conditions = [
            't1.is_deleted' => (int) 0,
            't1.is_active' => (int) 1,
            't1.users_id' => (int) $userId
        ];

        //dd($conditions);

        $query = DB::table('user_to_projects as t1')
            ->join('projects as t2','t1.projects_id','=','t2.id')
            ->where($conditions)
            ->select('t2.*');

        $records = $query->orderBy('t2.in_year','desc')->orderBy('t2.date_start', 'desc')->get();       
         
        return $records;
    }

    
    /**
     * getSummaryTitleBox
     *
     * @return void
     */
    public static function getSummaryTitleBox()
    {
        $projectTotalCounts = 0;
        $projectOnProcessCounts = 0;
        $projectSuccessCounts = 0;
        $projectReportDelayCounts = 10;

        
        $projectTotalCounts = self::where([
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
        ])->where('status_project', '!=', (int) 0)->count();

        $projectOnProcessCounts = self::where([
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
        ])->where('status_project', (int) 1)->count();

        $projectSuccessCounts = self::where([
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
        ])->where('status_project', (int) 2)->count();

        $array = [
            'project_total' => $projectTotalCounts,
            'project_onprocess' => $projectOnProcessCounts,
            'project_success' => $projectSuccessCounts,
            'project_report_delay' => $projectReportDelayCounts
        ];

        
        return $array;
    }

    
    /**
     * getPointOnMap
     *
     * @return void
     */
    public static function getPointOnMap()
    {
        $projects = self::where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

        $array = [];
        $lng = '';
        $lat = '';

        if (!empty($projects)) {
            foreach ($projects as $item) {
                if (!empty($item->lng_value) && !empty($item->lat_value)) {
                    $lng = $item->lng_value;
                    $lat = $item->lat_value;

                    $content_html = "<p style='text-align:left;'><a href='".URL('office/progress/project/edit')."/".$item->id."' target='_blank'>".$item->project_name."</a></p>";

                    $array[] = [
                        'lat' => $lng,
                        'lng' => $lat,
                        'title' => $item->project_name,
                        'content' => $content_html
                    ];
                } else {
                    if ($item->province_id > 0) {
                        $province_info = Province::find((int) $item->province_id);
                        
                        $lat = $province_info->PROVINCE_LAT;
                        $lng = $province_info->PROVINCE_LNG;

                        $content_html = "<p style='text-align:left;'><a href='".URL('office/progress/project/edit')."/".$item->id."' target='_blank'>".$item->project_name."</a></p>";

                        $array[] = [
                            'lat' => $lat,
                            'lng' => $lng,
                            'title' => $item->project_name,
                            'content' => $content_html
                        ];
                    }
                }

                
            }
        }

        return $array;
    }

    public static function getWithDrawIncome()
    {
        $projects = self::where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

        $array = [];
        if ($projects) {
            foreach ($projects as $item) { 
                $withdrawIncome = ProjectActionReport::getWithDrawIncomeTotal($item->id);

                $budgetTotal = $item->budget_amount;
                $currentDiffTotal = $item->budget_amount - $withdrawIncome;

                $percentVal = ($withdrawIncome * 100) / $budgetTotal;

                $array[] = [
                    'id' => '',
                    'code' => $item->eproproject_id,
                    'project_name' => $item->project_name,
                    'department_owner' => $item->project_name,
                    'start_date' => $item->project_name,
                    'end_date' => $item->project_name,
                    'grand_total' => getNumberCurrency(0),
                    'current_total' => getNumberCurrency($currentDiffTotal),
                    'percent_value' => getNumberCurrency($percentVal)
                ];
            }
        }

        return $array;
        
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
