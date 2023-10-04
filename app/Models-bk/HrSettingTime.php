<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrSettingTime extends Model
{
    use HasFactory;

    protected $table = 'hr_setting_times';
    
    public $timestamps = false;

    
    /**
     * Undocumented function updateRecord
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public static function updateRecord($data=[], $id=0)
    {
        $process = self::find((int) $id);
        
        $process->name = $data['name'];
        $process->check_in = $data['check_in'];
        $process->check_out = $data['check_out'];
        $process->start_check_in = $data['start_check_in'];
        $process->limit_not_over_check_out = $data['limit_not_over_check_out'];
        $process->time_late_number = $data['time_late_number'];
        $process->time_exit_number = $data['time_exit_number'];
        $process->office_distance = $data['office_distance'];
        $process->updated_at = getDateNow();
        
        return $process->save();
    }
}
