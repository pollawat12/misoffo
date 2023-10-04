<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeAttendance extends Model
{
    use HasFactory;

    protected $table = 'time_attendances';
    
    public $timestamps = false;

    /**
     * Undocumented function insertDB
     *
     * @param [type] $data
     * @return void
     */
    public static function insertDB($data, $userId=0)
    {
        $process = new self;
        $process->check_in_date = getDateNow();
        $process->check_in_time = date('H:i:s');
        $process->check_in_type = trim($data['check_in_type']);
        $process->users_id = (int) $userId;
        $process->latitude = trim($data['latitude']);
        $process->longitude = trim($data['longitude']);
        $process->check_time_type = trim($data['check_time_type']);
        $process->distance_number = $data['distance_number'];
        $process->note = $data['note'];
        $process->is_deleted = (int) 0;
        $process->is_actived = (int) 1;
        $process->is_approved = (int) 0;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        if ($process->save()) return $process->id;
        return false;
    }

    /**
     * Undocumented function getDataTimeLabel
     *
     * @param integer $userId
     * @param [type] $date
     * @param [type] $time
     * @param string $type
     * @return void
     */
    public static function getDataTimeLabel($userId=0, $date='', $type='in')
    {
        $defaultConditions = ['is_actived' => (int) 1, 'is_deleted' => (int) 0];
        $result = self::where('users_id', (int) $userId)
            ->where($defaultConditions)
            ->whereDate('check_in_date', trim($date))
            ->where('check_in_type', trim($type));
        if ($type == 'in') {
            $result->orderBy('check_in_date', 'asc');
        } 
        else {
            $result->orderBy('check_in_date', 'desc');
        }
        return $result->first();

        // $strDateTime = '-';

        // if ($result) {
        //     $strDateTime = getShowDateMonthTH($result->check_in_date, false);
        //     list($hh, $mm, $ii) = explode(':', trim($result->check_in_time));

        //     $strDateTime .= ' ' . implode(':', [$hh, $mm]) . ' น.';
        // }

        // return $strDateTime;
    }
}
