<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableDecline extends Model
{
    use HasFactory;

    protected $table = 'durable_decline';
    
    public $timestamps = false;

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->is_year = isset($data['is_year'])  ? (int) $data['is_year'] : 0;
        $process->is_decline  = isset($data['is_decline'])  ? (int) $data['is_decline'] : 0;
        $process->durable_id = isset($data['durable_id'])  ? trim($data['durable_id']) : 0;
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
        
        $process->is_year = isset($data['is_year'])  ? (int) $data['is_year'] : 0;
        $process->is_decline  = isset($data['is_decline'])  ? (int) $data['is_decline'] : 0;
        $process->durable_id = isset($data['durable_id'])  ? trim($data['durable_id']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }
}
