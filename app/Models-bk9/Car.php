<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'budgets_costs';
    
    public $timestamps = false;

    /**
     * Undocumented function getRecords
     *
     * @param array $conditions
     * @return void
     */
    public static function getRecords($conditions=[])
    {
        $condDefault = ['is_deleted' => (int) 0, 'is_actived' => (int) 1];
        $query = self::where($condDefault);

        if (is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $field => $val) {
                if (is_array($val)) {
                    $query->whereIn($field, $val);
                } else {
                    $query->where($field, $val);
                }
                
            }
        }

        return $query->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Undocumented function insertDB
     *
     * @param array $data
     * @return void
     */
    public static function insertDB($data=[])
    {
        if (!is_array($data)) return false;

        $process = new self;
        $process->code = null;
        $process->car_model = trim($data['car_model']);
        $process->car_brand = trim($data['car_brand']);
        $process->register_no = trim($data['register_no']);
        $process->driver_by = trim($data['driver_by']);
        $process->buy_date_at = trim($data['buy_date_at']);
        $process->car_type = trim($data['car_type']);
        $process->promise_type = trim($data['promise_type']);
        $process->attach_file = trim($data['attach_file']);
        $process->company_id = trim($data['company_id']);
        $process->tel = trim($data['tel']);
        $process->start_date = (isset($data['start_date'])) ? $data['start_date'] : null;
        $process->end_date = (isset($data['end_date'])) ? $data['end_date'] : null;
        $process->is_deleted = (int) 0;
        $process->is_actived = (int) 1;
        $process->created_at = date('Y-m-d H:i:s');
        $process->updated_at = date('Y-m-d H:i:s');

        return $process->save();
    }
}
