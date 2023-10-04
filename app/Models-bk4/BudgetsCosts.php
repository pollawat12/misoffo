<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsCosts extends Model
{
    use HasFactory;

    protected $table = 'budgets_costs';
    
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
            
            if($parentId != 0){

                $conditions = [
                    'projects_id' =>  $id,
                    'parent_id' =>  $parentId,
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];

            }else{

                $conditions = [
                    'projects_id' =>  $id,
                    'parent_id' =>  0,
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];

            }
        }else{

            $conditions = [
                'parent_id' =>  0,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

        }
        
        
        $query = self::where($conditions)->orderBy('date_report', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                if($row->projects_id != 0){
                    // $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    // foreach ($Project as $rowProject);

                    $project_name = 'test';
                }else{
                    $project_name = 'สำนักงาน';
                }

                

                $statementtype = DataSetting::getNameDataByValueAndType($row->budget_categroy,'statementtype');
                $institution = DataSetting::getNameDataByValueAndType($row->institution,'institution');
                $categorybudget = DataSetting::getNameDataByValueAndType($row->cost_categroy,'categorybudget');

                $array[] = [
                    'id' => $row->id,
                    'date_report' => $row->date_report,
                    'page_number' => $row->page_number,
                    'petition_number' => $row->petition_number,
                    'cut_top_number' => $row->cut_top_number,
                    'expense_item' => $row->expense_item,
                    'cost_type' => $row->cost_type,
                    'cost_amount' => $row->cost_amount,
                    'status_approved' => $row->status_approved,
                    'project_id' => $row->projects_id,
                    'project_name' => $project_name,
                    'institution' => $institution,
                    'cost_categroy' => $categorybudget,
                    'budget_categroy' => $statementtype,
                ];
            }
        }


        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = isset($data['parent_id'])  ? trim($data['parent_id']) : 0;
        $process->sort_order = 0;
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->page_number = isset($data['page_number'])  ? trim($data['page_number']) : '';
        $process->expense_item = isset($data['expense_item'])  ? trim($data['expense_item']) : '';
        $process->pay_for = isset($data['pay_for'])  ? trim($data['pay_for']) : 0;
        $process->expenses_amount = isset($data['expenses_amount'])  ? trim($data['expenses_amount']) : 0;
        $process->deduct_amount = isset($data['deduct_amount'])  ? trim($data['deduct_amount']) : 0;
        $process->pay_NHSO = isset($data['pay_NHSO'])  ? trim($data['pay_NHSO']) : 0;
        $process->pay_oil = isset($data['pay_oil'])  ? trim($data['pay_oil']) : 0;
        $process->money_in_amount = isset($data['money_in_amount'])  ? trim($data['money_in_amount']) : 0;
        $process->bank_amount = isset($data['bank_amount'])  ? trim($data['bank_amount']) : 0;
        $process->interest_amount = isset($data['interest_amount'])  ? trim($data['interest_amount']) : 0;
        $process->sum_amount = isset($data['sum_amount'])  ? trim($data['sum_amount']) : 0;
        $process->budget_categroy = isset($data['budget_categroy'])  ? trim($data['budget_categroy']) : 0;
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : 0;
        $process->cost_type = isset($data['cost_type'])  ? trim($data['cost_type']) : 1;
        $process->institution = isset($data['institution_id'])  ? trim($data['institution_id']) : 0;
        $process->cost_categroy = isset($data['cost_categroy'])  ? trim($data['cost_categroy']) : 0;
        $process->status_approved = isset($data['status_approved'])  ? (int) $data['status_approved'] : 0;
        $process->projects_id  = isset($data['projects_id'])  ? (int) $data['projects_id'] : 0;
        $process->projects_id_1  = isset($data['projects_id_1'])  ? (int) $data['projects_id_1'] : 0;
        $process->projects_id_2  = isset($data['projects_id_2'])  ? (int) $data['projects_id_2'] : 0;
        $process->year_id  = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->type_id  = isset($data['type_id'])  ? (int) $data['type_id'] : 0;
        $process->cost_detail  = isset($data['cost_detail'])  ? trim($data['cost_detail']) : '';
        $process->year_budget  = isset($data['year_budget'])  ? (int) $data['year_budget'] : 0;
        $process->note  = isset($data['note'])  ? trim($data['note']) : '';
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
        $process->sort_order = 0;
        $process->date_report = isset($data['date_report'])  ? getInputDateToDB($data['date_report']) : date('Y-m-d');
        $process->page_number = isset($data['page_number'])  ? trim($data['page_number']) : '';
        $process->expense_item = isset($data['expense_item'])  ? trim($data['expense_item']) : '';
        $process->pay_for = isset($data['pay_for'])  ? trim($data['pay_for']) : 0;
        $process->expenses_amount = isset($data['expenses_amount'])  ? trim($data['expenses_amount']) : 0;
        $process->deduct_amount = isset($data['deduct_amount'])  ? trim($data['deduct_amount']) : 0;
        $process->pay_NHSO = isset($data['pay_NHSO'])  ? trim($data['pay_NHSO']) : 0;
        $process->pay_oil = isset($data['pay_oil'])  ? trim($data['pay_oil']) : 0;
        $process->money_in_amount = isset($data['money_in_amount'])  ? trim($data['money_in_amount']) : 0;
        $process->bank_amount = isset($data['bank_amount'])  ? trim($data['bank_amount']) : 0;
        $process->interest_amount = isset($data['interest_amount'])  ? trim($data['interest_amount']) : 0;
        $process->sum_amount = isset($data['sum_amount'])  ? trim($data['sum_amount']) : 0;
        $process->budget_categroy = isset($data['budget_categroy'])  ? trim($data['budget_categroy']) : 0;
        $process->budget_type = isset($data['budget_type'])  ? trim($data['budget_type']) : 0;
        $process->cost_type = isset($data['cost_type'])  ? trim($data['cost_type']) : 1;
        $process->institution = isset($data['institution'])  ? trim($data['institution']) : 0;
        $process->cost_categroy = isset($data['cost_categroy'])  ? trim($data['cost_categroy']) : 0;
        $process->status_approved = isset($data['status_approved'])  ? (int) $data['status_approved'] : 0;
        $process->projects_id  = isset($data['projects_id'])  ? (int) $data['projects_id'] : 0;
        $process->projects_id_1  = isset($data['projects_id_1'])  ? (int) $data['projects_id_1'] : 0;
        $process->projects_id_2  = isset($data['projects_id_2'])  ? (int) $data['projects_id_2'] : 0;
        $process->year_id  = isset($data['year_id'])  ? (int) $data['year_id'] : 0;
        $process->type_id  = isset($data['type_id'])  ? (int) $data['type_id'] : 0;
        $process->cost_detail  = isset($data['cost_detail'])  ? trim($data['cost_detail']) : '';
        $process->year_budget  = isset($data['year_budget'])  ? (int) $data['year_budget'] : 0;
        $process->note  = isset($data['note'])  ? trim($data['note']) : '';
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

    public static function getDataDetail($id=0 , $parentId=0, $isCount=false)
    {
        $conditions = [
            'id' =>  $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        
        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($Project as $rowProject);

                $YearBudgets = YearBudget::where('id',$row->year_budgets_id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($YearBudgets as $rowYearBudgets)

                $array[] = [
                    'id' => $row->id,
                    'date_report' => $row->date_report,
                    'amount' => $row->amount,
                    'cost_type' => $row->cost_type,
                    'status_approved' => $row->status_approved,
                    'project_name' => $rowProject->project_name,
                    'yearbudgets_year' => $rowYearBudgets->in_year,
                    'yearbudgets_start' => $rowYearBudgets->date_start,
                    'yearbudgets_end' => $rowYearBudgets->date_end,
                ];
            }
        }


        return $array;
    }


    public static function getDashboardProject($Checkdate)
    {

        $YearBudgets = YearBudget::where('is_deleted', '0')->where('is_active','1')->where('date_end', '>=', $Checkdate)->orderBy('id', 'ASC')->skip(0)->take(1)->get();
        foreach ($YearBudgets as $rowYearBudgets);

        $records = self::select('projects_id')->where('year_id', $rowYearBudgets->id)->where('projects_id' , '!=', '0')->where('is_deleted', '0')->where('is_active','1')->groupBy('projects_id')->get();

        if (!empty($records)) {
            foreach ($records as $row) {

                $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();

                foreach ($Project as $rowProject);

                $array[] = [
                    'project_id' => $row->projects_id,
                    'project_name' => $rowProject->project_name,
                ];
            }
        }

        

        return $array;
    }


     /**
     * getDataYearAll
     *
     * @param  mixed $type
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataYearAll($id=0 , $parentId=0, $type=0 , $isCount=false)
    {
        if($id != 0){
            
            if($parentId != 0){

                $conditions = [
                    'year_id' =>  $id,
                    'type_id' => $type,
                    'parent_id' =>  $parentId,
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];

            }else{

                $conditions = [
                    'year_id' =>  $id,
                    'type_id' => $type,
                    'parent_id' =>  0,
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1
                ];

            }
        }else{

            $conditions = [
                'parent_id' =>  0,
                'type_id' => $type,
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];

        }
        
        
        $query = self::where($conditions)->orderBy('date_report', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                if($row->budget_type != '0'){

                    $info = BudgetsrDetail::find((int) $row->budget_type);

                    if($info->budget_id == '325'){

                        if($row->projects_id != 0){
                            $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();
                            foreach ($Project as $rowProject);

                            $project_name = $rowProject['project_name'];
                        }else{
                            $project_name = 'สำนักงาน';
                        }

                    }else{

                        if($row->projects_id != 0){

                            $projectDetail = BudgetsrDetail::find((int) $row->projects_id);   

                        }elseif($row->projects_id_1 != 0){

                            $projectDetail = BudgetsrDetail::find((int) $row->projects_id_1); 

                        }else{

                            $projectDetail = BudgetsrDetail::find((int) $row->projects_id_2); 

                        }

                        $project_name = $projectDetail->name;
                    }

                }else{
                    $project_name = '';
                }

                if($row->budget_categroy != '0'){

                    $categroys = BudgetsrDetail::where('id',$row->budget_categroy)->where('is_deleted', '0')->where('is_active','1')->get();
                    foreach ($categroys as $categroy);

                    $statementtype = $categroy['name'];

                }else{

                    $statementtype = '';     
                }
                
                $institution = DataSetting::getNameDataByValueAndType($row->institution,'institution');

                $array[] = [
                    'id' => $row->id,
                    'date_report' => $row->date_report,
                    'page_number' => $row->page_number,
                    'expense_item' => $row->expense_item,
                    'pay_for' => $row->pay_for,
                    'expenses_amount' => $row->expenses_amount,
                    'cost_amount' => $row->cost_amount,
                    'status_approved' => $row->status_approved,
                    'project_id' => $row->projects_id,
                    'project_name' => $project_name,
                    'institution' => $institution,
                    'budget_categroy' => $statementtype,
                ];
            }
        }


        return $array;
    }


     /**
     * getDataReport
     *
     * @param  mixed $type
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataReport($statementtype=0 , $budget=0 , $id=0 , $isCount=false)
    {
        $conditions = [
            'budget_categroy' =>  $statementtype,
            'budget_type' =>  $budget,
            'year_id' =>  $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        
        $query = self::where($conditions)->orderBy('date_report', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                if($row->projects_id != 0){
                    $Project = Project::where('id',$row->projects_id)->where('is_deleted', '0')->where('is_active','1')->get();
                    foreach ($Project as $rowProject);

                    $project_name = $rowProject->project_name;
                }else{
                    $project_name = 'สำนักงาน';
                }

                

                $statementtype = DataSetting::getNameDataByValueAndType($row->budget_categroy,'statementtype');
                $institution = DataSetting::getNameDataByValueAndType($row->institution,'institution');
                $categorybudget = DataSetting::getNameDataByValueAndType($row->cost_categroy,'categorybudget');

                $array[] = [
                    'id' => $row->id,
                    'date_report' => $row->date_report,
                    'page_number' => $row->page_number,
                    'petition_number' => $row->petition_number,
                    'cut_top_number' => $row->cut_top_number,
                    'expense_item' => $row->expense_item,
                    'cost_type' => $row->cost_type,
                    'cost_amount' => $row->cost_amount,
                    'status_approved' => $row->status_approved,
                    'project_id' => $row->projects_id,
                    'project_name' => $project_name,
                    'institution' => $institution,
                    'cost_categroy' => $categorybudget,
                    'budget_categroy' => $statementtype,
                ];
            }
        }


        return $array;
    }
}
