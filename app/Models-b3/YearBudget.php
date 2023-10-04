<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearBudget extends Model
{
    use HasFactory;

    protected $table = 'year_budgets';
    
    public $timestamps = false;


    public static function getDataAll()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        return $query->orderBy('in_year','desc')->get();
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
        $process->in_year = (int) $data['year'];
        $process->date_start = getInputDateToDB($data['date_start']);
        $process->date_end = getInputDateToDB($data['date_end']);
        $process->is_default = (int) 0;
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

        $isDefault = trim($data['is_default']);
        if ($isDefault == 1) {
            self::query()->update(['is_default' => (int) 0]);
        }
        
        $process->in_year = (int) $data['year'];
        $process->date_start = getInputDateToDB($data['date_start']);
        $process->date_end = getInputDateToDB($data['date_end']);
        $process->is_default = (int) $data['is_default'];
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
