<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsCostsOil extends Model
{
    use HasFactory;

    protected $table = 'budget_costs_oil';
    
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
        $process->compensate_date = isset($data['compensate_date'])  ? getInputDateToDB($data['compensate_date']) : date('Y-m-d');
        $process->compensate_num = isset($data['compensate_num'])  ? trim($data['compensate_num']) : '';
        $process->compensate_payfor = isset($data['compensate_payfor'])  ? trim($data['compensate_payfor']) : '';
        $process->compensate_status = isset($data['compensate_status'])  ? trim($data['compensate_status']) : 0;
        $process->compensate_oile20_liter = isset($data['compensate_oile20_liter'])  ? trim($data['compensate_oile20_liter']) : 0.00;
        $process->compensate_oile20_price = isset($data['compensate_oile20_price'])  ? trim($data['compensate_oile20_price']) : 0.00;
        $process->compensate_oile85_liter = isset($data['compensate_oile85_liter'])  ? trim($data['compensate_oile85_liter']) : 0.00;
        $process->compensate_oile85_price = isset($data['compensate_oile85_price'])  ? trim($data['compensate_oile85_price']) : 0.00;
        $process->compensate_oild_liter = isset($data['compensate_oild_liter'])  ? trim($data['compensate_oild_liter']) : 0.00;
        $process->compensate_oiled_price = isset($data['compensate_oiled_price'])  ? trim($data['compensate_oiled_price']) : 0.00;
        $process->compensate_oild10_liter = isset($data['compensate_oild10_liter'])  ? trim($data['compensate_oild10_liter']) : 0.00;
        $process->compensate_oild10_price = isset($data['compensate_oild10_price'])  ? trim($data['compensate_oild10_price']) : 0.00;
        $process->compensate_oild20_liter = isset($data['compensate_oild20_liter'])  ? trim($data['compensate_oild20_liter']) : 0.00;
        $process->compensate_oild20_price = isset($data['compensate_oild20_price'])  ? trim($data['compensate_oild20_price']) : 0.00;
        $process->compensate_lpg_liter = isset($data['compensate_lpg_liter'])  ? trim($data['compensate_lpg_liter']) : 0.00;
        $process->compensate_lpg_price = isset($data['compensate_lpg_price'])  ? trim($data['compensate_lpg_price']) : 0.00;
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
        $process->compensate_date = isset($data['compensate_date'])  ? getInputDateToDB($data['compensate_date']) : date('Y-m-d');
        $process->compensate_num = isset($data['compensate_num'])  ? trim($data['compensate_num']) : '';
        $process->compensate_payfor = isset($data['compensate_payfor'])  ? trim($data['compensate_payfor']) : 0;
        $process->compensate_status = isset($data['compensate_status'])  ? trim($data['compensate_status']) : 0;
        $process->compensate_oile20_liter = isset($data['compensate_oile20_liter'])  ? trim($data['compensate_oile20_liter']) : 0.00;
        $process->compensate_oile20_price = isset($data['compensate_oile20_price'])  ? trim($data['compensate_oile20_price']) : 0.00;
        $process->compensate_oile85_liter = isset($data['compensate_oile85_liter'])  ? trim($data['compensate_oile85_liter']) : 0.00;
        $process->compensate_oile85_price = isset($data['compensate_oile85_price'])  ? trim($data['compensate_oile85_price']) : 0.00;
        $process->compensate_oild_liter = isset($data['compensate_oild_liter'])  ? trim($data['compensate_oild_liter']) : 0.00;
        $process->compensate_oiled_price = isset($data['compensate_oiled_price'])  ? trim($data['compensate_oiled_price']) : 0.00;
        $process->compensate_oild10_liter = isset($data['compensate_oild10_liter'])  ? trim($data['compensate_oild10_liter']) : 0.00;
        $process->compensate_oild10_price = isset($data['compensate_oild10_price'])  ? trim($data['compensate_oild10_price']) : 0.00;
        $process->compensate_oild20_liter = isset($data['compensate_oild20_liter'])  ? trim($data['compensate_oild20_liter']) : 0.00;
        $process->compensate_oild20_price = isset($data['compensate_oild20_price'])  ? trim($data['compensate_oild20_price']) : 0.00;
        $process->compensate_lpg_liter = isset($data['compensate_lpg_liter'])  ? trim($data['compensate_lpg_liter']) : 0.00;
        $process->compensate_lpg_price = isset($data['compensate_lpg_price'])  ? trim($data['compensate_lpg_price']) : 0.00;
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
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        
        
        $query = self::where($conditions)->orderBy('compensate_date', 'desc');

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $payfor = BudgetCertificateCompany::find((int) $row->compensate_payfor);

                $price = $row->compensate_oile20_price + $row->compensate_oile85_price + $row->compensate_oiled_price + $row->compensate_oild10_price + $row->compensate_oild20_price + $row->compensate_lpg_price;

                $liter = $row->compensate_oile20_liter + $row->compensate_oile85_liter + $row->compensate_oiled_liter + $row->compensate_oild10_liter + $row->compensate_oild20_liter + $row->compensate_lpg_liter;

                $array[] = [
                    'id' => $row->id,
                    'compensate_num' => $row->compensate_num,
                    'compensate_payfor' => $payfor->company_name,
                    'compensate_date' => $row->compensate_date,
                    'compensate_status' => $row->compensate_status,
                    'price' => $price,
                    'liter' => $liter,
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
