<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToProject extends Model
{
    use HasFactory;

    protected $table = 'user_to_projects';
    
    public $timestamps = false;

    
    /**
     * getEmployeeProjectById
     *
     * @param  mixed $projectId
     * @return void
     */
    public static function getEmployeeProjectById($projectId=0)
    {
        $conditions = [
            'projects_id' => (int) $projectId,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'group_type' => (int) 1
        ];

        $query = self::where($conditions)->orderBy('id','asc')->get();

        $employess = [];
        if (!empty($query)) {
            foreach ($query as $row) {
                $info = \App\Models\UserInformation::where('users_id', (int) $row->users_id)->first();
                $emp = \App\Models\User::find((int) $row->users_id);

                $role = \App\Models\Role::find((int) $emp->roles_id);

                $employess[] = [
                    'id' => $row->users_id,
                    'name' => $info->firstname,
                    'role_name' => $role->name,
                    'role_id' => $emp->roles_id,
                    'mobile' => $info->mobile,
                    'email' => $info->email,
                    'line_id' => '-'
                ];
            }
        }

        return $employess;
    }


    public static function insertRow($userId=0, $projectId=0)
    {
        $process = new self;

        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->group_type = (int) 1;
        $process->created_at = date('Y-m-d H:i:s');
        $process->updated_at = date('Y-m-d H:i:s');
        $process->users_id = (int) $userId;
        $process->projects_id = (int) $projectId;

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
