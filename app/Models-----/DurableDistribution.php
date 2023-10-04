<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableDistribution extends Model
{
    use HasFactory;

    protected $table = 'durable_distribution';
    
    public $timestamps = false;

    public static function inserRow($data, $id=0, $returnId=false)
    {
        $process = new self;
        $process->distribution_type = isset($data['distribution_type'])  ? (int) $data['distribution_type'] : 0;
        $process->distribution_sta = isset($data['distribution_sta'])  ? (int) $data['distribution_sta'] : 0;
        $process->durable_id = (int) $id;
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
        
        $process->distribution_type = isset($data['distribution_type'])  ? (int) $data['distribution_type'] : 0;
        $process->distribution_sta = isset($data['distribution_sta'])  ? (int) $data['distribution_sta'] : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }
}
