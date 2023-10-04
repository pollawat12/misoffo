<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsDetail extends Model
{
    use HasFactory;

    protected $table = 'sms_details';
    
    public $timestamps = false;

    
    /**
     * insertOne
     *
     * @param  mixed $data
     * @param  mixed $campId
     * @return void
     */
    public static function insertOne($data=[], $campId=0)
    {
        $process = new self;

        $process->send_code = $data['send_code'];
        $process->status_code = $data['status_code'];
        $process->phone_number = $data['phone_number'];
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->sms_campaigns_id = (int) $campId;

        return $process->save();
    }
}
