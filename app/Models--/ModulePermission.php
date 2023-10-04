<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ModulePermission
 */
class ModulePermission extends Model
{
    use HasFactory;

    protected $table = 'module_permissions';
    
    public $timestamps = false;
    
    /**
     * insertWithArray
     *
     * @param  mixed $mains
     * @param  mixed $subMains
     * @param  mixed $isReturnId
     * @return void
     */
    public static function insertWithArray($mains=[], $subMains=[] , $roleId=0, $isReturnId=false)
    {
        if (count($mains) > 0) { 
            $user = self::where('roles_id', (int) $roleId)->delete();

            foreach ($mains as $k => $v) {
                $process = new self;

                $process->is_has_menu = (int) 0;
                $process->is_action = (int) 1;
                $process->is_active = (int) 1;
                $process->is_deleted = (int) 0;
                $process->created_at = getDateNow();
                $process->updated_at = getDateNow();
                $process->main_functions_id = (int) $v;
                $process->module_functions_id = (int) 0;
                $process->roles_id = (int) $roleId;
                $process->users_id = (int) 0;
                $process->save();
            }
        }
        
        if (count($subMains) > 0) {
            foreach ($subMains as $k => $v) {
                $process = new self;

                $process->is_has_menu = (int) 0;
                $process->is_action = (int) 1;
                $process->is_active = (int) 1;
                $process->is_deleted = (int) 0;
                $process->created_at = getDateNow();
                $process->updated_at = getDateNow();
                $process->main_functions_id = (int) 0;
                $process->module_functions_id = (int) $v;
                $process->roles_id = (int) $roleId;
                $process->users_id = (int) 0;
                $process->save();
            }
        }
    }
}
