<?php

namespace App\Models;

use Hash;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function information()
    {
        return $this->hasOne(\App\Models\UserInformation::class, 'users_id');
    }

    public function duty()
    {
        return $this->hasOne(\App\Models\UserDutyDetail::class, 'users_id');
    }
    
    
    /**
     * getEmployees
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getEmployees($arrConds=[], $isCount=false)
    {
        $conditions = [
            // 'is_employee' => (int) 0,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {
                $info = $row->information;  
                
                $empName = (!empty($info->prename) && is_numeric($info->prename)) ? $prename = DataSetting::getNameDataByValueAndType($info->prename,'prename').' ' : '';
                $empName .= (!empty($info->firstname)) ?  trim($info->firstname) . ' ' . trim($info->lastname).' ' : '';

                // $duty = $row->duty;
                // $department = DataSetting::getNameDataByValueAndType($duty->department_no,'department');
                // $position = DataSetting::getNameDataByValueAndType($duty->position_no,'position');

                $department = '-';

                $position = '-';

                $array[] = [
                    'id' => $row->id,
                    'code' => '-',
                    'name' => $empName,
                    'position' => $position,
                    'department' => $department,
                ];
            }
        }


        return $array;
    }


    public static function getEmployeeDepartment($departmentId=0)
    {
        $conditions = [
            'is_employee' => (int) 1,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {
                $info = $row->information;

                $empName = (!empty($info->prename)) ? $info->prename.'' : '';
                $empName .= trim($info->firstname) . ' ' . trim($info->lastname);

                $duty = $row->duty;
                // $department = DataSetting::getNameDataByValueAndType($duty->department_no,'department');
                // $position = DataSetting::getNameDataByValueAndType($duty->position_no,'position');

                $array[] = [
                    'id' => $row->id,
                    'code' => '-',
                    'name' => $empName,
                    'role_id' => $row->roles_id,
                    'position' => 'เจ้าหน้าที่ (หน่วยงาน)',
                    'department' => '-'
                ];
            }
        }


        return $array;
    }

    public static function insertSubRow($data)
    {
        $process = new self;

        $process->username = trim($data['email']);
        $process->password = Hash::make('1234');
        $process->is_employee = (int) 0;
        $process->is_login = (int) 1;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->logined_at = null;
        $process->created_at = date('Y-m-d H:i:s');
        $process->updated_at = date('Y-m-d H:i:s');
        $process->roles_id = (int) 3;

        if ($process->save()) {
            $insertId = $process->id;

            \App\Models\UserInformation::insertRow($data, $insertId);

            // \App\Models\UserDutyDetail::insertRow($data, $insertId);
        }

        return $insertId;
    }


    public static function insertEmpRow($data, $projectId=0, $isReturnId=false)
    {
        $process = new self;

        $process->username = trim($data['username']);
        $process->password = trim($data['password']);
        $process->is_employee = (int) 0;
        $process->is_login = (int) 1;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->logined_at = null;
        $process->created_at = date('Y-m-d H:i:s');
        $process->updated_at = date('Y-m-d H:i:s');
        $process->roles_id = (int) $data['roles_id'];

        $result = false;
        if ($process->save()) {
            $insertId = $process->id;

            $result = true;

            \App\Models\UserInformation::insertRow($data, $insertId);

            //\App\UserDutyDetail::insertRow($data, $insertId);
            \App\Models\UserToProject::insertRow($insertId, $projectId);
            //insertRow($userId=0, $projectId=0)
        }

        return $result;
    }

    public static function existUsername($str='')
    {
        # code...
        $nCounts = self::where('username', trim($str))->count();
        return $nCounts;
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
