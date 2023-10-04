<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamilies extends Model
{
    use HasFactory;

    protected $table = 'user_families';
    
    public $timestamps = false;

    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->prename = (isset($data['prename'])) ? $data['prename'] : null;
        $process->firstname = (isset($data['firstname'])) ? $data['firstname'] : '';
        $process->lastname = (isset($data['lastname'])) ? $data['lastname'] : '';
        $process->card_no = (isset($data['card_no'])) ? $data['card_no'] : '';
        $process->tax_no = (isset($data['tax_no'])) ? $data['tax_no'] : null;
        $process->contact_info = (isset($data['contact_info'])) ? $data['contact_info'] : '';
        $process->relation_type = (isset($data['relation_type'])) ? $data['relation_type'] : 0;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->users_id = (int) $data['user_id'];
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->prename = (isset($data['prename'])) ? $data['prename'] : null;
        $process->firstname = (isset($data['firstname'])) ? $data['firstname'] : '';
        $process->lastname = (isset($data['lastname'])) ? $data['lastname'] : '';
        $process->card_no = (isset($data['card_no'])) ? $data['card_no'] : '';
        $process->tax_no = (isset($data['tax_no'])) ? $data['tax_no'] : null;
        $process->contact_info = (isset($data['contact_info'])) ? $data['contact_info'] : '';
        $process->relation_type = (isset($data['relation_type'])) ? $data['relation_type'] : 0;
        $process->is_present = (isset($data['is_present'])) ? $data['is_present'] : (int) 0;
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
