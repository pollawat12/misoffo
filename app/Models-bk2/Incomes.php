<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $table = 'incomes';
    
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

                $Company = IncomesCompany::where('id', $row->incomes_company)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($Company as $rowCompany);

                $sum = 0;
                $sumOil = IncomesDetail::where('incomes_id', $row->id)->where('is_deleted', '0')->where('is_active','1')->get();
                foreach ($sumOil as $rowsumOil){

                    $sum += $rowsumOil->incomes_total;
                }
                
                $array[] = [
                    'id' => $row->id,
                    'incomes_company' => $rowCompany->company_name,
                    'incomes_day' => $row->incomes_day,
                    'incomes_note' => $row->incomes_note,
                    'incomes_status' => $row->incomes_status,
                    'incomes_money' => $sum,
                ];
            }
        }


        return $array;
    }


    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->incomes_company = isset($data['incomes_company'])  ? trim($data['incomes_company']) : '';
        $process->incomes_day = isset($data['incomes_day'])  ? getInputDateToDB($data['incomes_day']) : NULL;
        $process->incomes_note = isset($data['incomes_note'])  ? trim($data['incomes_note']) : '';
        $process->incomes_file = isset($data['incomes_file'])  ? trim($data['incomes_file']) : '';
        $process->incomes_status = isset($data['incomes_status'])  ? trim($data['incomes_status']) : '';
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
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->incomes_company = isset($data['incomes_company'])  ? trim($data['incomes_company']) : '';
        $process->incomes_day = isset($data['incomes_day'])  ? getInputDateToDB($data['incomes_day']) : NULL;
        $process->incomes_note = isset($data['incomes_note'])  ? trim($data['incomes_note']) : '';
        $process->incomes_file = isset($data['incomes_file'])  ? trim($data['incomes_file']) : '';
        $process->incomes_status = isset($data['incomes_status'])  ? trim($data['incomes_status']) : '';
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

    
    /**
     * getIncomeInYears
     *
     * @param  mixed $sDate
     * @param  mixed $eDate
     * @return void
     */
    public static function getIncomeInYears($sDate='', $eDate='')
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $query = self::where($conditions)->whereBetween('incomes_day', [$sDate, $eDate]);
        return $query->get();
        // ->where(function($q) use ($sDate, $eDate) {
        //     $q->whereBetween('incomes_day', [$sDate, $eDate])->orWhereBetween('date_end', [$sDate, $eDate]);
        // });
    }
}
