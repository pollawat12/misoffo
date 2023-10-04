<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveMeeting extends Model
{
    use HasFactory;

    protected $table = 'reserve_meetings';
    
    public $timestamps = false;


    public static function getMeetingLists()
    {
        $conditions = [
            't1.is_deleted' => (int) 0,
            't1.is_active' =>  (int) 1
        ];

        $query = DB::table('reserve_meetings as t1')
            ->leftJoin('data_settings as t2', 't2.id', '=', 't1.meeting_room_id')
            ->leftJoin('data_settings as t3', 't3.id', '=', 't1.meeting_type_id')
            ->where('t2.group_type','meeting_room')
            ->where('t3.group_type','meeting_type')
            ->where($conditions)
            ->select('t1.*', 't2.name as meeting_room', 't3.name as meeting_type');

        return $query->orderBy('date_start', 'desc')->get();
    }


    /**
     * insertArray
     *
     * @param  mixed $array
     * @param  mixed $return_id
     * @return void
     */
    public static function insertArray($array, $return_id=false)
    {
        // $query = new self;
        if ($return_id) {
            return self::create($array)->id;
        }
        return self::insert($array);
    }

    /**
     * updateArray
     *
     * @param  mixed $input
     * @param  mixed $return_id
     * @return void
     */
    public static function updateArray($array, $id=0)
    {
        // $query = new self;
        return self::where('id', $id)->update($array);
    }
    
    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
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
     * getMeetingExists
     *
     * @param  mixed $sDate
     * @param  mixed $eDate
     * @return void
     */
    public static function getMeetingExists($sDate='', $eDate='', $meeting_id=0)
    {
        $conditions = [
            'meeting_room_id' => (int) $meeting_id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $query = self::where($conditions)->where(function($q) use ($sDate, $eDate) {
            $q->whereBetween('date_start', [$sDate, $eDate])->orWhereBetween('date_end', [$sDate, $eDate]);
        });

        return $query->get();
    }
    
    /**
     * getMeetingExistsUpdate
     *
     * @param  mixed $sDate
     * @param  mixed $eDate
     * @param  mixed $room_meeting_id
     * @param  mixed $meeting_id
     * @param  mixed $user_id
     * @return void
     */
    public function getMeetingExistsUpdate($sDate='', $eDate='', $room_meeting_id=0, $meeting_id=0)
    {
        $info = self::find((int) $meeting_id);
        
        $timestamp_date_start = strtotime($info->date_start);
        $timestamp_date_end = strtotime($info->date_end);
        $new_timestamp_date_start = strtotime($sDate);
        $new_timestamp_date_end = strtotime($eDate);

        if (($timestamp_date_start == $new_timestamp_date_start) && ($timestamp_date_end == $new_timestamp_date_end) && $meeting_id > 0) {
            return (int) 0;
        }

        $conditions = [
            'meeting_room_id' => (int) $room_meeting_id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $query = self::where($conditions)->where(function($q) use ($sDate, $eDate) {
            $q->whereBetween('date_start', [$sDate, $eDate])->orWhereBetween('date_end', [$sDate, $eDate]);
        });

        $results = $query->get();
        return (int) count($results);
    }
}
