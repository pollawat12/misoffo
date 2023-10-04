<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReportTotal extends Model
{
    use HasFactory;

    protected $table = 'project_report';
    
    public $timestamps = false;
    public static function insertRow($data, $id=0)
    {
        $process = new self;

        $process->date_report = isset($data['date_report'])  ? getCreateReportDate($data['date_report']) : date('Y-m-d');
        $process->do_consult = isset($data['do_consult'])  ? (int) $data['do_consult']  : 0;
        $process->do_consult_price = isset($data['do_consult_price'])  ? trim($data['do_consult_price']) : 0.00;
        $process->do_owner = isset($data['do_owner'])  ? (int) $data['do_owner'] : 0;
        $process->do_owner_price = isset($data['do_owner_price'])  ? trim($data['do_owner_price']) : 0.00;
        $process->is_approved =isset($data['is_approved'])  ? trim($data['is_approved']) : 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->projects_id = (int) $id;
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->date_report = isset($data['date_report'])  ? getCreateReportDate($data['date_report']) : date('Y-m-d');
        $process->do_consult = isset($data['do_consult'])  ? (int) $data['do_consult']  : 0;
        $process->do_consult_price = isset($data['do_consult_price'])  ? trim($data['do_consult_price']) : 0.00;
        $process->do_owner = isset($data['do_owner'])  ? (int) $data['do_owner'] : 0;
        $process->do_owner_price = isset($data['do_owner_price'])  ? trim($data['do_owner_price']) : 0.00;
        $process->is_approved =isset($data['is_approved'])  ? trim($data['is_approved']) : 0;
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
