<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCampaign extends Model
{
    use HasFactory;

    protected $table = 'sms_campaigns';
    
    public $timestamps = false;

    
    /**
     * insertOne
     *
     * @param  mixed $data
     * @param  mixed $returnId
     * @return void
     */
    public static function insertOne($data=[], $returnId=false)
    {
        $process = new self;

        $process->subject = $data['subject'];
        $process->detail = $data['detail'];
        $process->total_numbers = $data['total_numbers'];
        $process->total_current = $data['total_current'];
        $process->message = $data['message'];
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
}
